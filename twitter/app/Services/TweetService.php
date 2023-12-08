<?php

namespace App\Services;

use App\Models\Tweet;
use App\Repositories\TweetRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TweetService
{
    /**
     * ツイートの存在と所有者をチェックする。
     *
     * @param Tweet $tweet
     * @return bool
     */
    public function checkTweetOwner(Tweet $tweet)
    {
        return $tweet->user_id === Auth::id();
    }

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
     * @return Tweet|null
     */
    public function findTweetById(int $tweetId): ?Tweet
    {
        $tweetRepository = new TweetRepository();
        return $tweetRepository->findById($tweetId);
    }

    /**
     * ツイート作成
     *
     * @param array $tweet
     *
     * @return void
     */
    public function createTweet(array $tweet): void
    {
        $content = $tweet['content'];
        $tweetRepository = new TweetRepository();
        $tweetRepository->create($content);
    }

    /**
     * ツイート更新
     *
     * @param int $tweetId
     * @param array $tweet
     *
     * @return void
     */
    public function updateTweet(int $tweetId, array $tweet): void
    {
        $content = $tweet['content'];
        $tweetRepository = new TweetRepository();
        $tweetRepository->update($tweetId, $content);
    }
}
