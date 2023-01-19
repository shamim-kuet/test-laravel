<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\RoleHasPermissionService;
use App\Services\GroupService;
use App\Services\CommonService;

use Session;

class RolePermissionController extends BaseController
{

    private $RoleHasPermissionService;
    private $commonService;
    private $groupService;

    use FlashMessages;

    public function __construct(RoleHasPermissionService $RoleHasPermissionService, CommonService $commonService, GroupService $groupService)
    {
        $this->RoleHasPermissionService = $RoleHasPermissionService;
        $this->commonService = $commonService;
        $this->groupService = $groupService;
    }

    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("role-permission.index")) {
                try {
                    $roles = $this->commonService->getCommonData('role');
                    $results = $this->groupService->groupWithPermission();

                    if ($results['status'] == true) {
                        $groups = $results['data'];
                        return view('admin.pages.role-permission.index', [
                            'prefixname' => 'Admin',
                        ], compact('roles', 'groups'));
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


    public function store(Request $request)
    {
        try {
            $data = $request->all();
            // dd($data);
            $result = $this->RoleHasPermissionService->create($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('role-permission');
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



    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            // dd($data);
            $result = $this->RoleHasPermissionService->update($data, $id);
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
