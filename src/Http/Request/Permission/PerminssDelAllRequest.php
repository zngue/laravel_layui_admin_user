<?php


namespace Zngue\User\Http\Request\Permission;


use Zngue\User\Helper\ApiFromRequest;

class PerminssDelAllRequest extends ApiFromRequest
{

    public function rules()
    {
        return [
            'ids'=>'required|array',
        ] ;
    }
    public function messages()
    {
        return [
            'ids.required'=>':attribute 不能为空',
            'ids.array'=>':attribute 必须为数字',
        ];
    }

}
