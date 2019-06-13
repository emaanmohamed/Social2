@extends('layouts.admin')


@section('content')

    <h1>Posts</h1>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Title</th>
            <th>body</th>
            <th>Post Link</th>
            <th>Comments</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
        </thead>
        <tbody>

        @if($posts)

            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><img height="50" width="50px" src="{{$post->photo ? url($post->photo->file) : 'https://via.placeholder.com/100'}}"></td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}">{{isset($post->user->name) ? $post->user->name : 'no user'}}</a></td>
                    <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>

                    <td>{{$post->title}}</td>
                    <td>{{Str::limit($post->body, 30)}}</td>
                    <td><a href="{{route('home.post', $post->id)}}">View Post</a></td>
                    <td><a href="{{route('admin.comments.show', $post->id)}}">View Comment</a></td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
@stop