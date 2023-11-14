<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * ユーザー一覧を取得し、表示する
     *
     * @return View
     */
    public function index(): View
    {
        $users = $this->userService->getAllUser();
        return view('user.index', compact('users'));
    }

    /**
     * ユーザー詳細を取得し、表示する
     *
     * @param int $userId
     *
     * @return View|RedirectResponse
     */
    public function show(int $userId): View|RedirectResponse
    {
        $user = $this->userService->findUserById($userId);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }
        return view('user.show', compact('user'));
    }

    /**
     * ユーザー情報を更新する
     *
     * @param UserUpdateRequest $request
     *
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request): RedirectResponse
    {
        try {
            $this->userService->updateUserInfo(Auth::id(), $request->validated());

            return back()->with('success', 'ユーザー情報を更新しました。');
        } catch (\Exception $e) {
            return back()->with('error', 'ユーザー情報の更新に失敗しました: ' . $e->getMessage());
        }
    }
}
