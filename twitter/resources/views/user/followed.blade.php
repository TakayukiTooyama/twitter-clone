<x-layout>
    <div class="container">
        <h1>フォロワー</h1>
        <ul style="list-style-type: none; padding: 0;">
            @foreach ($followedUsers as $user)
                <div class="card mb-2">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src={{ asset('image/noicon.png') }}
                                style="width: 48px; height: 48px; margin-right: 8px; border-radius: 100%;">
                            <p class="m-0">{{ $user->name }}</p>
                        </div>
                        <x-button.follow-button :user="$user" />
                    </div>

                </div>
            @endforeach
        </ul>
    </div>
</x-layout>
