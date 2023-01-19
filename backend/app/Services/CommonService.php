<?php

namespace App\Services;

use App\Config\Curl;
use Illuminate\Support\Facades\Hash;

class CommonService
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


    public function index($slug)
    {
        try {
            $response = $this->curl->send('GET', 'common/' . $slug, '', '', 'display');
            // dd($response);
            if ($response->success == true) {
                $data = array('status' => true, 'message' => $response->message, 'data' => $response->data);
                return $data;
            } else {
                return ['status' => false, 'message' => ($response->message ?? 'Failed')];
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }


    public function getCommonData($slug)
    {
        $getResult = $this->index($slug);

        if ($getResult['status'] == true) {
            $data = $getResult['data'];
        } else {
            $data = '';
        }

        return $data;
    }
}
