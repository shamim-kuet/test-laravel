<?php

namespace App\Services;
use App\Config\Curl;
use Illuminate\Support\Facades\Hash;

class BannerService
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
			$response = $this->curl->send('GET','banner','', '','display');	
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
			 $response = $this->curl->send('POST','banner-filter','',$inputs,'filter');		
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
			$response = $this->curl->send('POST','banner/store', '', $inputs,'insert');
			//dd($response);
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
			 $response = $this->curl->send('GET','banner', $id,'','display');
			 
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
			 $response = $this->curl->send('POST','banner/update', $id, $inputs,'update');
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
