<?php


namespace App\Services;

use Carbon\Carbon;
use Exception;
use App\Services\RoleHasPermissionService;


class UtilityService
{
    // public function __construct(RoleHasPermissionService $roleHasPermissionService)
    // {
	// 	 $this->roleHasPermissionService = $roleHasPermissionService;

    // }


    public static function storeSession($result): void
    {
        $response =  $result->permission;

                foreach ($response as $d=>$value){
                    $permission[$d]=$value->guard_name;
                }
                session()->put('permission', $permission);
        // $permission = $this->roleHasPermissionService->permissions();
        // $permission = RoleHasPermissionService::permissions();
        session()->put('user_id', $result->user->id);
		session()->put('mobile_number', $result->user->phone);
        session()->put('email', $result->user->email);
        session()->put('username', $result->user->username);
        session()->put('role_id', $result->user->user_type);
        session()->put('name', $result->user->name);
        session()->put('partner_id', $result->user->partner_id);
        session()->put('token', $result->access_token);
        session()->put('token_type', $result->token_type);
        session()->put('expires_in', $result->expires_in);
    }



    public static function loadImage($file_url)
    {
        $file_headers = get_headers($file_url);

        if (in_array('HTTP/1.0 404 Not Found', $file_headers))
            return asset('/assets/media/img/default.png');

        else if (in_array('HTTP/1.0 404 Not Found', $file_headers))
            return asset('/assets/media/img/default.png');

        else
            return $file_url;
			//return asset('/upload/images/course_image/'.$file_url);
    }
	
    public static function checkPermission($permission)
    {
        $permissionArray=session()->get('permission');
        return in_array($permission,$permissionArray);

    }
	
	public static function commonDateFormate($date)
    {
        return date('Y-m-d',strtotime($date));
    }
	
	public static function number($amount)
    {
		return number_format($amount,2);
    }



}
