<?php

namespace App\Http\Controllers\frontend\v1;

use App\Http\Controllers\BaseController;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class OrderController extends BaseController
{
    /**
     * Construct order controller
     */
     public function __construct()
     {
//         $this->middleware('auth:customer');
     }

    /**
     * Place order with appropriate data
     * @return JsonResponse
     */
    public function placeOrder(Request $request)
    {
        $data = [];

        return $this->successResponse($data, 'Data retrieved successfully', Response::HTTP_OK);
    }
}
