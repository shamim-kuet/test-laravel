<?php

namespace App\Services;

use App\Config\Curl;

class InvoiceGenerateService
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
            $response = $this->curl->send('GET', 'invoicegenerate', '', '', 'display');
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


    public function filter($inputs)
    {
        try {
            $response = $this->curl->send('POST', 'invoicegenerate-filter', '', $inputs, 'filter');
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

    public function listFilter($inputs)
    {
        try {
            $response = $this->curl->send('POST', 'invoicegeneratelist-filter', '', $inputs, 'filter');
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

    public function generatedInvoice()
    {
        try {
            $response = $this->curl->send('GET', 'invoicegenerate/generated', '', '', 'display');
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
    public function billstatement($id)
    {
        try {
            // dd($id);
            $response = $this->curl->send('GET', 'invoicegenerate/billstatement', $id, '', 'display');
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
    public function ItemizedBill($id)
    {
        try {
            // dd($id);
            $response = $this->curl->send('GET', 'invoicegenerate/itemizedbill', $id, '', 'display');
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
    public function printInvoice($id)
    {
        try {
            // dd($id);
            $response = $this->curl->send('GET', 'invoicegenerate/print', $id, '', 'display');
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
    public function editInvoice($id)
    {
        try {
            // dd($id);
            $response = $this->curl->send('GET', 'invoicegenerate/edit', $id, '', 'display');
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

    public function save($inputs)
    {
        try {
            $inputs['created_by'] = session('user_id');
            // dd($inputs);
            $response = $this->curl->send('GET', 'invoicegenerate/save', '', json_encode($inputs), 'insert');
            //  dd($response);
            return $response;
        } catch (\Exception $exception) {
            \Helper::handleException($exception);
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }

    public function create($inputs)
    {
        try {
            $inputs['created_by'] = session('user_id');
            $response = $this->curl->send('GET', 'invoicegenerate/store', '', json_encode($inputs), 'insert');
            //  dd($response);
            return $response;
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
            $response = $this->curl->send('POST', 'invoicegenerate/update', '', json_encode($inputs), 'update');
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
