@extends('layouts.dashboard')

@section('content')

    <h1>
        {{$post->title}}
    </h1>

    <p>
        {{$post->content}}
    </p>

    <div class="mt-3">
        <a href="{{route('admin.posts.edit', $post->id)}}">Edit</a>
    </div>

    <div class="mt-3">
        <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <input onclick="confirm('Are you sure??')" type="submit" value="Delete">
        </form>
    </div>
@endsection
