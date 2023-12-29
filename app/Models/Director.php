<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Film;

class Director extends Model
{
    use HasFactory;

    protected $table = 'directors';

    protected $fillable = [
      'fullname', 'avatar', 'bio'
    ];

    public function films(): BelongsToMany
    {
        return $this->belongsToMany(Film::class, 'films_directors');
    }
}
