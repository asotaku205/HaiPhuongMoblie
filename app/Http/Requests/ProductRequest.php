<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'product_name' => 'required|max:255',
            'category_id' => 'required',
            'product_description' => 'required',
            'product_content' => 'required',
            'product_price' => 'required|numeric|min:0',
            'product_status' => 'required',
        ];
        
        if ($this->isMethod('post')) {
            $rules['product_image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else if ($this->isMethod('put') || $this->isMethod('patch')) {
            if ($this->hasFile('product_image')) {
                $rules['product_image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            }
        }
        
        return $rules;
    }
    public function messages(): array
    {
        return [
            'product_name.required' => 'Tên sản phẩm không được để trống',
            'category_id.required' => 'Danh mục không được để trống',
            'product_description.required' => 'Mô tả sản phẩm không được để trống',
            'product_content.required' => 'Nội dung sản phẩm không được để trống',
            'product_price.required' => 'Giá sản phẩm không được để trống',
            'product_status.required' => 'Trạng thái sản phẩm không được để trống',
        ];
    }
}
