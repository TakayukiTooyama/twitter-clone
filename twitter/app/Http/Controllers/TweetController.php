<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Http\Requests\TweetCreateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class TweetController extends Controller
{
    /**
     * Tweetモデルのインスタンス
     *
     * @var Tweet
     */
    protected $tweet;

    /**
     * 新しいコントローラインスタンスの生成
     *
     * @param Tweet $tweet
     *
     * @return void
     */
    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    public function index()
    {
        // $tweets = $this->tweet->getAll();
        return view('tweet.index');
    }

    /**
     * ツイートの作成
     *
     * @param TweetCreateRequest
     *
     * @return RedirectResponse
     */
    public function create(TweetCreateRequest $request): RedirectResponse
    {
        $userId = Auth::id();
        $content = $request->only('content');
        $this->tweet->tweetCreate($content);
        return redirect()->route('tweet.index', compact($userId));
    }
}
