<?php

namespace App\Services;

use App\Config\Curl;

class MerchantService
{
    /**
     * @param $inputs
     * @return mixed
     */

    public $curl;


    public function __construct(Curl $curl)
    {
        $this->curl = $curl;
    }


     public function index()
     {
         try {
             $response = $this->curl->send('GET', 'merchant', '', '', 'display');
             // dd($response);
             if ($response->success == true) {
                 $data = array('status' => true, 'message' => $response->message, 'data' => $response->data);
                 return $data;
             } else {
                 return ['status' => false, 'message' => ($response['message'] ?? 'Failed')];
             }
         } catch (\Exception $exception) {
             \Helper::handleException($exception);
             return ['status' => false, 'message' => 'Something went wrong'];
         }
     }


    public function filter($inputs)
    {
        try {
            $response = $this->curl->send('POST', 'merchant-filter', '', $inputs, 'filter');
            if ($response->success == true) {
                $data = array('status' => true, 'message' => $response->message, 'data' => $response->data);
                return $data;
            } else {
                return ['status' => false, 'message' => ($response['message'] ?? 'Failed')];
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }

    public function create($inputs)
    {
        $inputs['created_by'] = session('user_id');
        $inputs['partner_id'] = 1;
        try {
            // dd($inputs);
            $response = $this->curl->send('POST', 'merchant/store', '', json_encode($inputs), 'insert');
            // dd($response);
            if ($response->success == true) {
                $data = array('status' => true, 'message' => $response->message);
                return $data;
            } else {
                return ['status' => false, 'error'=>$response->error, 'message' => ($response->message ?? 'Failed')];
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->curl->send('GET', 'merchant', $id, '', 'display');

            if ($response->success == true) {
                $data = array('status' => true, 'message' => $response->message, 'data' => $response->data);
                return $data;
            } else {
                return ['status' => false, 'message' => ($response['message'] ?? 'Failed')];
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }
    public function show($id)
    {
        try {
            $response = $this->curl->send('GET', 'merchant', $id, '', 'display');

            if ($response->success == true) {
                $data = array('status' => true, 'message' => $response->message, 'data' => $response->data);
                return $data;
            } else {
                return ['status' => false, 'message' => ($response['message'] ?? 'Failed')];
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }


    public function update($inputs, $id)
    {
        $inputs['updated_by'] = session('user_id');
        $inputs['partner_id'] = 1;
        // try {
        $response = $this->curl->send('POST', 'merchant/update', $id, $inputs, 'update');
        //  dd($response);
        if ($response->success == true) {
            $data = array('status' => true, 'message' => $response->message);
            return $data;
        } else {
            return ['status' => false, 'message' => ($response['message'] ?? 'Failed')];
        }
        // } catch (\Exception $exception) {
        //     \Helper::handleException($exception);
        //     return ['status' => false, 'message' => 'Something went wrong'];
        // }
    }


    public function hubAssign($inputs)
    {
        $inputs['updated_by'] = session('user_id');
        $inputs['partner_id'] = 1;
        // dd($inputs);
        try {
            $response = $this->curl->send('POST', 'merchant/hubassign', '', json_encode($inputs), 'update');
            //dd($response);
            if ($response->success == true) {
                $data = array('status' => true, 'message' => $response->message);
                return $data;
            } else {
                return ['status' => false, 'message' => ($response['message'] ?? 'Failed')];
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }
}
