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
        return view('home', compact('tweets'));
    }

    /**
     * ツイートの詳細
     *
     * @param int $userId
     * @param int $tweetId
     *
     * @return View|RedirectResponse
     */
    public function show(int $userId, int $tweetId): View|RedirectResponse
    {

        $tweet = $this->tweetService->findTweetById($tweetId);
        if (!$tweet) {
            return redirect()->route('home')->with('error', 'ツイートが存在しません。');
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
            return back()->route('home');
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
    public function update(TweetRequest $request, int $userId, int $tweetId): RedirectResponse
    {
        try {
            $tweet = $this->tweetService->findTweetById($tweetId);
            if (!$tweet) {
                return back()->with('error', '更新するツイートが存在しません。');
            }
            if ($userId !== Auth::id()) {
                return back()->with('error', '他のユーザーのツイートは更新できません。');
            }
            $content = $request->validated()['content'];
            $this->tweetService->updateTweet($tweetId, $content);
            return back()->with('success', 'ツイートが更新されました');
        } catch (AuthorizationException $e) {
            return back()->with('error', '認証されていないユーザーが更新しようとしました。');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'ツイートの更新に失敗しました。');
        }
    }

    /**
     * ツイートの削除
     *
     * @param int $userId
     * @param int $tweetId
     *
     * @return RedirectResponse
     */ public function delete(int $userId, int $tweetId): RedirectResponse
    {
        try {
            $tweet = $this->tweetService->findTweetById($tweetId);
            if (!$tweet) {
                return back()->with('error', '削除するツイートが存在しません。');
            }
            if ($userId !== Auth::id()) {
                return back()->with('error', '他のユーザーのツイートは削除できません。');
            }
            $this->tweetService->deleteTweet($tweetId);
            return redirect()->route('home')->with('success', 'ツイートを削除しました。');
        } catch (AuthorizationException $e) {
            return back()->with('error', '認証されていないユーザーが削除しようとしました。');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'ツイートの削除に失敗しました。');
        }
    }
}
