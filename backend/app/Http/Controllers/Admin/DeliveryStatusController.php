<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\DeliveryStatusService;
use Session;

class DeliveryStatusController extends BaseController
{
    use FlashMessages;

    private $deliverystatusService;

    public function __construct(DeliveryStatusService $deliverystatusService)
    {
        $this->deliverystatusService = $deliverystatusService;
    }

    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("deliverystatus.index")) {
                try {
                    $result = $this->deliverystatusService->index();
                    // dd($result);

                    if ($result['status'] == true) {
                        return view('admin.pages.deliverystatus.index', [
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
            $result = $this->deliverystatusService->filter($data);

            return view('admin.pages.deliverystatus.index', [
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("deliverystatus.create")) {
            return view('admin.pages.deliverystatus.create', [
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

            $result = $this->deliverystatusService->create($data);
            //dd($result);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('deliverystatus');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("deliverystatus.edit")) {
            try {
                $result = $this->deliverystatusService->edit($id);
                return view('admin.pages.deliverystatus.edit', [
                    'prefixname' => 'Admin',
                    'title' => 'User Edit',
                    'page_title' => 'User Edit',
                    'deliverystatus' => $result['data'],
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

            $result = $this->deliverystatusService->update($data, $id);
            //dd($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('deliverystatus');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("deliverystatus.show")) {
            $getResponse = $curl->send('GET', 'deliverystatus', $id, '', 'display');
            return view('admin.pages.deliverystatus.details', [
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("deliverystatus.destroy")) {
            try {
                $getResponse = $curl->send('DELETE', 'deliverystatus', $id, '', 'delete');
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
