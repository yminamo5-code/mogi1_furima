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
        return 
        [
            'itemname'=>['required'],
            'description'=>['required','max:255'],
            'image'=>['required','image','mimes:jpeg,png'],
            'category'=>['required'],
            'condition'=>['required'],
            'price'=> ['required','integer','min:0'],
        ];
    }
    
    public function messages()
    {
        return [
            'itemname.required'=>'商品名を入力してください',
            'description.required'=>'商品説明を入力してください',
            'description.max'=>'商品説明は255文字以内にしてください',
            'image.required'=>'画像はアップロード必須です',
            'image.mimes'=>'拡張子が.jpegもしくは.pngにしてください',
            'category.required'=>'商品のカテゴリーを選択してください',
            'price.required'=>'商品価格を入力してください',
            'price.integer'=>'数値を入力してください',
            'price.min'=>'0以上を入力してください'
        ];
    }   
}
