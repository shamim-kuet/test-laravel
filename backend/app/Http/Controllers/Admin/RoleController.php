<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\RoleService;
use App\Services\PermissionService;
use App\Services\GroupService;
use Session;

class RoleController extends BaseController
{

    private $roleService;

    use FlashMessages;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }


    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("role.index")) {
            try {
                $result = $this->roleService->index();
                if ($result['status'] == true) {
                    // dd($result);
                    return view('admin.pages.role.index', [
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
            $result = $this->roleService->filter($data);
            //dd($result);
            return view('admin.pages.role.index', [
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("role.create")) {
            return view('admin.pages.role.create', [

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
            $result = $this->roleService->create($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('role');
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
            $result = $this->roleService->edit($id);

            // dd($result);
            return view('admin.pages.role.edit', [
                'prefixname' => 'Admin',
                'title' => 'User Edit',
                'page_title' => 'User Edit',
                'role' => $result['data'],
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

            $result = $this->roleService->update($data, $id);
            //dd($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('role');
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
        $getResponse = $curl->send('GET', 'role', $id, '', 'display');
        return view('admin.pages.role.details', [
            'prefixname' => 'Admin',
            'title' => 'User Create',
            'page_title' => 'User Create',
            'user' => $getResponse->data,
        ]);
    }
    public function destroy($id, Curl $curl)
    {
        try {
            $getResponse = $curl->send('DELETE', 'role', $id, '', 'delete');
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
