<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\HubResource;
use App\Models\DeliveryInvoice;
use App\Models\DeliveryInvoiceDetails;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Hub;
use Illuminate\Support\Facades\Session;

class MerchantPaymentReportController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return HubResource
     */
    public function index()
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

        return $this->successResponse($data, 'All DeliveryInvoice List', Response::HTTP_OK);
    }

    public function indexMerchant()
    {
        $merchantId = auth('merchant')->id();
        $data = DeliveryInvoice::with('merchant', 'merchant.business')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();

        return $this->successResponse($data, 'All Delivery Invoice List', Response::HTTP_OK);
    }

    public function filter($filterdata = '', $type = '')
    {
        $query = DeliveryInvoice::query();

        if ($type!='' && $type=='csv') {
            if ($filterdata!="") {
                $merchant_id = $filterdata['merchant_id'] ??= '';
                $formdate = $filterdata['formdate'] ??= '';
                $todate = $filterdata['todate'] ??= '';
                $rider_id = $filterdata['rider_id'] ??= '';
            } else {
                $merchant_id = '';
                $formdate = '';
                $todate = '';
                $rider_id = '';
            }
        } else {
            $merchant_id = request()->merchant_id;
            $formdate = request()->formdate;
            $todate = request()->todate;
            $rider_id = request()->rider_id;
        }


        if ($merchant_id != "") {
            $query->where('merchant_id', $merchant_id);
        }

        if ($rider_id != "") {
            $query->where('rider_id', $rider_id);
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
            $data = $query->with('merchant', 'merchant.business')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $data = $query->with('merchant', 'merchant.business')->orderBy('id', 'DESC')->get();
        }

        if ($type!='' && $type=='csv') {
            return $data;
        } else {
            return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
        }
    }

    public function merchantFilter($filterdata = '', $type = '')
    {
        $query = DeliveryInvoice::query();

        if ($type!='' && $type=='csv') {
            if ($filterdata!="") {
                $formdate = $filterdata['formdate'] ??= '';
                $todate = $filterdata['todate'] ??= '';
            } else {
                $formdate = '';
                $todate = '';
            }
        } else {
            $formdate = request()->formdate;
            $todate = request()->todate;
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
        $data = $query->with('merchant', 'merchant.business')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();

        if ($type!='' && $type=='csv') {
            return $data;
        } else {
            return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
        }
    }

    public function detailsFilter($filterdata = '', $type = '')
    {
        // $data = $request->all();
        $query = DeliveryInvoiceDetails::query();

        if ($type!='' && $type=='csv') {
            if ($filterdata!="") {
                $merchant_id = $filterdata['merchant_id'] ??= '';
                $formdate = $filterdata['formdate'] ??= '';
                $todate = $filterdata['todate'] ??= '';
                $hub_id = $filterdata['hub_id'] ??= '';
            } else {
                $merchant_id = '';
                $formdate = '';
                $todate = '';
                $hub_id = '';
            }
        } else {
            $merchant_id = request()->merchant_id;
            $formdate = request()->formdate;
            $todate = request()->todate;
            $hub_id = request()->hub_id;
        }

        if ($merchant_id != "") {
            $query->where('merchant_id', $merchant_id);
        }


        if ($hub_id != "") {
            $query->whereHas("merchant", function ($subQuery) use ($hub_id) {
                $subQuery->where("hub_id", "=", $hub_id);
            });
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
            $data = $query->with('merchant', 'merchant.business', 'merchant.hub', 'order')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $data = $query->with('merchant', 'merchant.business', 'merchant.hub', 'order')->orderBy('id', 'DESC')->get();
        }

        if ($type!='' && $type=='csv') {
            return $data;
        } else {
            return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
        }
    }

    public function merchantDetailsFilter($filterdata = '', $type = '')
    {
        $query = DeliveryInvoiceDetails::query();

        if ($type!='' && $type=='csv') {
            if ($filterdata!="") {
                $formdate = $filterdata['formdate'] ??= '';
                $todate = $filterdata['todate'] ??= '';
            } else {
                $formdate = '';
                $todate = '';
            }
        } else {
            $formdate = request()->formdate;
            $todate = request()->todate;
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
        $data = $query->with('merchant', 'merchant.business', 'merchant.hub', 'order')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();

        if ($type!='' && $type=='csv') {
            return $data;
        } else {
            return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
        }
    }


    public function details($id)
    {
        $user = Auth::user();
        $roleid = $user->user_type;



        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = DeliveryInvoiceDetails::with('merchant', 'merchant.business', 'merchant.hub', 'order')->where('invoice_id', $id)->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $data = DeliveryInvoiceDetails::with('merchant', 'merchant.business', 'merchant.hub', 'order')->where('invoice_id', $id)->orderBy('id', 'DESC')->get();
        }
        return $this->successResponse($data, 'All DeliveryInvoice Details List', Response::HTTP_OK);
    }

    public function detailsMerchant($id)
    {
        $merchantId = auth('merchant')->id();
        $data = DeliveryInvoiceDetails::with('merchant', 'merchant.business', 'merchant.hub', 'order')->where('invoice_id', $id)->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();

        return $this->successResponse($data, 'All DeliveryInvoice Details List', Response::HTTP_OK);
    }

    public function allDetails()
    {
        $user = Auth::user();
        $roleid = $user->user_type;

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = DeliveryInvoiceDetails::with('merchant', 'merchant.business', 'merchant.hub', 'order')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $data = DeliveryInvoiceDetails::with('merchant', 'merchant.business', 'merchant.hub', 'order')->orderBy('id', 'DESC')->get();
        }
        return $this->successResponse($data, 'All DeliveryInvoice Details List', Response::HTTP_OK);
    }

    public function allDetailsMerchant()
    {
        $merchantId = auth('merchant')->id();
        $data = DeliveryInvoiceDetails::with('merchant', 'merchant.business', 'merchant.hub', 'order')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();

        return $this->successResponse($data, 'All Delivery Invoice Details List', Response::HTTP_OK);
    }
}
