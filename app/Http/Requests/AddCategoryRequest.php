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
            'category_name' => 'required|string|max:255',
            'category_description' => 'required|string',
            'category_status' => 'required|in:0,1',
            'parent_id' => 'nullable|exists:category_product,category_id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'category_name.required' => 'Vui lòng nhập tên danh mục',
            'category_name.max' => 'Tên danh mục không được vượt quá 255 ký tự',
            'category_description.required' => 'Vui lòng nhập mô tả danh mục',
            'category_status.required' => 'Vui lòng chọn trạng thái danh mục',
            'category_status.in' => 'Trạng thái danh mục không hợp lệ',
            'parent_id.exists' => 'Danh mục cha không tồn tại',
        ];
    }
}
