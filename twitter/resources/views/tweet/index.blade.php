<x-layout>
    <div class="container-sm px-0 position-relative">
        <div class="border border-bottom-0">
            {{-- @foreach --}}
            <div class="d-flex border-bottom p-3">
                <img src={{ asset('image/noicon.png') }}
                    style="width: 80px; height: 80px; margin-right: 8px; border-radius: 100%;">
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="fw-bold m-0">Takayuki Tooyama</p>
                        <i class="far fa-edit" style="cursor: pointer;"></i>
                    </div>
                    <p class="mb-2">
                        本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文本文
                    </p>
                    <div class="d-flex align-items-center">
                        <i class="far fa-heart" style="cursor: pointer;"></i>
                        <span class="mx-1">100</span>
                    </div>
                </div>
            </div>
            {{-- @endforeach --}}
        </div>
        <button type="button" class="btn btn-primary position-fixed"
            style="bottom: 24px; right:24px; border-radius: 100%;" data-bs-toggle="modal"
            data-bs-target="#tweetCreateModal">
            <i class="fa fa-plus" style="color: #ffffff;"></i>
        </button>
    </div>

    {{-- モーダル --}}
    <div id="tweetCreateModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">キャンセル</button>
                    <form method="POST">
                        <button type="button" class="btn btn-primary" style="border-radius: 30px;"
                            data-bs-dismiss="modal">ツイートする</button>
                    </form>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <img src={{ asset('image/noicon.png') }}
                            style="width: 60px; height: 60px; margin-right: 8px; border-radius: 100%;">
                        <textarea class="form-control" id="message-text" style="min-height: 240px;"></textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- モーダル --}}
        <div id="tweetUpdateModal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">キャンセル</button>
                        <form method="POST" action={{ route('tweet.create') }}>
                            <button type="button" class="btn btn-primary" style="border-radius: 30px;"
                                data-bs-dismiss="modal">更新</button>
                        </form>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex">
                            <img src={{ asset('image/noicon.png') }}
                                style="width: 60px; height: 60px; margin-right: 8px; border-radius: 100%;">

                            <div>
                                <textarea class="form-control @error('tweet_content') is-invalid @enderror" id="new-tweet" name="tweet_content" required
                                    style="min-height: 240px;">{{ old('tweet_content', $tweet->content ?? '') }}</textarea>
                                @error('tweet_content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-layout>
