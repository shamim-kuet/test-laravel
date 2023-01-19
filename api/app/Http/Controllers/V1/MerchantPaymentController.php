<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\HubResource;
use App\Models\MerchantPayments;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Hub;

class MerchantPaymentController extends BaseController
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
            $data = MerchantPayments::with('merchant','merchant.business')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $data = MerchantPayments::with('merchant','merchant.business')->orderBy('id', 'DESC')->get();
        }
        return $this->successResponse($data, 'All MerchantPayments List', Response::HTTP_OK);
    }

    // public function filter(Request $request)
    // {
    //     $query = Hub::query();
    // 	if($request->keyword!=""){
    // 		  $search = $request->get('keyword');
    // 		  $query->where(function($query) use ($search) {
    // 			$query->where('legal_name', 'LIKE', '%'.$search.'%')
    // 			->orWhere('company_name', 'LIKE', '%'.$search.'%')
    // 			->orWhere('legal_name', 'LIKE', '%'.$search.'%')
    // 			->orWhere('company_phone', 'LIKE', '%'.$search.'%')
    // 			->orWhere('contact_person_name', 'LIKE', '%'.$search.'%')
    // 			->orWhere('contact_person_phone', 'LIKE', '%'.$search.'%')
    // 			->orWhere('contact_person_email', 'LIKE', '%'.$search.'%')
    // 			->orWhere('company_email', 'LIKE', '%'.$search.'%');
    // 		  });
    // 	  }
    // 	if($request->status!=""){
    // 		$query->where('status',$request->status);
    // 	}

    // 	if($request->subscription_type!=""){
    // 		$query->where('subscription_type',$request->subscription_type);
    // 	}

    // 	if($request->fromdate!="" && $request->todate!=""){
    // 		$query->whereBetween('created_at',[$request->fromdate,$request->todate]);
    // 	}
    // 	elseif($request->fromdate=="" && $request->todate!=""){
    // 		$query->whereDate('created_at',$request->todate);
    // 	}
    // 	elseif($request->fromdate!="" && $request->todate==""){
    // 		$query->whereDate('created_at',$request->fromdate);
    // 	}

    // 	$data = $query->orderBy('id','DESC')->get();
    // 	return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
    // }

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
    public function store(Request $request, MerchantPayments $pr)
    {

        $data = $pr->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
        $payment_request = MerchantPayments::find($id);
        return $this->successResponse($payment_request, 'MerchantPayments List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MerchantPayments  $payment_request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment_request = MerchantPayments::find($id);
        return $this->successResponse($payment_request, 'Specific MerchantPayments Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MerchantPayments  $payment_request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payment_request = MerchantPayments::find($id);
        $data = $payment_request->update($request->all());
        return $this->successResponse($data, 'MerchantPayments Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MerchantPayments  $payment_request
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantPayments $payment_request)
    {
        $result = $payment_request->delete();
        return $this->successResponse($result, 'MerchantPayments Deleted', Response::HTTP_OK);
    }
}
