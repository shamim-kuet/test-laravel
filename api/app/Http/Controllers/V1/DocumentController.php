<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use App\Models\Hub;


use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class DocumentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return DocumentResource
     */
    public function index()
    {
        $user = Auth::user();
        $roleid=$user->user_type;
        $data = Document::orderBy('id','DESC')->get();
		return $this->successResponse(DocumentResource::collection($data), 'All Document List', Response::HTTP_OK);

    }

	public function filter(Request $request)
    {
        $query = Document::query();
		if($request->keyword!=""){
			  $search = $request->get('keyword');
			  $query->where(function($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%')
				->orWhere('user_type', 'LIKE', '%'.$search.'%');
			  });
		  }
		// if($request->status!=""){
		// 	$query->where('status',$request->status);
		// }

		// if($request->member_type!=""){
		// 	$query->where('member_type',$request->member_type);
		// }

		// if ($request->formdate != "" && $request->todate != "") {
        //     $query->whereDate('created_at','<=', $request->todate);
        //     $query->whereDate('created_at','>=', $request->formdate);
        // } elseif ($request->formdate == "" && $request->todate != "") {
        //     $query->whereDate('created_at','<=', $request->todate);
        // } elseif ($request->formdate != "" && $request->todate == "") {
        //     $query->whereDate('created_at','>=', $request->formdate);
        // }

		$data = $query->orderBy('id','DESC')->get();
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
    public function store(Request $request)
    {
		//$data= $merchant->create($request->all());
        //return $request->user_type;
		$dataDocument = Document::create([
                'partner_id' => $request->partner_id,
				'user_id' => $request->user_id,
                'user_type' => $request->user_type,
                'name' => $request->name,
                'filename' => $request->filename,
                'created_by' => $request->created_by
            ]);

        //return $dataDocument;
		return $this->successResponse($dataDocument, 'Created Successfully', Response::HTTP_CREATED);

    }


    public function show($id)
    {
		//$merchant = Document::find($id);
		$merchant = Document::with('business','contacts','documents')->find($id);
        return $this->successResponse($merchant, 'Document List', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $merchant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$merchant = Document::find($id);
		$merchant = Document::with('business','contacts','documents')->find($id);
        return $this->successResponse($merchant, 'Specific Document Data', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$merchant = Document::find($id);
		//$data= $merchant->update($request->all());
		$merchant->update([
                'partner_id' => $request->partner_id,
				//'username' => $request->username,
                'status' => $request->status,
                'canlogin' => $request->status,
                'password' => Hash::make($request->password),
                'name' => $request->name,
                'code' => $request->code,
                'phone' => $request->phone,
                'email' => $request->email,
                'enroll_date' => date('Y-m-d'),
                'member_type' => 'General',
                'emargency_contact' => $request->emargency_contact,
                'created_by' => $request->created_by
            ]);

            $merchant->contacts()->update([
				'partner_id' => $request->partner_id,
                'status' => $request->status,
                'name' => $request->cname,
                'phone' => $request->cphone,
                'email' => $request->cemail,
                'address' => $request->caddress,
                'emargency_contact' => $request->cemargency_contact,
                'created_by' => $request->created_by
            ]);

			$merchant->business()->update([
				'partner_id' => $request->partner_id,
                'status' => $request->status,
                'name' => $request->bname,
                'phone' => $request->bphone,
                'email' => $request->bemail,
                'address' => $request->baddress,
                'emargency_contact' => $request->cemargency_contact,
                'company_type' => $request->company_type,
                'hotline' => $request->hotline,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'linkedin' => $request->linkedin,
                'instagram' => $request->instagram,
                'created_by' => $request->created_by
            ]);

			 $merchant->documents()->update([
				'partner_id' => $request->partner_id,
                'status' => $request->status,
                'documents_type' => $request->documents_type,
                'headline' => $request->headline,
                'created_by' => $request->created_by
            ]);

       	return $this->successResponse($merchant, 'Document Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $merchant)
    {
        $result= $merchant->delete();
        return $this->successResponse($result, 'Document Deleted', Response::HTTP_OK);
    }
}
