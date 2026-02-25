<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
