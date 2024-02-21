<x-layout>
    <div class="container-sm px-0">
        <div class="d-flex p-3 border">
            <a href={{ route('users.show', ['userId' => auth()->id()]) }}>

                <img src={{ asset('image/noicon.png') }}
                    style="width: 80px; height: 80px; margin-right: 8px; border-radius: 100%;">
            </a>
            <form id="tweetForm" method="POST" action={{ route('tweet.create', ['userId' => auth()->id()]) }}
                class="flex-grow-1">
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
                <div class="card"
                    onclick="location.href='{{ route('tweet.show', ['userId' => $tweet->user_id, 'tweetId' => $tweet->id]) }}'"
                    style="cursor: pointer;">
                    <div class="card-body d-flex p-3">
                        <div onclick="event.stopPropagation();">
                            <a href="{{ route('users.show', ['userId' => $tweet->user_id]) }}">
                                <img src="{{ asset('image/noicon.png') }}"
                                    style="width: 80px; height: 80px; border-radius: 100%;" alt="User Icon" />
                            </a>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title">{{ $tweet->user->name }}</h5>
                            <p class="card-text">{{ $tweet->content }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <div class="border border-bottom-0">
            @foreach ($tweets as $tweet)
                <a href={{ route('tweet.show', ['userId' => auth()->id(), 'tweetId' => $tweet->id]) }}
                    class="text-reset text-decoration-none">
                    <div class="d-flex border-bottom p-3 ">
                        <a href={{ route('users.show', ['userId' => $tweet->user_id]) }}
                            style="width: 80px; height: 80px; border-radius: 100%; margin-right: 8px; ">
                            <img src={{ asset('image/noicon.png') }}
                                style="width: 80px; height: 80px; border-radius: 100%;" />
                        </a>

                        <div>
                            <p class="fw-semibold m-0 mb-2">{{ $tweet->user->name }}</p>
                            <p class="mb-2">
                                {{ $tweet->content }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div> --}}
    </div>
</x-layout>
