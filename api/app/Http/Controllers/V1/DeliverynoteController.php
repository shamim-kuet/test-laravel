<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\DeliverynoteResource;
use App\Models\Deliverynote;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeliverynoteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return DeliverynoteResource
     */
    public function index()
    {
        $data = Deliverynote::orderBy('id','DESC')->get();
		return $this->successResponse(DeliverynoteResource::collection($data), 'All Deliverynote List', Response::HTTP_OK);

    }

	public function filter(Request $request)
    {
        $query = Deliverynote::query();
		if($request->keyword!=""){
			  $search = $request->get('keyword');
			  $query->where(function($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%')
				->orWhere('type', 'LIKE', '%'.$search.'%');
			  });
		  }
		// if($request->status!=""){
		// 	$query->where('status',$request->status);
		// }

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
     * Deliverynote a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Deliverynote $hublocation)
    {
		$data= $hublocation->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
		$hublocation = Deliverynote::find($id);
        return $this->successResponse($hublocation, 'Deliverynote List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deliverynote  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hublocation = Deliverynote::find($id);
        return $this->successResponse($hublocation, 'Specific Deliverynote Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deliverynote  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$hublocation = Deliverynote::find($id);
		$data= $hublocation->update($request->all());
       return $this->successResponse($data, 'Deliverynote Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deliverynote  $hublocation
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $hublocation = Deliverynote::find($id);
    //     $result= $hublocation->delete();
    //     return $this->successResponse($result, 'Deliverynote Deleted', Response::HTTP_OK);
    // }
}
