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
                        <x-form.input-text label="メールアドレス" type="email" name="email" :value="$user->email" required />

                        <!-- パスワードフィールド -->
                        <x-form.input-password label="パスワード" name="password" iconId="togglePasswordIcon" />

                        <!-- 新しいパスワード確認フィールド -->
                        <x-form.input-password label="新しいパスワードの確認" name="password_confirmation"
                            iconId="togglePasswordConfirmationIcon" />

                        <div class="d-flex justify-content-between align-items-center">
                            {{-- 更新ボタン --}}
                            <button type="submit" class="btn btn-primary">更新</button>
                            {{-- 削除モーダルボタン --}}
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">削除</button>
                        </div>
                    </form>
                </div>
            </div>
            <x-modal.delete-modal label="ユーザー" route="users.delete" :id="$user->id" />
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
