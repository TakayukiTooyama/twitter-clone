<?php

namespace App\Http\Controllers;

use App\Services\FollowerService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FollowerController extends Controller
{
    protected $followerService;

    public function __construct(FollowerService $followerService)
    {
        $this->followerService = $followerService;
    }

    /**
     * フォロー一覧
     *
     * @return View
     */
    public function following(): View
    {
        $followingUsers = $this->followerService->getFollowingUser(Auth::id());
        return view('user.following', compact('followingUsers'));
    }

    /**
     * フォロワー一覧
     *
     * @return View
     */
    public function followed(): View
    {
        $followedUsers = $this->followerService->getFollowedUser(Auth::id());
        return view('user.followed', compact('followedUsers'));
    }

    /**
     * ユーザーフォロー
     *
     * @param int $followedId
     *
     * @return RedirectResponse
     */
    public function follow(int $followedId): RedirectResponse
    {
        try {
            if (Auth::id() === $followedId) {
                return back()->with('error', '自分自身をフォローすることはできません。');
            }
            $this->followerService->followUser(Auth::id(), $followedId);
            return back()->with('error', 'フォローしました。');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'フォローに失敗しました。');
        }
    }

    /**
     * ユーザーフォロー解除
     *
     * @param int $followedId
     *
     * @return RedirectResponse
     */
    public function unfollow(int $followedId): RedirectResponse
    {
        try {
            $this->followerService->unFollowUser(Auth::id(), $followedId);
            return back()->with('error', 'フォロー解除しました。');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'フォロー解除に失敗しました。');
        }
    }
}
