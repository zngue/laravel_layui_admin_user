<?php


namespace Zngue\User\Service;

use Illuminate\Support\Facades\DB;
use Zngue\User\Models\RoleModel;

class RoleService
{
    public static function userRole()
    {
        return RoleModel::select(['id', 'name'], 'pid')->get();
    }

    public static function getOne($id)
    {

        return RoleModel::find($id);
    }

    public static function edit($data)
    {
        if (!empty($data['id']) && is_numeric($data['id']) && $data['id'] > 0) {
            $id = $data['id'];
            unset($data['id']);
            return self::save($id, $data);
        } else {
            return self::add($data);
        }
    }

    public static function add($data)
    {
        return RoleModel::create($data);
    }

    public static function del($id)
    {
        $role = RoleModel::find($id);
        if ($role) {
            try {
                DB::transaction(function () use ($id, $role) {
                    self::roleRelationUser($role, $id);
                    $role->delete();
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
        return RoleModel::where('id', $id)->update($data);
    }

    public static function getList($keywords, $field, $order, $limit)
    {
        $roleList = RoleModel::where(function ($q) use ($keywords) {
            if (!empty($keywords)) {
                $q->where('name', 'like', '%' . $keywords . '%');
            }
        });
        if ($field && $order) {
            $roleList->orderBy($field, $order);
        }
        return $roleList->paginate(ConstService::pageNum($limit));
    }

    public static function changeStatus($id, $status)
    {
        return RoleModel::where('id', $id)->update(['status' => $status]);
    }

    //给角色添加权限
    public static function addPermission($id, $ids)
    {
        $role = self::getOne($id);
        return $role->syncPermissions($ids);
    }

    public static function rolePermissionCheckList($id)
    {
        $role = self::getOne($id);
        //$permission = PermissionModel::select(['id', 'name', 'guard_name', 'pid'])->get();
        $permission = UserService::getUserPermissionList();
        $permissionData = [];
        foreach ($permission as $k => $v) {
            $v->title = $v->name;
            if ($role->hasPermissionTo($v)) {
                $v->checked = true;
            } else {
                $v->checked = false;
            }
            $v->open = true;
            unset($v->guard_name);
            $permissionData[] = $v->toArray();;
        }
        return PermissionService::getTree($permissionData);
    }

    public static function roleRelationUser(RoleModel $role, $id)
    {
        $userList = $role->users()->get();
        foreach ($userList as $user) {
            UserService::removeUserRole($user, $id);
        }
    }
}
