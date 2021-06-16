@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="dark font-weight-bold">Posts</h1>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th class="text-center" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td><a class="btn btn-success" href="{{ route('admin.posts.show', $post->slug) }}">SHOW</a></td>
                        <td>EDIT</td>
                        <td>DELETE</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection