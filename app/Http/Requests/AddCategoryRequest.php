<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
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
            'category_name' => 'required',
            'category_description' => 'required',
            'category_status' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'category_name.required' => 'Chưa nhập tên danh mục',
            'category_description.required' => 'Chưa nhập mô tả danh mục',
            'category_status.required' => 'Chưa chọn trạng thái',
        ];
    }

}
