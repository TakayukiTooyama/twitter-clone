<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * ユーザー一覧取得
     *
     * @return Collection
     */
    public function getAllUser(): Collection
    {
        return $this->userRepository->findAll();
    }

    /**
     * ユーザーIDからユーザー情報を取得
     *
     * @param int $userId
     *
     * @return ?User
     */
    public function findUserById(int $userId): ?User
    {
        return $this->userRepository->findById($userId);
    }

    /**
     * ユーザー情報を更新
     *
     * @param int $userId
     * @param array $userInfo
     *
     * @return void
     */
    public function updateUserInfo(int $userId, array $userInfo): void
    {
        if (!empty($userInfo['password'])) {
            $userInfo['password'] = Hash::make($userInfo['password']);
        } else {
            unset($userInfo['password']);
        }
        $this->userRepository->update($userId, $userInfo);
    }

    /**
     * ユーザー削除
     *
     * @param int $userId
     *
     * @return bool
     */
    public function deleteUser(int $userId): void
    {
        $this->userRepository->delete($userId);
    }
}
