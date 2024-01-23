<?php

namespace App\Repositories;

use App\Models\Tweet;
use Illuminate\Database\Eloquent\Collection;


class TweetRepository
{
    /**
     * ツイート一覧取得
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return Tweet::orderBy('created_at', 'desc')->get();
    }

    /**
     * ツイートIDからツイートを取得
     *
     * @param int $tweetId
     *
     * @return ?Tweet
     */
    public function findById(int $tweetId): ?Tweet
    {
        return Tweet::find($tweetId);
    }

    /**
     * ツイート作成
     *
     * @param int $userId
     * @param string $content
     *
     * @return void
     */
    public function create(int $userId, string $content): void
    {
        Tweet::create([
            'user_id' => $userId,
            'content' => $content,
        ]);
    }

    /**
     * ツイート更新
     *
     * @param int $tweetId
     * @param string $content
     *
     * @return void
     */
    public function update(int $tweetId, string $content): void
    {
        Tweet::where('id', $tweetId)->update(['content' => $content]);
    }

    /**
     * ツイート削除
     *
     * @param int $tweetId
     *
     * @return void
     */
    public function delete(int $tweetId): void
    {
        Tweet::where('id', $tweetId)->delete();
    }
}
