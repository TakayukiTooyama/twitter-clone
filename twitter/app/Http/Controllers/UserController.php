<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * Userモデルのインスタンス
     *
     * @var User
     */
    protected $user;

    /**
     * 新しいコントローラインスタンスの生成
     *
     * @param User $user
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * ユーザー一覧を取得し、表示する
     *
     * @return View
     */
    public function index(): View
    {
        $users = $this->user->getAll();
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
        $user = $this->user->findByUserId($userId);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }
        return view('user.show', compact('user'));
    }

    /**
     * ユーザー情報を更新する
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, int $userId): RedirectResponse
    {
        // リクエストの取得
        $validatedUserInfo = $request->only(['name', 'email', 'password']);

        // パスワードが提供されている場合のみ更新、そうでなければ配列から削除
        if (!empty($validatedUserInfo['password'])) {
            $validatedUserInfo['password'] = Hash::make($validatedUserInfo['password']);
        } else {
            unset($validatedUserInfo['password']);
        }

        // ユーザー情報の更新
        if (Auth::id() === $userId) {
            $isUpdated = $this->user->userInfoUpdate($validatedUserInfo);
        }

        return $isUpdated
            ? back()->with('success', 'ユーザー情報を更新しました。')
            : back()->with('error', 'ユーザー情報に失敗しました。');
    }

    /**
     *  ユーザーを削除する
     *
     * @return RedirectResponse
     */
    public function delete(): RedirectResponse
    {
        $isDeleted = $this->user->userDelete();
        return $isDeleted
            ? redirect()->route('login')->with('success', 'ユーザーを削除しました。')
            : redirect()->route('users.index')->with('error', 'ユーザーの削除に失敗しました。');
    }
}
