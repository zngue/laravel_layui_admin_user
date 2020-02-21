<?php
namespace Zngue\User\Http\Controller;
use Illuminate\Http\Request;
use Zngue\User\Http\Request\Permission\PerminssDelAllRequest;
use Zngue\User\Http\Request\Permission\PerminssionDelRequest;
use Zngue\User\Http\Request\Permission\PermissionAddRequest;
use Zngue\User\Http\Request\Permission\PermissionChangeStatus;
use Zngue\User\Http\Request\Permission\PermissionSaveRequest;
use Zngue\User\Service\PermissionService;
class PermissionController extends Controller
{
    public function Index(Request $request){

        if ($request->ajax() ){
            $keywords=$request->input('keywords','');
            $field=$request->input('field','');
            $order=$request->input('order','');
            $limit = $request->input('limit','');
            $listObj =PermissionService::getList($keywords,$field,$order,$limit);
            $item =$listObj->items();
            $num =$listObj->total();
            return $this->layTableJson($item,$num);
        }
        return $this->zngView('permission.index');
    }
    public function add(){
        return $this->zngView('permission.add');
    }
    public function ajaxList(){
        return PermissionService::permissionNode();
    }
    public function save(Request $request){

        $id=$request ->input('id',0);
        if (empty($id)){
            return redirect()->route('permission.index');
        }
        $data=PermissionService::getOne($id);
        if (!$data){
            return redirect()->route('permission.index');
        }
        return $this->zngView('permission.save',compact('data'));
    }
    public function doSave(PermissionSaveRequest $request){
        $data = $request->all();
        $data = PermissionService::pidData($data);
       if ( PermissionService::save($data['id'],$data)){
           return $this->returnArray([],'操作成功',200);
       }
        return $this->returnArray([],'操作失败',100);
    }
    public function edit(PermissionAddRequest $request){
        $data =$request->all();
        $data['pid']=0;
        $data =PermissionService::pidData($data);
        $r =PermissionService::add($data);
        if ($r){
            return $this->returnArray([],'操作成功',200);
        }
        return $this->returnArray([],'操作失败',100);
    }
    public function changeStatus(PermissionChangeStatus $request){
        $data =$request->only('id','name','status');

        if (!PermissionService::checkStatusName($data['name'])){
            return $this->returnArray('参数错误');
        }
        if (PermissionService::changeStatus($data)){
            return $this->returnArray([],'操作成功',200);
        }
        return  $this->returnArray([],'操作失败',100);
    }
    public function del(PerminssionDelRequest $request){
        $id =$request->input('id');
        $res  =  PermissionService::del($id);
       return $this->returnInfo($res);
    }
    public function delAll(PerminssDelAllRequest $request){
        $ids=$request->input('ids');
        if (PermissionService::delAll($ids)){
            return $this->returnArray([],'操作成功',200);
        }
        return $this->returnArray([],'操作成功',100);
    }


}
