<x-layout>
    <div class="container-sm px-0 border position-relative">
        <a href={{ route('tweet.index') }} class="opacity-50 d-inline-block px-3 py-2 text-reset text-decoration-none">
            <i class="fas fa-chevron-left"></i><span class="fw-bold" style="margin-left: 6px;">戻る</span>
        </a>
        <form method="POST" action={{ route('tweet.update', ['id' => $tweet->id]) }} id="user-form">
            @csrf
            @method('PUT')
            <div class="d-flex p-3">
                <img src={{ asset('image/noicon.png') }}
                    style="width: 80px; height: 80px; margin-right: 8px; border-radius: 100%;">
                <div class="flex-grow-1">
                    <p class="fw-bold m-0 mb-2">{{ $tweet->user->name }}</p>
                    @if (auth()->id() == $tweet->user->id)
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content"
                            style="margin-bottom: 6px;" required value={{ old('content', $tweet->content) }}></textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    @else
                        <p class="mb-2">
                            {{ $tweet->content }}
                        </p>
                    @endif
                    <div class="d-flex align-items-center">

                    </div>
                    @if (auth()->id() == $tweet->user_id)
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <button type="submit" class="btn btn-primary">更新</button>
                        </div>
                    @endif
                </div>
            </div>
        </form>
        <x-modal.success-modal />
    </div>
    @push('body-scripts')
        <script src={{ asset('js/alert.js') }}></script>
    @endpush
</x-layout>
