<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    protected $fillable = [
        'code',
        'name',
        'location',
        'latitude',
        'longitude',
        'description',
        'status',
    ];

    public function towers(): HasMany
    {
        return $this->hasMany(Tower::class);
    }
}