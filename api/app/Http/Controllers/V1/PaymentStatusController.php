<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PaymentStatusResource;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentStatusController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return PaymentStatusResource
     */
    public function index()
    {
        $data = PaymentStatus::orderBy('id', 'DESC')->get();
        return $this->successResponse(PaymentStatusResource::collection($data), 'All PaymentStatus List', Response::HTTP_OK);
    }

    public function filter(Request $request)
    {
        $query = PaymentStatus::query();
        if ($request->keyword != "") {
            $search = $request->get('keyword');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        if ($request->status != "") {
            $query->where('status', $request->status);
        }

        // if($request->isready!=""){
        // 	$query->where('isready',$request->isready);
        // }

        // if ($request->formdate != "" && $request->todate != "") {
        //     $query->whereDate('created_at','<=', $request->todate);
        //     $query->whereDate('created_at','>=', $request->formdate);
        // } elseif ($request->formdate == "" && $request->todate != "") {
        //     $query->whereDate('created_at','<=', $request->todate);
        // } elseif ($request->formdate != "" && $request->todate == "") {
        //     $query->whereDate('created_at','>=', $request->formdate);
        // }

        $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
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
     * PaymentStatus a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PaymentStatus $hublocation)
    {
        $data = $hublocation->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
        $hublocation = PaymentStatus::find($id);
        return $this->successResponse($hublocation, 'PaymentStatus List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentStatus  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hublocation = PaymentStatus::find($id);
        return $this->successResponse($hublocation, 'Specific PaymentStatus Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentStatus  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hublocation = PaymentStatus::find($id);
        $data = $hublocation->update($request->all());
        return $this->successResponse($data, 'PaymentStatus Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentStatus  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hublocation = PaymentStatus::find($id);
        $result = $hublocation->delete();
        return $this->successResponse($result, 'PaymentStatus Deleted', Response::HTTP_OK);
    }
}
