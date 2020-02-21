<?php


namespace Zngue\User\Http\Request\User;


use Zngue\User\Helper\ApiFromRequest;

class UserAddRequest extends ApiFromRequest
{

    public function rules()
    {
        return [
            'status'=>'required|numeric',
            'name'=>'required|unique:users',
            'password'=>'required',
        ] ;
    }
    public function messages()
    {
        return [
            'status.required'=>':attribute 不能为空',
            'status.numeric'=>':attribute 必须为数字',
            'name.required'=>':attribute 不能为空',
            'name.unique'=>':attribute 已存在,请更换',
            'password.required'=>':attribute  不能为空',
        ];
    }

}
