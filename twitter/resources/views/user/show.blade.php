<x-layout>
    <div class="container mt-5">
        @if (session('success'))
            <div id="alert-success" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (auth()->id() == $user->id)
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">ユーザー詳細</h1>
                    <form method="POST" action={{ route('users.update', ['id' => $user->id]) }} id="user-form">
                        @csrf
                        @method('PUT')

                        {{-- 名前入力フィールド --}}
                        <x-form.input-text label="名前" name="name" :value="$user->name" required />

                        {{-- メールアドレス入力フィールド --}}
                        <x-form.input-text label="メールアドレス" type="email" name="email" :value="$user->email" />

                        <!-- パスワードフィールド -->
                        <x-form.input-password label="パスワード" name="password" iconId="togglePasswordIcon" />

                        <!-- 新しいパスワード確認フィールド -->
                        <x-form.input-password label="新しいパスワードの確認" name="password_confirmation"
                            iconId="togglePasswordConfirmationIcon" />

                        {{-- 更新ボタン --}}
                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                </div>
            </div>
        @else
            <div>
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">ユーザー詳細</h1>
                        <p class="mb-0">【Name】 {{ $user->name }}</p>
                        <p>【Email】 {{ $user->email }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('body-scripts')
        <script src={{ asset('js/user-form.js') }}></script>
    @endpush
</x-layout>
