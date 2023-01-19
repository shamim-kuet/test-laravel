<?php

namespace App\Services;
use App\Config\Curl;

class UserService
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
			$response = $this->curl->send('GET','admin','', '','display');
            // dd($response);
			//if($response!='Unauthorized'){
				if ($response->success == true) {
					$data = array('status' => true, 'message' => $response->message, 'data' => $response->data);
					return $data;
				} else {
					return ['status' => false, 'message' => ($response['message'] ?? 'Failed')];
				}
			/*}
			else{
				return redirect(route('logout'));
			}*/
        } catch (\Exception $exception) {
            \Helper::handleException($exception);
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }


	public function filter($inputs)
    {
		//dd($inputs);
        try {
			 $response = $this->curl->send('POST','admin-filter','',$inputs,'filter');
			//  dd( $response);
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
			$response = $this->curl->send('POST','admin/store', '', $inputs,'insert');
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

	public function edit($id)
    {
        try {
			 $response = $this->curl->send('GET','admin', $id,'','display');

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
			 $response = $this->curl->send('POST','admin/update', $id, $inputs,'update');
			 //dd($inputs);
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
