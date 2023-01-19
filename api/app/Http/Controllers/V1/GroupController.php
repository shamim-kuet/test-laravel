<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return GroupResource
     */
    public function index()
    {
        $data = Group::orderBy('id', 'DESC')->get();
        return $this->successResponse(GroupResource::collection($data), 'All Group List', Response::HTTP_OK);
    }


    public function groupWithPermission()
    {
        $data = Group::with('groupHasPermission')->orderBy('id', 'DESC')->get();
        return $this->successResponse(GroupResource::collection($data), 'All Group List', Response::HTTP_OK);
    }

    public function filter(Request $request)
    {
        $query = Group::query();

        if ($request->keyword != "") {
            $search = $request->get('keyword');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $group)
    {
        $data = $group->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
        $group = Group::find($id);
        return $this->successResponse($group, 'Group List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        return $this->successResponse($group, 'Specific Group Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Group::find($id);
        $data = $group->update($request->all());
        return $this->successResponse($data, 'Group Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $result = $group->delete();
        return $this->successResponse($result, 'Group Deleted', Response::HTTP_OK);
    }
}
