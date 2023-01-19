<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\ComplaintResource;
use App\Models\Complaint;
use App\Models\Deliverynote;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Hub;

class ComplaintController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return ComplaintResource
     */
    public function index()
    {
        $user = Auth::user();
        $roleid = $user->user_type;

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = Complaint::with('merchant','merchant.business','rider')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id','DESC')->get();
        }
        else{
            $data = Complaint::with('merchant','merchant.business','rider')->orderBy('id','DESC')->get();

        }
		return $this->successResponse($data, 'All Complaint List', Response::HTTP_OK);

    }
    public function indexMerchant()
    {
        $merchantId = auth('merchant')->id();
        $data = Complaint::with('merchant','rider')->orderBy('id','DESC')->where('merchant_id',$merchantId)->get();
		return $this->successResponse($data, 'All Complaint List', Response::HTTP_OK);

    }


	public function filter(Request $request)
    {
        $query = Complaint::query();
		if($request->keyword!=""){
			  $search = $request->get('keyword');
			  $query->where(function($query) use ($search) {
				$query->where('purpose', 'LIKE', '%'.$search.'%')
				->orWhere('message', 'LIKE', '%'.$search.'%');
			  });
		  }
		if($request->status!=""){
			$query->where('status',$request->status);
		}

		if ($request->formdate != "" && $request->todate != "") {
            $query->whereDate('created_at','<=', $request->todate);
            $query->whereDate('created_at','>=', $request->formdate);
        } elseif ($request->formdate == "" && $request->todate != "") {
            $query->whereDate('created_at','<=', $request->todate);
        } elseif ($request->formdate != "" && $request->todate == "") {
            $query->whereDate('created_at','>=', $request->formdate);
        }


        $user = Auth::user();
        $roleid = $user->user_type;

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = $query->with('merchant','merchant.business','rider')->whereHas("merchant", function ($subQuery) use ($hub) {
                $subQuery->where("hub_id", "=", $hub->id);
            })->orderBy('id','DESC')->get();
        }
        else{
            $data = $query->with('merchant','merchant.business','rider')->orderBy('id','DESC')->get();

        }

		// $data = $query->with('merchant','merchant.business','rider')->orderBy('id','DESC')->get();
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
    public function store(Request $request, Complaint $complaint)
    {
		 $validator = Validator::make($request->all(), [
			'message' => 'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            foreach($error->toArray() as $err){
                $errmsg[] = $err;
            }
            return $this->errorRessponse('Failed', $errmsg, Response::HTTP_CREATED);
        }



		$data= $complaint->create($request->all());
        return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
		$hub = Complaint::find($id);
        return $this->successResponse($hub, 'Complaint List', Response::HTTP_OK);
    }
    public function showMerchant($id)
    {
        $merchantId = auth('merchant')->id();
		$hub = Complaint::where('merchant_id',$merchantId)->find($id);
        return $this->successResponse($hub, 'Complaint List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint  $hub
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hub = Complaint::find($id);
        return $this->successResponse($hub, 'Specific Complaint Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $hub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
		$hub = Complaint::find($id);
		$data= $hub->update($request->all());
       return $this->successResponse($data, 'Complaint Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $hub
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $hub)
    {
        $result= $hub->delete();
        return $this->successResponse($result, 'Complaint Deleted', Response::HTTP_OK);
    }


    public function complaintPuropse()
    {
        $data = Deliverynote::select('id','name','type')->where('type','complaint_puropse')->orderBy('id','DESC')->get();
        return response()->json([
            'success' => true,
            'message' => 'Complaint Puropse',
            'data' => $data
        ]);
    }


    public function merchantFilter(Request $request)
    {
        $query = Complaint::query();
		if($request->keyword!=""){
			  $search = $request->get('keyword');
			  $query->where(function($query) use ($search) {
				$query->where('purpose', 'LIKE', '%'.$search.'%')
				->orWhere('message', 'LIKE', '%'.$search.'%');
			  });
		  }
		if($request->status!=""){
			$query->where('status',$request->status);
		}

		// if ($request->formdate != "" && $request->todate != "") {
        //     $query->whereBetween('created_at', [$request->formdate, $request->todate]);
        // } elseif ($request->formdate == "" && $request->todate != "") {
        //     $query->whereDate('created_at','<=', $request->todate);
        // } elseif ($request->formdate != "" && $request->todate == "") {
        //     $query->whereDate('created_at','>=', $request->formdate);
        // }


        $merchantId = auth('merchant')->id();
        $data = $query->with('merchant','merchant.business','rider')->where('merchant_id',$merchantId)->orderBy('id','DESC')->get();

        // $data = $query->with('merchant','merchant.business','rider')->orderBy('id','DESC')->get();


		// $data = $query->with('merchant','merchant.business','rider')->orderBy('id','DESC')->get();
		return $this->successResponse($data, 'Filter Data', Response::HTTP_OK);
    }



}
