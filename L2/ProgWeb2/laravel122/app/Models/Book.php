<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


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
        get: fn (int $value) => $value / 100,
        set: fn (float $value) => $value * 100,
    );
}
}


