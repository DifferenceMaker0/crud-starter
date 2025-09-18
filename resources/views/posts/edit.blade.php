@extends('layouts.posts')

@section('content')
 
        <h1>Edit Post</h1> 
    <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Edit Your Post</h3>
                </div>
                <div class="card-body">

                    {{ html()->form('PUT')->route('posts.update', ['post' => $post->id])->open() }}
                    @csrf
                    <div class="form-group mb-3">
                        {{html()->form('title', 'Title')}}
                        {{html()->text('title', $post->title)->placeholder('Title') }} 
                        {{html()->form('body', 'Body')}}
                        {{html()->textarea('body', $post->body)->class('form-control')->placeholder('Body Text') }} 
                            @if($posts->thumbnail)
                        <img src="/thumbnails/{{$page->thumbnail}}" width="75px" height="auto" />
                            @endif
                        
                        <div class="form-group">
                            {{ html()->file('cover_image')}}
                        </div> 
                        {{-- {{html()->hidden('_method','PUT')}} --}}
                        {{html()->submit('Submit')->class('btn btn-primary') }}
                        {{ html()->form()->close() }}  
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div> 
@endsection


                    {{-- <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf 
                        <div class="mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Body *</label>
                            <input type="text" class="form-control @error('body') is-invalid @enderror" 
                                   id="body" name="body" value="{{ old('body') }}" required>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Create Post
                            </button>
                        </div> 
                    </form> --}}

