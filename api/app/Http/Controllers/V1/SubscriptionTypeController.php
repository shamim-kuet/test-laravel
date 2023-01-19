<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\SubscriptionTypeResource;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionTypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return SubscriptionTypeResource
     */
    public function index()
    {
        $data = SubscriptionType::orderBy('id','DESC')->get();
		return $this->successResponse(SubscriptionTypeResource::collection($data), 'All SubscriptionType List', Response::HTTP_OK);

    }

	public function filter(Request $request)
    {
        $query = SubscriptionType::query();
		if($request->keyword!=""){
			  $search = $request->get('keyword');
			  $query->where(function($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%')
				->orWhere('email', 'LIKE', '%'.$search.'%')
				->orWhere('phone', 'LIKE', '%'.$search.'%')
				->orWhere('address', 'LIKE', '%'.$search.'%')
				->orWhere('zone', 'LIKE', '%'.$search.'%')
				->orWhere('region', 'LIKE', '%'.$search.'%')
				->orWhere('area', 'LIKE', '%'.$search.'%');
			  });
		  }
		if($request->status!=""){
			$query->where('status',$request->status);
		}

		if($request->isready!=""){
			$query->where('isready',$request->isready);
		}

		if($request->fromdate!="" && $request->todate!=""){
			$query->whereBetween('created_at',[$request->fromdate,$request->todate]);
		}
		elseif($request->fromdate=="" && $request->todate!=""){
			$query->whereDate('created_at',$request->todate);
		}
		elseif($request->fromdate!="" && $request->todate==""){
			$query->whereDate('created_at',$request->fromdate);
		}

		$data = $query->orderBy('id','DESC')->get();
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
     * SubscriptionType a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SubscriptionType $hublocation)
    {
		$data= $hublocation->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
		$hublocation = SubscriptionType::find($id);
        return $this->successResponse($hublocation, 'SubscriptionType List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubscriptionType  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hublocation = SubscriptionType::find($id);
        return $this->successResponse($hublocation, 'Specific SubscriptionType Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubscriptionType  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$hublocation = SubscriptionType::find($id);
		$data= $hublocation->update($request->all());
       return $this->successResponse($data, 'SubscriptionType Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscriptionType  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hublocation = SubscriptionType::find($id);
        $result= $hublocation->delete();
        return $this->successResponse($result, 'SubscriptionType Deleted', Response::HTTP_OK);
    }
}
