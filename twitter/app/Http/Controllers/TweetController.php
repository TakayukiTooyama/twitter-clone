<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Services\TweetService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TweetController extends Controller
{
    protected $tweetService;

    public function __construct(TweetService $tweetService)
    {
        $this->tweetService = $tweetService;
    }

    /**
     * ツイート一覧の取得
     *
     * @return View
     */
    public function index(): View
    {
        $tweets = $this->tweetService->getAllTweet();
        return view('tweet.index', compact('tweets'));
    }

    /**
     * ツイートの作成
     *
     * @param TweetRequest
     *
     * @return RedirectResponse
     */
    public function create(TweetRequest $request): RedirectResponse
    {
        try {
            $this->tweetService->createTweet($request->validated());
            return back()->route('tweet.index');
        } catch (\Exception $e) {
            return back()->with('error', 'ツイートの投稿に失敗しました。');
        }
    }
}
