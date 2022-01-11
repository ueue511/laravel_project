<?php

namespace App\Http\Requests;

use Hamcrest\Core\IsTypeOf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookFormRequest extends FormRequest
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
            'book_tag' => 'bail|required|array',
            'book_tag.*' => 'bail|required|integer',
            'item_amount' => 'bail|required|integer|digits_between:1,6',
            'published' => 'bail|required|date|before:today',
        ];
    }
    
    // 画像ファイルのバリデーション判定　新規:画像ファイル　追加:画像path　
    public function withValidator( Validator $validator )
    {
        $validator->sometimes( 'item_img', 'bail|required|image|mimes:jpeg,png,jpg,gif', function( $input ){
            return is_string( $input->item_img ) === false;
        });
        
        $validator->sometimes('item_img', 'bail|required',
        function( $input ){
            return is_string( $input->item_img ) === true;
        });
    }
    
    public function messages()
    {
        return [
            'item_name.required' => 'タイトルを入力してください',
            'item_name.between' => 'タイトルは３文字〜255以内で入力してください',
            'book_tag.required' => '最低１つはジャンルを選択してください',
            'book_tag.integer' => 'ジャンルから選択してください',
            'item_amount.required' => '金額を入力してください',
            'item_amount.integer' => '半角数字で入力してください',
            'item_amount.digits_between' => '￥999999以内で入力してください',
            'published.required' => '本公開日を指定してください',
            'published.before' => '本日から以前の年月日を指定してください',
            'item_img.required' => '画像ファイルを選択してください',
            'item_img.image' => '画像ファイルを選択してください',
            'item_img.mimes' => 'ファイル形式「jpeg,png,jpg,gif」から選択してください'
            
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
    protected function failedValidation( Validator $validator )
    {
        $this->merge( ['validated' => 'true'] );

        !is_string( $this->item_img )? $file = $this->item_img: $file='';  //imgファイルがある場合、file取得
        
        if ( !empty($file) ) {               //fileが空かチェック
            $filename = $file->getClientOriginalName();  //ファイル名を取得
            $target_path = public_path( 'temporary/' );
            !file_exists( $target_path . $filename )?$file->move( $target_path, $filename ): '';  //一時フォルダーにファイルを移動
        } else {
            $filename = $this->item_img;
        }
        
        $this->_method === 'post' ? $redirectUrl = '/admin': $redirectUrl =
        $_SERVER['REQUEST_URI'];

        // リダイレクト先
        throw new HttpResponseException (
            redirect( $redirectUrl )
            ->withInput( $this->input ) 
            ->withErrors( $validator )
            ->with([ 
                'message_id' => 'danger', 
                'filename' => $filename,
            ])
        );
    }
}