<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    /**
     * ユーザー一覧取得
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return User::all();
    }

    /**
     * ユーザーIDからユーザー情報を取得
     *
     * @param int $userId
     *
     * @return ?User
     */
    public function findById(int $userId): ?User
    {
        return User::find($userId);
    }

    /**
     * ユーザー情報を更新
     *
     * @param int $userId
     * @param array $userInfo
     *
     * @return void
     */
    public function update(int $userId, array $userInfo): void
    {
        User::where('id', $userId)->update($userInfo);
    }
    /**
     * ユーザー削除
     *
     * @param int $userId
     *
     * @return void
     */
    public function delete(int $userId): void
    {
        User::where('id', $userId)->delete();
    }
}
