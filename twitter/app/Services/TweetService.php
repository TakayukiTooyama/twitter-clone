<?php

namespace App\Services;

use App\Models\Tweet;
use App\Repositories\TweetRepository;
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
}
