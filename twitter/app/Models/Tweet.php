<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class Tweet extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public function tweetCreate(array $tweetPost)
    {
        return Tweet::create([
            'user_id' => Auth::id(),
            'content' => $tweetPost['content'],
        ]);
    }
}
