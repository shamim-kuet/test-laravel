<?php

namespace App\Http\Controllers\V1;

use Storage;
use App\Models\Hub;
use App\Services\Validation;
use App\Models\Setting;
use App\Models\Merchant;
use App\Models\Plan;
use App\Models\MerchantPlan;
use Illuminate\Http\Request;
use App\Models\MerchantContact;
use App\Models\MerchantBusiness;
use App\Models\MerchantDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Http\Resources\MerchantResource;
use App\Models\Store;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class MerchantController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return MerchantResource
     */
    public function index()
    {
        $user = Auth::user();
        $roleid = $user->user_type;



        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();

            $data = Merchant::with('hub', 'business', 'contacts')->where('hub_id', '=', $hub->id)->orderBy('id', 'DESC')->get();
        } else {
            $data = Merchant::with('hub', 'business', 'contacts')->orderBy('id', 'DESC')->get();
        }

        return $this->successResponse(MerchantResource::collection($data), 'All Merchant List', Response::HTTP_OK);
    }

    public function filter(Request $request)
    {
        $query = Merchant::query();
        if ($request->keyword != "") {
            $search = $request->get('keyword');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('code', 'LIKE', '%' . $search . '%')
                    ->orWhere('enroll_date', 'LIKE', '%' . $search . '%');
            });
        }
        if ($request->status != "") {
            $query->where('status', $request->status);
        }

        if ($request->member_type != "") {
            $query->where('member_type', $request->member_type);
        }

        if ($request->formdate != "" && $request->todate != "") {
            $query->whereDate('created_at', '<=', $request->todate);
            $query->whereDate('created_at', '>=', $request->formdate);
        } elseif ($request->formdate == "" && $request->todate != "") {
            $query->whereDate('created_at', '<=', $request->todate);
        } elseif ($request->formdate != "" && $request->todate == "") {
            $query->whereDate('created_at', '>=', $request->formdate);
        }

        $user = Auth::user();
        $roleid = $user->user_type;



        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();

            $data = $query->with('hub', 'business', 'contacts')->where('hub_id', '=', $hub->id)->orderBy('id', 'DESC')->get();
        } else {
            $data = $query->with('hub', 'business', 'contacts')->orderBy('id', 'DESC')->get();
        }


        // $data = $query->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Merchant $merchant)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $request = (object) $data;
        // return $data;
        // $validator = Validator::make($request, [
        //     'username' => 'required,unique:App\Models\Merchant,username',
        //     'bemail' => 'required,unique:App\Models\Merchant,email',
        //     'password' => 'required',
        //     'password_confirmation' => 'required',
        //     'phone' => 'required,unique:App\Models\Merchant,phone',
        //     'cname' => 'required',
        //     'cphone' => 'required',
        //     'bname' => 'required',
        //     'baddress' => 'required',
        //     'facebook' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     $error = $validator->errors();
        //     $productService = new Validation;
        //     $validation = $productService->storeValidation($error);

        //     return $this->errorRessponse('Failed', $validation, Response::HTTP_CREATED);
        // }

        $getLastId = Merchant::orderBy('id', 'DESC')->first();
        // if ($getLastId != "") {
        //     $code = str_pad($getLastId->code + 1, 6, 0, STR_PAD_LEFT);
        // } else {
        //     $code = str_pad(1, 6, 0, STR_PAD_LEFT);
        // }

        $dataMerchant = Merchant::create([
            'partner_id' => $request->partner_id,
            'username' => $request->username,
            'status' => $request->status,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'code' => $request->code,
            'logo' => $request->logo,
            'phone' => $request->phone,
            'email' => $request->bemail,
            'enroll_date' => date('Y-m-d'),
            'member_type' => 'General',
            'emargency_contact' => $request->phone,
            'created_by' => $request->created_by,
            'district_id' => $request->district_id,
            'upozila_id' => $request->area
        ]);

        $dataMerchant->contacts()->create([
            'partner_id' => $request->partner_id,
            'status' => $request->status,
            'name' => $request->cname,
            'phone' => $request->cphone,
            'email' => $request->bemail,
            'photo' => $request->photo,
            'address' => $request->baddress,
            'created_by' => $request->created_by
        ]);



        if ($request->payment_type == 'Mobile Banking') {
            $dataMerchant->business()->create([
                'payment_type'=>$request->payment_type,
                'partner_id' => $request->partner_id,
                'status' => $request->status,
                'name' => $request->bname,
                'phone' => $request->cphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'facebook' => $request->facebook,
                'created_by' => $request->created_by,
                'account_number' => $request->m_account_number,
                'mobile_banking_type' => $request->mobile_banking_type,
            ]);
        } elseif ($request->payment_type == 'Banking') {
            $dataMerchant->business()->create([
                'payment_type'=>$request->payment_type,
                'partner_id' => $request->partner_id,
                'status' => $request->status,
                'name' => $request->bname,
                'phone' => $request->cphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'facebook' => $request->facebook,
                'created_by' => $request->created_by,

                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'branch_name' => $request->branch_name,
                'routing_number' => $request->routing_number,
            ]);
        } else {
            $dataMerchant->business()->create([
                'payment_type'=>$request->payment_type,
                'partner_id' => $request->partner_id,
                'status' => $request->status,
                'name' => $request->bname,
                'phone' => $request->cphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'facebook' => $request->facebook,
                'created_by' => $request->created_by
            ]);
        }


        MerchantDocument::create([
            'partner_id' => $request->partner_id,
            'merchant_id' => $dataMerchant->id,
            'status' => $request->status,
            'documents_type' => $request->documents_type,
            'headline' => $request->headline,
            'files' => $request->files,
            'created_by' => $request->created_by
        ]);



        Store::create([
            'partner_id' => $request->partner_id,
            'status' => 1,
            'merchant_id' => $dataMerchant->id,
            'default_store' => 1,
            'name' => $dataMerchant->name,
            'email' => @$dataMerchant->email,
            'phone' => @$dataMerchant->phone,
            'address' => @$request->baddress,
            'region' => $request->district_id,
            //'zone' => $request->area,
            'area' => $request->area,
            'created_by' => $dataMerchant->id
        ]);



        // foreach ($request->deliveryplan as $dplans) {
        //     MerchantPlan::create([
        //         'partner_id' => $request->partner_id,
        //         'delivery_plan_id' => $dplans,
        //         'merchant_id' => $dataMerchant->id,
        //         'created_by' => $request->created_by
        //     ]);
        // }

        // foreach ($request->returnplan as $rplans) {
        //     MerchantPlan::create([
        //         'partner_id' => $request->partner_id,
        //         'return_plan_id' => $rplans,
        //         'merchant_id' => $dataMerchant->id,
        //         'created_by' => $request->created_by
        //     ]);
        // }


        return $this->successResponse($dataMerchant, 'Created Successfully', Response::HTTP_CREATED);
    }
    public function storeMerchant(Request $request, Merchant $merchant)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:merchants,username',
            'bemail' => 'required|unique:merchant_businesses,email',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            $productService = new Validation();
            $validation = $productService->storeValidation($error);

            // return $this->errorRessponse('Failed', $validation, Response::HTTP_CREATED);

            return $response = [
                'success' => false,
                'message' => $validation[0],
            ];
        }


        // $setting = Setting::first();
        // $url=$setting ? $setting->default_url : '';
        // $apiurl=$setting->api_url;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $logo = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads/merchant';

            $image->move($destinationPath, $logo);

            $shellscript="mv uploads/merchant/".$logo." ../../backend/public/uploads/merchant/contact_person/";
            shell_exec($shellscript);
        } else {
            $logo = "";
        }




        ///merchant doccument upload
        if ($request->hasFile('id_front')) {
            $image = $request->file('id_front');
            $id_front = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads/merchantdoc';

            $image->move($destinationPath, $id_front);
            $shellscript="mv uploads/merchantdoc/".$image." ../../backend/public/uploads/document/";
            shell_exec($shellscript);
        } else {
            $id_front = "";
        }

        //back
        if ($request->hasFile('id_back')) {
            $image = $request->file('id_back');
            $id_back = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads/merchantdoc';

            $image->move($destinationPath, $id_back);
            $shellscript="mv uploads/merchantdoc/".$image." ../../backend/public/uploads/document/";
            shell_exec($shellscript);
        } else {
            $id_back = "";
        }


        $getLastId = Merchant::orderBy('id', 'DESC')->first();
        // if ($getLastId != "") {
        //     $code = str_pad($getLastId->code + 1, 6, 0, STR_PAD_LEFT);
        // } else {
        //     $code = str_pad(1, 6, 0, STR_PAD_LEFT);
        // }

        $dataMerchant = Merchant::create([
            'partner_id' => 1,
            'username' => $request->username,
            'status' => 0,
            'canlogin' => 1,
            'password' => Hash::make($request->password),
            'name' => $request->merchantName,
            'code' => $request->code,
            'logo' => $logo,
            'phone' => $request->phone,
            'email' => $request->email,
            'enroll_date' => date('Y-m-d'),
            'member_type' => 'General',
            'hub_id' => $request->hub_id,
            'emargency_contact' => $request->emargency_contact,
            'nid' => $request->nid,
            'nid_type' => $request->nid_type,
            'logo_source' => 'api',
            'district_id' => $request->district_id,
            'upozila_id' => $request->upozila_id

        ]);

        Store::create([
            'partner_id' => $request->partner_id,
            'status' => 1,
            'merchant_id' => $dataMerchant->id,
            'default_store' => 1,
            'name' => $dataMerchant->name,
            'email' => @$dataMerchant->email,
            'phone' => @$dataMerchant->phone,
            'address' => @$request->baddress,
            'region' => $request->district_id,
            //'zone' => $request->area,
            'area' => $request->area,
            'created_by' => $dataMerchant->id
        ]);
        // return $dataMerchant;

        MerchantDocument::create([
            'merchant_id' => $dataMerchant->id,
            'partner_id' => 1,
            'headline' => 'id_front',
            'documents_type' => $request->nid_type,
            'files' => $id_front,
            'doc_source' => 'api',
        ]);
        MerchantDocument::create([
            'merchant_id' => $dataMerchant->id,
            'partner_id' => 1,
            'headline' => 'id_back',
            'documents_type' => $request->nid_type,
            'files' => $id_back,
            'doc_source' => 'api',
        ]);

        $dataMerchant->contacts()->create([
            'partner_id' => 1,
            'status' => 1,
            'name' => $request->contactName,
            'phone' => $request->contactPhone,
            'email' => $request->contactEmail,
            'address' => $request->contactAddress,
            'emargency_contact' => $request->contact_emargency_contact,


        ]);


        if ($request->payment_type == "Mobile Banking") {
            $business = [
                'payment_type' => $request->payment_type,
                'partner_id' => 1,
                'status' => 1,
                'name' => $request->bname,
                'phone' => $request->bphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'emargency_contact' => $request->b_emargency_contact,
                'company_type' => $request->company_type,
                'hotline' => $request->hotline,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'linkedin' => $request->linkedin,
                'instagram' => $request->instagram,
                'account_name' => $request->m_account_name,
                'account_number' => $request->m_account_number,
                'mobile_banking_type' => $request->mobile_banking_type,
            ];
        } elseif ($request->payment_type == "Banking") {
            $business = [
                'payment_type' => $request->payment_type,
                'partner_id' => 1,
                'status' => 1,
                'name' => $request->bname,
                'phone' => $request->bphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'emargency_contact' => $request->b_emargency_contact,
                'company_type' => $request->company_type,
                'hotline' => $request->hotline,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'linkedin' => $request->linkedin,
                'instagram' => $request->instagram,
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'branch_name' => $request->branch_name,
                'routing_number' => $request->routing_number,

            ];
        } elseif ($request->payment_type == "COD") {
            $business = [
                'payment_type' => $request->payment_type,
                'partner_id' => 1,
                'status' => 1,
                'name' => $request->bname,
                'phone' => $request->bphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'emargency_contact' => $request->b_emargency_contact,
                'company_type' => $request->company_type,
                'hotline' => $request->hotline,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'linkedin' => $request->linkedin,
                'instagram' => $request->instagram,

            ];
        } else {
            $business = [
                'payment_type' => $request->payment_type,
                'partner_id' => 1,
                'status' => 1,
                'name' => $request->bname,
                'phone' => $request->bphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'emargency_contact' => $request->b_emargency_contact,
                'company_type' => $request->company_type,
                'hotline' => $request->hotline,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'linkedin' => $request->linkedin,
                'instagram' => $request->instagram,

            ];
        }

        $dataMerchant->business()->create($business);




        // $dataMerchant->documents()->create([
        //     'partner_id' => 1,
        //     'status' => 1,
        //     'documents_type' => $request->documents_type,
        //     'headline' => $request->headline,

        // ]);

        return $this->successResponse("", 'Created Successfully', Response::HTTP_CREATED);
    }




    ///////update profile

    public function MerchantProfileUpdate(Request $request, Merchant $merchant)
    {
        $validator = Validator::make($request->all(), [

            'username' => 'required|unique:merchants,username,' . $request->merchant_id . ',id',
            'email' => 'required|unique:merchants,email,' . $request->merchant_id . ',id',
            'bemail' => 'required|unique:merchant_businesses,email,' . $request->businesses_id . ',id',
            'emargency_contact' => 'required|unique:merchants,emargency_contact,' . $request->merchant_id . ',id',
            'contactEmail' => 'unique:merchant_contacts,email,' . $request->contacts_id . ',id',
            'b_emargency_contact' => 'required|unique:merchant_businesses,emargency_contact,' . $request->businesses_id . ',id',

        ]);
        if ($validator->fails()) {
            $error = $validator->errors();
            $productService = new Validation();
            $validation = $productService->storeValidation($error);

            return $this->errorRessponse('Failed', $validation, Response::HTTP_CREATED);
        }


        // $setting = Setting::first();
        // $url=$setting ? $setting->default_url : '';

        // if ($request->hasFile('logo')) {
        //     $image = $request->file('logo');
        //     $logo = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = $url.'uploads/merchant';
        //     // return $destinationPath;
        //     $image->move($destinationPath, $logo);
        // }else{
        //     $logo ="";
        // }
        // return $logo;
        $logo = "";

        $getLastId = Merchant::orderBy('id', 'DESC')->first();
        if ($getLastId != "") {
            $code = str_pad($getLastId->code + 1, 6, 0, STR_PAD_LEFT);
        } else {
            $code = str_pad(1, 6, 0, STR_PAD_LEFT);
        }

        $dataMerchant = Merchant::where('id', $request->merchant_id)->update([
            'partner_id' => 1,
            'username' => $request->username,
            'status' => 0,
            'canlogin' => 1,
            'name' => $request->merchantName,
            'code' => $code,
            'logo' => $logo,
            'phone' => $request->phone,
            'email' => $request->email,
            'enroll_date' => date('Y-m-d'),
            'member_type' => 'General',
            'hub_id' => $request->hub_id,
            'emargency_contact' => $request->emargency_contact,
            'nid' => $request->nid,
            'nid_type' => $request->nid_type

        ]);

        $dataMerchant->contacts()->update([
            'partner_id' => 1,
            'status' => 1,
            'name' => $request->contactName,
            'phone' => $request->contactPhone,
            'email' => $request->contactEmail,
            'address' => $request->contactAddress,
            'emargency_contact' => $request->contact_emargency_contact,

        ]);


        if ($request->payment_type == "Mobile Banking") {
            $business = [
                'payment_type' => $request->payment_type,
                'partner_id' => 1,
                'status' => 1,
                'name' => $request->bname,
                'phone' => $request->bphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'emargency_contact' => $request->b_emargency_contact,
                'company_type' => $request->company_type,
                'hotline' => $request->hotline,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'linkedin' => $request->linkedin,
                'instagram' => $request->instagram,
                'account_name' => $request->m_account_name,
                'account_number' => $request->m_account_number,
                'mobile_banking_type' => $request->mobile_banking_type,
            ];
        } elseif ($request->payment_type == "Banking") {
            $business = [
                'payment_type' => $request->payment_type,
                'partner_id' => 1,
                'status' => 1,
                'name' => $request->bname,
                'phone' => $request->bphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'emargency_contact' => $request->b_emargency_contact,
                'company_type' => $request->company_type,
                'hotline' => $request->hotline,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'linkedin' => $request->linkedin,
                'instagram' => $request->instagram,
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'branch_name' => $request->branch_name,
                'routing_number' => $request->routing_number,

            ];
        } else {
            $business = [
                'payment_type' => $request->payment_type,
                'partner_id' => 1,
                'status' => 1,
                'name' => $request->bname,
                'phone' => $request->bphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'emargency_contact' => $request->b_emargency_contact,
                'company_type' => $request->company_type,
                'hotline' => $request->hotline,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'linkedin' => $request->linkedin,
                'instagram' => $request->instagram,

            ];
        }

        $dataMerchant->business()->update($business);

        // $dataMerchant->documents()->create([
        //     'partner_id' => 1,
        //     'status' => 1,
        //     'documents_type' => $request->documents_type,
        //     'headline' => $request->headline,

        // ]);

        return $this->successResponse("", 'updated Successfully', Response::HTTP_CREATED);
    }


    public function ProfileEdit($id)
    {
        //$merchant = Merchant::find($id);
        $merchant = Merchant::with('business', 'contacts', 'documents')->find($id);
        return $this->successResponse($merchant, 'Specific Merchant Data', Response::HTTP_OK);
    }


    public function show($id)
    {
        //$merchant = Merchant::find($id);
        $merchant = Merchant::with('business', 'contacts', 'documents')->find($id);
        return $this->successResponse($merchant, 'Merchant List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$merchant = Merchant::find($id);
        $merchant = Merchant::with('business', 'contacts', 'documents')->find($id);
        return $this->successResponse($merchant, 'Specific Merchant Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $data = json_decode(file_get_contents('php://input'), true);
        // return $request = (object) $data;
        // return $request;
        $merchant = Merchant::find($id);
        //$data= $merchant->update($request->all());
        $merchant->update([
            'partner_id' => $request->partner_id,
            'username' => $request->username,
            'status' => $request->status,
            'name' => $request->name,
            'code' => $request->code,
            'logo' => $request->logo,
            'phone' => $request->phone,
            'email' => $request->bemail,
            'enroll_date' => date('Y-m-d'),
            'member_type' => 'General',
            'emargency_contact' => $request->phone,
            'created_by' => $request->created_by,
            'district_id' => $request->district_id,
            'upozila_id' => $request->area
        ]);

        $merchant->contacts()->update([
            'partner_id' => $request->partner_id,
            'status' => $request->status,
            'name' => $request->cname,
            'phone' => $request->cphone,
            'email' => $request->bemail,
            'photo' => $request->photo,
            'address' => $request->baddress,
            'created_by' => $request->created_by
        ]);



        if ($request->payment_type == 'Mobile Banking') {
            $merchant->business()->update([
                'payment_type'=>$request->payment_type,
                'partner_id' => $request->partner_id,
                'status' => $request->status,
                'name' => $request->bname,
                'phone' => $request->cphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'facebook' => $request->facebook,
                'created_by' => $request->created_by,
                'account_number' => $request->m_account_number,
                'mobile_banking_type' => $request->mobile_banking_type,
            ]);
        } elseif ($request->payment_type == 'Banking') {
            $merchant->business()->update([
                'payment_type'=>$request->payment_type,
                'partner_id' => $request->partner_id,
                'status' => $request->status,
                'name' => $request->bname,
                'phone' => $request->cphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'facebook' => $request->facebook,
                'created_by' => $request->created_by,

                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'branch_name' => $request->branch_name,
                'routing_number' => $request->routing_number,
            ]);
        } else {
            $merchant->business()->update([
                'payment_type'=>$request->payment_type,
                'partner_id' => $request->partner_id,
                'status' => $request->status,
                'name' => $request->bname,
                'phone' => $request->cphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'facebook' => $request->facebook,
                'created_by' => $request->created_by
            ]);
        }



        $merchant->documents()->update([
            'partner_id' => $request->partner_id,
            'status' => $request->status,
            'documents_type' => $request->documents_type,
            'headline' => $request->headline,
            'created_by' => $request->created_by
        ]);

        // foreach ($request->deliveryplan as $dplans) {
        //     MerchantPlan::where('merchant_id', $merchant->id)->update([
        //         'partner_id' => $request->partner_id,
        //         'delivery_plan_id' => $dplans,
        //         'created_by' => $request->created_by
        //     ]);
        // }

        // foreach ($request->returnplan as $rplans) {
        //     MerchantPlan::where('merchant_id', $merchant->id)->update([
        //         'partner_id' => $request->partner_id,
        //         'return_plan_id' => $rplans,
        //         'created_by' => $request->created_by
        //     ]);
        // }

        return $this->successResponse($merchant, 'Merchant Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        $result = $merchant->delete();
        return $this->successResponse($result, 'Merchant Deleted', Response::HTTP_OK);
    }




    public function hubAssign(Request $request, Merchant $merchant)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        //return $data;

        $merchant_ids = $data['merchant_id'];
        $hub_ids = $data['hub_id'];
        $cods = $data['cod'];

        $updated_by = $data['updated_by'];
        $partner_id = $data['partner_id'];


        if (!empty($merchant_ids) && count($merchant_ids) > 0) {
            foreach ($merchant_ids as $k => $item) {
                if ($merchant_ids[$k] != "") {
                    if ($hub_ids[$item] != "") {
                        $hubUpdate = array(
                            'hub_id' => $hub_ids[$item],
                            'cod' => $cods[$item],
                            'updated_at' => date('Y-m-d H:i:s'),
                            'updated_by' => $updated_by,
                        );
                        Merchant::where('id', $item)->update($hubUpdate);
                    }

                    if (isset($data['deliveryplan']) && $data['deliveryplan'] != '') {
                        $deliveryplans = $data['deliveryplan'];

                        MerchantPlan::where('merchant_id', $item)->where('plan_type', 'delivery')->forceDelete();

                        if (isset($deliveryplans[$item]) && $deliveryplans[$item] != '') {
                            foreach ($deliveryplans[$item] as $dplan) {
                                $getPlanLocation = Plan::where('id', $dplan)->first();
                                $merchantDeliveryPlan = array(
                                    'partner_id' => $partner_id,
                                    'merchant_id' => $item,
                                    'plan_id' => $dplan,
                                    'location' => $getPlanLocation->location,
                                    'plan_type' => 'delivery',
                                    'created_by' => $data['updated_by'],
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_by' => $data['updated_by'],
                                    'updated_at' => date('Y-m-d H:i:s')
                                );

                                $checkExist =  MerchantPlan::where('merchant_id', $item)->where('plan_id', $dplan)->first();
                                if ($checkExist!="") {
                                    MerchantPlan::where('id', $checkExist->id)->update($merchantDeliveryPlan);
                                } else {
                                    MerchantPlan::insert($merchantDeliveryPlan);
                                }
                            }
                        }
                    }

                    if (isset($data['returnplan']) && $data['returnplan'] != '') {
                        $returnplans = $data['returnplan'];
                        MerchantPlan::where('merchant_id', $item)->where('plan_type', 'return')->forceDelete();

                        if (isset($returnplans[$item]) && $returnplans[$item]!='') {
                            foreach ($returnplans[$item] as $rplan) {
                                $getRPlanLocation = Plan::where('id', $rplan)->first();
                                $merchantReturnPlan = array(
                                    'partner_id' => $partner_id,
                                    'merchant_id' => $item,
                                    'plan_id' => $rplan,
                                    'location' => $getRPlanLocation->location,
                                    'plan_type' => 'return',
                                    'created_by' => $data['updated_by'],
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_by' => $data['updated_by'],
                                    'updated_at' => date('Y-m-d H:i:s')
                                );

                                $checkRExist =  MerchantPlan::where('merchant_id', $item)->where('plan_id', $rplan)->first();

                                if ($checkRExist!="") {
                                    MerchantPlan::where('id', $checkRExist->id)->update($merchantReturnPlan);
                                } else {
                                    MerchantPlan::insert($merchantReturnPlan);
                                }
                            }
                        }
                    }
                }
            }
            $responsedata = 'Updated';
        } else {
            $responsedata = 'Please select merchant';
        }

        return $this->successResponse($responsedata, 'Merchant Plan Assigned', Response::HTTP_CREATED);
    }
}
