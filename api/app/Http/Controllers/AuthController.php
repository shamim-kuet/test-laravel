<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\RoleHasPermission;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

	 public function register(Request $reqquest){
	 	$this->validate($reqquest, [
			//'username' => 'required|unique:users,username,2,id',
			'username' => 'required|unique:users,username',
			'password' => 'required|confirmed'
		]);
		$username = $reqquest->input('username');
		$email = $reqquest->input('email');
		$phone = $reqquest->input('phone');
		$password = Hash::make($reqquest->input('password'));

		User::create(['username'=>$username,'password'=>$password,'email'=>$email,'phone'=>$phone]);
		return response()->json(['status'=>'success','message'=>'created']);
	}

    public function login(Request $request)
    {
		$credentials = request(['password', 'username']);
        //return $credentials;

		$this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

		$fieldType = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

// return $fieldType;
        if(! $token = auth()->attempt(array($fieldType => $credentials['username'], 'password' => $credentials['password'])))
        {
			return response()->json(['message' => 'Login Failed! Wrong Credentials','status' => false], 401);
		}

        //return $token;
        return $this->respondWithToken($token);
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

        return response()->json(['status'=>true, 'message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
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

		$user = Auth::user();
        $id=$user->user_type;
        $permission = RoleHasPermission::join('permissions','role_has_permissions.permission_id', '=' , 'permissions.id')->where('role_has_permissions.role_id','=',$id)->get(['permissions.guard_name']);

        return response()->json([
            'user' => $user,
            'permission'=>$permission,
			'status' => true,
			'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
