<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Services\TweetService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
     * ツイートの詳細
     *
     * @param int $tweetId
     *
     * @return View|RedirectResponse
     */
    public function show($tweetId): View|RedirectResponse
    {
        $tweet = $this->tweetService->findTweetById($tweetId);
        if (!$tweet) {
            return redirect()->route('tweet.index')->with('error', 'ツイートが存在しません。');
        }
        return view('tweet.show', compact('tweet'));
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

    /**
     * ツイートの更新
     *
     * @param TweetRequest
     * @param int $tweetId
     *
     * @return RedirectResponse
     */
    public function update(TweetRequest $request, int $tweetId)
    {
        try {
            // ツイートの取得
            $tweet = $this->tweetService->findTweetById($tweetId);
            if (!$tweet) {
                return back()->with('error', '更新するツイートが存在しません。');
            }
            if ($tweet->user_id !== Auth::id()) {
                return back()->with('error', '認証されていないユーザーが更新しようとしました。');
            }
            $this->tweetService->updateTweet($tweetId, $request->validated());
            return redirect()->route('tweet.show')->with('success', 'ツイートを更新しました。');
        } catch (\Exception $e) {
            return back()->with('error', 'ツイートの更新に失敗しました。');
        }
    }

    /**
     * ツイートの削除
     *
     * @param int $tweetId
     *
     * @return RedirectResponse
     */ public function delete(int $tweetId)
    {
        try {
            // ツイートの取得
            $tweet = $this->tweetService->findTweetById($tweetId);
            if (!$tweet) {
                return back()->with('error', '削除するツイートが存在しません。');
            }
            if ($tweet->user_id !== Auth::id()) {
                return back()->with('error', '認証されていないユーザーが削除しようとしました。');
            }
            // ツイートの削除
            $this->tweetService->deleteTweet($tweetId);
            return redirect()->route('tweet.index')->with('success', 'ツイートを削除しました。');
        } catch (\Exception $e) {
            return back()->with('error', 'ツイートの削除に失敗しました。');
        }
    }
}
