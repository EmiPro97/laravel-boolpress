@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="dark font-weight-bold">Posts</h1>
        @if (session('Deleted'))
            <div class="alert alert-success">
                <strong>{{ session('Deleted') }}</strong>
                deleted successfully.
            </div>
        @endif
        <a class="btn btn-primary mb-3" href="{{ route('admin.posts.create') }}">Create a new post</a>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th class="text-center" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>@if ($post->category) {{ $post->category->name }} @endif</td>
                        <td class="text-center"><a class="btn btn-success" href="{{ route('admin.posts.show', $post->id) }}">SHOW</a></td>
                        <td class="text-center"><a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">EDIT</a></td>
                        <td class="text-center">
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection