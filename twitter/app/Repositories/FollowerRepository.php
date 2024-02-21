<?php

namespace App\Repositories;

use App\Models\Follower;
use Illuminate\Database\Eloquent\Collection;

class FollowerRepository
{

    /**
     * ユーザーフォロー判定
     *
     * @param int $userId
     * @param int $followedId
     *
     * @return bool
     */
    public function isFollowing(int $userId, int $followedId): bool
    {
        return Follower::where('following_id', $userId)
            ->where('followed_id', $followedId)
            ->exists();
    }

    /**
     * フォロー一覧
     *
     * @param int $userId
     *
     * @return Collection
     */
    public function getFollowing(int $userId): Collection
    {
        return Follower::where('following_id', $userId)
            ->join('users', 'users.id', '=', 'followers.followed_id')
            ->get();
    }

    /**
     * フォロワー一覧
     *
     * @param int $userId
     *
     * @return Collection
     */
    public function getFollowed(int $userId): Collection
    {
        return Follower::where('followed_id', $userId)
            ->join('users', 'users.id', '=', 'followers.following_id')
            ->get();
    }

    /**
     * ユーザーフォロー
     *
     * @param int $userId
     * @param int $followedId
     *
     * @return void
     */
    public function store(int $userId, int $followedId): void
    {
        Follower::create([
            'following_id' => $userId,
            'followed_id' => $followedId,
        ]);
    }

    /**
     * ユーザーフォロー解除
     *
     * @param int $userId
     * @param int $followedId
     *
     * @return void
     */
    public function delete(int $userId, int $followedId): void
    {
        Follower::where('following_id', $userId)
            ->where('followed_id', $followedId)
            ->delete();
    }
}
