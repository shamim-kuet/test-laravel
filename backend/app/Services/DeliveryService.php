<?php

namespace App\Services;
use App\Config\Curl;

class DeliveryService
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
			 $response = $this->curl->send('GET','delivery','', '','display');
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
    public function hubAssignedList()
    {
       try {
            $response = $this->curl->send('GET','delivery/hubAssignedList','', '','display');
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


    public function deliveryCashRecivedList()
     {
        try {
			 $response = $this->curl->send('GET','delivery/deliveryCashRecivedList','', '','display');
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



	public function newdelivery()
     {
        try {
			 $response = $this->curl->send('GET','delivery/newdelivery','', '','display');
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
			 $response = $this->curl->send('POST','delivery-filter','',$inputs,'filter');
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

    public function deliveryCashRecivedFilter($inputs)
    {
        try {
			 $response = $this->curl->send('POST','deliveryCashRecived-filter','',$inputs,'filter');
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
			$response = $this->curl->send('POST','delivery/store', '', json_encode($inputs),'insert');
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
		$inputs['updated_by'] = session('user_id');
		$inputs['partner_id'] = 1;
        try {
			// dd($inputs);
			$response = $this->curl->send('POST','delivery/reassign', '', json_encode($inputs),'insert');
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
			 $response = $this->curl->send('GET','delivery', $id,'','display');
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


	public function update($inputs)
    {
		$inputs['updated_by'] = session('user_id');
		// dd($inputs);
        try {
			 $response = $this->curl->send('POST','delivery/update', '', json_encode($inputs),'update');
			// dd($response);
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



    public function rider_report($inputs){
        // dd($inputs);
        try {
            $response = $this->curl->send('GET','rider_report','', json_encode($inputs),'filter');
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


    public function riderReportFilter($inputs)
    {
        try {
			 $response = $this->curl->send('POST','riderReport-filter','',$inputs,'filter');
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


    public function riderDeliveryReport()
    {
       try {
            $response = $this->curl->send('GET','riderDeliveryReport','', '','display');
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

   public function riderDeliveryReportFilter($inputs)
   {
       try {
            $response = $this->curl->send('POST','riderDeliveryReport-filter','',$inputs,'filter');
        //    dd($response);
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

   public function hubDeliveryReport()
    {
       try {
            $response = $this->curl->send('GET','hubDeliveryReport','', '','display');
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

   public function hubDeliveryReportFilter($inputs)
   {
       try {
            $response = $this->curl->send('POST','hubDeliveryReport-filter','',$inputs,'filter');
        //    dd($response);
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

}
