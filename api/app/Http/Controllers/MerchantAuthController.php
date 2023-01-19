<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Otp;
use Illuminate\Http\Request;
use App\Models\RoleHasPermission;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;

class MerchantAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:merchant', ['except' => ['login', 'register']]);
    }



    public function login(Request $request)

    {

        // Validate passed parameters

        $this->validate($request, [

            'username' => 'required',

            'password' => 'required',

        ]);

        // Get the user with the email

        $user = Merchant::with('hub:id,name','business:id,merchant_id,name')->where('username', $request['username'])->where('canlogin',1)->where('status',1)->first();




        if ($user != '') {
            $user->makeHidden(['password','created_at','updated_at','deleted_at','deleted_by','updated_by','created_by']);
            if (Hash::check($request['password'], $user['password'])) {

                //dd($user);

                try {

                    // verify the credentials and create a token for the user

                    if (!$token = JWTAuth::fromUser($user)) {

                        return response()->json(['error' => 'invalid_credentials'], 401);
                    } else {
                        $url=DB::select("select* from settings where id = 1 LIMIT 1");

                            $user->url=$url[0]->default_url;
                            $user->image_path ='uploads/merchant/contact_person/';


                        return $this->respondWithToken($user, $token);
                    }
                } catch (JWTException $e) {

                    // something went wrong

                    return response()->json(['error' => 'could_not_create_token'], 500);
                }
            } else {

                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } else {

            return response()->json(['error' => 'invalid_credentials'], 401);
        }
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
    protected function respondWithToken($user, $token)
    {


        $id = $user->user_type;
        // $permission = RoleHasPermission::join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')->where('role_has_permissions.role_id', '=', $id)->get(['permissions.guard_name']);
        return response()->json([
            'user' => $user,
            // 'permission' => $permission,
            'status' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
