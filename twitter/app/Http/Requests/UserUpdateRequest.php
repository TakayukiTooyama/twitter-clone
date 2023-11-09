<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
     * ユーザー情報更新のバリデーション
     *
     * @return array
     */
    public function rules(): array
    {
        $userId = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($userId)],
            'email' => ['required', 'email', 'email:dns', 'email:spoof', 'max:256', Rule::unique('users')->ignore($userId)],
            'password' => ['nullable', 'string', 'between:8,24', 'confirmed'],
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
            'name.required' => '名前を入力してください',
            'name.string' => '有効な形式で入力してください',
            'name.max' => '20文字以下で入力してください',

            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '有効なメールアドレスをご利用ください',
            'email.max' => '256文字以下で入力してください',
            'email.unique' => 'そのメールアドレスは使用されています',

            'password.required' => 'パスワードを入力してください',
            'password.between' => '8文字以上24文字以下で入力してください',
            'password.confirmed' => 'パスワードが一致しません'
        ];
    }
}
