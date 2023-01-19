<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\EmployeeidResource;
use App\Models\Employeeid;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeidController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return EmployeeidResource
     */
    public function index()
    {
        $data = Employeeid::with('role')->orderBy('id', 'DESC')->get();
        return $this->successResponse(EmployeeidResource::collection($data), 'All Employeeid List', Response::HTTP_OK);
    }

    public function filter(Request $request)
    {
        $query = Employeeid::query();
        if ($request->keyword != "") {
            $search = $request->get('keyword');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
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
     * Employeeid a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Employeeid $hublocation)
    {
        $data = $hublocation->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
        $hublocation = Employeeid::find($id);
        return $this->successResponse($hublocation, 'Employeeid List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employeeid  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hublocation = Employeeid::find($id);
        return $this->successResponse($hublocation, 'Specific Employeeid Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employeeid  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hublocation = Employeeid::find($id);
        $data = $hublocation->update($request->all());
        return $this->successResponse($data, 'Employeeid Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employeeid  $hublocation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hublocation = Employeeid::find($id);
        $result = $hublocation->delete();
        return $this->successResponse($result, 'Employeeid Deleted', Response::HTTP_OK);
    }
}
