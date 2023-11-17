<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TweetRequest extends FormRequest
{
    /**
     * ユーザー情報更新の認可
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * ツイート作成のバリデーション
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:140'],
        ];
    }

    /**
     * ユーザー情報更新のエラーメッセージ
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'content.required' => '文章を入力してください',
            'content.string' => '有効な形式で入力してください',
            'content.max' => '140文字以下で入力してください',
        ];
    }
}
