<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\DocumentService;
use App\Services\CommonService;
use Session;

class DocumentController extends BaseController
{

    private $documentService;

    use FlashMessages;

    public function __construct(DocumentService $documentService, CommonService $commonService)
    {
        $this->documentService = $documentService;
        $this->commonService = $commonService;
    }

    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("document.index")) {
                try {
                    $result = $this->documentService->index();
                    //dd($result);
                    if ($result['status'] == true) {
                        return view('admin.pages.document.index', [
                            'prefixname' => 'Admin',
                            'getResponse' => $result['data'],
                        ]);
                    } else {
                        self::message('error', 'Data not found');
                        return view('admin.pages.notfound');
                    }
                } catch (\Exception $exception) {
                    \Helper::handleException($exception);

                    self::message('error', 'Failed, Please try again');
                    return view('admin.pages.notfound');
                }
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function filter(Request $request, Curl $curl)
    {

        try {
            $data = $request->all();

            $result = $this->documentService->filter($data);
            //dd($result);
            return view('admin.pages.document.index', [
                'prefixname' => 'Admin',
                'title' => 'User Edit',
                'page_title' => 'User Edit',
                'getResponse' => $result['data'],
            ]);
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }

    public function create()
    {
        $documenttype = $this->commonService->getCommonData('document-type');
        $hubinfo = $this->commonService->getCommonData('hub');
       //dd($documenttype);
        return view('admin.pages.document.create', [
            'documenttype' => $documenttype,
            'hubinfo' => $hubinfo,
            'prefixname' => 'Partner',
            'title' => 'Partner Create',
            'page_title' => 'Partner Create'
        ]);
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $getLogoName = \Utility::uploadDocument('document/'.$request->user_type,'files');

            $data['filename'] = $getLogoName;

            $result = $this->documentService->create($data);

            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('document');
            } else {
                self::message('error', $result['message']);
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("document.edit")) {
            try {
                $result = $this->documentService->edit($id);
                //dd($result);
                return view('admin.pages.document.edit', [
                    'prefixname' => 'Admin',
                    'title' => 'User Edit',
                    'page_title' => 'User Edit',
                    'document' => $result['data'],
                ]);
            } catch (\Exception $exception) {
                \Helper::handleException($exception);

                self::message('error', 'Failed, Please try again');
                return redirect()->back();
            }
        } else {
            return redirect('/');
        }
    }


    public function update(Request $request, $id)
    {

        try {
            $data = $request->all();

            $result = $this->documentService->update($data, $id);

            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('document');
            } else {
                self::message('error', $result['message']);
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }


    public function show($id, Curl $curl)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("document.show")) {
            try {
                $getResponse = $curl->send('GET', 'document', $id, '', 'display');
                if ($getResponse->success == true) {

                    if ($getResponse->data != NULL) {
                        return view('admin.pages.document.details', [
                            'prefixname' => 'Admin',
                            'title' => 'User Create',
                            'page_title' => 'User Create',
                            'user' => $getResponse->data,
                        ]);
                    } else {
                        self::message('error', 'Data not found');
                        return redirect()->back();
                    }
                } else {
                    self::message('error', $result['message']);
                    return redirect()->back();
                }
            } catch (\Exception $exception) {
                \Helper::handleException($exception);

                self::message('error', 'Failed Please try again');
                return redirect()->back();
            }
        } else {
            self::message('error', 'Failed you are not authorised for this action');
            return redirect()->back();
        }
    }
    public function destroy($id, Curl $curl)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("document.destroy")) {
        try {
            $getResponse = $curl->send('DELETE', 'document', $id, '', 'delete');
            if ($getResponse) {
                self::message('success', 'Data Deleted successfully Done');
                return redirect()->route('user.index');
            }
            self::message('error', 'Data failed on update');
            return redirect()->back();
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    } else {
        self::message('error', 'Failed you are not authorised for this action');
        return redirect()->back();
    }
    }

    /*public function store(Request $request, Curl $curl)
    {
	   $request['status'] = 0;
       $data = $request->all();
        $getResponse = $curl->send('POST','document', '', $data,'insert');
        if ($getResponse) {
			self::message('success', 'Data Added successfully Done');
            return redirect()->route('document.index');
        }

		self::message('error', 'Data failed on create');
        return redirect()->back();
    }

	public function edit($id, Curl $curl)
    {

        //if (Auth::user()->hasRole(['Admin'])) {
			$getResponse = $curl->send('GET','document', $id,'','display');
            return view('admin.pages.document.edit', [
                'prefixname' => 'Partner',
                'title' => 'Partner Create',
                'page_title' => 'Partner Create',
                'document' => $getResponse->data,
            ]);
        } else {
            abort(401, 'Unauthorized Error');
        }
    }

    public function update(Curl $curl, Request $request, $id)
    {
        $data = $request->all();
        $getResponse = $curl->send('POST','document/update', $id, $data,'update');
        if ($getResponse) {
			self::message('success', 'Data Updated successfully Done');
            return redirect()->route('document.index');
        }
		self::message('error', 'Data failed on update');
        return redirect()->back();
    }


	public function show($id, Curl $curl)
    {
        $getResponse = $curl->send('GET','document', $id,'','display');
            return view('admin.pages.document.details', [
                'prefixname' => 'Admin',
                'title' => 'User Create',
                'page_title' => 'User Create',
                'user' => $getResponse->data,
            ]);
    }
    public function destroy($id, Curl $curl)
    {
        $getResponse = $curl->send('DELETE','document', $id, '','delete');
        if ($getResponse) {
			self::message('success', 'Data Deleted successfully Done');
            return redirect()->route('document.index');
        }
		self::message('error', 'Data failed on update');
        return redirect()->back();
    }*/
}
