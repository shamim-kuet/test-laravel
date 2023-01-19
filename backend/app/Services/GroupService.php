<?php

namespace App\Services;

use App\Config\Curl;

class GroupService
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
            $response = $this->curl->send('GET', 'group', '', '', 'display');

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



    public function groupWithPermission()
    {
        try {
            $response = $this->curl->send('GET', 'group/permission', '', '', 'display');
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
            $response = $this->curl->send('POST', 'group-filter', '', $inputs, 'filter');
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
        try {
            $response = $this->curl->send('POST', 'group/store', '', $inputs, 'insert');
            if ($response->success == true) {
                $data = array('status' => true, 'message' => $response->message);
                return $data;
            } else {
                return ['status' => false, 'message' => ($response->message ?? 'Failed')];
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->curl->send('GET', 'group', $id, '', 'display');

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
        try {
            $response = $this->curl->send('POST', 'group/update', $id, $inputs, 'update');
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
