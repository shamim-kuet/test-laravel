<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Config\Curl;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\CommonService;
use App\View\Components\FlashMessages;
use Session;
use Illuminate\Support\Facades\Hash;




class UserController extends BaseController
{
    private $userService;

    private $commonService;

    use FlashMessages;

    public function __construct(UserService $userService, CommonService $commonService)
    {
        $this->userService = $userService;
        $this->commonService = $commonService;
    }




    public function index(Curl $curl)
    {
        // dd(session()->get('role_id'));
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("user.index")) {
                try {
                    $roles = $this->commonService->getCommonData('role');
                    $result = $this->userService->index();
                    // dd($result);
                    if ($result['status'] == true) {
                        return view('admin.pages.users.index', [
                            'prefixname' => 'Admin',
                            'title' => 'User Edit',
                            'page_title' => 'User Edit',
                            'getResponse' => $result['data'],
                            'roles' => $roles,
                        ]);
                    } else {
                        self::message('error', 'Data not found');
                        return view('admin.pages.notfound');
                    }
                } catch (\Exception $exception) {
                    \Helper::handleException($exception);
                    // dd($exception);

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
            $result = $this->userService->filter($data);
            $roles = $this->commonService->getCommonData('role');
            // dd($result);
            return view('admin.pages.users.index', [
                'prefixname' => 'Admin',
                'title' => 'User Edit',
                'page_title' => 'User Edit',
                'getResponse' => $result['data'],
                'roles' => $roles,
            ]);
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }

    public function create()
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("user.create")) {
            $lastuser = $this->commonService->getCommonData('lastuser');
            // dd($lastuser);
            $roles = $this->commonService->getCommonData('role');
            list($prefix, $eid) = explode('-',$lastuser->employee_id);
            $empid = str_pad($eid + 1, 6, 0, STR_PAD_LEFT);


            //dd($lastuser);
            return view('admin.pages.users.create', [
                'prefixname' => 'Admin',
                'title' => 'User Create',
                'page_title' => 'User Create',
            ], compact('roles','empid'));
        } else {
            return redirect('/');
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $data['password'] = Hash::make($request->password);
            $result = $this->userService->create($data);
            dd($result);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('user');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("user.edit")) {
            try {
                $roles = $this->commonService->getCommonData('role');
                $result = $this->userService->edit($id);
                return view('admin.pages.users.edit', [
                    'prefixname' => 'Admin',
                    'title' => 'User Edit',
                    'page_title' => 'User Edit',
                    'user' => $result['data'],
                ], compact('roles'));
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
        /*$data = $request->all();
        $getResponse = $curl->send('POST','admin/update', $id, $data,'update');
        if ($getResponse) {
			self::message('success', 'Data Updated successfully Done');
            return redirect()->route('user.index');
        }
		self::message('error', 'Data failed on update');
        return redirect()->back();*/

        try {
            $data = $request->all();

            $result = $this->userService->update($data, $id);
            //dd($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('user');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("user.show")) {
            $getResponse = $curl->send('GET', 'admin', $id, '', 'display');
            return view('admin.pages.users.details', [
                'prefixname' => 'Admin',
                'title' => 'User Create',
                'page_title' => 'User Create',
                'user' => $getResponse->data,
                'roles' => Role::all(),
            ]);
        } else {
            self::message('error', 'Failed, you dont have permission');
            return redirect()->back();
        }
    }
    public function destroy($id, Curl $curl)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("user.destroy")) {
            try {
                $getResponse = $curl->send('DELETE', 'admin', $id, '', 'delete');
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
