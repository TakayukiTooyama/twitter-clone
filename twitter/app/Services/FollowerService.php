<?php

namespace App\Services;

use App\Repositories\FollowerRepository;
use Illuminate\Database\Eloquent\Collection;

class FollowerService
{
    protected $followerRepository;

    public function __construct(FollowerRepository $followerRepository)
    {
        $this->followerRepository = $followerRepository;
    }

    /**
     * ユーザーフォロー判定
     *
     * @param int $userId
     * @param int $targetUserId
     *
     * @return bool
     */
    public function isFollowing(int $userId, int $targetUserId): bool
    {
        return $this->followerRepository->isFollowing($userId, $targetUserId);
    }

    /**
     * フォロー一覧
     *
     * @param int $userId
     *
     * @return Collection
     *
     */
    public function getFollowingUser(int $userId): Collection
    {
        return $this->followerRepository->getFollowing($userId);
    }

    /**
     * フォロー一覧
     *
     * @param int $userId
     *
     * @return Collection
     *
     */
    public function getFollowedUser(int $userId): Collection
    {
        return $this->followerRepository->getFollowed($userId);
    }

    /**
     * ユーザーフォロー
     *
     * @param int $userId
     * @param int $followedId
     *
     * @return void
     */
    public function followUser(int $userId, int $followedId): void
    {
        $this->followerRepository->store($userId, $followedId);
    }

    /**
     * ユーザーフォロー解除
     *
     * @param int $userId
     * @param int $followedId
     *
     * @return void
     */
    public function unFollowUser(int $userId, int $followedId): void
    {
        $this->followerRepository->delete($userId, $followedId);
    }
}
