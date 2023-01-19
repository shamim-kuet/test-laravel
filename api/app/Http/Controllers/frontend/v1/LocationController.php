<?php

namespace App\Http\Controllers\frontend\v1;

use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LocationController extends BaseController
{
    /**
     * Construct example controller
     */
     public function __construct()
     {
//         $this->middleware('auth:customer');
     }

    /**
     * Get resources data from storage
     * @return JsonResponse
     */
    public function cities(Request $request)
    {
        $query = DB::table('cities')->select('id', 'country_id', 'state_id', 'name')->orderBy('id');
        if ($request['limit']) {
            $query->limit($request['limit']);
        }
        $data = $query->get();

        return $this->successResponse($data, 'Data retrieved successfully', Response::HTTP_OK);
    }

    /**
     * Get resources data from storage
     * @return JsonResponse
     */
    public function states(Request $request)
    {
        $query = DB::table('states')->select('id', 'country_id', 'name')->orderBy('id');
        if ($request['limit']) {
            $query->limit($request['limit']);
        }
        $data = $query->get();

        return $this->successResponse($data, 'Data retrieved successfully', Response::HTTP_OK);
    }

    /**
     * Get resources data from storage
     * @return JsonResponse
     */
    public function countries(Request $request)
    {
        $query = DB::table('countries')->select('id', 'name', 'iso2', 'iso3', 'phone_code', 'currency')->orderBy('id');
        if ($request['limit']) {
            $query->limit($request['limit']);
        }
        $data = $query->get();

        return $this->successResponse($data, 'Data retrieved successfully', Response::HTTP_OK);
    }
}
