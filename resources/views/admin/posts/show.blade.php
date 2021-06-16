@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="font-weight-bold">{{ $post->title }} Details</h2>
        <div class="mb-5">
            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Edit Post</a>
        </div>
        <div>
            {{ $post->content }}
        </div>
    </div>
@endsection