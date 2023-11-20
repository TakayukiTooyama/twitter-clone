<x-layout>
    <div class="container-sm px-0">
        <div class="d-flex p-3 border">
            <img src={{ asset('image/noicon.png') }}
                style="width: 80px; height: 80px; margin-right: 8px; border-radius: 100%;">
            <form id="tweetForm" method="POST" action={{ route('tweet.create') }} class="flex-grow-1">
                @csrf
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content"
                    style="min-height: 140px; margin-bottom: 6px;" required></textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary" style="border-radius: 30px;">POST</button>
            </form>
        </div>
        <div class="border border-bottom-0">
            @foreach ($tweets as $tweet)
                <div class="d-flex border-bottom p-3">
                    <img src={{ asset('image/noicon.png') }}
                        style="width: 80px; height: 80px; margin-right: 8px; border-radius: 100%;">
                    <div>
                        <p class="fw-semibold m-0 mb-2">{{ $tweet->user->name }}</p>
                        <p class="mb-2">
                            {{ $tweet->content }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
