<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\Rider;
use App\Models\AssignPickup;
use App\Models\Deliverynote;
use Illuminate\Http\Request;
use App\Models\DeliveryManagement;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

class RiderAuthController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:rider', ['except' => ['login', 'register', 'forgetpassword', 'otpVerifie', 'changePassword', 'riderRegisterOtp']]);
    }

    public function register(Request $request, Rider $rider)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:riders',
            'phone' => 'required|unique:riders',
            'password' => 'required',
        ]);
        $phone = $request->phone;
        $otp = $request->otp;
        $formattedCurrentDate = date('Y-m-d H:i:s');
        DB::table('otps')->where('exp_time', '<=', $formattedCurrentDate)->where('verified', '<>', true)->delete();
        $riderotp = Otp::where('phone', $phone)->where('user_types', '=', 'rider_register')->orderBy('id', 'DESC')->first();
        if ($riderotp) {
            if ($riderotp->otp == $otp) {
                $riderotp->verified = true;
                $riderotp->save();
            } else {
                return response()->json(['error' => 'invalid otp'], 401);
            }
        } else {
            return response()->json(['error' => 'otp expired please resend otp'], 401);
        }



        try {
            $reqData = $request->all();
            $reqData['password'] = Hash::make($request->password);
            $reqData['partner_id'] = 1;
            $reqData['canlogin'] = 0;
            $reqData['status'] = 0;
            $data = $rider->create($reqData);
            return $this->successResponse($data, 'Created Successfully', 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Registration Failed', 'exception' => $exception], 500);
        }
    }

    public function UpdateProfile(Request $request){

        $userId = auth('rider')->id();
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $photo = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads/merchant';

            $image->move($destinationPath, $photo);

            $shellscript="mv uploads/merchant/".$photo." ../../backend/public/uploads/rider/";
            shell_exec($shellscript);
        } else {
            $photo = "";
        }


        $data=Rider::where('id',$userId)->update([
            "name"=>$request->name,
            "phone"=>$request->phone,
            "email"=>$request->email,
            "photo"=> $photo

        ]);

        return $this->successResponse($data, 'Rider Updated', Response::HTTP_OK);

    }

    public function login(Request $request)
    {
        // Validate passed parameters
        $this->validate($request, [
            'employee_id' => 'required',
            'password' => 'required',
        ]);
        // Get the user with the email
        $user = Rider::with('hub:id,name')->where('employee_id', $request['employee_id'])->where('canlogin',1)->where('status',1)->select('id','name','employee_id','email','username','phone','emargency_contact','address','zone','area','photo','password','hub_id')->first();

        if ($user != '') {
            if (Hash::check($request['password'], $user['password'])) {
                //dd($user);
                try {
                    // verify the credentials and create a token for the user
                    if (!$token = JWTAuth::fromUser($user)) {
                        return response()->json(['error' => 'invalid_credentials'], 401);
                    } else {
                        $url=DB::select("select default_url from settings where id = 1 LIMIT 1");
                        $user->url=$url[0]->default_url;
                        $user->image_path ='uploads/rider/';
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


    public function logout()
    {
        auth()->logout();

        return response()->json(['success' => true, 'message' => 'Successfully logged out']);
    }

    protected function respondWithToken($user, $token)
    {
        $id = $user->user_type;
        return response()->json([
            'user' => $user,
            'success' => true,
            'access_token' => $token,
            //'access_token' => $this->jwt($user),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 *24
        ]);
    }

    public function forgetpassword(Request $request, Otp $otp)
    {
        $phone = $request->phone;
        $employee_id = $request->employee_id;



        $rider = Rider::where('phone', $phone)->where('employee_id', $employee_id)->first();
        // return response()->json(['status' => true, 'message' => 'Successfully otp generated','data'=>$rider]);
        if (is_null($rider)) {
            return response()->json(['error' => 'invalid_user_information'], 401);
        }

        $minute_to_add = 1;  //after how many minute otp will eapire
        $currentDate = strtotime(date('Y-m-d H:i:s'));
        $futureDate = $currentDate + (60 * $minute_to_add);
        $exp = date("Y-m-d H:i:s", $futureDate);


        // $otp->otp = rand(1000, 9999);
        $otp->otp = '1010';

        $otp->verified = false;
        $otp->user_types = 'rider';
        $otp->phone = $phone;
        $otp->exp_time = $exp;

        $otp->save();
        return response()->json(['status' => true, 'message' => 'Successfully otp generated']);
    }

    public function otpVerifie(Request $request, Rider $rider)
    {
        $phone = $request->phone;
        $employee_id = $request->employee_id;
        $rider_otp = $request->riderotp;
        $rider = Rider::where('phone', $phone)->where('employee_id', $employee_id)->first();
        $user = $rider;
        if (is_null($rider)) {
            return response()->json(['error' => 'invalid_user_information'], 401);
        }

        $formattedCurrentDate = date('Y-m-d H:i:s');
        DB::table('otps')->where('exp_time', '<=', $formattedCurrentDate)->where('verified', '<>', true)->delete();

        $riderotp = Otp::where('phone', $phone)->orderBy('id', 'DESC')->first();
        if ($riderotp) {
            if ($riderotp->otp == $rider_otp) {
                $riderotp->verified = true;
                $riderotp->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Successfully OTP Verified',
                    'phone' => $phone,
                    'employee_id' => $employee_id
                ]);
            }
        }

        return response()->json(['error' => 'invalid otp'], 401);
    }

    public function changePassword(Request $request)
    {
        $phone = $request->phone;
        $employee_id = $request->employee_id;
        $password = Hash::make($request->password);

        $rider = Rider::where('phone', $phone)->where('employee_id', $employee_id)->first();
        if (is_null($rider)) {
            return response()->json(['error' => 'invalid_user_information'], 401);
        }
        $riderotp = Otp::where('phone', $phone)->where('verified', '=', true)->orderBy('id', 'DESC')->first();
        if ($riderotp) {
            $rider->password = $password;
            $rider->save();
            $riderotp->delete();
        }


        return response()->json(['status' => true, 'message' => 'Successfully password changed']);
    }



    public function riderRegisterOtp(Request $request, Otp $otp)
    {
        $phone = $request->phone;

        $minute_to_add = 2;  //after how many minute otp will eapire
        $currentDate = strtotime(date('Y-m-d H:i:s'));
        $futureDate = $currentDate + (60 * $minute_to_add);
        $exp = date("Y-m-d H:i:s", $futureDate);


        // $otp->otp = rand(1000, 9999);
        $otp->otp = '6969';

        $otp->verified = false;
        $otp->user_types = 'rider_register';
        $otp->phone = $phone;
        $otp->exp_time = $exp;

        $otp->save();
        return response()->json(['status' => true, 'message' => 'Successfully otp generated']);
    }


    public function myLedger()
    {
        $userId = auth('rider')->id();
        $formattedCurrentDate = date('Y-m-d');
        $delivery = DeliveryManagement::where('rider_id', $userId)->where('delivery_date', '=', $formattedCurrentDate)->get();
        $peakup = AssignPickup::where('rider_id', $userId)->where('pickup_date', '=', $formattedCurrentDate)->get();

        $pendingPeakup=0;
        $peakupPicked=0;
        $peakupUnpicked=0;

        $pendingDelivary=0;
        $delivaryOnhold=0;
        $delivaryDelivered=0;
        $delivaryReturned=0;

        $TodayCashCollection = 0;
        $TodayCollectedAmount = 0;
        $TodayDueAmount = 0;
        $TodayTotalDelivary=0;
        $TodayTotalPicked=0;


        if ($peakup) {
            foreach ($peakup as $p) {
                $TodayTotalPicked++;
                if ($p->status == 7) {
                    $pendingPeakup++;
                }
                if($p->status == 12){
                    $peakupPicked++;
                }
                if($p->status == 13){
                    $peakupUnpicked++;
                }
            }
        }

        if ($delivery) {
            foreach ($delivery as $d) {
                $TodayTotalDelivary++;
                $TodayCashCollection += $d->collectable_amount;
                if ($d->status == 7) {
                    $pendingDelivary++;
                }
                if ($d->status == 19) {
                    $delivaryOnhold++;
                }
                if ($d->status == 15) {
                    $delivaryDelivered++;
                    $TodayCollectedAmount += $d->collectable_amount;
                }
                if ($d->status == 17) {
                    $$delivaryReturned++;
                }
            }
        }

        $TodayDueAmount = $TodayCashCollection-$TodayCollectedAmount;

        $data = [
            'totalPickup'=>$TodayTotalPicked,
            'pendingPickup' => $pendingPeakup,
            'pickedPickup' => $peakupPicked,
            'unpickedPickup' => $peakupUnpicked,
            'totalDelivery'=>$TodayTotalDelivary,
            'pendingDelivery' => $pendingDelivary,
            'onHoldDelivary' => $delivaryOnhold,
            'deliveredDelivary' => $delivaryDelivered,
            'returnedDelivary' => $delivaryReturned,
            'totalAmount' => $TodayCashCollection,
            'collectedAmount' => $TodayCollectedAmount,
            'dueAmount' => $TodayDueAmount
        ];

        return response()->json([
            'success' => true,
            'message' => 'Rider My Ledger Information',
            'data' => $data
        ]);
    }


    public function pickupNote()
    {
        $data = Deliverynote::select('id','name','type')-> where('type','pickup')->orderBy('id','DESC')->get();
        return response()->json([
            'success' => true,
            'message' => 'General Comments',
            'data' => $data
        ]);
    }
    public function deliveryNote()
    {
        $data = Deliverynote::select('id','name','type')-> where('type','delivery')->orderBy('id','DESC')->get();
        return response()->json([
            'success' => true,
            'message' => 'General Comments',
            'data' => $data
        ]);
    }


    public function riderHomeInfo()
    {

        dd('dkjfhdk');
        $userId = auth('rider')->id();
        $formattedCurrentDate = date('Y-m-d');
        $delivery = DeliveryManagement::where('rider_id', $userId)->where('delivery_date', '=', $formattedCurrentDate)->get();
        $peakup = AssignPickup::where('rider_id', $userId)->where('pickup_date', '=', $formattedCurrentDate)->where('status', '=', 'Picked')->count();
        $TargetDelivary = 0;
        $AchievedDelivary = 0;
        $TodayCollected = 0;


        if ($delivery) {
            foreach ($delivery as $d) {
                $TargetDelivary++;
                if ($d->status == "Delivered") {
                    $AchievedDelivary++;
                    $TodayCollected += $d->collectable_amount;
                }
            }
        }
        $Todaysdelivery = $AchievedDelivary;

        $data = [
            'TargetDelivary' => $TargetDelivary,
            'AchievedDelivary' => $AchievedDelivary,
            'TodayCollected' => $TodayCollected,
            'Todaysdelivery' => $Todaysdelivery,
            'Todayspeakup' => $peakup
        ];

        return response()->json([
            'success' => true,
            'message' => 'Rider Home Information',
            'data' => $data
        ]);
    }
    public function profileInfo()
    {

        $userId = auth('rider')->id();

        $delivery = DeliveryManagement::where('rider_id', $userId)->get();
        $peakup = AssignPickup::where('rider_id', $userId)->where('status', '=', 'Picked')->count();
        $TargetDelivary = 0;
        $AchievedDelivary = 0;
        $Collected = 0;


        if ($delivery) {
            foreach ($delivery as $d) {
                $TargetDelivary++;
                if ($d->status == "Delivered") {
                    $AchievedDelivary++;
                    $Collected += $d->collectable_amount;
                }
            }
        }
        $delivery = $AchievedDelivary;

        $data = [
            'TargetDelivary' => $TargetDelivary,
            'AchievedDelivary' => $AchievedDelivary,
            'Collected' => $Collected,
            'delivery' => $delivery,
            'peakup' => $peakup
        ];

        return response()->json([
            'success' => true,
            'message' => 'My Ledger Information',
            'data' => $data
        ]);
    }
}
