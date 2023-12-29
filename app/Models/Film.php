<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Actor;

class Film extends Model
{
    use HasFactory;

    protected $table = 'films';

    protected $fillable = [
      'title', 'description', 'thumbnail',
      'trailer', 'year', 'budget', 'rating'
    ];

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class, 'films_actors');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'films_categories');
    }

    public function directors(): BelongsToMany
    {
        return $this->belongsToMany(Director::class, 'films_directors');
    }
}
