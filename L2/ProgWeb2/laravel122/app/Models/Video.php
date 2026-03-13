<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory;
    protected $fillable = [
    'title',
    'description',
    'image',
    'year',
    'price',
    'is_published',
];

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
