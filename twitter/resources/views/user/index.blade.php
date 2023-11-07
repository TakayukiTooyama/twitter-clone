@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ユーザー一覧</h1>
        <ul>
            @foreach ($users as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection
