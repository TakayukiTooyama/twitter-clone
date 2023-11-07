<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
}
