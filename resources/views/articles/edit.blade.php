@extends('layouts.posts')

@section('title', 'Edit Article - Article Hub')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Article</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $article->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="excerpt" class="form-label">Excerpt</label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                      id="excerpt" name="excerpt" rows="3" 
                                      placeholder="Brief description of the article (optional)">{{ old('excerpt', $article->excerpt) }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content *</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="10" required>{{ old('content', $article->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="featured_image" class="form-label">Featured Image</label>
                            @if($article->featured_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                         class="img-thumbnail" style="max-height: 150px;" alt="Current featured image">
                                    <small class="form-text text-muted d-block">Current featured image</small>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                   id="featured_image" name="featured_image" accept="image/*">
                            <div class="form-text">Leave empty to keep current image</div>
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Additional Images</label>
                            @if($article->images && count($article->images) > 0)
                                <div class="mb-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($article->images as $image)
                                            <img src="{{ asset('storage/' . $image) }}" 
                                                 class="img-thumbnail" style="max-height: 100px;" alt="Gallery image">
                                        @endforeach
                                    </div>
                                    <small class="form-text text-muted d-block">Current gallery images</small>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('images.*') is-invalid @enderror" 
                                   id="images" name="images[]" accept="image/*" multiple>
                            <div class="form-text">Select additional images to add to the gallery</div>
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="published" 
                                       name="published" value="1" {{ old('published', $article->published) ? 'checked' : '' }}>
                                <label class="form-check-label" for="published">
                                    <i class="fas fa-eye me-1"></i>Published
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('articles.show', $article) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                                <button type="button" class="btn btn-outline-danger ms-2" 
                                        onclick="confirmDelete({{ $article->id }})">
                                    <i class="fas fa-trash me-2"></i>Delete
                                </button>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Article
                            </button>
                        </div>
                    </form>
                </div>
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
function confirmDelete(articleId) {
    if (confirm('Are you sure you want to delete this article? This action cannot be undone.')) {
        const form = document.getElementById('deleteForm');
        form.action = `/articles/${articleId}`;
        form.submit();
    }
}
</script>
@endsection