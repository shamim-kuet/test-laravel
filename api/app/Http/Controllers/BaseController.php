<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public $user;


    public function __construct()
    {
        /*$this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });*/
    }

    /**
     * Return data with json response and response code success
     * @return JsonResponse
     */
    public function successResponse($result, $message, $responseCode)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $responseCode);
    }


    /**
     * Return error json response
     * @return JsonResponse
     */
    public function errorRessponse($error, $errorMessages = [], $code = 404)
    {
        try {
            $response = [
                'success' => false,
                'message' => $error,
            ];

            if(!empty($errorMessages)){
                $response['error'] = $errorMessages;
            }


            return response()->json($response, $code);
        } catch (\Throwable $th) {
            return response()->json( $th->getMessage());
        }
    }
}
