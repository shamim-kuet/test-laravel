<?php

namespace App\Http\Controllers\V1;

use App\Models\Order;
use App\Models\CashHandover;
use Illuminate\Http\Request;
use App\Models\DeliveryInvoice;
use App\Models\DeliveryInvoiceDetails;
use App\Models\DeliveryManagement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\DeliveryInvoiceResource;
use App\Http\Resources\DeliveryManagementResource;
use Illuminate\Support\Facades\Auth;
use App\Models\Hub;

class InvoiceGenerateController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return DeliveryInvoiceResource
     */
    // public function index()
    // {
    //     $data = CashHandover::with('rider','order')->where('status','!=','Generated')->orderBy('id','DESC')->get();
    // 	return $this->successResponse(DeliveryInvoiceResource::collection($data), 'All DeliveryInvoice List', Response::HTTP_OK);

    // }

    public function index()
    {
        $user = Auth::user();
        $roleid = $user->user_type;

        $orderids=DeliveryInvoiceDetails::pluck('order_id');
        $statuses = array(32,17);
        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();

            $data = DeliveryManagement::with('merchant', 'merchant.business')->whereNotIn('order_id', $orderids)
                ->whereHas("merchant", function ($subQuery) use ($hub) {
                    $subQuery->where("hub_id", "=", $hub->id);
                })->whereIn('status', $statuses)
                ->select(
                    'merchant_id',
                    DB::raw("SUM(received_amount) as total_received"),
                    DB::raw("SUM(delivery_charge) as total_deliverycharge"),
                    DB::raw("SUM(total_return_cost) as total_returncharge"),
                    DB::raw("SUM(cod_charge) as total_codcharge"),
                    DB::raw("SUM(weight_charge) as total_weight_charge"),
                    DB::raw("SUM(total_charge) as total_charge"),
                    DB::raw("COUNT(id) as total_order")
                )
                ->groupBy('merchant_id')->get();
        } else {
            $data = DeliveryManagement::with('merchant', 'merchant.business')->whereNotIn('order_id', $orderids)
                ->whereIn('status', $statuses)
                ->select(
                    'merchant_id',
                    DB::raw("SUM(received_amount) as total_received"),
                    DB::raw("SUM(delivery_charge) as total_deliverycharge"),
                    DB::raw("SUM(total_return_cost) as total_returncharge"),
                    DB::raw("SUM(cod_charge) as total_codcharge"),
                    DB::raw("SUM(weight_charge) as total_weight_charge"),
                    DB::raw("SUM(total_charge) as total_charge"),
                    DB::raw("COUNT(id) as total_order")
                )
                ->groupBy('merchant_id')->get();
        }


        return $this->successResponse(DeliveryManagementResource::collection($data), 'All DeliveryManagement List', Response::HTTP_OK);
    }

    public function generatedInvoice()
    {
        $user = Auth::user();
        $roleid = $user->user_type;

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();

            $data = DeliveryInvoice::with('merchant', 'merchant.business')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $data = DeliveryInvoice::with('merchant', 'merchant.business')->orderBy('id', 'DESC')->get();
        }

        return $this->successResponse(DeliveryInvoiceResource::collection($data), 'All DeliveryInvoice List', Response::HTTP_OK);
    }

    public function billstatement($id)
    {
        $data = Order::where('merchant_id', '=', $id)->with('plan')->get();
        return $this->successResponse($data, 'Order List', Response::HTTP_OK);
    }
    public function itemizedBill($id)
    {
        $data = Order::where('merchant_id', '=', $id)->with('plan')->get();
        return $this->successResponse($data, 'Order List', Response::HTTP_OK);
    }

    public function printInvoice($id)
    {
        //$data = DeliveryInvoice::with('admin', 'merchant', 'invoiceDetails', 'invoiceDetails.order','invoiceDetails.order.deliveryManagement', 'invoiceDetails.order.plan', 'invoiceDetails.order.orderProduct', 'invoiceDetails.order.orderProduct.product','invoiceDetails.order.district','invoiceDetails.order.upozila')->find($id);
        $data = DeliveryInvoice::with('admin', 'merchant', 'merchant.business', 'invoiceDetails', 'invoiceDetails.statuses', 'invoiceDetails.order', 'invoiceDetails.order.deliveryManagement', 'invoiceDetails.order.plan', 'invoiceDetails.order.district', 'invoiceDetails.order.upozila')->find($id);
        // return $data;
        return $this->successResponse($data, 'DeliveryInvoice List', Response::HTTP_OK);
    }

    public function editInvoice($id)
    {
        $orderids=DeliveryInvoiceDetails::where('merchant_id', $id)->pluck('order_id');
        $statuses = array(32,17);
        $data = DeliveryManagement::with('merchant', 'merchant.business', 'order', 'deliverStatus')->where('merchant_id', $id)->whereIn('status', $statuses)->whereNotIn('order_id', $orderids)->get();
        return $this->successResponse($data, 'Invoice Order List', Response::HTTP_OK);
    }

    public function filter($filterdata = '', $type = '')
    {
        $query = DeliveryManagement::query();

        if ($type!='' && $type=='csv') {
            if ($filterdata!="") {
                $merchant_id = $filterdata['merchant_id'] ??= '';
                $formdate = $filterdata['formdate'] ??= '';
                $todate = $filterdata['todate'] ??= '';
            } else {
                $merchant_id = '';
                $formdate = '';
                $todate = '';
            }
        } else {
            $merchant_id = request()->merchant_id;
            $formdate = request()->formdate;
            $todate = request()->todate;
        }

        // if ($request->keyword != "") {
        //     $search = $request->get('keyword');
        //     $query->where('invoice_no', 'LIKE', '%' . $search . '%');
        // }

        if ($merchant_id != "") {
            $query->where('merchant_id', $merchant_id);
        }


        if ($formdate != "" && $todate != "") {
            $query->whereBetween('created_at', [$formdate, $todate]);
        } elseif ($formdate == "" && $todate != "") {
            $query->whereDate('created_at', '<=', $todate);
        } elseif ($formdate != "" && $todate == "") {
            $query->whereDate('created_at', '>=', $formdate);
        }


        $user = Auth::user();
        $roleid = $user->user_type;

        $orderids=DeliveryInvoiceDetails::pluck('order_id');
        $statuses = array(32,17);
        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();

            $data = $query->with('merchant', 'merchant.business')->whereNotIn('order_id', $orderids)
                ->whereHas("merchant", function ($subQuery) use ($hub) {
                    $subQuery->where("hub_id", "=", $hub->id);
                })->whereIn('status', $statuses)
                ->select(
                    'merchant_id',
                    DB::raw("SUM(received_amount) as total_received"),
                    DB::raw("SUM(delivery_charge) as total_deliverycharge"),
                    DB::raw("SUM(total_return_cost) as total_returncharge"),
                    DB::raw("SUM(cod_charge) as total_codcharge"),
                    DB::raw("SUM(weight_charge) as total_weight_charge"),
                    DB::raw("SUM(total_charge) as total_charge"),
                    DB::raw("COUNT(id) as total_order")
                )
                ->groupBy('merchant_id')->get();
        } else {
            $data = $query->with('merchant', 'merchant.business')->whereNotIn('order_id', $orderids)
                ->whereIn('status', $statuses)
                ->select(
                    'merchant_id',
                    DB::raw("SUM(received_amount) as total_received"),
                    DB::raw("SUM(delivery_charge) as total_deliverycharge"),
                    DB::raw("SUM(total_return_cost) as total_returncharge"),
                    DB::raw("SUM(cod_charge) as total_codcharge"),
                    DB::raw("SUM(weight_charge) as total_weight_charge"),
                    DB::raw("SUM(total_charge) as total_charge"),
                    DB::raw("COUNT(id) as total_order")
                )
                ->groupBy('merchant_id')->get();
        }


        if ($type!='' && $type=='csv') {
            return $data;
        } else {
            return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
        }
    }


    public function listFilter($filterdata = '', $type = '')
    {
        $query = DeliveryInvoice::query();
        $user = Auth::user();
        $roleid = $user->user_type;

        if ($type!='' && $type=='csv') {
            if ($filterdata!="") {
                $merchant_id = $filterdata['merchant_id'] ??= '';
                $formdate = $filterdata['formdate'] ??= '';
                $todate = $filterdata['todate'] ??= '';
            } else {
                $merchant_id = '';
                $formdate = '';
                $todate = '';
            }
        } else {
            $merchant_id = request()->merchant_id;
            $formdate = request()->formdate;
            $todate = request()->todate;
        }
        if ($merchant_id != "") {
            $query->orWhere('merchant_id', $merchant_id);
        }

        if ($formdate != "" && $todate != "") {
            $query->whereBetween('created_at', [$formdate, $todate]);
        } elseif ($formdate == "" && $todate != "") {
            $query->whereDate('created_at', '<=', $todate);
        } elseif ($formdate != "" && $todate == "") {
            $query->whereDate('created_at', '>=', $formdate);
        }


        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();

            $data = $query->with('merchant', 'merchant.business')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $data = $query->with('merchant', 'merchant.business')->orderBy('id', 'DESC')->get();
        }

        // $data = $query->with('merchant', 'merchant.business')->orderBy('id', 'DESC')->get();

        if ($type!='' && $type=='csv') {
            return $data;
        } else {
            return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
        }
    }


    public function store(Request $request, DeliveryInvoice $invoice)
    {
        $jsondata = json_decode(file_get_contents('php://input'), true);

        $tReceived = $jsondata['tReceived'];
        $tDCharge = $jsondata['tDCharge'];
        $tRCharge = $jsondata['tRCharge'];
        $tCCharge = $jsondata['tCCharge'];
        $twCharge = $jsondata['twCharge'];
        $ttCharge = $jsondata['ttCharge'];
        $totalorder = $jsondata['tOrder'];
        $created_by = $jsondata['created_by'];

        $merchantids = $jsondata['merchant_id'];
        $cids[] = $jsondata['merchant_id'];
        $statuses = array(32,17);

        foreach ($merchantids as $mid) {
            $getLastId = $invoice->orderBy('id', 'DESC')->first();
            if ($getLastId != "") {
                $newInvoiceId = str_pad($getLastId->invoice_no + 1, 6, 0, STR_PAD_LEFT);
            } else {
                $newInvoiceId = str_pad(1, 6, 0, STR_PAD_LEFT);
            }

            $invoicedata = array(
                'partner_id' => 1,
                'merchant_id' => $mid,
                'created_by' => $created_by,
                'invoice_no' => $newInvoiceId,
                'collection' => $tReceived,
                'delivery_charge' => $tDCharge,
                'return_charge' => $tRCharge,
                'weight_charge' => $twCharge,
                'total_charge' => $ttCharge,
                'totalorder' => $totalorder,
                'cod_charge' => $tCCharge,
                'invoice_date' => date('Y-m-d')
            );
            $data = $invoice->create($invoicedata);

            $invoiceid = $data->id;

            $deliveryDetailsDatails = DeliveryManagement::where('merchant_id', $mid)->whereIn('status', $statuses)->get();
            foreach ($deliveryDetailsDatails as $orderdetails) {
                DeliveryManagement::where('order_id', $orderdetails->order_id)->update(['invoice' => 1]);
                $invoicedetailsdata = array(
                    'partner_id' => 1,
                    'created_by' => $created_by,
                    'invoice_id' => $invoiceid,
                    'merchant_id' => $orderdetails->merchant_id,
                    'order_id' => $orderdetails->order_id,
                    'status' => $orderdetails->status
                );

                DeliveryInvoiceDetails::create($invoicedetailsdata);
            }
        }
        $responsedata = $cids;
        return $this->successResponse($responsedata, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function save(Request $request, DeliveryInvoice $invoice)
    {
        $jsondata = json_decode(file_get_contents('php://input'), true);
        $Deliveryids=$jsondata['summe_code'];
        $data=DeliveryManagement::with('merchant', 'merchant.business')
                ->whereIn('id', $Deliveryids)
                ->select(
                    'merchant_id',
                    DB::raw("SUM(received_amount) as total_received"),
                    DB::raw("SUM(delivery_charge) as total_deliverycharge"),
                    DB::raw("SUM(total_return_cost) as total_returncharge"),
                    DB::raw("SUM(cod_charge) as total_codcharge"),
                    DB::raw("SUM(weight_charge) as total_weight_harge"),
                    DB::raw("SUM(total_charge) as total_charge"),
                    DB::raw("COUNT(id) as total_order")
                )
                ->groupBy('merchant_id')->first();



        $tReceived = $data['total_received'];
        $tDCharge = $data['total_deliverycharge'];
        $tRCharge = $data['total_returncharge'];
        $tCCharge = $data['total_codcharge'];
        $twCharge = $data['total_weight_harge'];
        $ttCharge = $data['total_charge'];
        $totalorder = $data['total_order'];
        $created_by = $jsondata['created_by'];
        $mid=$data['merchant_id'];

        // $merchantids = $jsondata['merchant_id'];
        // $cids[] = $jsondata['merchant_id'];
        $statuses = array(32,17);


        $getLastId = $invoice->orderBy('id', 'DESC')->first();
        if ($getLastId != "") {
            $newInvoiceId = str_pad($getLastId->invoice_no + 1, 6, 0, STR_PAD_LEFT);
        } else {
            $newInvoiceId = str_pad(1, 6, 0, STR_PAD_LEFT);
        }

        $invoicedata = array(
            'partner_id' => 1,
            'merchant_id' => $mid,
            'created_by' => $created_by,
            'invoice_no' => $newInvoiceId,
            'collection' => $tReceived,
            'delivery_charge' => $tDCharge,
            'return_charge' => $tRCharge,
            'total_charge' => $ttCharge,
            'weight_charge' => $twCharge,
            'totalorder' => $totalorder,
            'cod_charge' => $tCCharge,
            'invoice_date' => date('Y-m-d')
        );
        $data = $invoice->create($invoicedata);

        $invoiceid = $data->id;

        $deliveryDetailsDatails = DeliveryManagement::where('merchant_id', $mid)->whereIn('id', $Deliveryids)->whereIn('status', $statuses)->get();
        foreach ($deliveryDetailsDatails as $orderdetails) {
            DeliveryManagement::where('order_id', $orderdetails->order_id)->update(['invoice' => 1]);
            $invoicedetailsdata = array(
                'partner_id' => 1,
                'created_by' => $created_by,
                'invoice_id' => $invoiceid,
                'merchant_id' => $orderdetails->merchant_id,
                'order_id' => $orderdetails->order_id,
                'status' => $orderdetails->status
            );

            DeliveryInvoiceDetails::create($invoicedetailsdata);
        }

        $responsedata=$Deliveryids;
        return $this->successResponse($responsedata, 'Created Successfully', Response::HTTP_CREATED);
    }





    public function show($id)
    {
        $hub = DeliveryInvoice::find($id);
        return $this->successResponse($hub, 'DeliveryInvoice List', Response::HTTP_OK);
    }


    public function generatedInvoiceMerchant()
    {
        $merchantId = auth('merchant')->id();
        $data = DeliveryInvoice::where('merchant_id', $merchantId)->select('invoice_no', 'invoice_date', 'collection')->orderBy('id', 'DESC')->get();
        return $this->successResponse(DeliveryInvoiceResource::collection($data), 'All DeliveryInvoice List', Response::HTTP_OK);
    }
}
