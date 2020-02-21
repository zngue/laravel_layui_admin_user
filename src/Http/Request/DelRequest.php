<?php


namespace Zngue\User\Http\Request;


use Zngue\User\Helper\ApiFromRequest;

class DelRequest extends ApiFromRequest
{

    public function rules()
    {
        return [
            'id'=>'required|numeric',
        ] ;
    }
    public function messages()
    {
        return [
            'id.required'=>':attribute 不能为空',
            'id.numeric'=>':attribute 必须为数字',
        ];
    }
}
