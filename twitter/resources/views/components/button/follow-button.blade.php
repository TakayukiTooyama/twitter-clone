@if (Auth::id() !== $user->id)
    @if (Auth::user()->followings->contains($user->id))
        <form method="POST" action={{ route('users.unfollow', ['userId' => $user->id]) }}>
            @csrf
            @method('DELETE')
            <button class="btn btn-primary">フォロー中</button>
        </form>
    @else
        <form method="POST" action={{ route('users.follow', ['userId' => $user->id]) }}>
            @csrf
            @method('PUT')
            <button class="btn btn-dark">フォロー</button>
        </form>
    @endif
@endif
