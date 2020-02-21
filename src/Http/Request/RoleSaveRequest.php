<?php


namespace Zngue\User\Http\Request;


use Zngue\User\Helper\ApiFromRequest;

class RoleSaveRequest extends ApiFromRequest
{

    public function rules()
    {
        return [
            'id'=>'required|numeric',
            'status'=>'required|numeric',
            'name'=>'required'
        ] ;
    }
    public function messages()
    {
        return [
            'id.required'=>':attribute 不能为空',
            'id.numeric'=>':attribute 必须为数字',
            'status.required'=>':attribute 不能为空',
            'status.numeric'=>':attribute 必须为数字',
            'name.required'=>':attribute 不能为空',
        ];
    }

}
