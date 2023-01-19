<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;

use App\Models\MerchantPaymentRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Hub;

class PaymentRequestController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return MerchantPaymentRequest
     */
    public function index()
    {
        $user = Auth::user();
        $roleid = $user->user_type;



        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = MerchantPaymentRequest::with('merchant','merchant.business')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $data = MerchantPaymentRequest::with('merchant','merchant.business')->orderBy('id', 'DESC')->get();
        }
        return $this->successResponse($data, 'All MerchantPaymentRequest List', Response::HTTP_OK);
    }

    public function indexMerchant()
    {
        $merchantId = auth('merchant')->id();
            $data = MerchantPaymentRequest::where('merchant_id',$merchantId)->select('id','payment_status','payment_date','amount')->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'All MerchantPaymentRequest List', Response::HTTP_OK);
    }



    public function filter(Request $request)
    {
        // $query = MerchantPaymentRequest::query();
        // if($request->keyword!=""){
        // 	  $search = $request->get('keyword');
        // 	  $query->where(function($query) use ($search) {
        // 		$query->where('legal_name', 'LIKE', '%'.$search.'%')
        // 		->orWhere('company_name', 'LIKE', '%'.$search.'%')
        // 		->orWhere('legal_name', 'LIKE', '%'.$search.'%')
        // 		->orWhere('company_phone', 'LIKE', '%'.$search.'%')
        // 		->orWhere('contact_person_name', 'LIKE', '%'.$search.'%')
        // 		->orWhere('contact_person_phone', 'LIKE', '%'.$search.'%')
        // 		->orWhere('contact_person_email', 'LIKE', '%'.$search.'%')
        // 		->orWhere('company_email', 'LIKE', '%'.$search.'%');
        // 	  });
        //   }
        // if($request->status!=""){
        // 	$query->where('status',$request->status);
        // }

        // if($request->subscription_type!=""){
        // 	$query->where('subscription_type',$request->subscription_type);
        // }

        // if($request->fromdate!="" && $request->todate!=""){
        // 	$query->whereBetween('created_at',[$request->fromdate,$request->todate]);
        // }
        // elseif($request->fromdate=="" && $request->todate!=""){
        // 	$query->whereDate('created_at',$request->todate);
        // }
        // elseif($request->fromdate!="" && $request->todate==""){
        // 	$query->whereDate('created_at',$request->fromdate);
        // }

        // $data = $query->orderBy('id','DESC')->get();
        // return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
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
    public function store(Request $request, MerchantPaymentRequest $pr)
    {

        $data = $pr->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }

    public function storeMerchant(Request $request, MerchantPaymentRequest $pr)
    {
        $merchantId = auth('merchant')->id();
        // $data = [
        //     'merchant_id' => $merchantId,
        //     'amount' => $request->amount,
        //     'payment_date=>' => $request->payment_date,
        //     'partner_id' => 1,
        //     'status' => $request->status,
        //     'created_by' => $merchantId,
        //     'remark' => $request->remark,
        //     'payment_method' => $request->payment_method,

        // ];




if($request->payment_method == "") {

    $data = [
        'merchant_id' => $merchantId,
        'amount' => $request->amount,
        'payment_date' => $request->payment_date,
        'partner_id' => 1,
        'status' => $request->status,
        'created_by' => $merchantId,
        'remark' => $request->remark,
        'payment_status'=>"Pending",
    ];
}elseif($request->payment_method == "COD") {

        $data = [
            'merchant_id' => $merchantId,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'partner_id' => 1,
            'status' => $request->status,
            'created_by' => $merchantId,
            'remark' => $request->remark,
            'payment_status'=>"Pending",
        ];
}elseif ($request->payment_method == "mobile_banking") {

            $data = [
                'merchant_id' => $merchantId,
                'amount' => $request->amount,
                'payment_date' => $request->payment_date,
                'partner_id' => 1,
                'status' => $request->status,
                'created_by' => $merchantId,
                'remark' => $request->remark,
                'payment_method' => $request->payment_method,
                'payment_status'=>"Pending",

                'account_name' => $request->m_account_name,
                'account_number' => $request->m_account_number,
            ];
        } elseif ($request->payment_method == "bank") {
            $data = [
                'bank_name'=> $request->bank_name,
                'merchant_id' => $merchantId,
                'amount' => $request->amount,
                'payment_date' => $request->payment_date,
                'partner_id' => 1,
                'status' => $request->status,
                'created_by' => $merchantId,
                'remark' => $request->remark,
                'payment_method' => $request->payment_method,
                'payment_status'=>"Pending",

                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'branch_no' => $request->branch_name,
                'routing_no' => $request->routing_number,

            ];
        }

        $data = $pr->create($data);
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $payment_request = MerchantPaymentRequest::find($id);
        return $this->successResponse($payment_request, 'MerchantPaymentRequest List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MerchantPaymentRequest  $payment_request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment_request = MerchantPaymentRequest::find($id);
        return $this->successResponse($payment_request, 'Specific MerchantPaymentRequest Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MerchantPaymentRequest  $payment_request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payment_request = MerchantPaymentRequest::find($id);
        $data = $payment_request->update($request->all());
        return $this->successResponse($data, 'MerchantPaymentRequest Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MerchantPaymentRequest  $payment_request
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantPaymentRequest $payment_request)
    {
        $result = $payment_request->delete();
        return $this->successResponse($result, 'MerchantPaymentRequest Deleted', Response::HTTP_OK);
    }
}
