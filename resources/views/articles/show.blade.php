@extends('layouts.posts')

@section('title', $article->title . ' - Article Hub')

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <article class="card">
                @if($article->featured_image)
                    <img src="{{ asset('storage/' . $article->featured_image) }}" 
                         class="card-img-top" style="height: 400px; object-fit: cover;" alt="{{ $article->title }}">
                @endif
                
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <span class="badge badge-published me-2">
                                <i class="fas fa-eye me-1"></i>Published
                            </span>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $article->published_at->format('F d, Y') }}
                            </small>
                        </div>
                        <div class="d-flex align-items-center">
                            <small class="text-muted me-3">
                                <i class="fas fa-clock me-1"></i>{{ $article->reading_time }} min read
                            </small>
                            <div class="btn-group">
                                <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="confirmDelete({{ $article->id }})">
                                    <i class="fas fa-trash me-1"></i>Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    <h1 class="card-title mb-4">{{ $article->title }}</h1>
                    
                    <div class="article-content">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    @if($article->images && count($article->images) > 0)
                        <hr class="my-4">
                        <h5><i class="fas fa-images me-2"></i>Gallery</h5>
                        <div class="image-gallery">
                            @foreach($article->images as $image)
                                <img src="{{ asset('storage/' . $image) }}" 
                                     class="gallery-image" alt="Article image"
                                     onclick="openImageModal('{{ asset('storage/' . $image) }}')">
                            @endforeach
                        </div>
                    @endif
                </div>
            </article>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Articles
                </a>
                <div>
                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Article
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            @if($relatedArticles->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-bookmark me-2"></i>Related Articles</h5>
                    </div>
                    <div class="card-body">
                        @foreach($relatedArticles as $related)
                            <div class="d-flex mb-3">
                                @if($related->featured_image)
                                    <img src="{{ asset('storage/' . $related->featured_image) }}" 
                                         class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;" 
                                         alt="{{ $related->title }}">
                                @else
                                    <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px; min-width: 60px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-1">
                                        <a href="{{ route('articles.show', $related) }}" 
                                           class="text-decoration-none">{{ $related->title }}</a>
                                    </h6>
                                    <small class="text-muted">
                                        {{ $related->published_at->format('M d, Y') }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <img src="" id="modalImage" class="img-fluid w-100" alt="Article image">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script>
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
    imageModal.show();
}

function confirmDelete(articleId) {
    if (confirm('Are you sure you want to delete this article? This action cannot be undone.')) {
        const form = document.getElementById('deleteForm');
        form.action = `/articles/${articleId}`;
        form.submit();
    }
}
</script>
@endsection