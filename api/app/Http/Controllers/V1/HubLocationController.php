<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\HubLocationResource;
use App\Models\HubLocation;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HubLocationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return HubLocationResource
     */
    public function index()
    {
        $data = HubLocation::orderBy('id','DESC')->get();
		return $this->successResponse(HubLocationResource::collection($data), 'All HubLocation List', Response::HTTP_OK);

    }

	public function filter(Request $request)
    {
        $query = HubLocation::query();
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

		if ($request->formdate != "" && $request->todate != "") {
            $query->whereDate('created_at','<=', $request->todate);
            $query->whereDate('created_at','>=', $request->formdate);
        } elseif ($request->formdate == "" && $request->todate != "") {
            $query->whereDate('created_at','<=', $request->todate);
        } elseif ($request->formdate != "" && $request->todate == "") {
            $query->whereDate('created_at','>=', $request->formdate);
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
     * HubLocation a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HubLocation $hublocation)
    {
		$data= $hublocation->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
		$hublocation = HubLocation::find($id);
        return $this->successResponse($hublocation, 'HubLocation List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HubLocation  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hublocation = HubLocation::find($id);
        return $this->successResponse($hublocation, 'Specific HubLocation Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HubLocation  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$hublocation = HubLocation::find($id);
		$data= $hublocation->update($request->all());
       return $this->successResponse($data, 'HubLocation Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HubLocation  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hublocation = HubLocation::find($id);
        $result= $hublocation->delete();
        return $this->successResponse($result, 'HubLocation Deleted', Response::HTTP_OK);
    }
}
