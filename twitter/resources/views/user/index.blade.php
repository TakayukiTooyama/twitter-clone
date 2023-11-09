<x-layout>
    <div class="container">
        <h1>ユーザー一覧</h1>
        <ul>
            @foreach ($users as $user)
                <a href={{ route('users.show', ['id' => $user->id]) }}>
                    <li>{{ $user->name }}</li>
                </a>
            @endforeach
        </ul>
    </div>
</x-layout>
