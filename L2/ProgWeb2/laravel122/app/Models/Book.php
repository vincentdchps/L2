<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;


class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

     protected $fillable = ['title', 'description', 'image', 'page', 'price', 'is_published', 'author_id'];

    public function author(): BelongsTo {
        return $this->belongsTo(Author::class);
    }  


protected function price(): Attribute
{
    return Attribute::make(      
        get: fn () => $this->attributes['price'] / 100,
        set: fn ($value) => $value * 100,
    );
}

protected static function booted(): void
{
    static::addGlobalScope('published', function (Builder $query) {
        $query->where('is_published', true);
    });
}

public function scopeWithoutPublished(Builder $query): Builder
{
    return $query->withoutGlobalScopes();
}
}


