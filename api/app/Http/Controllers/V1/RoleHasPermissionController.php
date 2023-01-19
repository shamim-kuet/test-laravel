<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\RoleHasPermissionResource;
use App\Models\RoleHasPermission;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class RoleHasPermissionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return PermissionResource
     */
    public function index()
    {
        $data = RoleHasPermission::with('group')->orderBy('id', 'DESC')->get();
        return $this->successResponse(RoleHasPermissionResource::collection($data), 'All Permission List', Response::HTTP_OK);
    }


    // public function store(Request $request, RoleHasPermission $permission)
    // {
    // 	$data= $permission->create($request->all());
    //     return $this->successResponse($data, 'Created Successfully', Response::HTTP_CREATED);
    // }

    public function store(Request $request)
    {
        $data = json_decode(file_get_contents('php://input'), true);

         $groupids = $data['group'];
         $roleid = $data['role_id'];

        
        if (!empty($groupids) && count($groupids) > 0) {

            foreach ($groupids as $k => $item) {

                if (isset($data['permissions'][$groupids[$k]]) && count($data['permissions'][$groupids[$k]]) > 0) {
                    $permissions = $data['permissions'][$groupids[$k]];

                    foreach ($permissions as $pitem) {
                        $permissionArray[] = array(
                            'group_id'=>$groupids[$k],
                            'role_id'=>$roleid,
                            'permission_id'=>$pitem,
                            'partner_id'=>$data['partner_id'],
                            'created_by'=>$data['created_by'],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                    }

                }
            }
            $permission = new RoleHasPermission;
            $responsedata = $permission->insert($permissionArray);
        }
        else {
            $responsedata = 'Please select role and permission';
        }

        return $this->successResponse($responsedata, 'Created Successfully', Response::HTTP_CREATED);
    }



    public function update(Request $request, $id)
    {
        $permission = RoleHasPermission::find($id);
        $data = $permission->update($request->all());
        return $this->successResponse($data, 'Permission Updated', Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleHasPermission $permission)
    {
        $result = $permission->delete();
        return $this->successResponse($result, 'Permission Deleted', Response::HTTP_OK);
    }

    public function permissions($id)
    {
        $permission = RoleHasPermission::join('permissions','role_has_permissions.permission_id', '=' , 'permissions.id')->where('role_has_permissions.role_id','=',$id)->get(['permissions.guard_name']);

        return $this->successResponse($permission, 'All Permission List', Response::HTTP_OK);
    }
}
