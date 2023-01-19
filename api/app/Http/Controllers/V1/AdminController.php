<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Admin::with('role')->orderBy('id','DESC')->get();
        //return $this->successResponse($data, 'All Admin Data', Response::HTTP_OK);
		return $this->successResponse(AdminResource::collection($data), 'All Admin List', Response::HTTP_OK);
    }

	public function filter(Request $request)
    {
        $query = Admin::query();

		if($request->keyword!=""){
			  $search = $request->get('keyword');
			  $query->where(function($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%')
				->orWhere('email', 'LIKE', '%'.$search.'%')
				->orWhere('phone', 'LIKE', '%'.$search.'%');
			  });
		  }
		if($request->status!=""){
			$query->where('status',$request->status);
		}
		if($request->usertype!=""){
			$query->where('user_type',$request->usertype);
		}

		// if ($request->formdate != "" && $request->todate != "") {
        //     $query->whereDate('created_at','<=', $request->todate);
        //     $query->whereDate('created_at','>=', $request->formdate);
        // } elseif ($request->formdate == "" && $request->todate != "") {
        //     $query->whereDate('created_at','<=', $request->todate);
        // } elseif ($request->formdate != "" && $request->todate == "") {
        //     $query->whereDate('created_at','>=', $request->formdate);
        // }

		$data = $query->orderBy('id','DESC')->with('role')->get();
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
    public function store(Request $request, Admin $admin)
    {
        //$data= $admin->create($request->only('username', 'name', 'email','phone','password','present_address','permanent_address','facebook','twitter','linkedin','github'));
		$input = $request->all();
        $input['employee_id'] = $request->employeeid_prefix.'-'.$request->employee_id;
        $data= $admin->create($input);
        return $this->successResponse($data, 'Successfully Inserted', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$admin = Admin::find($id);
        return $this->successResponse($admin, 'User List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
        return $this->successResponse($admin, 'Specific User Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$admin = Admin::find($id);
        //$data= $admin->update($request->only('name', 'email','phone','present_address','designation','permanent_address','facebook','twitter','linkedin','github', 'username'));
		$data= $admin->update($request->all());
       return $this->successResponse($data, 'User Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $result= $admin->delete();
        return $this->successResponse($result, 'User Deleted', Response::HTTP_OK);
    }
}
