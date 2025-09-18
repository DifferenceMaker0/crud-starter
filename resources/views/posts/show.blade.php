@extends('layouts.posts')

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <img style="width:100%" src="/thumbnails/{{$page->thumbnail}}"> 
    <br><br>
    <div>
        {{$post->body}}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by @if($post->user_id) {{ $post->user_id }} @endif</small>
    <hr>

    @if(!auth()->guest())
        @if( auth()->user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

            {{ html()->form()->open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) }}
                {{ html()->hidden('_method', 'DELETE') }}
                {{ html()->submit('Delete')->class('btn btn-danger') }}
            {{ html()->form()->close() }}   
        @endif
    @endif

@endsection