<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:products,name,'.$this->id,
            'slug' => 'required|unique:products,name,'.$this->id,
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric|lt:price',
            'category_id' => 'required',
            'description' => 'nullable',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.unique' => "$this->name đã tồn tại",
            'slug.required' => 'Vui lòng nhập slug',
            'slug.unique' => "$this->slug đã tồn tại",
            'price.required' => "Vui lòng nhập giá bán",
            'price.numeric' => "Giá bán phải là một con số",
            'sale_price.numeric' => "Giá sale phải là một con số",
            'sale_price.lt' => "Giá sale phải nhỏ hơn giá bán",
            'category_id.required' => 'Chọn danh mục cho sản phẩm'
        ];
    }
}
