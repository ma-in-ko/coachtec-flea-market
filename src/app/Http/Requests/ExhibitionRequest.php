<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'name' => ['required', 'string',],
            'description' => ['required', 'string', 'max:255'],
            'image'=> ['required', 'image', 'mimes:jpeg,png'],
            'categories' => ['required', 'array'],
            'categories.*' =>['integer'],
            'condition' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages() {
        return[
            'name.required' => '商品名を入力してください',
            'name.string' => '商品名は文字で入力してください',
            'description.required' => '商品説明を入力してください',
            'description.string' => '商品説明は文字で250文字以内で入力してください',
            'description.max' => '商品説明は文字で250文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '商品画像はjpegまたはpngで保存してください',
            'categories.required' => 'カテゴリーを選択してください',
            'condition.required' => '商品状態を選択してください',
            'price.required' => '価格を入力してください',
            'price.numeric' => '価格は数字で入力してください',
            'price.min' => '価格は0円以上で入力してください'
        ];
    }
}
