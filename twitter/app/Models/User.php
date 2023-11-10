<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ユーザー一覧を取得する
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return User::all();
    }

    /**
     * ユーザー詳細を取得する
     *
     * @param int $userId
     *
     * @return User|null
     */
    public function findByUserId(int $userId): User|null
    {
        return User::find($userId);
    }

    /**
     * ユーザー情報を更新する
     *
     * @param array $validatedUserInfo
     *
     * @return bool
     */
    public function userInfoUpdate(array $validatedUserInfo): bool
    {
        return Auth::user()->update($validatedUserInfo);
    }

    /**
     * ユーザーを削除する
     *
     * @return bool
     */
    public function userDelete(): bool
    {
        return Auth::user()->delete();
    }
}
