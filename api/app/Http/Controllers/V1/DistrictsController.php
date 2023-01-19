<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\CodchargeResource;
use App\Models\Codcharge;
use App\Models\District;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DistrictsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return CodchargeResource
     */
    public function index()
    {
        $data = District::orderBy('district_name')->get();
        // $data = Codcharge::orderBy('id','DESC')->get();
		return $this->successResponse($data, 'All Districts List', Response::HTTP_OK);

    }


}
