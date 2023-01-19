<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PartnerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return PartnerResource
     */
    public function index()
    {
        $data = Partner::orderBy('id','DESC')->get();
		return $this->successResponse(PartnerResource::collection($data), 'All Partner List', Response::HTTP_OK);

    }

	public function filter(Request $request)
    {
        $query = Partner::query();
		if($request->keyword!=""){
			  $search = $request->get('keyword');
			  $query->where(function($query) use ($search) {
				$query->where('legal_name', 'LIKE', '%'.$search.'%')
				->orWhere('company_name', 'LIKE', '%'.$search.'%')
				->orWhere('legal_name', 'LIKE', '%'.$search.'%')
				->orWhere('company_phone', 'LIKE', '%'.$search.'%')
				->orWhere('contact_person_name', 'LIKE', '%'.$search.'%')
				->orWhere('contact_person_phone', 'LIKE', '%'.$search.'%')
				->orWhere('contact_person_email', 'LIKE', '%'.$search.'%')
				->orWhere('company_email', 'LIKE', '%'.$search.'%');
			  });
		  }
		if($request->status!=""){
			$query->where('status',$request->status);
		}

		if($request->subscription_type!=""){
			$query->where('subscription_type',$request->subscription_type);
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
    public function store(Request $request, Partner $partner)
    {
		$data= $partner->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
		$partner = Partner::find($id);
        return $this->successResponse($partner, 'Partner List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partner = Partner::find($id);
        return $this->successResponse($partner, 'Specific Partner Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$partner = Partner::find($id);
		$data= $partner->update($request->all());
       return $this->successResponse($data, 'Partner Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $result= $partner->delete();
        return $this->successResponse($result, 'Partner Deleted', Response::HTTP_OK);
    }
}
