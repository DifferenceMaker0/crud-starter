<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'featured_image',
        'images',
        'published',
        'published_at',
    ];

    protected $casts = [
        'images' => 'array',
        'published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected function excerpt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value = null) => $value ?: $this->generateExcerpt(),
        );
    }

    public function generateExcerpt($length = 150)
    {
        return strlen(strip_tags($this->content)) > $length 
            ? substr(strip_tags($this->content), 0, $length) . '...'
            : strip_tags($this->content);
    }

    public function getReadingTimeAttribute()
    {
        $wordsPerMinute = 200;
        $wordCount = str_word_count(strip_tags($this->content));
        return ceil($wordCount / $wordsPerMinute);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }
}