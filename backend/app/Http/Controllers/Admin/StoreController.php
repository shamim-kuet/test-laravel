<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\StoreService;
use App\Services\CommonService;
use Session;

class StoreController extends BaseController
{

    private $storeService;

    use FlashMessages;

    public function __construct(StoreService $storeService,CommonService $commonService )
    {
        $this->storeService = $storeService;
        $this->commonService = $commonService;
    }

    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("store.index")) {
                try {
                    $result = $this->storeService->index();
// return $result;
                    if ($result['status'] == true) {
                        return view('admin.pages.store.index', [
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
            $result = $this->storeService->filter($data);

            return view('admin.pages.store.index', [
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("store.create")) {
            $merchants = $this->commonService->getCommonData('merchant');
            $district = $this->commonService->getCommonData('district');
            $upozila = $this->commonService->getCommonData('upozila');

            return view('admin.pages.store.create', [
                'prefixname' => 'Partner',
                'title' => 'Partner Create',
                'page_title' => 'Partner Create',
                'merchants' => $merchants,
                'district' => $district,
                'upozila' => $upozila,
            ]);
        } else {
            self::message('error', 'Failed, you dont have permission');
            return redirect()->back();
        }
    }


    public function store(Request $request)
    {

        try {
            $data = $request->all();

            $result = $this->storeService->create($data);

            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('store');
            }  else {

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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("store.edit")) {
            try {
                $result = $this->storeService->edit($id);
                $merchants = $this->commonService->getCommonData('merchant');
                $district = $this->commonService->getCommonData('district');
                $upozila = $this->commonService->getCommonData('upozila');

                // dd($upozila);
                return view('admin.pages.store.edit', [
                    'prefixname' => 'Admin',
                    'title' => 'User Edit',
                    'page_title' => 'User Edit',
                    'store' => $result['data'],
                    'merchants' => $merchants,
                    'district' => $district,
                    'upozila' => $upozila,
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

            $result = $this->storeService->update($data, $id);
            //dd($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('store');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("store.show")) {
            $getResponse = $curl->send('GET', 'store', $id, '', 'display');
            return view('admin.pages.store.details', [
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("store.destroy")) {
            try {
                $getResponse = $curl->send('DELETE', 'store', $id, '', 'delete');
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
