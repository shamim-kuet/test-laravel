<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use Intervention\Image\Facades\Image as Image;
use App\Services\RoleHasPermissionService;

class UtilityService
{
    // public function __construct(RoleHasPermissionService $roleHasPermissionService)
    // {
    // 	 $this->roleHasPermissionService = $roleHasPermissionService;

    // }


    public static function storeSession($result)
    {
        $response =  $result->permission;
        foreach ($response as $d => $value) {
            $permission[$d] = $value->guard_name;
        }

        if (!isset($permission)) {
            $permission[] = '';
        }
        session()->put('permission', $permission);
        // $permission = $this->roleHasPermissionService->permissions();
        // $permission = RoleHasPermissionService::permissions();
        session()->put('user_id', $result->user->id);
        session()->put('mobile_number', $result->user->contact);
        session()->put('designation', $result->user->designation);
        session()->put('email', $result->user->email);
        session()->put('username', $result->user->username);
        session()->put('role_id', $result->user->role);
        session()->put('name', $result->user->fullname);
        // session()->put('partner_id', $result->user->partner_id);
        session()->put('token', $result->access_token);
        session()->put('token_type', $result->token_type);
        session()->put('expires_in', $result->expires_in);
    }



    public static function loadImage($file_url)
    {
        $file_headers = get_headers($file_url);

        if (in_array('HTTP/1.0 404 Not Found', $file_headers)) {
            return asset('/assets/media/img/default.png');
        } elseif (in_array('HTTP/1.0 404 Not Found', $file_headers)) {
            return asset('/assets/media/img/default.png');
        } else {
            return $file_url;
        }
        //return asset('/upload/images/course_image/'.$file_url);
    }

    public static function checkPermission($permission)
    {
        $permissionArray = session()->get('permission');
        if ($permissionArray != "") {
            return in_array($permission, $permissionArray);
        }
    }

    public static function commonDateFormate($date)
    {
        $date = !empty($date) ? date('Y-m-d', strtotime($date)) : " ";
        return $date;
    }

    public static function dateFormatting($date)
    {
        $date = !empty($date) ? date('l, d F Y', strtotime($date)) : " ";
        return $date;
    }

    public static function numberFormatting($number)
    {
        return number_format($number, 2);
    }

    public static function number($amount)
    {
        $amountFormate = !empty($amount) ? number_format($amount, 2) : $amount;

        return $amountFormate;
    }


    public static function checkNullDate($date)
    {
        $dateResponse = !empty($date) ? $date : date('Y-m-d');
        return $dateResponse;
    }


    public static function uploadFile($dir, $filename, $width, $height)
    {
        $savedFileName = '';

        if (request()->hasFile($filename)) {
            if (request()->file($filename)->isValid()) {
                try {
                    $file = request()->file($filename);
                    $savedFileName = $filename . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $directory = 'uploads/' . $dir;
                    $pathLarge = $directory . '/' . $savedFileName;

                    if (!is_dir($directory)) {
                        mkdir($directory, 777, true);
                    }

                    if ($width == 0) {
                        $file->move($directory, $savedFileName);
                    } else {
                        self::imageResize($file, $pathLarge, $savedFileName, $width, $height);
                    }
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                }
            }
        }

        return $savedFileName;
    }






    public static function uploadDocument($dir, $filename)
    {
        $savedFileName = '';

        if (request()->hasFile($filename)) {
            if (request()->file($filename)->isValid()) {
                try {
                    $file = request()->file($filename);

                    $savedFileName = $filename . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $directory = 'uploads/' . $dir;
                    $pathLarge = $directory;

                    if (!is_dir($directory)) {
                        mkdir($directory, 777, true);
                    }

                    $file->move($pathLarge, $savedFileName);
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                }
            }
        }

        return $savedFileName;
    }


    public static function imageResize($file, $path, $filename, $width, $height)
    {
        $img = Image::make($file);
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->resizeCanvas($width, $height, 'center', false, array(255, 255, 255, 0));
        $img->save($path);
    }
}
