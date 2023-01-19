<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Config\Curl;
use Illuminate\Http\Request;
use App\Services\CommonService;
use App\Services\MerchantService;
use App\View\Components\FlashMessages;
use App\Http\Controllers\BaseController;

class MerchantController extends BaseController
{
    use FlashMessages;

    private $merchantService;

    private $commonService;

    public function __construct(MerchantService $merchantService, CommonService $commonService)
    {
        // dd(Session::get('token'));  
        if (Session::get('token') == null) {
            // return redirect('login')->send();
        }
        $this->merchantService = $merchantService;
        $this->commonService = $commonService;
    }

    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            dd(Session::get('token'));
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("merchant.index")) {
                try {
                    $result = $this->merchantService->index();
                    if ($result['status'] == true) {
                        return view('admin.pages.merchant.index', [
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
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("merchant.index")) {
                try {
                    $data = $request->all();

                    $result = $this->merchantService->filter($data);
                    //dd($result);
                    return view('admin.pages.merchant.index', [
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
        }
    }

    public function create()
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("merchant.create")) {
                $documenttype = $this->commonService->getCommonData('document-type');
                $district = $this->commonService->getCommonData('district');
                $upozila = $this->commonService->getCommonData('upozila');

                return view('admin.pages.merchant.create', [
                    'documenttype' => $documenttype,
                    'districts' => $district,
                    'upozilas' => $upozila,
                    'prefixname' => 'Partner',
                    'title' => 'Partner Create',
                    'page_title' => 'Partner Create'
                ]);
            }
        }
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $getLogoName = \Utility::uploadFile('merchant', 'logo', 400, 450);
            $data['logo'] = $getLogoName;

            $getCPersonName = \Utility::uploadFile('merchant/contact_person', 'cphoto', 400, 450);
            $data['photo'] = $getCPersonName;

            $getDocuments = \Utility::uploadFile('merchant/documents', 'files', 0, 0);
            $data['files'] = $getDocuments;

            dd($data);
            $result = $this->merchantService->create($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);

                return redirect()->route('merchant.index');
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
            dd($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("merchant.edit")) {
            try {
                $result = $this->merchantService->edit($id);
                $documenttype = $this->commonService->getCommonData('document-type');
                $hubinfo = $this->commonService->getCommonData('hub');
                $deliveryplan = $this->commonService->getCommonData('delivery-plan');
                $returnplan = $this->commonService->getCommonData('return-plan');
                $district = $this->commonService->getCommonData('district');
                $upozila = $this->commonService->getCommonData('upozila');
                // dd($result);
                return view('admin.pages.merchant.edit', [
                    'documenttype' => $documenttype,
                    'hubinfo' => $hubinfo,
                    'deliveryplan' => $deliveryplan,
                    'returnplan' => $returnplan,
                    'districts' => $district,
                    'upozilas' => $upozila,
                    'prefixname' => 'Partner',
                    'title' => 'Partner Create',
                    'page_title' => 'Partner Create',
                    'merchant' => $result['data'],
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

            $result = $this->merchantService->update($data, $id);
            // dd($result);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('merchant');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("merchant.show")) {
            try {
                $getResponse = $curl->send('GET', 'merchant', $id, '', 'display');
                if ($getResponse->success == true) {
                    if ($getResponse->data != null) {
                        return view('admin.pages.merchant.details', [
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
                    self::message('error', 'Failed');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("merchant.destroy")) {
            try {
                $getResponse = $curl->send('DELETE', 'merchant', $id, '', 'delete');
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

    public function hubAssign(Request $request)
    {
        try {
            $data = $request->all();

            $result = $this->merchantService->hubAssign($data);

            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('merchant');
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
}
