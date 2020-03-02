<?php


namespace Zngue\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Zngue\User\Helper\Helpers;
use Zngue\User\Service\UserService;

class UserPermission
{
    use Helpers;
    public function handle(Request $request, Closure $next)
    {

        $user=Auth::user();
        if ($user && $user->is_super){
            return $next($request);
        }
        $route_name=$request->route()->getName();
        $permissionStatus=$this->getUserPermission($route_name);
        if ($request->ajax()){
            if ($permissionStatus===false){
                return $this->returnError('暂无权限,请联系管理员',4001201);
            }
        }else{
            if ($permissionStatus===false){
                return redirect()->route('main.index');
            }
        }
        return $next($request);
    }

    public function getUserPermission($name){
        $permissionList =UserService::getUserPermissionList();
        $list =$permissionList->toArray();
        $uriArr =[];
        foreach ($list as $v){
            $dataList =explode('|',$v['route_name']);
            $uriArr=array_merge($uriArr,$dataList);
        }
        $uriArr=array_unique($uriArr);
        return  in_array($name,$uriArr)?true:false;
    }

    public function ajax($user){





    }



}
