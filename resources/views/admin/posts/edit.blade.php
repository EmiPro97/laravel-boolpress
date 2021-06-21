@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5 font-weight-bold offset-md-2">Edit <a target="_blank" href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></h1>

        
        <div class="row">
            <div class="col-md-8 offset-md-2 text-light">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title*</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title', $post->title) }}">
                            @error('title')
                            <div>-- {{ $message }} --</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content*</label>
                            <textarea class="form-control @error('title') is-invalid @enderror" id="content" name="content" rows="6">{{ old('content', $post->content) }}</textarea>
                            @error('content')
                            <div>-- {{ $message }} --</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Edit post</button>
                    </form>
                </div>
            </div>
    </div>
@endsection