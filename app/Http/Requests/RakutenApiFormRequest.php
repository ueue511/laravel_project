<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RakutenApiFormRequest extends FormRequest
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
            'item_img' => 'bail|required|url',
            'item_name' => 'bail|required|between:3, 255',
            'item_amount' => 'bail|required|integer|digits_between:1,6',
            'published' => 'bail|required|before:today',
        ];
    }

    public function messages() 
    {
        return [
            'item_img.url' => 'URLを入力して下さい',
            'item_name.required' => 'タイトルを入力してください',
            'item_name.between' => 'タイトルは３文字〜255以内で入力してください',
            'item_amount.required' => '金額を入力してください',
            'item_amount.integer' => '半角数字で入力してください',
            'item_amount.digits_between' => '￥999999以内で入力してください',
            'published.required' => '本公開日を指定してください',
            'published.before' => '本日から以前の年月日を指定してください',
        ];
    }
}