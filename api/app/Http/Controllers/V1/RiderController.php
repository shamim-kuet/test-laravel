<?php

namespace App\Http\Controllers\V1;

use App\Models\Rider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\RiderResource;
use App\Http\Controllers\BaseController;
use App\Models\Hub;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Services\Validation;
use Illuminate\Validation\Rule;
use Auth;

class RiderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return RiderResource
     */
    public function index()
    {
        $user = Auth::user();
        $roleid = $user->user_type;
// dd($roleid);
        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = Rider::with('hub')->where('hub_id', '=', $hub->id)->orderBy('id', 'DESC')->get();
        } else {
            $data = Rider::with('hub')->orderBy('id', 'DESC')->get();
        }
        return $this->successResponse(RiderResource::collection($data), 'All Rider List', Response::HTTP_OK);
    }

    public function filter(Request $request)
    {
        // return $request->keyword;
        // $data = Rider::with('hub')->get();
        // return $data;
        $query = Rider::query();
        if ($request->keyword != "") {
            $search = $request->keyword;
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('username', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('zone', 'LIKE', '%' . $search . '%')
                    ->orWhere('area', 'LIKE', '%' . $search . '%')
                    ->orWhere('address', 'LIKE', '%' . $search . '%')
                    ->orWhere('employee_id', 'LIKE', '%' . $search . '%');
            });
        }
        if ($request->status != "") {
            $query->where('status', $request->status);
        }

        if ($request->hub_id != "") {
            $query->where('hub_id', $request->hub_id);
        }

        if ($request->formdate != "" && $request->todate != "") {
            $query->whereDate('created_at','<=', $request->todate);
            $query->whereDate('created_at','>=', $request->formdate);
        } elseif ($request->formdate == "" && $request->todate != "") {
            $query->whereDate('created_at','<=', $request->todate);
        } elseif ($request->formdate != "" && $request->todate == "") {
            $query->whereDate('created_at','>=', $request->formdate);
        }


        $user = Auth::user();
        $roleid = $user->user_type;

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = $query->with('hub')->where('hub_id', '=', $hub->id)->orderBy('id', 'DESC')->get();
        } else {
            $data = $query->with('hub')->orderBy('id', 'DESC')->get();
        }

        // $data = $query->with('hub')->orderBy('id', 'DESC')->get();
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
    public function store(Request $request, Rider $rider)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:App\Models\Rider,username',
            'employee_id' => 'unique:App\Models\Rider,employee_id'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            $productService = new Validation;
            $validation = $productService->storeValidation($error);

            return $this->errorRessponse('Failed', $validation, Response::HTTP_CREATED);
        }



        $reqData = $request->all();
        $reqData['password'] = Hash::make($request->password);
        $data = $rider->create($reqData);
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
        $rider = Rider::with('hub')->find($id);
        return $this->successResponse($rider, 'Rider List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rider = Rider::with('hub')->find($id);
        return $this->successResponse($rider, 'Specific Rider Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'employee_id' => 'unique:App\Models\Rider,employee_id',
            'employee_id' => [
                'required',
                Rule::unique('riders')->ignore($id),
            ],
            //'username' => 'required|unique:App\Models\Rider,username, '.$id
            //'username' => 'required|unique:riders,username,'.$id.',id',
            'username' => [
                'required',
                Rule::unique('riders')->ignore($id),
            ],
        ]);



        if ($validator->fails()) {
            $error = $validator->errors();
            $productService = new Validation;
            $validation = $productService->storeValidation($error);

            return $this->errorRessponse('Failed', $validation, Response::HTTP_CREATED);
        }

        $rider = Rider::find($id);
        $data = $rider->update($request->all());
        return $this->successResponse($data, 'Rider Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rider $rider)
    {
        $result = $rider->delete();
        return $this->successResponse($result, 'Rider Deleted', Response::HTTP_OK);
    }
}
