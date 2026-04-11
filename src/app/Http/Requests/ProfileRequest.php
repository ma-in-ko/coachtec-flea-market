<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'image' => ['nullable', 'mimes:jpeg,png'],
            'name' => ['required', 'string', 'max:20'],
            'postal_code' => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255']
        ];
    }

    public function messages() {
        return[

            'image.mimes' =>'イメージ画像はjpegかpngで保存してください',
            'name.required' =>'お名前を入力してください',
            'name.string' =>'お名前は文字で入力してください',
            'name.max' => 'お名前は20文字以内で入力してください',
            'postal_code.required' => '郵便番号を入力してください',
            'postal_code.regex' => '郵便番号は〇〇〇-〇〇〇〇で入力してください',
            'address.required' => '住所を入力してください',
            'address.string' => '住所は文字で入力してください',
            'address.max' => '住所は255文字以内で入力してください',

        ];
    }
}
