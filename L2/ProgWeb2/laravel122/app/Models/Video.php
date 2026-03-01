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

public function scopePublished(Builder $query): void
{
    $query->where('is_published', true);
}

}
