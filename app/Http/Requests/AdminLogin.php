<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLogin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //会员名做规则设置
            //username 校验的参数  required 规则,用户名不能为空
            //users 表名
            'username'=>'required|regex:/\w{4,8}/',
            'password'=>'required|regex:/\w{6,12}/'
        ];
    }

    // 自定义错误
    public function messages(){
        return[
            'username.required'=>'用户名不能为空',
            'username.regex'=>'用户名必须为4-8位任意的数字字母下划线',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码必须为6-12位任意的数字字母下划线'
            ];
    }
}
