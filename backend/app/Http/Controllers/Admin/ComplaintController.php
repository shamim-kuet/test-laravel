<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\ComplaintService;
use App\Services\CommonService;
use Session;

class ComplaintController extends BaseController
{

    private $complaintService, $commonService;

    use FlashMessages;

    public function __construct(ComplaintService $complaintService, CommonService $commonService)
    {
        $this->commonService = $commonService;
        $this->complaintService = $complaintService;
    }

    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("complaint.index")) {
                try {
                    $result = $this->complaintService->index();

                    if ($result['status'] == true) {
                        return view('admin.pages.complaint.index', [
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
            $result = $this->complaintService->filter($data);

            return view('admin.pages.complaint.index', [
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("complaint.create")) {
            try {
                $complaint_puropse = $this->complaintService->complaint_puropse();
            $complaint_puropse = $complaint_puropse['data'];
                /// Get Merchant Data
                $merchants = $this->commonService->getCommonData('merchant');
                /// Get Rider Data
                $riders = $this->commonService->getCommonData('rider');


                return view('admin.pages.complaint.create', compact('complaint_puropse','merchants', 'riders'));
            } catch (\Exception $exception) {
                \Helper::handleException($exception);

                self::message('error', 'Something wrong. Please check api, authentication or restart system');
                return redirect()->back();
            }
        } else {
            return redirect('/');
        }
    }


    public function store(Request $request)
    {

        try {
            $data = $request->all();
            $result = $this->complaintService->create($data);

            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('complaint');
            } else {
                if ($result['error'] && gettype($result['error']) == true) {
                    $errors = (array) $result['error'];
                } else {
                    $errors = '';
                }
                return redirect()->back()->with('errors', $errors);
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("complaint.edit")) {
            try {
                $complaint_puropse = $this->complaintService->complaint_puropse();

                $result = $this->complaintService->edit($id);
                /// Get Merchant Data
                $merchants = $this->commonService->getCommonData('merchant');
                /// Get Rider Data
                $riders = $this->commonService->getCommonData('rider');

                return view('admin.pages.complaint.edit', [
                    'prefixname' => 'Admin',
                    'title' => 'User Edit',
                    'page_title' => 'User Edit',
                    'merchants' => $merchants,
                    'complaint_puropse' => $complaint_puropse['data'],
                    'riders' => $riders,
                    'complaint' => $result['data'],
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

            $result = $this->complaintService->update($data, $id);
            //dd($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('complaint');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("complaint.show")) {
            $getResponse = $curl->send('GET', 'complaint', $id, '', 'display');
            return view('admin.pages.complaint.details', [
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("complaint.destroy")) {
            try {
                $getResponse = $curl->send('DELETE', 'complaint', $id, '', 'delete');
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
}
