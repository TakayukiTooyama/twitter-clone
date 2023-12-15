<?php

namespace App\Services;

use App\Models\Tweet;
use App\Repositories\TweetRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TweetService
{
    /**
     * ツイート一覧取得
     *
     * @return Collection
     */
    public function getAllTweet(): Collection
    {
        $tweetRepository = new TweetRepository();
        return $tweetRepository->findAll();
    }

    /**
     * ツイートIDからツイートを取得
     *
     * @param int $tweetId
     *
     * @return ?Tweet
     */
    public function findTweetById(int $tweetId): ?Tweet
    {
        $tweetRepository = new TweetRepository();
        return $tweetRepository->findById($tweetId);
    }

    /**
     * ツイート作成
     *
     * @param int $userId
     * @param string $content
     *
     * @return void
     */
    public function createTweet(int $userId, string $content): void
    {
        $tweetRepository = new TweetRepository();
        $tweetRepository->create($userId, $content);
    }

    /**
     * ツイート更新
     *
     * @param int $tweetId
     * @param string $content
     *
     * @return void
     */
    public function updateTweet(int $tweetId, string $content): void
    {
        $tweetRepository = new TweetRepository();
        $tweetRepository->update($tweetId, $content);
    }
}
