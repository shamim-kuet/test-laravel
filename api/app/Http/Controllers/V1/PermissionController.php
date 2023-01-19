<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return PermissionResource
     */
    public function index()
    {
        $data = Permission::with('group')->orderBy('id','DESC')->get();
		return $this->successResponse(PermissionResource::collection($data), 'All Permission List', Response::HTTP_OK);

    }

	public function filter(Request $request)
    {
        $query = Permission::query();

		if($request->keyword!=""){
			  $search = $request->get('keyword');
			  $query->where(function($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%');
			  });
		  }

		$data = $query->orderBy('id','DESC')->with('group')->get();
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
    public function store(Request $request)
    {
        $permission = new Permission;
		$data= $permission->create($request->all());
        //return $data;
       return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
		$permission = Permission::with('group')->find($id);
        return $this->successResponse($permission, 'Permission List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        return $this->successResponse($permission, 'Specific Permission Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$permission = Permission::find($id);
		$data= $permission->update($request->all());
       return $this->successResponse($data, 'Permission Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $result= $permission->delete();
        return $this->successResponse($result, 'Permission Deleted', Response::HTTP_OK);
    }
}
