<?php


namespace Zngue\User\Http\Controller;



use Illuminate\Support\Facades\Auth;
use Zngue\User\Http\Request\LoginRequest;

class Login extends Controller
{
    public function index(){


        return $this->zngView('login.index');
    }
    public function doLogin(LoginRequest $request){
        $data =$request->only(['name','password']);
        if (Auth::attempt($data)){

            return $this->returnArray([],'登录成功');
        }else{
            return $this->returnArray([],'登录失败',400100);
        }
    }
    public function loginOut(){
        Auth::logout();
        $user = Auth::user();
        return $this->returnInfo(!$user);
    }
}
