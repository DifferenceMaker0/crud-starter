@extends('layouts.posts')

@section('content')

<h1>Post: {{ $post->title }}</h1>
<div class="d-inline"><a href="{{ route('posts.index') }}">Go Back(route helper)</a></div>
<div>
    <a href="/posts" class="btn btn-default">Go Back(static declaration)</a>
<div>

<div class="d-flex justify-content-center align-items-center flex-column">
    <h3 class="mb-0"> Featured </h3>
    <div class="card" style="width: 18rem;">
        <div class="card-header"> 
            <h5 class="card-title">{{$post->title}}</h5> 
            <div class="card-body"> 
                <div> 
                    {{$post->body}}
                </div>  
            </div>
        </div>
    </div>
    <button><a href="/posts/{{$post->id}}/edit" class="btn btn-default"><i class="fas fa-plus-circle me-2"></i> Edit</a></button>
    <main>
    <section>
        <table>
        <tbody>
            @if($post->user_id)
            <th><label for="{{ $post->user_id }}">Viewing Posts by {{ $post->user_id }}</label></th>
            @endif
            <tr>
                <td>1</td>
                <td>{{$post->title}}</td>
                <td>1</td>
            </tr>
            <tr>
                <td>2</td>
                <td>{{$post->body}}</td>
                <td>2</td>
            </tr>
            <tr>
                <td>3</td>
                <td><a href="/posts/{{$post->id}}" class="btn btn-primary">Suggested For You</a></td>
                <td>3</td>
            </tr>
        </tbody> 
        </table>
    </section> 
    </main>  
    <div class="card-footer text-muted">
        <small>Written on {{$post->created_at}}</small> 
        <small>by {{ $post->user_id }}</small>
        <hr>
    </div>  
</div>

@endsection