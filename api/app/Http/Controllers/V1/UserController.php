<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'All User List', Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $data['user'] = $user->create($request->only('name', 'email', 'password', 'username', 'phone'));
        return $this->successResponse($data, 'Registration Successfull', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return $this->successResponse($user, 'All User List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return $this->successResponse($user, 'All User List', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data['user'] = $user->update($request->only('name', 'email', 'password'));
        return $this->successResponse($data, 'User Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $result = $user->delete();
        return $this->successResponse($result, 'User Deleted', Response::HTTP_OK);
    }

    public function filter(Request $request)
    {
        $query = User::query();
        if ($request->keyword != "") {
            $search = $request->get('keyword');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%');
            });
        }
        if ($request->status != "") {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
    }
}
