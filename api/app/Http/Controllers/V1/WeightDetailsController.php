<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PlanResource;
use App\Models\WeightDetail;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WeightDetailsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return PlanResource
     */
    public function index()
    {
        $data = WeightDetail::orderBy('id','DESC')->get();
		return $this->successResponse($data, 'All WeightDetails List', Response::HTTP_OK);

    }

	public function filter(Request $request)
    {
        $query = WeightDetail::query();
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
     * Plan a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, WeightDetail $hublocation)
    {
        $request->merge(['partner_id' => 1]);
		$data= $hublocation->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
		$hublocation = WeightDetail::find($id);
        return $this->successResponse($hublocation, 'Plan List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hublocation = WeightDetail::find($id);
        return $this->successResponse($hublocation, 'Specific Plan Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$hublocation = WeightDetail::find($id);
		$data= $hublocation->update($request->all());
       return $this->successResponse($data, 'WeightDetail Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeightDetail $hublocation)
    {
        $result= $hublocation->delete();
        return $this->successResponse($result, 'WeightDetail Deleted', Response::HTTP_OK);
    }
}
