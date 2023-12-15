<?php

namespace App\Policies;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TweetPolicy
{
    use HandlesAuthorization;

    /**
     * ツイート更新の認可
     *
     * @param  User  $user
     * @param  Tweet  $tweet
     *
     * @return bool
     */
    public function update(User $user, Tweet $tweet)
    {
        return $user->id === $tweet->user_id;
    }
}
