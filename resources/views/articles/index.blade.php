@extends('layouts.posts')

@section('title', 'Articles - Article Hub')

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1><i class="fas fa-newspaper me-3"></i>Article Hub</h1>
                <p class="lead">Discover amazing articles and stories from our community</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" class="d-flex">
                <input type="text" name="search" class="form-control search-box me-2" 
                       placeholder="Search articles..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('articles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Create New Article
            </a>
        </div>
    </div>

    @if($articles->count() > 0)
        <div class="row">
            @foreach($articles as $article)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card article-card">
                        @if($article->featured_image)
                            <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                 class="card-img-top article-image" alt="{{ $article->title }}">
                        @else
                            <div class="card-img-top article-image bg-light d-flex align-items-center justify-content-center">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge badge-published">
                                    <i class="fas fa-eye me-1"></i>Published
                                </span>
                                <small class="article-meta">
                                    <i class="fas fa-clock me-1"></i>{{ $article->reading_time }} min read
                                </small>
                            </div>
                            
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text text-muted">{{ $article->excerpt }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="article-meta">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $article->published_at->format('M d, Y') }}
                                </small>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('articles.show', $article) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('articles.edit', $article) }}" 
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-search fa-4x text-muted mb-3"></i>
            <h3 class="text-muted">No articles found</h3>
            <p class="text-muted">
                @if(request('search'))
                    No articles match your search criteria.
                @else
                    Be the first to create an article!
                @endif
            </p>
            <a href="{{ route('articles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Create New Article
            </a>
        </div>
    @endif
</div>
@endsection