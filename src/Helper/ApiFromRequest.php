<?php


namespace Zngue\User\Helper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
class ApiFromRequest extends FormRequest
{
    use Helpers;
    protected  $name;
    public function __construct()
    {
        $this->name = Route::currentRouteName();
    }
    public function authorize(){
        return true;
    }
    public function rules(){
        return [];
    }
    public function messages(){
        return [];
    }
    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->first();
        echo $this->returnJson([],$message,422);
        exit();
    }
}
