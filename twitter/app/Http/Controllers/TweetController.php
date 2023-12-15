<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Services\TweetService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    public function show(int $tweetId): View|RedirectResponse
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
            $content = $request->validated()['content'];
            $this->tweetService->createTweet(Auth::id(), $content);
            return back()->route('tweet.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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
    public function update(TweetRequest $request, int $tweetId): RedirectResponse
    {
        try {
            $tweet = $this->tweetService->findTweetById($tweetId);
            if (!$tweet) {
                return back()->with('error', '更新するツイートが存在しません。');
            }
            $this->authorize('update', $tweet);
            $content = $request->validated()['content'];
            $this->tweetService->updateTweet($tweetId, $content);
            return back()->with('success', 'ツイートが更新されました');
        } catch (AuthorizationException $e) {
            Log::error($e->getMessage());
            return back()->with('error', '認証されていないユーザーが更新しようとしました。');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'ツイートの更新に失敗しました。');
        }
    }
}
