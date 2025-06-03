<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            "admusername"=> "required",
            "admpassword"=> "required",
        ];
    }
    public function messages(): array
    {
        return [
            'admusername.required' => 'Vui lòng nhập tên đăng nhập',
            'admpassword.required' => 'Vui lòng nhập mật khẩu',
        ];
    }
}
