<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\DeliveryManagement;
use App\Models\DeliveryInvoice;
use App\Models\AssignPickup;
use App\Models\DeliveryStatus;
use Illuminate\Http\Request;
use DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Hub;
use App\Models\Merchant;
use App\Models\Rider;

use function PHPSTORM_META\type;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return OrderResource
     */
    public function index()
    {
        $user = Auth::user();
        $roleid = $user->user_type;


        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = Order::with('merchant', 'merchant.business', 'store', 'plan', 'returnplan', 'deliverStatus', 'district', 'upozila')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $data = Order::with('merchant', 'merchant.business', 'store', 'plan', 'returnplan', 'deliverStatus', 'district', 'upozila')->orderBy('id', 'DESC')->get();
        }
        return $this->successResponse(OrderResource::collection($data), 'All Order List', Response::HTTP_OK);
    }

    public function indexMerchant(Request $request)
    {
        $merchantId = auth('merchant')->id();
        $query = Order::query();
        $query->with('merchant', 'merchant.business:id,name,merchant_id', 'store', 'deliverStatus', 'district', 'upozila')->where('merchant_id', $merchantId);


        if ($request->consignment_id != "") {
            $query->where("consignment_id", $request->consignment_id);
        }

        $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse(OrderResource::collection($data), 'All Order List', Response::HTTP_OK);
    }

    public function filter($filterdata = '', $type = '')
    {
        $query = Order::query();
        if ($type!='' && $type=='csv') {
            if ($filterdata!="") {
                $merchant_id = $filterdata['merchant_id'] ??= '';
                $formdate = $filterdata['formdate'] ??= '';
                $todate = $filterdata['todate'] ??= '';
                $keyword = $filterdata['keyword'] ??= '';
                $status = $filterdata['status'] ??= '';
            } else {
                $merchant_id = '';
                $formdate = '';
                $todate = '';
                $keyword = '';
                $status = '';
            }
        } else {
            $merchant_id = request()->merchant_id;
            $formdate = request()->formdate;
            $todate = request()->todate;
            $keyword = request()->keyword;
            $status = request()->status;
        }


        if ($keyword != "") {
            $search = $keyword;
            $query->where(function ($query) use ($search) {
                $query->where('customer_mobile', 'LIKE', '%' . $search . '%')
                    ->orWhere('merchant_order_id', 'LIKE', '%' . $search . '%')
                    ->orWhere('collectable_amount', 'LIKE', '%' . $search . '%')
                    ->orWhere('delivery_charge', 'LIKE', '%' . $search . '%')
                    ->orWhere('total_return_cost', 'LIKE', '%' . $search . '%')
                    ->orWhere('cod_charge', 'LIKE', '%' . $search . '%');
            });
        }

        if ($merchant_id != "") {
            $query->where('merchant_id', $merchant_id);
        }

        if ($status != "") {
            $query->where('status', $status);
        }


        if ($formdate != "" && $todate != "") {
            $query->whereDate('created_at', '<=', $todate);
            $query->whereDate('created_at', '>=', $formdate);
        } elseif ($formdate == "" && $todate != "") {
            $query->whereDate('created_at', '<=', $todate);
        } elseif ($formdate != "" && $todate == "") {
            $query->whereDate('created_at', '>=', $formdate);
        }


        $user = Auth::user();
        $roleid = $user->user_type;

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = $query->with('merchant', 'merchant.business', 'store', 'plan', 'returnplan', 'deliverStatus', 'district', 'upozila')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $data = $query->with('merchant', 'merchant.business', 'store', 'plan', 'returnplan', 'deliverStatus', 'district', 'upozila')->orderBy('id', 'DESC')->get();
        }

        if ($type!='' && $type=='csv') {
            return $data;
        } else {
            return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
        }
    }


    public function merchantFilter($filterdata = '', $type = '')
    {
        // $data = $request->all();
        $query = Order::query();
        if ($type!='' && $type=='csv') {
            if ($filterdata!="") {
                $merchant_id = $filterdata['merchant_id'] ??= '';
                $formdate = $filterdata['formdate'] ??= '';
                $todate = $filterdata['todate'] ??= '';
                $keyword = $filterdata['keyword'] ??= '';
                $status = $filterdata['status'] ??= '';
            } else {
                $merchant_id = '';
                $formdate = '';
                $todate = '';
                $keyword = '';
                $status = '';
            }
        } else {
            $merchant_id = request()->merchant_id;
            $formdate = request()->formdate;
            $todate = request()->todate;
            $keyword = request()->keyword;
            $status = request()->status;
        }


        if ($keyword != "") {
            $search = $keyword;
            $query->where(function ($query) use ($search) {
                $query->where('customer_mobile', 'LIKE', '%' . $search . '%')
                    ->orWhere('merchant_order_id', 'LIKE', '%' . $search . '%')
                    ->orWhere('collectable_amount', 'LIKE', '%' . $search . '%')
                    ->orWhere('delivery_charge', 'LIKE', '%' . $search . '%')
                    ->orWhere('total_return_cost', 'LIKE', '%' . $search . '%')
                    ->orWhere('cod_charge', 'LIKE', '%' . $search . '%');
            });
        }

        if ($merchant_id != "") {
            $query->where('merchant_id', $merchant_id);
        }

        if ($status != "") {
            $query->where('status', $status);
        }


        if ($formdate != "" && $todate != "") {
            $query->whereDate('created_at', '<=', $todate);
            $query->whereDate('created_at', '>=', $formdate);
        } elseif ($formdate == "" && $todate != "") {
            $query->whereDate('created_at', '<=', $todate);
        } elseif ($formdate != "" && $todate == "") {
            $query->whereDate('created_at', '>=', $formdate);
        }

        $merchantId = auth('merchant')->id();
        $data = $query->where('merchant_id', $merchantId)->with('merchant', 'store', 'deliverStatus', 'district', 'upozila')->orderBy('id', 'DESC')->get();

        if ($type!='' && $type=='csv') {
            return $data;
        } else {
            return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
        }
    }
    /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request, Order $hub)
    {
         $validator = Validator::make($request->all(), [
            'merchant_order_id' => 'required|unique:App\Models\Order,merchant_order_id'
        ]);

         if ($validator->fails()) {
            $error = $validator->errors();
        return $this->errorRessponse('Failed', $error, Response::HTTP_CREATED);
        }

        $getLastId = Order::orderBy('id','DESC')->first();
        if($getLastId!=""){
            $newConsignmentId = str_pad($getLastId->consignment_id+1, 6, 0, STR_PAD_LEFT);
        }
        else{
            $newConsignmentId = str_pad(1, 6, 0, STR_PAD_LEFT);
        }

        $request['consignment_id'] = $newConsignmentId;
        $request['status'] = 'Accepted';

        $data= $hub->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }*/


    public function store_merchant(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'unique:stores,email',


        ]);
        if ($validator->fails()) {
            $error = $validator->errors();
            foreach ($error->toArray() as $err) {
                $errmsg[] = $err;
            }
            return $this->errorRessponse('Failed', $errmsg, Response::HTTP_CREATED);
        }


        $merchantId = auth('merchant')->id();
        $data = json_decode(file_get_contents('php://input'), true);


        $getLastId = Order::orderBy('id', 'DESC')->first();
        if ($getLastId != "") {
            $newConsignmentId = str_pad($getLastId->consignment_id + 1, 6, 0, STR_PAD_LEFT);
        } else {
            $newConsignmentId = str_pad(1, 6, 0, STR_PAD_LEFT);
        }


        $orderdata['consignment_id']             = $newConsignmentId;
        $orderdata['status']                     = 25;

        $orderdata['total_cost']                =        $data['total_cost'] ? $data['total_cost'] : 0;
        $orderdata['delivery_charge']                =        $data['delivery_cost'] ? $data['delivery_cost'] : 0;
        $orderdata['weight_charge']                =        $data['weight_cost'] ? $data['weight_cost'] : 0;
        $orderdata['cod_charge']                =        $data['cod_cost'] ? $data['cod_cost'] : 0;
        $orderdata['total_return_cost']                =        $data['total_return_cost'] ? $data['total_return_cost'] : 0;
        $orderdata['weight']                      =       $data['weight'] ? $data['weight'] : 0;


        $orderdata['merchant_id']             =        $merchantId;
        //$orderdata['store_id']                 =        $data['store_id']==""?0:$data['store_id'];
        $orderdata['time']=                             $data['time'];
        $orderdata['store_id']                 =        $data['store_id'];
        // $orderdata['total_cost']                =        isset($data['total_cost']) ? $data['total_cost'] : 0;
        // $orderdata['total_cost']=0;
        $orderdata['store_id']                   =        $data['store_id'];
        $orderdata['delivery_date']              =        $data['delivery_date'];
        // $orderdata['delivery_plan_id']           =        $data['delivery_plan_id'];
        // $orderdata['return_plan_id']             =        $data['return_plan_id'] ? $data['return_plan_id'] : 0;
        $orderdata['merchant_order_id']          =        $data['merchant_order_id'];
        $orderdata['partialdelivery']            =        $data['partialdelivery'];
        //$orderdata['package_description']        =      $data['package_description'];
        $orderdata['instruction']                =        $data['instruction'];
        //$orderdata['delivery_note']              =      $data['delivery_note'];
        $orderdata['collectable_amount']         =        $data['collectable_amount'] ? $data['collectable_amount'] : '0';
        $orderdata['customer_name']              =        $data['customer_name'];
        $orderdata['customer_mobile']            =        $data['customer_mobile'];
        $orderdata['customer_email']             =        $data['customer_email'];
        $orderdata['customer_address']           =        $data['customer_address'];
        //$orderdata['customer_zone']              =        $data['customer_zone'];
        //$orderdata['customer_latitude']          =        $data['customer_latitude'];
        //$orderdata['customer_longtitude']        =        $data['customer_longtitude'];
        $orderdata['created_by']                 =         $merchantId;
        $orderdata['partner_id']                 =         1;
        $orderdata['district']                 =         $data['district'];
        $orderdata['upozila']                 =         $data['area'];
        $order->create($orderdata);
        $lastOrderid = DB::getPdo()->lastInsertId();

        if (!empty($data['product_id']) && count($data['product_id']) > 0) {
            $products = $data['product_id'];
            $quantities = $data['quantity'];
            foreach ($products as $k => $item) {
                $orderproducts = new OrderProduct();
                $orderproducts->order_id =  $lastOrderid;
                $orderproducts->product_id = $products[$k];
                $orderproducts->quantity = $quantities[$k];
                $orderproducts->partner_id = 1;
                $orderproducts->created_by = $merchantId;
                $responsedata = $orderproducts->save();
            }
        } else {
            $responsedata = 'Please select product';
        }

        return $this->successResponse($responsedata, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function store(Request $request, Order $order)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        // return $data;
        $getLastId = Order::orderBy('id', 'DESC')->first();
        if ($getLastId != "") {
            $newConsignmentId = str_pad($getLastId->consignment_id + 1, 6, 0, STR_PAD_LEFT);
        } else {
            $newConsignmentId = str_pad(1, 6, 0, STR_PAD_LEFT);
        }

        $orderdata['consignment_id']             = $newConsignmentId;
        $orderdata['status']                     =        25;

        $orderdata['total_cost']                =        $data['total_cost'] ? $data['total_cost'] : 0;
        $orderdata['delivery_charge']                =        $data['delivery_cost'] ? $data['delivery_cost'] : 0;
        $orderdata['weight_charge']                =        $data['weight_cost'] ? $data['weight_cost'] : 0;
        $orderdata['cod_charge']                =        $data['cod_cost'] ? $data['cod_cost'] : '';
        $orderdata['total_return_cost']                =        $data['total_return_cost'] ? $data['total_return_cost'] : 0;
        $orderdata['weight']                      =       $data['weight'] ? $data['weight'] : 0;



        $orderdata['merchant_id']                =        $data['merchant_id'];
        $orderdata['store_id']                   =        $data['store_id'];
        $orderdata['time']                        =        $data['time'];
        $orderdata['delivery_date']              =        $data['delivery_date'];
        $orderdata['delivery_plan_id']           =        $data['delivery_plan_id'];
        $orderdata['return_plan_id']             =        $data['return_plan_id'] ? $data['return_plan_id'] : 0;
        $orderdata['merchant_order_id']          =        $data['merchant_order_id'];
        $orderdata['partialdelivery']            =        $data['partialdelivery'];
        //$orderdata['package_description']        =        $data['package_description'];
        $orderdata['instruction']                =        $data['instruction'];
        //$orderdata['delivery_note']              =        $data['delivery_note'];
        $orderdata['collectable_amount']         =        $data['collectable_amount'] ? $data['collectable_amount'] : '0';
        $orderdata['customer_name']              =        $data['customer_name'];
        $orderdata['customer_mobile']            =        $data['customer_mobile'];
        $orderdata['customer_email']             =        $data['customer_email'];
        $orderdata['customer_address']           =        $data['customer_address'];
        //$orderdata['customer_zone']              =        $data['customer_zone'];
        //$orderdata['customer_latitude']          =        $data['customer_latitude'];
        //$orderdata['customer_longtitude']        =        $data['customer_longtitude'];
        $orderdata['created_by']                 =         $data['created_by'];
        $orderdata['partner_id']                 =         1;
        $orderdata['district']                 =         $data['district'];
        $orderdata['upozila']                 =         $data['area'];
        $order->create($orderdata);
        $lastOrderid = DB::getPdo()->lastInsertId();



        if (!empty($data['product_id']) && count($data['product_id']) > 0) {
            $products = $data['product_id'];
            $quantities = $data['quantity'];
            foreach ($products as $k => $item) {
                $orderproducts = new OrderProduct();
                $orderproducts->order_id =  $lastOrderid;
                $orderproducts->product_id = $products[$k];
                $orderproducts->quantity = $quantities[$k];
                $orderproducts->partner_id = 1;
                $orderproducts->created_by = $data['created_by'];
                $responsedata = $orderproducts->save();
            }
        } else {
            $responsedata = 'Please select product';
        }

        return $this->successResponse($responsedata, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
        $hub = Order::with('merchant', 'store')->find($id);
        return $this->successResponse($hub, 'Order List', Response::HTTP_OK);
    }

    public function showMerchant($id)
    {
        $merchantId = auth('merchant')->id();
        $hub = Order::with('merchant', 'merchant.business:id,name,merchant_id', 'store')->where('merchant_id', $merchantId)->find($id);
        return $this->successResponse($hub, 'Order List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $hub
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hub = Order::with('merchant', 'store')->find($id);
        return $this->successResponse($hub, 'Specific Order Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $hub
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);


        $orderdata['total_cost']                =        $data['total_cost'] ? $data['total_cost'] : '0';
        $orderdata['delivery_charge']                =        $data['delivery_cost'] ? $data['delivery_cost'] : '0';
        $orderdata['weight_charge']                =        $data['weight_cost'] ? $data['weight_cost'] : '0';
        $orderdata['cod_charge']                =        $data['cod_cost'] ? $data['cod_cost'] : '0';
        $orderdata['total_return_cost']                =        $data['total_return_cost'] ? $data['total_return_cost'] : '0';
        $orderdata['weight']                      =       $data['weight'] ? $data['weight'] : 0;


        $orderdata['merchant_id']                =        $data['merchant_id'];
        $orderdata['store_id']                   =        $data['store_id'];
        $orderdata['time']                   =        $data['time'];
        $orderdata['payment_status']              =        $data['payment_status'];
        $orderdata['delivery_date']              =        $data['delivery_date'];
        $orderdata['delivery_plan_id']           =        $data['delivery_plan_id'];
        $orderdata['return_plan_id']             =        $data['return_plan_id'] ? $data['return_plan_id'] : 0;
        $orderdata['merchant_order_id']          =        $data['merchant_order_id'];
        $orderdata['partialdelivery']            =        $data['partialdelivery'];

        //$orderdata['package_description']        =        $data['package_description'];
        $orderdata['instruction']                =        $data['instruction'];
        //$orderdata['delivery_note']              =        $data['delivery_note'];
        $orderdata['collectable_amount']         =        $data['collectable_amount'] ? $data['collectable_amount'] : '0';
        $orderdata['customer_name']              =        $data['customer_name'];
        $orderdata['customer_mobile']            =        $data['customer_mobile'];
        $orderdata['customer_email']             =        $data['customer_email'];
        $orderdata['customer_address']           =        $data['customer_address'];

        //$orderdata['customer_zone']              =        $data['customer_zone'];
        //$orderdata['customer_latitude']          =        $data['customer_latitude'];
        //$orderdata['customer_longtitude']        =        $data['customer_longtitude'];

        $orderdata['updated_by']                 =         $data['updated_by'];
        $orderdata['partner_id']                 =         1;

        $orderdata['district']                 =         $data['district'];
        $orderdata['upozila']                 =         $data['area'];

        // return $orderdata;
        $order = Order::find($id);
        $order->update($orderdata);



        if (!empty($data['product_id']) && count($data['product_id']) > 0) {
            $products = $data['product_id'];
            $quantities = $data['quantity'];
            foreach ($products as $k => $item) {
                $orderproducts = new OrderProduct();
                $orderproducts->order_id =  $id;
                $orderproducts->product_id = $products[$k];
                $orderproducts->quantity = $quantities[$k];
                $orderproducts->partner_id = $data['partner_id'];
                $orderproducts->updated_by = $data['updated_by'];
                $responsedata = $orderproducts->save();
            }
        } else {
            $responsedata = 'Please select product';
        }


        return $this->successResponse($responsedata, 'Order Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $hub
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $hub)
    {
        $result = $hub->delete();
        return $this->successResponse($result, 'Order Deleted', Response::HTTP_OK);
    }


    public function parcelTracking(Request $request)
    {
        $merchantId = auth('merchant')->id();
        $query = DeliveryManagement::query();
        $query->with(
            'order:id,consignment_id,customer_name,created_at'
        )->select(
            'id',
            'order_id',
            'collectable_amount',
            'payment_status'
        )->where('merchant_id', $merchantId);

        $query->whereHas("order", function ($subQuery) use ($request) {
            $subQuery->where("consignment_id", "=", $request->consignment_id);
        });

        $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse(OrderResource::collection($data), 'Order details', Response::HTTP_OK);
    }

    public function acceptedList(Request $request)
    {
        $merchantId = auth('merchant')->id();

        // $data = Order::where('merchant_id', $merchantId)->where('status', '=', 'Accepted')->select("id", "created_at", "consignment_id", "customer_name", "collectable_amount",)->orderBy('id', 'DESC')->get();
        $query = DeliveryManagement::query();
        $query->with(
            'order:id,consignment_id,customer_name,created_at'
        )->select(
            'id',
            'order_id',
            'collectable_amount',
            'payment_status'
        )->where('merchant_id', $merchantId)->where('status', '=', 'Accepted');

        if ($request->merchant_order_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("merchant_order_id", "=", $request->merchant_order_id);
            });
        }
        if ($request->consignment_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("consignment_id", "=", $request->consignment_id);
            });
        }

        $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse(OrderResource::collection($data), 'Accepted Order List', Response::HTTP_OK);
    }
    public function pendingList(Request $request)
    {
        $merchantId = auth('merchant')->id();
        // $data = Order::where('merchant_id', $merchantId)->where('status', '=', 'Pending')->select("id", "created_at", "consignment_id", "customer_name", "collectable_amount",)->orderBy('id', 'DESC')->get();
        $query = DeliveryManagement::query();
        $query->with(
            'order:id,consignment_id,customer_name,created_at'
        )->select(
            'id',
            'order_id',
            'collectable_amount',
            'payment_status'
        )->where('merchant_id', $merchantId)->where('status', '=', 'Pending');
        if ($request->merchant_order_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("merchant_order_id", "=", $request->merchant_order_id);
            });
        }
        if ($request->consignment_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("consignment_id", "=", $request->consignment_id);
            });
        }

        $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse(OrderResource::collection($data), 'Pending Order List', Response::HTTP_OK);
    }
    public function InTransitList(Request $request)
    {
        $merchantId = auth('merchant')->id();
        $query = DeliveryManagement::query();
        $query->with(
            'order:id,consignment_id,customer_name,created_at'
        )->select(
            'id',
            'order_id',
            'collectable_amount',
            'payment_status'
        )->where('merchant_id', $merchantId)->where('status', '=', 'In Transit');

        if ($request->merchant_order_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("merchant_order_id", "=", $request->merchant_order_id);
            });
        }
        if ($request->consignment_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("consignment_id", "=", $request->consignment_id);
            });
        }

        $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse(OrderResource::collection($data), 'accepted Order List', Response::HTTP_OK);
    }
    public function DeliveredList(Request $request)
    {
        $merchantId = auth('merchant')->id();
        $query = DeliveryManagement::query();
        $query->with(
            'order:id,consignment_id,customer_name,created_at'
        )->select(
            'id',
            'order_id',
            'collectable_amount',
            'payment_status'
        )->where('merchant_id', $merchantId)->where('status', '=', 'Delivered');

        if ($request->merchant_order_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("merchant_order_id", "=", $request->merchant_order_id);
            });
        }
        if ($request->consignment_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("consignment_id", "=", $request->consignment_id);
            });
        }
        $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse(OrderResource::collection($data), 'accepted Order List', Response::HTTP_OK);
    }
    public function ReturnedList(Request $request)
    {
        $merchantId = auth('merchant')->id();
        $query = DeliveryManagement::query();
        $query->with(
            'order:id,consignment_id,customer_name,created_at'
        )->select(
            'id',
            'order_id',
            'collectable_amount',
            'payment_status'
        )->where('merchant_id', $merchantId)->where('status', '=', 'Returned');
        if ($request->merchant_order_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("merchant_order_id", "=", $request->merchant_order_id);
            });
        }
        if ($request->consignment_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("consignment_id", "=", $request->consignment_id);
            });
        }

        $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse(OrderResource::collection($data), 'accepted Order List', Response::HTTP_OK);
    }

    public function OnHoldList(Request $request)
    {
        $merchantId = auth('merchant')->id();
        $query = DeliveryManagement::query();
        $query->with(
            'order:id,consignment_id,customer_name,created_at'
        )->select(
            'id',
            'order_id',
            'collectable_amount',
            'payment_status'
        )->where('merchant_id', $merchantId)->where('status', '=', 'On Hold');
        if ($request->merchant_order_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("merchant_order_id", "=", $request->merchant_order_id);
            });
        }
        if ($request->consignment_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("consignment_id", "=", $request->consignment_id);
            });
        }

        $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse(OrderResource::collection($data), 'accepted Order List', Response::HTTP_OK);
    }

    public function homedeliveryinfomerchant()
    {
        $merchantId = auth('merchant')->id();
        $data = DeliveryManagement::with('deliverStatus', 'rider', 'order')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->take(5)->get();

        return $this->successResponse($data, 'Delivery List', Response::HTTP_OK);
    }
    public function homedeliveryinfo()
    {
        $user = Auth::user();
        $roleid = $user->user_type;

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = DeliveryManagement::with('merchant', 'merchant.business', 'deliverStatus', 'rider', 'order')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->take(5)->get();
        } else {
            $data = DeliveryManagement::with('hub', 'merchant', 'merchant.business', 'deliverStatus', 'rider', 'order')->orderBy('id', 'DESC')->take(5)->get();
        }

        return $this->successResponse($data, 'Delivery List', Response::HTTP_OK);
    }

    public function homeListMerchant()
    {
        $merchantId = auth('merchant')->id();
        $allstatus = DeliveryStatus::withCount('totalOrder')->where('type', 'delivery')->orderBy('id', 'DESC')->get();
        foreach ($allstatus as $status) {
            $totalStatus = DeliveryManagement::where('status', $status->id)
                ->where('merchant_id', $merchantId)->count('id');

            $finaldata[] = array(
                "id" => $status->id,
                "name" => $status->name,
                "total" => $totalStatus,
            );
        }
        // return $finaldata;

        //     // $status= DeliveryStatus::withCount('totalOrder')->whereHas("totalOrder", function ($subQuery) use ($merchantId) {
        //     //     $subQuery->where("merchant_id", "=", $merchantId);
        //     // })->orderBy('id', 'DESC')->get();


        //     $status= DeliveryStatus::withCount('totalOrder')->orderBy('id', 'DESC')->get();

        // // dd($status);
        $pickup = AssignPickup::where('merchant_id', $merchantId);
        $order = Order::where('merchant_id', $merchantId);


        $picked = 0;
        $unpicked = 0;
        $payableamount = 0;
        $paidamount = 0;




        // $invoicedata = DeliveryInvoice::select('collection',)->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();

        // if ($invoicedata) {
        //     foreach ($invoicedata as $d) {
        //         $paidamount += $d->collection;

        //     }
        // }



        //DB::raw('SUM(collection) AS totalCollection'),
        //DB::raw('SUM(cod_charge) AS totalCod'),
        //DB::raw('SUM(delivery_charge) AS totalDeliveryCharge')

        $invoicedata = DB::table('delivery_invoices')
            ->select(
                DB::raw('SUM(collection) AS paidAmount'),
                DB::raw('SUM(total_charge) AS total_charge')
            )
            ->where('merchant_id', $merchantId)
            ->first();

        if ($pickup) {
            foreach ($pickup->get() as $p) {
                if ($p->status == 12) {
                    $picked++;
                }
                if ($p->status == 13) {
                    $unpicked++;
                }
            }
            $assignedOrder = $pickup->count();
        }

        $totalOrder = $order->count();
        $invoicedata->payableamount =  0;
        $data = [

            'picked' => $picked,
            'unpicked' => $unpicked,
            //'paidamount' => $paidamount,
            //'payableamount' => $payableamount,
            'assignedOrder' => $assignedOrder,
            'totalOrder' => $totalOrder,
            'status' => $finaldata,
            'invoice' => $invoicedata,
        ];


        return $this->successResponse($data, 'Home List', Response::HTTP_OK);
    }

    public function homeNotifyMerchant()
    {
        $merchantId = auth('merchant')->id();
        $totalOrder = Order::where('merchant_id', $merchantId)->where('status', 25)->count();

        $data = [
            'torder' => $totalOrder,
        ];

        return $this->successResponse($data, 'Home Notify List', Response::HTTP_OK);
    }



    public function homeList()
    {
        $user = Auth::user();
        $roleid = $user->user_type;
        $allstatus = DeliveryStatus::where('type', 'delivery')->orderBy('id', 'DESC')->get();
        $thub=0;
        $hub_name='';


        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id", "name")->first();
            $hub_name=$hub->name;
            // $data = DeliveryManagement::with('merchant', 'rider', 'order','deliverStatus')->where('status','<>',27)->where("hub_id", "=", $user->id)->orderBy('id', 'DESC')->get();
            $tmerchent = Merchant::where("hub_id", "=", $hub->id)->where('status', 1)->count();
            $tmerchentRequest = Merchant::where("hub_id", "=", $hub->id)->where('status', 0)->count();
            $trider = Rider::with('hub')->where('hub_id', '=', $hub->id)->where('status', 1)->count();
            $triderRequest = Rider::with('hub')->where('hub_id', '=', $hub->id)->where('status', 0)->count();

            $torder = Order::whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->count();
            $torderRequest = Order::whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->where('status', 25)->count();



            foreach ($allstatus as $status) {
                $totalStatus = DeliveryManagement::where('status', $status->id)->whereHas("merchant", function ($subQuery) use ($hub) {
                    $subQuery->where("hub_id", "=", $hub->id);
                })->count();

                $finaldata[] = array(
                    "id" => $status->id,
                    "name" => $status->name,
                    "total" => $totalStatus,
                );
            }
        } else {
            $tmerchent = Merchant::where('status', 1)->count();
            $tmerchentRequest = Merchant::where('status', 0)->count();
            $trider = Rider::with('hub')->where('status', 1)->count();
            $triderRequest = Rider::with('hub')->where('status', 0)->count();

            $torder = Order::count();
            $torderRequest = Order::where('status', 25)->count();
            $thub=Hub::count();

            foreach ($allstatus as $status) {
                $totalStatus = DeliveryManagement::where('status', $status->id)->count();

                $finaldata[] = array(
                    "id" => $status->id,
                    "name" => $status->name,
                    "total" => $totalStatus,
                );
            }
        }



        $data = [
            'torder'=>$torder,
            'torderRequest'=>$torderRequest,
            'tmerchent'=>$tmerchent,
            'tmerchentRequest'=>$tmerchentRequest,
            'trider'=>$trider,
            'triderRequest'=>$triderRequest,
            'thub'=>$thub,
            'status' => $finaldata,
            'hubName' => $hub_name,
        ];


        return $this->successResponse($data, 'Home List', Response::HTTP_OK);
    }

    public function homeNotification()
    {
        $user   = Auth::user();
        $roleid = $user->user_type;

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id", "name")->first();

            $torder    = Order::whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->where('status', 25)->count();
            $tmerchent = Merchant::where("hub_id", "=", $hub->id)->where('status', 0)->count();
            $trider    = Rider::with('hub')->where('hub_id', '=', $hub->id)->where('status', 0)->count();
        } else {
            $torder    = Order::where('status', 25)->count();
            $tmerchent = Merchant::where('status', 0)->count();
            $trider    = Rider::with('hub')->where('status', 0)->count();
        }

        $data = [
            'torder'=>$torder,
            'tmerchent'=>$tmerchent,
            'trider'=>$trider,
        ];

        return $this->successResponse($data, 'Home Notify List', Response::HTTP_OK);
    }





    public function common_order_details(Request $request)
    {
        $merchantId = auth('merchant')->id();
        $query = DeliveryManagement::query();
        $query->with(
            'order:id,consignment_id,collectable_amount,created_at,customer_name,customer_mobile,customer_email,customer_address',
            'order.orderlog:id,order_id,updated_date,status',
            'rider:id,name,zone,phone'
        )->select(
            'id',
            'merchant_id',
            'delivery_date',
            'order_id',
            'rider_id'
        )->where('merchant_id', $merchantId)->where('id', $request->id);

        $data = $query->orderBy('id', 'DESC')->first();
        $dt = date('Y-m-d', strtotime($data->order->created_at));
        $data['order']['order_date'] = $dt;


        /// return $dt;

        // $data[0]->order->created_at=date("l, d F Y", strtotime($data[0]->order->created_at));
        // $data[0]->delivery_date=date("Y-m-d H:i:s", $data[0]->delivery_date);
        // return $data[0]->delivery_date;
        // dd($data);


        return $this->successResponse($data, 'accepted Order List', Response::HTTP_OK);
    }
    public function order_amount_update(Request $request)
    {
        $order_id = $request->order_id;
        $amount = $request->amount;
        $order = Order::find($order_id);
        $order->update(['collectable_amount' => $amount]);
        DeliveryManagement::where('order_id', $order_id)->update(['collectable_amount' => $amount]);



        return $this->successResponse($order_id, 'Updated Successfully', Response::HTTP_CREATED);
    }




    /////////////delivery list for merchant app /////////////////////////
    public function DeliveryList(Request $request)
    {
        $merchantId = auth('merchant')->id();
        $status = $request->status_id;
        // $data = Order::where('merchant_id', $merchantId)->where('status', '=', 'Accepted')->select("id", "created_at", "consignment_id", "customer_name", "collectable_amount",)->orderBy('id', 'DESC')->get();
        $query = DeliveryManagement::query();
        $query->with(
            'order:id,consignment_id,merchant_order_id,customer_name,created_at'
        )->select(
            'id',
            'order_id',
            'collectable_amount',
            'payment_status',
            'invoice'
        )->where('merchant_id', $merchantId)->where('status', $status);

        if ($request->merchant_order_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("merchant_order_id", "=", $request->merchant_order_id);
            });
        }
        if ($request->consignment_id != "") {
            $query->whereHas("order", function ($subQuery) use ($request) {
                $subQuery->where("consignment_id", "=", $request->consignment_id);
            });
        }

        $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse(OrderResource::collection($data), 'Accepted Order List', Response::HTTP_OK);
    }
}
