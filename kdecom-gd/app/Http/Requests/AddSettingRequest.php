<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSettingRequest extends FormRequest
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
            'config_key' => 'required|unique:settings',
            'config_value' => 'required',
        ];
    }
    public function messages(): array{
        return [
            'config_key.required'=>'Tên cấu hình không được trống! ',
            'config_value.required'=>'Giá trị không được trống! ',
            'config_key.unique'=>'Đã có cấu hình này!',

        ];
    }

}
