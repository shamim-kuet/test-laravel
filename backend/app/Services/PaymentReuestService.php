<?php

namespace App\Services;
use App\Config\Curl;

class PaymentReuestService
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
			 $response = $this->curl->send('GET','paymentrequest','', '','display');
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



    public function create($inputs)
    {
		$inputs['created_by'] = session('user_id');
        $inputs['partner_id'] = 1;

        try {
			// dd($inputs);
			$response = $this->curl->send('POST','paymentrequest/store', '', $inputs,'insert');
			//dd($response);
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

	public function update($inputs)
    {
		$inputs['updated_by'] = session('user_id');
		//dd($inputs);
        try {
			 $response = $this->curl->send('POST','paymentrequest/update', '', json_encode($inputs),'update');
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
