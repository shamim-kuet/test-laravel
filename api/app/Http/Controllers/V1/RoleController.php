<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return RoleResource
     */
    public function index()
    {
        $data = Role::orderBy('id', 'DESC')->get();
        //dd( $data);
        return $this->successResponse(RoleResource::collection($data), 'All Role List', Response::HTTP_OK);
    }

    public function filter(Request $request)
    {
        $query = Role::query();

		if($request->keyword!=""){
			  $search = $request->get('keyword');
			  $query->where(function($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%');
			  });
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
    public function store(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return $this->errorRessponse('Failed', $error, Response::HTTP_CREATED);
        }
        $data = $role->create($request->all());
        return $this->successResponse($data, 'Role Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
        $role = Role::find($id);
        return $this->successResponse($role, 'Role List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return $this->successResponse($role, 'Specific Role Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $data = $role->update($request->all());
        return $this->successResponse($data, 'Role Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $result = $role->delete();
        return $this->successResponse($result, 'Role Deleted', Response::HTTP_OK);
    }
}
