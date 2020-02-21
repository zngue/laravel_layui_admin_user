<?php


namespace Zngue\User\Http\Request\Permission;


use Zngue\User\Helper\ApiFromRequest;

class PermissionAddRequest extends ApiFromRequest
{

    public function rules()
    {
        return [
            'status'=>'required|numeric',
            'name'=>'required|unique:permissions',
            'uri'=>'required',
            'is_menu'=>'required',
            'route_name'=>'required',
        ] ;
    }
    public function messages()
    {
        return [
            'status.required'=>':attribute 不能为空',
            'status.numeric'=>':attribute 必须为数字',
            'name.required'=>':attribute 不能为空',
            'name.unique'=>':attribute 已存在,请更换',
            'uri.required'=>':attribute 跳转地址 不能为空',
            'is_menu.required'=>':attribute 是否为菜单 不能为空',
            'route_name.required'=>':attribute 权限name 不能为空',
        ];
    }

}
