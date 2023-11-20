<?php

namespace App\Repositories;

use App\Models\Tweet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;


class TweetRepository
{
    /**
     * ツイート作成
     *
     * @param string $content
     *
     * @return void
     */
    public function create(string $content): void
    {
        Tweet::create([
            'user_id' => Auth::id(),
            'content' => $content,
        ]);
    }
}
