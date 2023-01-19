<?php

namespace App\Http\Controllers\frontend\v1;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use App\Http\Controllers\BaseController;
use App\Models\Customer;
use App\Models\Otp;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Helper;

class AuthController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    //

    public function login(Request $request)
    {
        if (!$request->otp|| $request->otp=="" ||empty($request->otp)) {
            return response()->json(['message' => 'Failed! please enter your OTP', 'status' => false], 401);
        }

        $verifie = $this->otpVerifie($request->phone, $request->otp);
        if ($verifie) {
            $user = Customer::where('contact', $request->phone)->select('id', 'fullname', 'contact', 'username', 'email', 'address', 'district', 'area', 'zipcode', 'photo')->first();

            if ($user != '') {
                $token = Auth::guard('customer-api')->login($user);
                return $this->respondWithToken($token);
            } else {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } else {
            return response()->json(['message' => 'Login Failed! Wrong OTP or OTP expire please tri again', 'status' => false], 401);
        }
    }

    public function profileUpdate(Request $request)
    {
        if (!$request->access_token || $request->access_token == "" || empty($request->access_token)) {
            return $this->faildResponse('unauthorized', 400);
        } else {
            $token_info = json_decode(base64_decode($request->access_token));
            if (Customer::where('id', $token_info->id)->where('token', $request->access_token)->first()) {
                $request->merge(['customer_id' => $token_info->id]);
            } else {
                return $this->faildResponse('unauthorized', 400);
            }
        }
        if ($request->contact) {
            if ($request->contact!="") {
                if (Customer::where("contact", $request->contact)->first()) {
                    return $this->faildResponse('contact number already exists', 400);
                }
            }
        }
        if ($request->email) {
            if ($request->email!="") {
                if (Customer::where("email", $request->email)->first()) {
                    return $this->faildResponse('email already exists', 400);
                }
            }
        }


        $request->merge(['updated_by' => $request->customer_id]);
        $request->merge(['updated_at' => date('Y-m-d H:i:s')]);

        // dd($request->all());
        $data = Customer::where('id', $request->customer_id)->create($request->except(['access_token','customer_id']));
        return $this->successResponse($data, 'Profile updated', Response::HTTP_OK);
    }




    public function Otp(Request $request, Otp $otp)
    {
        if (!$request->phone|| $request->phone=="" ||empty($request->phone)) {
            return response()->json(['message' => 'Failed! please enter your valid phone number', 'status' => false], 401);
        }
        $phone = $request->phone;

        $minute_to_add = 2;  //after how many minute otp will expire
        $currentDate = strtotime(date('Y-m-d H:i:s'));
        $futureDate = $currentDate + (60 * $minute_to_add);
        $exp = date("Y-m-d H:i:s", $futureDate);

        $otpnumber=rand(1000, 9999); //for real otp after sms gateway intrigation
        $message= $otpnumber;
        $response = Helper::sendSms($phone,$message);




        if($response['Status']==0){
        $otp->otp = $otpnumber;
        $otp->verified = false;
        $otp->user_types = 'customer_register';
        $otp->phone = $phone;
        $otp->exp_time = $exp;

        $otp->save();
        return response()->json(['status' => true, 'message' => 'Successfully otp generated']);
        }
        else{
            return response()->json(['status' => false, 'code'=>$response['Status'], 'message' => 'Failed']);
        }
    }

    public function otpVerifie($phone, $otp)
    {
        $phone = $phone;
        // $employee_id = $request->employee_id;
        $rider_otp = $otp;
        $rider = Customer::where('contact', $phone)->first();

        $user = $rider;
        if (is_null($rider)) {
            Customer::create(['contact'=>$phone]);
            // $rider=Customer::where('contact', $phone)->first();
        }

        $formattedCurrentDate = date('Y-m-d H:i:s');
        DB::table('otps')->where('exp_time', '<=', $formattedCurrentDate)->where('verified', '<>', true)->delete();

        $riderotp = Otp::where('phone', $phone)->where('exp_time', '>=', $formattedCurrentDate)->orderBy('id', 'DESC')->first();
        if ($riderotp) {
            if ($riderotp->otp == $rider_otp) {
                $riderotp->verified = true;
                $riderotp->save();

                return true;
            }
        }
        return false;
    }





    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['status' => true, 'message' => 'Successfully logged out']);
    }




    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        // $id = $user->id;
        // $phone= $user->contact;
        // $userData = array('id'=>$id,'phone'=>$phone);
        // $accessToken = base64_encode(json_encode($userData));

        // Customer::where('id', $id)->update(['token' => $accessToken]);
        $user =  Auth::guard('customer-api')->user();

        return response()->json([
            'customer' => $user,
            'status' => true,
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }
}
