<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Hub;
use App\Services\Validation;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductResource
     */
    public function index()
    {
        $user = Auth::user();
        $roleid = $user->user_type;
        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = Product::with('merchant', 'merchant.business', 'store')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $data = Product::with('merchant', 'merchant.business', 'store')->orderBy('id', 'DESC')->get();
        }
        return $this->successResponse(ProductResource::collection($data), 'All Product List', Response::HTTP_OK);
    }

    public function indexMerchant()
    {
        $merchantId = auth('merchant')->id();
        $data = Product::with('merchant', 'store')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();
        return $this->successResponse(ProductResource::collection($data), 'All Product List', Response::HTTP_OK);
    }

    public function filter($filterdata = '', $type = '')
    {
        if ($type!='' && $type=='csv') {
            if ($filterdata!="") {
                $merchant_id = $filterdata['merchant_id'] ??= '';
                $formdate = $filterdata['formdate'] ??= '';
                $todate = $filterdata['todate'] ??= '';
                $keyword = $filterdata['keyword'] ??= '';
                $status = $filterdata['status'] ??= '';
            } else {
                $merchant_id = '';
                $formdate = '';
                $todate = '';
                $keyword = '';
                $status = '';
            }
        } else {
            $merchant_id = request()->merchant_id;
            $formdate = request()->formdate;
            $todate = request()->todate;
            $keyword = request()->keyword;
            $status = request()->status;
        }



        $query = Product::query();
        if ($keyword != "") {
            $search = $keyword;
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('sku', 'LIKE', '%' . $search . '%')
                    ->orWhere('price', 'LIKE', '%' . $search . '%')
                    ->orWhere('subtitle', 'LIKE', '%' . $search . '%');
            });
        }

        if ($merchant_id != "") {
            $query->orWhere('merchant_id', $merchant_id);
        }

        if ($status != "") {
            $query->where('status', $status);
        }

        if ($formdate != "" && $todate != "") {
            $query->whereDate('created_at', '<=', $todate);
            $query->whereDate('created_at', '>=', $formdate);
        } elseif ($formdate == "" && $todate != "") {
            $query->whereDate('created_at', '<=', $todate);
        } elseif ($formdate != "" && $todate == "") {
            $query->whereDate('created_at', '>=', $formdate);
        }

        $user = Auth::user();
        $roleid = $user->user_type;
        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = $query->with('merchant', 'merchant.business', 'store')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id', 'DESC')->get();
        } else {
            $data = $query->with('merchant', 'merchant.business', 'store')->orderBy('id', 'DESC')->get();
        }

        if ($type!='' && $type=='csv') {
            return $data;
        } else {
            return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
        }
    }


    public function merchantFilter($filterdata = '', $type = '')
    {
        $query = Product::query();
        if ($type!='' && $type=='csv') {
            if ($filterdata!="") {
                $formdate = $filterdata['formdate'] ??= '';
                $todate = $filterdata['todate'] ??= '';
                $keyword = $filterdata['keyword'] ??= '';
                $status = $filterdata['status'] ??= '';
            } else {
                $merchant_id = '';
                $formdate = '';
                $todate = '';
                $keyword = '';
                $status = '';
            }
        } else {
            $formdate = request()->formdate;
            $todate = request()->todate;
            $keyword = request()->keyword;
            $status = request()->status;
        }



        if ($keyword != "") {
            $search = $keyword;
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('sku', 'LIKE', '%' . $search . '%')
                    ->orWhere('price', 'LIKE', '%' . $search . '%')
                    ->orWhere('subtitle', 'LIKE', '%' . $search . '%');
            });
        }

        if ($status != "") {
            $query->where('status', $status);
        }

        if ($formdate != "" && $todate != "") {
            $query->whereBetween('created_at', [$formdate, $todate]);
        } elseif ($formdate == "" && $todate != "") {
            $query->whereDate('created_at', '<=', $todate);
        } elseif ($formdate != "" && $todate == "") {
            $query->whereDate('created_at', '>=', $formdate);
        }

        $merchantId = auth('merchant')->id();
        $data = $query->with('merchant', 'store')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();

        if ($type!='' && $type=='csv') {
            return $data;
        } else {
            return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
        }
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
    public function store(Request $request, Product $hub)
    {
        $request->merge(['partner_id' => 1]);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sku' => 'required|unique:App\Models\Product,sku'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            $productService = new Validation();
            $validation = $productService->storeValidation($error);

            return $this->errorRessponse('Failed', $validation, Response::HTTP_CREATED);
        }



        $data = $hub->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
        $hub = Product::with('merchant','merchant.business', 'store')->find($id);
        return $this->successResponse($hub, 'Product List', Response::HTTP_OK);
    }
    public function showMerchant($id)
    {
        $merchantId = auth('merchant')->id();
        $hub = Product::with('merchant','merchant.business','store')->where('merchant_id', $merchantId)->find($id);
        return $this->successResponse($hub, 'Product List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $hub
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hub = Product::with('merchant', 'store')->find($id);
        return $this->successResponse($hub, 'Specific Product Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $hub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hub = Product::find($id);
        $data = $hub->update($request->all());
        return $this->successResponse($data, 'Product Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $hub
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $hub)
    {
        $result = $hub->delete();
        return $this->successResponse($result, 'Product Deleted', Response::HTTP_OK);
    }
}
