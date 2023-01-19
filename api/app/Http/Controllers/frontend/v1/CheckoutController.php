<?php

namespace App\Http\Controllers\frontend\v1;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderLog;
use App\Models\OrderPayment;
use App\Models\Shipping;
use Illuminate\Support\Facades\DB;

class CheckoutController extends BaseController
{
    /**
     * Checkout and place order at onece
     */
    public function checkout(Request $request)
    {
        $userId = auth('customer')->id();
        if ($userId == null) {
            return $this->faildResponse('unauthorized', 400);
        }

        $request->merge(['customer_id' => $userId]);
        $latestOrderNumber = Order::orderBy('id', 'DESC')->first();
        if ($latestOrderNumber != "") {
            $existing_orders = $latestOrderNumber->order_number;
        }else {
            $existing_orders = "000000000";
        }
        $order_number = str_pad($existing_orders + 1, 8, "0", STR_PAD_LEFT);

        $order = new Order();
        $order['customer_id'] = $request['customer_id'];
        $order['shipping_id'] = $request['shipping_id'];
        $order['order_number'] = $order_number;
        $order['total_price'] = $request['total_price'];
        $order['status'] = "Pending";
        $order['order_date'] = date('Y-m-d');
        $order['created_at'] = date('Y-m-d H:i:s');
        $order['updated_at'] = date('Y-m-d H:i:s');
        $order->save();

        $order_log = new OrderLog();
        $order_log['order_id'] = $order['id'];
        $order_log['status'] = "Pending";
        $order_log['updated_date'] = date('Y-m-d H:i:s');
        $order_log->save();

        $this->OrderDetail($request, $order['id'], $request['items']);
        $this->Orderpayment($request, $order['id']);

        return $this->successResponse("Order placed successfully", 'checkout success', Response::HTTP_OK);
    }

    public function singleOrdeDetails(Request $request,$id){
        $userId = auth('customer')->id();
        if ($userId==null) {
            return $this->faildResponse('unauthorized', 400);
        }
        $request->merge(['customer_id' => $userId]);
        $data = Order::with('getCustomer:id,fullname,email,contact,photo','getOrderDetails:id,order_id,product_id,qty,saleprice,subtotal,shipping_charge,status,payment_method',
        'getOrderDetails.products:id,name,mainimage',
         'orderpayments:id,order_id,customer_id,shipping_id,total_amount,paid_amount,due_amount,discount,payment_method,shipping_charge,delivery_date,status',
         'shipping_address:id,address,division,district,area',
         'shipping_address.division:id,name',
         'shipping_address.district:id,name',
         'shipping_address.area:id,name',
        'orderLog:id,order_id,status,updated_date' )->where('id',$id)->where('customer_id', $request->customer_id)
        ->select('id','customer_id','shipping_id','order_number','total_price','status','order_date','delivery_date')->first();

        return $this->successResponse($data, 'Single Order details', Response::HTTP_OK);
    }


    public function OrderDetail($request, $lastOrderId, $products)
    {
        foreach ($products as $odp) {
            $oderTotalShippingCost = $request->shipping_cost;
            $od = new OrderDetail();
            $od->order_id = $lastOrderId;
            $od->customer_id = $request->user_id;
            $od->product_id = $odp['product_id'];
            $od->qty = $odp['qty'];
            $od->saleprice = $odp['price'];
            $od->subtotal = $odp['qty'] * $odp['price'];
            $od->shipping_charge = $oderTotalShippingCost;
            $od->shipping_id = $request->shipping_id;
            $od->payment_method = $request->payment_method;
            $od->status = "pending";
            $od->created_at = date('Y-m-d H:i:s');
            $od->updated_at = date('Y-m-d H:i:s');
            $od->save();

            $proInStock = DB::table('inventories')->select('current_qty')->where('product_id', $odp['product_id'])->first();
            if ($proInStock != "") {
                $arrayInventory = array('current_qty' => intval($proInStock->current_qty) - intval($odp['qty']));
                DB::table('inventories')->where('product_id', $odp['product_id'])->update($arrayInventory);
            }
        }
    }
    public function Orderpayment($request, $lastOrderId)
    {
        $oderTotalShippingCost = $request->shipping_cost;
        $oderTotalProductCost = $request->total_price;

        $data = array();
        $data['customer_id'] = $request->user_id;
        $data['order_id']  = $lastOrderId;
        $data['total_amount'] = $oderTotalProductCost + $oderTotalShippingCost;
        $data['discount'] = 0;
        $data['shipping_charge'] = $oderTotalShippingCost;
        $data['status'] = "Unpaid";
        $data['updated_by'] = $request->user_id;
        $data['created_by'] = $request->user_id;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        OrderPayment::insert($data);
    }


    public function shipping(Request $request)
    {
        if (!$request->access_token || $request->access_token == "" || empty($request->access_token)) {
            return $this->faildResponse('unauthorized', 400);
        } else {
            $token_info = json_decode(base64_decode($request->access_token));
            if (Customer::where('id', $token_info->id)->where('token', $request->access_token)->first()) {
                $request->merge(['customer_id' => $token_info->id]);
            } else {
                return $this->faildResponse('unauthorized', 400);
            }
        }
        $request->merge(['created_by' => $request->customer_id]);
        $request->merge(['updated_by' => $request->customer_id]);
        $request->merge(['created_at' => date('Y-m-d H:i:s')]);
        $request->merge(['updated_at' => date('Y-m-d H:i:s')]);

        // dd($request->all());
        $data = Shipping::create($request->except(['access_token']));
        return $this->successResponse($data, 'Shipping details', Response::HTTP_OK);
    }
    public function orderlist(Request $request)
    {
        $userId = auth('customer')->id();
        if ($userId==null) {
            return $this->faildResponse('unauthorized', 400);
        }
        $request->merge(['customer_id' => $userId]);
        $data = Order::with('getOrderDetails:id,order_id,product_id,qty,saleprice,subtotal,shipping_charge,status,payment_method', 'orderpayments:id,order_id,customer_id,shipping_id,total_amount,paid_amount,due_amount,discount,payment_method,shipping_charge,delivery_date,status')
            ->where('customer_id', $request->customer_id)
            ->select('id','customer_id','shipping_id','order_number','total_price','status','order_date','delivery_date')->get();

        return $this->successResponse($data, 'Order details', Response::HTTP_OK);
    }
    // public function orderLog(Request $request){
    //     $userId = auth('customer')->id();
    //     if ($userId==null) {
    //         return $this->faildResponse('unauthorized', 400);
    //     }

    //     $data = OrderLog::where('order_id', $request->order_id)->select('id','order_id','status','updated_date')->orderBy('updated_date', 'ASC')->get();

    //     return $this->successResponse($data, 'Order details', Response::HTTP_OK);
    // }
}
