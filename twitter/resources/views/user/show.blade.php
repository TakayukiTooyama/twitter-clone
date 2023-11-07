@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">ユーザー詳細</h1>
                <p>{{ $user->name }}</p>
                <p>{{ $user->email }}</p>
            </div>
        </div>
    </div>
@endsection
