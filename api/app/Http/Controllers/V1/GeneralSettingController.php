<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\GeneralSettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneralSettingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return GeneralSettingResource
     */
    public function index()
    {
        $data = Setting::orderBy('id','DESC')->get();
		return $this->successResponse(GeneralSettingResource::collection($data), 'All General Setting List', Response::HTTP_OK);

    }

	public function filter(Request $request)
    {
        $query = Setting::query();
		if($request->keyword!=""){
			  $search = $request->get('keyword');
			  $query->where(function($query) use ($search) {
				$query->where('site_name', 'LIKE', '%'.$search.'%')
				->orWhere('site_title', 'LIKE', '%'.$search.'%');
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
     * Setting a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Setting $hublocation)
    {
		$data= $hublocation->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
		$hublocation = Setting::find($id);
        return $this->successResponse($hublocation, 'General Setting List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hublocation = Setting::find($id);
        return $this->successResponse($hublocation, 'Specific General Setting Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$hublocation = Setting::find($id);
		$data= $hublocation->update($request->all());
       return $this->successResponse($data, 'General Setting Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hublocation = Setting::find($id);
        $result= $hublocation->delete();
        return $this->successResponse($result, 'General Setting Deleted', Response::HTTP_OK);
    }
}
