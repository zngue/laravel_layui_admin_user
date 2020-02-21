<?php
namespace Zngue\User\Http\Controller;
use Illuminate\Http\Request;
use Zngue\User\Http\Request\RoleEditRequest;
use Zngue\User\Http\Request\RoleRequest;
use Zngue\User\Http\Request\RoleSaveRequest;
use Zngue\User\Service\RoleService;

class RoleController extends Controller
{

    public function Index(Request $request){
        if ($request->ajax() ){
            $keywords=$request->input('keywords','');
            $field=$request->input('field','');
            $order=$request->input('order','');
            $limit = $request->input('limit','');
            $listObj =RoleService::getList($keywords,$field,$order,$limit);
            //print_r($listObj);die;
            $item =$listObj->items();
            $num =$listObj->total();
            return $this->layTableJson($item,$num);
        }
        return $this->zngView('role.index');
    }
    public function add(){

        return $this->zngView('role.add');
    }
    public function edit(RoleEditRequest $request){
        $data =$request->only(['id','name','status']);
        $role=RoleService::edit($data);
        if ($role){
            return $this->returnArray([],'操作成功',200);
        }else{
            return $this->returnArray([],'操作失败',100);
        }
    }
    public function doSave(RoleSaveRequest $request){
        $data =$request->all();
        $res =RoleService::save($data['id'],$data);
        if ($res){
            return $this->returnArray([],'操作成功',200);
        }else{
            return $this->returnArray([],'操作失败',100);
        }
    }
    public function save(Request $request){

        $id = $request->input('id',0);
        if ($id == 0){
            return redirect()->route('role.index');
        }
        $role =$data =RoleService::getOne($id);
        if (!$role){
            return redirect()->route('role.index');
        }
        $data=$role->toArray();
        //print_r($data->toArray());die;
        return $this->zngView('role.save',compact('data'));
    }
    public function changeStatus(RoleRequest $request){

        $id = $request->input('id',0);
        $status= $request->input('status');
        $res =RoleService::changeStatus($id,$status);
        if ($res){
            return $this->returnArray([],'修改成功',200);
        }
        return $this->returnArray([],'修改失败',100);
    }
    public function del(RoleRequest $request){

        $id = $request->input('id',0);
        if ($id == 0) {
            return $this->returnArray([], '参数错误', 100);
        }
        $roleDel=RoleService::del($id);
        if ($roleDel){
            return $this->returnArray([],'删除成功',200);
        }
        return $this->returnArray([],'删除失败',100);
    }

    public function rolePermission(Request $request){
        $id =$request->input('id',0);
//        $role =json_encode(,JSON_UNESCAPED_UNICODE);
        $role=RoleService::rolePermissionCheckList($id);
        $role[] = array(
            "id"=>0,
            "pid"=>0,
            "title"=>"全部",
            "open"=>true
        );
        return $this->zngView('role.permission',compact('role','id'));
    }
    public function saveRolePermission(Request $request){
        $ids=$request->input('ids',[]);
        $role_id = $request->input('role_id',0);
        if ($role_id==0){
            return $this->returnArray([],'参数错误',100);
        }
        $role =RoleService::addPermission($role_id,$ids);
        if ($role){
            return $this->returnArray([],'操作成功',200);
        }
        return $this->returnArray([],'操作失败',100);
    }

}
