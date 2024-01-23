<x-layout>
    <div class="container">
        <h1>ユーザー一覧</h1>
        <ul style="list-style-type: none; padding: 0;">
            @foreach ($users as $user)
                <div class="card mb-2">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src={{ asset('image/noicon.png') }}
                                style="width: 48px; height: 48px; margin-right: 8px; border-radius: 100%;">
                            <a href={{ route('users.show', ['id' => $user->id]) }}
                                class="text-reset text-decoration-none">
                                <li>{{ $user->name }}</li>
                            </a>
                        </div>
                        <x-button.follow-button :user="$user" />
                    </div>

                </div>
            @endforeach
        </ul>
    </div>
</x-layout>
