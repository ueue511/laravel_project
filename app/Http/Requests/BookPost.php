<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookPost extends FormRequest
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
            'item_name' => 'bail|required|between:3, 255',
            'item_number' => 'bail|required|integer|digits_between:1,3',
            'item_amount' => 'bail|required|integer|digits_between:1,6',
            'published' => 'bail|required|date|before:today',
            'item_img' => 'bail|required|image|mimes:jpeg,png,jpg,gif'
        ];
    }
    public function messages()
    {
        return [
            'item_name.required' => 'タイトルを入力してください',
            'item_name.between' => 'タイトルは３文字〜255以内で入力してください',
            'item_number.required' => '冊数を入力してください',
            'item_number.integer' => '半角数字で入力してください',
            'item_number.digits_between' => '999以内で入力してください',
            'item_amount.required' => '金額を入力してください',
            'item_amount.integer' => '半角数字で入力してください',
            'item_amount.digits_between' => '￥999999以内で入力してください',
            'published.required' => '本公開日を指定してください',
            'published.before' => '本日から以前の年月日を指定してください',
            'item_img.required' => '画像を選択してください',
            'item_img.image' => '画像ファイルを選択してください',
            'item_img.mimes' => '画像ファイルを選択してください'
            
        ];
    }

    /**
     * バリデータを取得する
     * @return  \Illuminate\Contracts\Validation\Validator  $validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @Override
     * 勝手にリダイレクトさせない
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $this->merge(['validated' => 'true']);
        // リダイレクト先
        throw new HttpResponseException (
            redirect('/')->withInput($this->input)->withErrors($validator)->with(['message_id' => 'danger'])
        );
    }
}