<?php


namespace Zngue\User\Service;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Zngue\User\Models\PermissionModel;
use Zngue\User\Models\User;

class UserService
{
    const CHANGE_STATUS_NAME = ['status'];

    public static function checkStatusName($name)
    {

        if (!in_array($name, self::CHANGE_STATUS_NAME)) {
            return false;
        }
        return true;
    }

    public static function getOne($id)
    {
        return User::find($id);
    }

    public static function getList($keywords, $field, $order, $limit)
    {
        $list = User::where(function ($q) use ($keywords) {
            if (!empty($keywords)) {
                $q->where('name', 'like', '%' . $keywords . '%');
            }
        });
        if ($field && $order) {
            $list->orderBy($field, $order);
        }
        $list->select(['users.*', 'roles.name as title']);
        $list->join('roles', 'users.role_id', '=', 'roles.id', 'left');
        return $list->paginate(ConstService::pageNum($limit));
    }

    public static function changeStatus($data)
    {
        return User::where('id', $data['id'])->update([$data['name'] => $data['status']]);
    }

    public static function add($data)
    {
        try {
            DB::transaction(function () use ($data) {
                $user = User::create($data);
                if (!empty($data['role_id']) && $user) {
                    $user->assignRole($data['role_id']);
                }
            });
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public static function getUserPermission()
    {

        $user = Auth::user();

        $user->roles()->get();
    }

    public static function removeUserRole(User $user, $role_id)
    {
        if ($user->hasRole($role_id)) {
            $user->removeRole($role_id);
            $user->update(['role_id' => 0]);
        }
    }

    public static function roleUpdateDeal(User $user)
    {
        if ($user->role_id) {
            if ($user->hasRole($user->role_id)) {
                $user->removeRole($user->role_id);
            }
        }
    }

    public static function del($id)
    {
        $user = self::getOne($id);
        if ($user) {
            try {
                DB::transaction(function () use ($user) {
                    self::roleUpdateDeal($user);
                    $user->delete();
                });
                return true;
            } catch (\Exception $exception) {
                return false;
            }
        }
        return false;
    }

    public static function save($id, $data)
    {
//            print_r($data);die;
        $user = self::getOne($id);
        if ($user) {
            try {
                DB::transaction(function () use ($id, $data, $user) {
                    if ($user->role_id) {
                        $user->removeRole($user->role_id);
                    }
                    User::where('id', $id)->update($data);
                    if (!empty($data['role_id'])) {
                        $user->assignRole($data['role_id']);
                    }
                });
                return true;
            } catch (\Exception $exception) {
                echo $exception->getMessage();
                return false;
            }
        }
        return false;
    }

    /**
     * @desc 获取当前用户的权限
     * @return array
     */
    public static function getUserPerminssion()
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $perminssion = PermissionModel::all();
        } else {
            $perminssion = $user->getPermissionsViaRoles();
        }
        if ($perminssion) {
            return $perminssion->toArray();
        } else {
            return [];
        }
    }

    public static function getUserPermissionList()
    {
        $user = Auth::user();
        if ($user->is_super) {
            return PermissionModel::where('status', 1)->get();
        } else {
            return $user->getPermissionsViaRoles()->where('status',1);
        }
    }
    public static function leftNavMenu(){
        $user = Auth::user();
        if ($user->is_super) {
            return PermissionModel::where('status', 1)->where('is_menu',1)->get();
        } else {
            return $user->getPermissionsViaRoles()->where('is_menu',1);
        }
    }

}
