<?php

namespace App\Services;
use App\Config\Curl;

class PartnerService
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
			 $response = $this->curl->send('GET','partner','', '','display');	
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
			 $response = $this->curl->send('POST','partner-filter','',$inputs,'filter');		
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
			$response = $this->curl->send('POST','partner/store', '', $inputs,'insert');
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
	
	public function edit($id)
    {
        try {
			 $response = $this->curl->send('GET','partner', $id,'','display');
			 
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
			 $response = $this->curl->send('POST','partner/update', $id, $inputs,'update');
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
