<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\StoreResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Store;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Hub;
use App\Services\Validation;

class StoreController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return StoreResource
     */
    public function index()
    {
        $user = Auth::user();
        $roleid = $user->user_type;

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = Store::with('merchant')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();

        } else {
            $data = Store::with('merchant')->orderBy('id', 'DESC')->get();
        }
        // $data = Store::orderBy('id', 'DESC')->get();
        return $this->successResponse(StoreResource::collection($data), 'All Store List', Response::HTTP_OK);
    }
    public function indexMerchant()
    {
        $merchantId = auth('merchant')->id();
        $data = Store::orderBy('id', 'DESC')->where('merchant_id', $merchantId)->get();
        return $this->successResponse(StoreResource::collection($data), 'All Store List', Response::HTTP_OK);
    }

    public function filter(Request $request)
    {
        $query = Store::query();
        if ($request->keyword != "") {
            $search = $request->get('keyword');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('address', 'LIKE', '%' . $search . '%');
            });
        }
        if ($request->status != "") {
            $query->where('status', $request->status);
        }

        if ($request->isready != "") {
            $query->where('isready', $request->isready);
        }

        if ($request->fromdate != "" && $request->todate != "") {
            $query->whereBetween('created_at', [$request->fromdate, $request->todate]);
        } elseif ($request->fromdate == "" && $request->todate != "") {
            $query->whereDate('created_at', '<=' ,$request->todate);
        } elseif ($request->fromdate != "" && $request->todate == "") {
            $query->whereDate('created_at', '>=' ,$request->fromdate);
        }

        $user = Auth::user();
        $roleid = $user->user_type;

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = $query->with('merchant')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();

        } else {
            $data = $query->with('merchant')->orderBy('id', 'DESC')->get();
        }

        // $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
    }

    public function merchantFilter(Request $request)
    {
        $query = Store::query();
        if ($request->keyword != "") {
            $search = $request->get('keyword');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('address', 'LIKE', '%' . $search . '%');
            });
        }
        if ($request->status != "") {
            $query->where('status', $request->status);
        }

        // if ($request->isready != "") {
        //     $query->where('isready', $request->isready);
        // }

        if ($request->formdate != "" && $request->todate != "") {
            $query->whereDate('created_at','<=', $request->todate);
            $query->whereDate('created_at','>=', $request->formdate);
        } elseif ($request->formdate == "" && $request->todate != "") {
            $query->whereDate('created_at','<=', $request->todate);
        } elseif ($request->formdate != "" && $request->todate == "") {
            $query->whereDate('created_at','>=', $request->formdate);
        }
        // $user = Auth::user();
        // $roleid = $user->user_type;

        // if ($roleid == 29) {
        //     $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
        //     $data = $query->with('merchant')->whereHas("merchant", function ($subQuery) use ($hub) {
        //         $subQuery->where("hub_id", "=", $hub->id);
        //     })->orderBy('id', 'DESC')->get();

        // } else {
        //     $data = $query->with('merchant')->orderBy('id', 'DESC')->get();
        // }

        $merchantId = auth('merchant')->id();
        $data = $query->orderBy('id', 'DESC')->where('merchant_id', $merchantId)->get();

        // $data = $query->orderBy('id', 'DESC')->get();
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
    public function store(Request $request, Store $store)
    {
        $request->merge(['status' => 1]);
        $request->merge(['partner_id' => 1]);

        $validator = Validator::make($request->all(), [
            'email' => 'unique:App\Models\Store,email',
            'name'=> 'required',
            'phone'=> 'required',
            'region' => 'required',
            'area' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            $productService = new Validation;
            $validation = $productService->storeValidation($error);

            return $this->errorRessponse('Failed', $validation, Response::HTTP_CREATED);
        }

        // if ($validator->fails()) {
        //     $error = $validator->errors();
        //     foreach($error->toArray() as $err){
        //         $errmsg[] = $err;
        //     }
        //     return $this->errorRessponse('Failed', $errmsg, Response::HTTP_CREATED);
        // }

        // if ($validator->fails()) {
		// 	$error = $validator->errors();
		//     return $this->errorRessponse('Failed', $error, Response::HTTP_CREATED);
        // }




        $data = $store->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }

    public function showMerchant($id)
    {
        $merchantId = auth('merchant')->id();
        $store = Store::where('merchant_id', $merchantId)->find($id);
        return $this->successResponse($store, 'Store List', Response::HTTP_OK);
    }

    public function show($id)
    {
        $store = Store::find($id);
        return $this->successResponse($store, 'Store List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);
        return $this->successResponse($store, 'Specific Store Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $store = Store::find($id);
        $data = $store->update($request->all());
        return $this->successResponse($data, 'Store Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $result = $store->delete();
        return $this->successResponse($result, 'Store Deleted', Response::HTTP_OK);
    }
}
