<?php

namespace App\Http\Controllers;

use App\Models\User;
use \Illuminate\View\View;

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
     * @param int $id
     *
     * @return View
     */
    public function show(int $id): View
    {
        $user = $this->user->findByUserId($id);
        return view('user.show', compact('user'));
    }
}
