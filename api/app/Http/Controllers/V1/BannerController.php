<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;


class BannerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return BannerResource
     */
    public function index()
    {
        $data = Banner::orderBy('id','DESC')->get();
		return $this->successResponse(BannerResource::collection($data), 'All Banner List', Response::HTTP_OK);

    }

	public function filter(Request $request)
    {
        $query = Banner::query();
		if($request->keyword!=""){
			  $search = $request->get('keyword');
			  $query->where(function($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%');
			  });
		  }
		if($request->status!=""){
			$query->where('status',$request->status);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Banner $hub)
    {
		 $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

		 if ($validator->fails()) {
			$error = $validator->errors();
			return $this->errorRessponse('Failed', $error, Response::HTTP_CREATED);
        }



		$data= $hub->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
		$hub = Banner::find($id);
        return $this->successResponse($hub, 'Banner List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $hub
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hub = Banner::find($id);
        return $this->successResponse($hub, 'Specific Banner Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $hub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$hub = Banner::find($id);
		$data= $hub->update($request->all());
       return $this->successResponse($data, 'Banner Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $hub
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $hub)
    {
        $result= $hub->delete();
        return $this->successResponse($result, 'Banner Deleted', Response::HTTP_OK);
    }
}
