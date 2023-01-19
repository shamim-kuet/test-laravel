<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlanController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return PlanResource
     */
    public function index()
    {
        $data = Plan::orderBy('id','DESC')->get();
		return $this->successResponse(PlanResource::collection($data), 'All Plan List', Response::HTTP_OK);

    }

	public function filter(Request $request)
    {
        $query = Plan::query();
		if($request->keyword!=""){
			  $search = $request->get('keyword');
			  $query->where(function($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%')
				->orWhere('time', 'LIKE', '%'.$search.'%')
				->orWhere('location', 'LIKE', '%'.$search.'%');
			  });
		  }
		if($request->type!=""){
			$query->where('type',$request->type);
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
    public function store(Request $request, Plan $hublocation)
    {
		$data= $hublocation->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
		$hublocation = Plan::find($id);
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
        $hublocation = Plan::find($id);
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
		$hublocation = Plan::find($id);
		$data= $hublocation->update($request->all());
       return $this->successResponse($data, 'Plan Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $hublocation)
    {
        $result= $hublocation->delete();
        return $this->successResponse($result, 'Plan Deleted', Response::HTTP_OK);
    }
}
