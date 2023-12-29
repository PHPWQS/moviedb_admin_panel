<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Film;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
      'category'
    ];

    public function films(): BelongsToMany
    {
        return $this->belongsToMany(Film::class, 'films_categories');
    }
}
