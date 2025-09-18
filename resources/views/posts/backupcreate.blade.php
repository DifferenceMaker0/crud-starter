@extends('layouts.pages')

@section('content')

    <h1>Create Post</h1>  
    {{ html()->span()->text('Hello world!') }}  

    {{-- <div @class(['p-4', 'font-bold' => true]) --}}
    <div class="d-flex flex-column justify-content-center align-items-center">
        {{ $icon->class('fa-eye') }}
        {{ html()->form('POST', '/posts/create')->class('d-flex flex-column justify-content-center align-items-center col-md-9')->open() }}
        <div class="d-flex flex-row justify-content-between col-9">
            {{ html()->label('Post Title:', 'title') }}
            {{ html()->text('title')->placeholder('Post Title') }} 
        </div>
        <div class="d-flex flex-row justify-content-between col-9">
        {{ html()->modelForm($post, 'PUT', '/posts/' . $post->id)->open() }}
            {{ html()->text('name') }} // Will pre-fill with $user->name
            {{ html()->email('email')->class('form-control') }} // Will pre-fill with $user->email
        {{ html()->closeModelForm() }} 
        {{ html()->password('password')->required() }}
        {{ html()->checkbox('newsletter', true, 'yes')->label('Subscribe to newsletter') }}
        {{ html()->select('country', ['US' => 'United States', 'CA' => 'Canada'], 'US')->class('form-select') }}
        </div>
        <div class="d-flex flex-row justify-content-between col-9">
            {{ html()->label('Post Body:', 'body') }}
            {{ html()->text('body')->placeholder('Body Content') }}
        </div> 
        {{ html()->submit('Submit')->class('btn btn-primary') }}
        {{ html()->form()->close() }}
    </div>
    

@endsection