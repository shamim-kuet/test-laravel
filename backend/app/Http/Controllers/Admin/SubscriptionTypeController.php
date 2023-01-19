<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\SubscriptionTypeService;
use Session;

class SubscriptionTypeController extends BaseController
{

    private $subscriptiontypeService;

    use FlashMessages;

    public function __construct(SubscriptionTypeService $subscriptiontypeService)
    {
        $this->subscriptiontypeService = $subscriptiontypeService;
    }

    public function index(Curl $curl)
    {

        if (Session::get('token') != null) {

            if ((session()->get('role_id') == 34) || \Utility::checkPermission("subscriptiontype.index")) {
                try {
                    $result = $this->subscriptiontypeService->index();

                    if ($result['status'] == true) {
                        return view('admin.pages.subscriptiontype.index', [
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
            $result = $this->subscriptiontypeService->filter($data);

            return view('admin.pages.subscriptiontype.index', [
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("subscriptiontype.create")) {
            return view('admin.pages.subscriptiontype.create', [
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

            $result = $this->subscriptiontypeService->create($data);
            //dd($result);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('subscriptiontype');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("subscriptiontype.edit")) {
            try {
                $result = $this->subscriptiontypeService->edit($id);
                return view('admin.pages.subscriptiontype.edit', [
                    'prefixname' => 'Admin',
                    'title' => 'User Edit',
                    'page_title' => 'User Edit',
                    'subscriptiontype' => $result['data'],
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

            $result = $this->subscriptiontypeService->update($data, $id);
            //dd($result);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('subscriptiontype');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("subscriptiontype.show")) {
            $getResponse = $curl->send('GET', 'subscriptiontype', $id, '', 'display');
            return view('admin.pages.subscriptiontype.details', [
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("subscriptiontype.destroy")) {
            try {
                $getResponse = $curl->send('DELETE', 'subscriptiontype', $id, '', 'delete');
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
