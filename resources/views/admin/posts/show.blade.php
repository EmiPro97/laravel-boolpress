@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="font-weight-bold">{{ $post->title }} Details</h2>
        @if ($post->category)
            <div class="mb-3"><strong>Category:</strong> <span class="p-2 badge badge-primary">{{ $post->category->name }}</span></div>
        @endif
        <div class="mb-5">
            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Edit Post</a>
        </div>
        <div class="mb-3">
            <h3 class="font-weight-bold">Content:</h3>
            {{ $post->content }}
        </div>

        {{-- Posts' tags --}}
        @if (count($post->tags) > 0)
            <h5 class="font-weight-bold">Tags:</h5>
            @foreach ($post->tags as $tag)
                <span class="badge badge-primary p-2">{{ $tag->name }}</span>
            @endforeach
        @endif
    </div>
@endsection