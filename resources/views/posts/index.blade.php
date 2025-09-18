@extends('layouts.posts')

@section('content')

    <h1>Posts</h1>
    <div class="d-flex justify-content-center align-items-center flex-column">
    @if(count($paginate) > 0)
        @foreach($paginate as $page)
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Featured
                    <div class="col-md-4 col-sm-4">
                        @if($page->cover_image)
                        <img style="width:100%" src="/thumbnails/{{$page->thumbnail}}"> 
                         @else 
                         <p>No Cover Image</p>
                         @endif
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$page->title}}</h5> 
                    <p class="card-text">{{$page->body}}</p>
                    <a href="/posts/read/{{$page->id}}" class="btn btn-primary">Read More</a>
                </div>
                <div class="card-footer text-muted">
                    <small>Written on {{$page->created_at}}  
                    </small>
                </div> 
            </div>
        @endforeach  
        {{$paginate->links()}}  
    </div>
    @else
        <p>No Posts Found</p> 
    @endif
<hr>
<div class="d-flex"> 
    <table>
        <tbody> 
            <tr>
                <td>(1280, 720 )</td> 
                <td>(HD)</td> 
            </tr> 
            <tr>
                <td>(1920, 1080)</td>
                <td>(Full HD)</td> 
            </tr>
            <tr>
                <td>(2560, 1440)</td>
                <td>(QHD)</td> 
            </tr>
            <tr>
                <td>(3840, 2160)</td>
                <td>(4K UHD)</td> 
            </tr> 
        </tbody>
    </table>

    <table>
        <tbody> 
            <tr>
                <th>(4:3)</th> 
                <tr>
                    <colgroup>
                        <td>120 x 90</td>
                        <td>(HD)</td>
                    </colgroup>
                </tr>
            </tr>
            <tr>
                <th>(4:3)</th> 
                <tr>
                    <colgroup>
                        <td>400 x 300</td>
                        <td>(Full HD)</td>
                    </colgroup>
                </tr>
            </tr>
            <tr>
                <th>(4:3)</th> 
                <tr>
                    <colgroup>
                        <td>800 x 600</td>
                        <td>(QHD)</td>
                    </colgroup>
                </tr>
            </tr> 
        </tbody>
    </table>
</div>

@endsection