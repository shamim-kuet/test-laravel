<?php

namespace App\Http\Controllers\frontend\v1;

use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ExampleApiController extends BaseController
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
    public function index(Request $request)
    {
        $data = "Hello World!";

        return $this->successResponse($data, 'Data retrieved successfully', Response::HTTP_OK);
    }

    /**
     * Store resources to storage
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'group_id'      => 'required|exists:groups,id',
        ]);
        $data = [];

        return $this->successResponse($data, 'Data stored successfully', Response::HTTP_OK);
    }

    /**
     * Update resources to storage
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'group_id'      => 'required|exists:groups,id',
        ]);
        $data = [];

        return $this->successResponse($data, 'Data updated successfully', Response::HTTP_OK);
    }

    /**
     * Delete resources from storage
     * @return JsonResponse
     */
    public function destroy($id, Request $request)
    {
        $data = [];

        return $this->successResponse($data, 'Data deleted successfully', Response::HTTP_OK);
    }
}
