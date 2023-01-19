<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\PartnerService;
use Session;

class PartnerController extends BaseController
{

    private $partnerService;

    use FlashMessages;

    public function __construct(PartnerService $partnerService)
    {
        $this->partnerService = $partnerService;
    }

    public function index(Curl $curl)
    {

        /*$getResponse = $curl->send('GET','partner','', '','display');
		if($getResponse->success){
			return view('admin.pages.partner.index',compact('getResponse'));
		}
		else{
			return view('admin.pages.notfound');
		}*/

        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("partner.index")) {
                try {
                    $result = $this->partnerService->index();

                    if ($result['status'] == true) {
                        return view('admin.pages.partner.index', [
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
            $result = $this->partnerService->filter($data);
            //dd($result);
            return view('admin.pages.partner.index', [
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("partner.create")) {
            return view('admin.pages.partner.create', [
                'prefixname' => 'Partner',
                'title' => 'Partner Create',
                'page_title' => 'Partner Create'
            ]);
        } else {
            return redirect('/');
        }
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $result = $this->partnerService->create($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('partner');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("partner.edit")) {
            try {
                $result = $this->partnerService->edit($id);
                return view('admin.pages.partner.edit', [
                    'prefixname' => 'Admin',
                    'title' => 'User Edit',
                    'page_title' => 'User Edit',
                    'partner' => $result['data'],
                ]);
            } catch (\Exception $exception) {
                \Helper::handleException($exception);

                self::message('error', 'Failed, Please try again');
                return redirect()->back();
            }
        } else {
            self::message('error', 'Failed, you dont have permission');
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();

            $result = $this->partnerService->update($data, $id);
            //dd($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('partner');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("partner.show")) {
            $getResponse = $curl->send('GET', 'partner', $id, '', 'display');
            return view('admin.pages.partner.details', [
                'prefixname' => 'Admin',
                'title' => 'User Create',
                'page_title' => 'User Create',
                'user' => $getResponse->data,
            ]);
        } else {
            self::message('error', 'Failed, you dont have permission');
            return redirect()->back();
        }
    }
    public function destroy($id, Curl $curl)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("partner.destroy")) {
            try {
                $getResponse = $curl->send('DELETE', 'partner', $id, '', 'delete');
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
            self::message('error', 'Failed, you dont have permission');
            return redirect()->back();
        }
    }

    /*public function store(Request $request, Curl $curl)
    {
	   $request['status'] = 0;
       $data = $request->all();
        $getResponse = $curl->send('POST','partner', '', $data,'insert');
        if ($getResponse) {
			self::message('success', 'Data Added successfully Done');
            return redirect()->route('partner.index');
        }

		self::message('error', 'Data failed on create');
        return redirect()->back();
    }

	public function edit($id, Curl $curl)
    {

        //if (Auth::user()->hasRole(['Admin'])) {
			$getResponse = $curl->send('GET','partner', $id,'','display');
            return view('admin.pages.partner.edit', [
                'prefixname' => 'Partner',
                'title' => 'Partner Create',
                'page_title' => 'Partner Create',
                'partner' => $getResponse->data,
            ]);
        } else {
            abort(401, 'Unauthorized Error');
        }
    }

    public function update(Curl $curl, Request $request, $id)
    {
        $data = $request->all();
        $getResponse = $curl->send('POST','partner/update', $id, $data,'update');
        if ($getResponse) {
			self::message('success', 'Data Updated successfully Done');
            return redirect()->route('partner.index');
        }
		self::message('error', 'Data failed on update');
        return redirect()->back();
    }


	public function show($id, Curl $curl)
    {
        $getResponse = $curl->send('GET','partner', $id,'','display');
            return view('admin.pages.partner.details', [
                'prefixname' => 'Admin',
                'title' => 'User Create',
                'page_title' => 'User Create',
                'user' => $getResponse->data,
            ]);
    }
    public function destroy($id, Curl $curl)
    {
        $getResponse = $curl->send('DELETE','partner', $id, '','delete');
        if ($getResponse) {
			self::message('success', 'Data Deleted successfully Done');
            return redirect()->route('partner.index');
        }
		self::message('error', 'Data failed on update');
        return redirect()->back();
    }*/
}
