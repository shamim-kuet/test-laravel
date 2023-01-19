<?php

namespace App\Http\Controllers\frontend\v1;

use App\Http\Controllers\BaseController;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Division;
use App\Models\Shipping;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends BaseController
{
    public function division(Request $request)
    {
        $data = Division::select("id", "name")->orderBy('name')->get();
        return $this->successResponse($data, 'All Requested Data', Response::HTTP_OK);
    }

    public function district(Request $request)
    {
        // return $request->division_id;
        $data = District::where('division_id', $request->division_id)->select("id", "name")->orderBy('name')->get();
        return $this->successResponse($data, 'All Requested Data', Response::HTTP_OK);
    }
    public function area(Request $request)
    {
        $data = Area::where('district_id', $request->district_id)->select("id", "name")->orderBy('name')->get();
        return $this->successResponse($data, 'All Requested Data', Response::HTTP_OK);
    }


    public function index(Request $request)
    {
        $userId = auth('customer')->id();
        if ($userId == null) {
            return $this->faildResponse('unauthorized', 400);
        }

        $request->merge(['customer_id' => $userId]);

        $query = Shipping::query();
        $query->with('district:id,name', 'division:id,name', 'area:id,name')->where('customer_id', $request->customer_id)->select('district', 'division', 'area', 'id', 'address', 'set_as_default', 'address_type');

        if ($request->address_type != "") {
            $query->where('address_type', $request->address_type);
        }


        $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Address details', Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $userId = auth('customer')->id();
        if ($userId == null) {
            return $this->faildResponse('unauthorized', 400);
        }

        $request->merge(['customer_id' => $userId]);


        $request->merge(['created_by' => $request->customer_id]);
        $request->merge(['updated_by' => $request->customer_id]);
        $request->merge(['created_at' => date('Y-m-d H:i:s')]);
        $request->merge(['updated_at' => date('Y-m-d H:i:s')]);

        // dd($request->all());
        $data = Shipping::create($request->except(['access_token']));
        return $this->successResponse($data, 'Address details', Response::HTTP_OK);
    }

    public function update(Request $request)
    {
        $userId = auth('customer')->id();
        if ($userId == null) {
            return $this->faildResponse('unauthorized', 400);
        }

        $request->merge(['customer_id' => $userId]);

        $request->merge(['updated_by' => $request->customer_id]);

        $request->merge(['updated_at' => date('Y-m-d H:i:s')]);

        $data = Shipping::where('id', $request->id)->update($request->except(['access_token']));
        return $this->successResponse($data, 'Address details Updated', Response::HTTP_OK);
    }

    public function delete(Request $request)
    {
        $userId = auth('customer')->id();
        if ($userId == null) {
            return $this->faildResponse('unauthorized', 400);
        }

        $request->merge(['customer_id' => $userId]);


        $data = Shipping::where('id', $request->id)->delete();
        return $this->successResponse($data, 'Address deleted', Response::HTTP_OK);
    }
}
