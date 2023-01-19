<?php

namespace App\Services\Login;

use App\Config\Curl;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginService
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

    public function postLogin($inputs)
    {

        try {
            $response =  $this->curl->send('POST', 'login', '', $inputs, 'insert');
            // dd($response);
            if ($response->status == true) {

                $this->loadAllUserInfo($response);

                $data = array('status' => true, 'message' => 'Welcome Back! ' . $response->user->fullname);
                return $data;
            } else {
                return ['status' => false, 'message' => $response->message];
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);
            // dd($exception);
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }

    public function loadAllUserInfo($response)
    {
        // dd($response);
        \Utility::storeSession($response);
    }

    public function logout()
    {
        try {
            $response =  $this->curl->send('POST', 'logout', '', '', 'display');
            //dd($response);
            if ($response != null) {
                if ($response->status == true) {
                    $data = array('status' => true);
                    return $data;
                } else {
                    return ['status' => false, 'message' => ($response['message'] ?? 'Credential didn\'t match any record')];
                }
            } else {
                $data = array('status' => true);
                return $data;
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }
    // public function permissions()
    // {
    //     $role_id = session()->get('role_id');

    //     try {
    //         $response = $this->curl->send('GET', 'role-permission/permission', $role_id, '', '');

    // if ($response->success == true) {
    //     $data =  $response->data;
    //     //  dd($data);
    //     // session()->put('permission', []);
    //     foreach ($data as $d=>$value){
    //         $permission[$d]=$value->guard_name;
    //     }
    //     session()->put('permission', $permission);
    //     $role = session()->get('permission');
    //     dd($role);
    //     return  true;
    // } else {
    //     return ['status' => false, 'message' => ($response['message'] ?? 'Failed')];
    // }
    //     } catch (\Exception $exception) {
    //         \Helper::handleException($exception);
    //         return ['status' => false, 'message' => 'Something went wrong'];
    //     }
    // }

}
