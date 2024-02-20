<?php

namespace App\Repositories;

use App\Models\Follower;

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
