<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login_identifier' => 'required',
            'password' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'login_identifier.required' => 'Vui lòng nhập tên đăng nhập,Email hoặc số điện thoại',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ];
    }
}
