<?php

namespace App\Services;
use App\Config\Curl;

class PickupService
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
			 $response = $this->curl->send('GET','pickup','', '','display');
			//  dd($response);
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


    public function riderPickUpReport()
    {
       try {
            $response = $this->curl->send('GET','riderPickUpReport','', '','display');
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


	public function printInvoice($id)
     {
        try {

			 $response = $this->curl->send('GET','pickup/print',$id, '','display');
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



	public function newpickup()
     {
        try {
			 $response = $this->curl->send('GET','pickup/newpickup','', '','display');
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
			 $response = $this->curl->send('POST','pickup-filter','',$inputs,'filter');
			//dd($response);
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

    public function riderPickUpReportFilter($inputs)
    {
        try {
			 $response = $this->curl->send('POST','riderPickUpReport-filter','',$inputs,'filter');
			//dd($response);
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
			//dd(json_encode($inputs));
			$response = $this->curl->send('POST','pickup/store', '', json_encode($inputs),'insert');
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
    public function reassign($inputs)
    {
		$inputs['created_by'] = session('user_id');
		$inputs['partner_id'] = 1;
        try {
			// dd(json_encode($inputs));
			$response = $this->curl->send('POST','pickup/reassign', '', json_encode($inputs),'insert');
			// dd($response);
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
			 $response = $this->curl->send('GET','pickup/edit', $id,'','display');
             //dd($response);
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
			 $response = $this->curl->send('POST','pickup/update', $id, json_encode($inputs),'update');
			//  dd($response);
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
