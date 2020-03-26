<?php


namespace Zngue\User\Service;


use Illuminate\Support\Facades\DB;
use Zngue\User\Models\PermissionModel;
use Zngue\User\Models\RoleModel;

class PermissionService
{
    const CHANGE_STATUS_NAME=['status','is_menu'];

    public static function getList($keywords,$field,$order,$limit){
            $list=PermissionModel::where(function ($q) use ($keywords){
            if (!empty($keywords)){
                $q->where('name','like','%'.$keywords.'%');
            }
        });
        if ($field && $order){
            $list->orderBy($field,$order);
        }else{
            $list->orderBy('id','desc');
        }
        return $list->paginate(ConstService::pageNum($limit));
    }
    public static function add($data){
        return PermissionModel::create($data);
    }
    public static function save($id,$data){
        return PermissionModel::where('id',$id)->update($data);
    }
    public static function checkStatusName($name){

        if (!in_array($name,self::CHANGE_STATUS_NAME)){
            return false;
        }
        return true;
    }
    public static function changeStatus($data){
        return PermissionModel::where('id',$data['id'])->update([$data['name']=>$data['status']]);
    }
    public static function del($id){
        $permission = PermissionModel::find($id);
        if ($permission){
            try {
                DB::transaction(function () use ($id,$permission){
                    self::permissionRelationRole($permission,$id);
                    $permission->delete();
                });
                return true;
            }catch (\Exception $exception){
                return false;
            }
        }
        return false;
    }
    public static function delAll($ids){

        return PermissionModel::destroy($ids);
    }
    public static function getOne($id){
        $one=PermissionModel::find($id);
        if ($one){
            return $one->toArray();
        }else{
            return false;
        }
    }
    public  static  function getTree($arr,$parent_id=0)
    {
        $tree = [];
        foreach ($arr as $k => $v) {
            if ($v['pid'] == $parent_id) {
                $vListArr = self::getTree($arr, $v['id']);
                if ($vListArr){
                    $v['children'] = $vListArr;
                }
                $tree[] = $v;
            }

        }
        return $tree;
    }
    public static function permissionNode(){
        $res =PermissionModel::select(['id','name','pid'])->get();
        if ($res){
            return self::getTree($res->toArray());
        }else{
            return [];
        }
    }
    public static function pidData($data){
        if (!empty($data['cate_pid_arr'])){
            $pidsArr=explode(',',$data['cate_pid_arr']);
            $pidsArr= array_reverse($pidsArr);
            if ($pidsArr){
                foreach ($pidsArr as $v){
                    if ($v && is_numeric($v)){
                        $data['pid']=$v;
                        break;
                    }
                }
            }
        }
        return $data;
    }
    public static function permissionRelationRole( PermissionModel $model, $id){
        $roleList=$model->roles()->get();
        foreach ($roleList as  $role){
            $role->revokePermissionTo($id);
        }
    }

}
