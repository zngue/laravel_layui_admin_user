<?php


namespace Zngue\User\Http\Controller;


use Zngue\User\Service\PermissionService;
use Zngue\User\Service\UserService;

class Index extends Controller
{

    public function index(){

        return $this->zngView('main.index');
    }
    public function main(){

        return $this->zngView('main.home');
    }
    public function letfNav(){

        $navs= UserService::leftNavMenu()->toArray();
        $navData = [];
        foreach ($navs as $nav){
            $data['title']=$nav['name'];
            $data['icon']=$nav['icon'];
            $data['spread']=false;
            $data['href']=route($nav['uri']);
            $data['id']=$nav['id'];
            $data['pid']=$nav['pid'];
            $navData[]=$data;
        }

       return $dataNav = PermissionService::getTree($navData);
        //print_r($dataNav);die;


    }
}
