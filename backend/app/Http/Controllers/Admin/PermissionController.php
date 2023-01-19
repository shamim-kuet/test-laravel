<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\PermissionService;
use App\Services\GroupService;
use Session;

class PermissionController extends BaseController
{

    private $permissionService;

    use FlashMessages;

    public function __construct(PermissionService $permissionService, GroupService $groupService)
    {
        $this->permissionService = $permissionService;
        $this->groupService = $groupService;
    }

    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("permission.index")) {
                try {
                    $result = $this->permissionService->index();

                    if ($result['status'] == true) {
                        return view('admin.pages.permission.index', [
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
            $result = $this->permissionService->filter($data);
            //dd($result);
            return view('admin.pages.permission.index', [
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("permission.create")) {
            $groups = $this->groupService->index()['data'];
            // dd($groups);
            return view('admin.pages.permission.create', [
                'prefixname' => 'Partner',
                'title' => 'Partner Create',
                'page_title' => 'Partner Create'
            ], compact('groups'));
        } else {
            return redirect('/');
        }
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $result = $this->permissionService->create($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('permission');
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
        try {
            $result = $this->permissionService->edit($id);
            $groups = $this->groupService->index()['data'];
            return view('admin.pages.permission.edit', [
                'prefixname' => 'Admin',
                'groups' => $groups,
                'page_title' => 'User Edit',
                'permission' => $result['data'],
            ]);
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();

            $result = $this->permissionService->update($data, $id);
            //dd($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('permission');
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
        $getResponse = $curl->send('GET', 'permission', $id, '', 'display');

        // dd($getResponse);
        return view('admin.pages.permission.details', [
            'prefixname' => 'Admin',
            'title' => 'User Create',
            'page_title' => 'User Create',
            'user' => $getResponse->data,
        ]);
    }
    public function destroy($id, Curl $curl)
    {
        try {
            $getResponse = $curl->send('DELETE', 'permission', $id, '', 'delete');
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
    }
}
