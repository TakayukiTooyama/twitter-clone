<?php

namespace App\Services;

use App\Models\Tweet;
use App\Repositories\TweetRepository;
use Illuminate\Database\Eloquent\Collection;

class TweetService
{
    protected $tweetRepository;

    public function __construct(TweetRepository $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    /**
     * ツイート一覧取得
     *
     * @return Collection
     */
    public function getAllTweet(): Collection
    {
        return $this->tweetRepository->findAll();
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
        return $this->tweetRepository->findById($tweetId);
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
        $this->tweetRepository->create($userId, $content);
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
        $this->tweetRepository->update($tweetId, $content);
    }

    /**
     * ツイート削除
     *
     * @param int $tweetId
     *
     * @return void
     */
    public function deleteTweet(int $tweetId): void
    {
        $tweetRepository = new TweetRepository();
        $tweetRepository->delete($tweetId);
    }
}
