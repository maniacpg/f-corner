<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name' => 'required|unique:products|max:255|min:10',
            'price' => 'required',
            'category_id' => 'required',
            'contents' => 'required',

        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Tên không thể để trống!',
            'name.unique' => 'Đã có tên sản phẩm này!',
            'name.max' => 'Tên không được quá 255 ký tự!',
            'name.min' => 'Tên không được ít hơn 10 ký tự!',
            'category_id.required' => 'Danh mục không được để trống',
            'contents.required' => 'Mô tả không được để trống',
            'price.required' => 'Giá không được để trống',
        ];
    }
}
