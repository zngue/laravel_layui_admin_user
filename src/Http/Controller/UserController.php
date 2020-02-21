<?php


namespace Zngue\User\Http\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Zngue\User\Http\Request\DelRequest;
use Zngue\User\Http\Request\StatusRequest;
use Zngue\User\Http\Request\User\UserAddRequest;
use Zngue\User\Http\Request\User\UserSaveRequest;
use Zngue\User\Models\User;
use Zngue\User\Service\PermissionService;
use Zngue\User\Service\RoleService;
use Zngue\User\Service\UserService;

class UserController extends Controller
{
    public function index(Request $request){
        if ($request->ajax() ){
            $field=$request->input('field','');
            $keywords=$request->input('keywords','');
            $order=$request->input('order','');
            $limit = $request->input('limit','');
            $listObj =UserService::getList($keywords,$field,$order,$limit);
            $item =$listObj->items();
            $num =$listObj->total();
            return $this->layTableJson($item,$num);
        }
        return $this->zngView('user.index');
    }
    public function add(){

        return  $this->zngView('user.add');
    }
    public function ajaxList(){

        $role =RoleService::userRole();
       return $role;
    }
    public function doAdd(UserAddRequest $request){
        $data =$request->all();
        $data['password'] = Hash::make($data['password']);
        if ( isset($data['role_id']) && empty($data['role_id'])  ){
            unset($data['role_id']);
        }
//        print_r($data);die;
        $r = UserService::add($data);
        if ($r){
            return $this->returnArray([],'操作成功',200);
        }
        return $this->returnArray([],'操作失败',100);
    }
    public function save(Request $request){
        $id = $request->input('id',10);
        $user =UserService::getOne($id);
        if (!$user) {
            return redirect()->route('user.index');
        }
        $data= $user->toArray();
        return $this->zngView('user.save',compact('data'));
    }
    public function doSave(UserSaveRequest $request){
        $data=$request->all();
        if (!empty($data['password'])){
            $data['password']=Hash::make($data['password']);
        }else{
            unset($data['password']);
        }
        if ( isset($data['role_id']) && empty($data['role_id'])  ){
            unset($data['role_id']);
        }
        $res =UserService::save($data['id'],$data);
        return $this->returnInfo($res);
    }
    public function del(DelRequest $request){
        $id = $request->input('id');
        $r=UserService::del($id);
        return $this->returnInfo($r);
    }
    public function changeStatus(StatusRequest $request){
        $data =$request->only('id','name','status');
        if (!UserService::checkStatusName($data['name'])){
            return $this->returnArray('参数错误');
        }
        if (UserService::changeStatus($data)){
            return $this->returnArray([],'操作成功',200);
        }
        return  $this->returnArray([],'操作失败',100);
    }
    public function delAll(){


    }
    public function getUserPermission(){


        $user =Auth::user();
//        $user->removeRole(4);
        $role=$user->roles()->get()->toArray();
        $a =$user->getPermissionsViaRoles()->where('is_menu',1)->toArray();
        print_r($a);
        print_r($role);die;



    }
}
