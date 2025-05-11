<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoverageArea extends Model
{
    protected $fillable = [
        'name',
        'city',
        'region',
        'postal_code',
        'latitude',
        'longitude',
        'radius',
        'description',
        'active',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'radius' => 'decimal:2',
        'active' => 'boolean',
    ];
}
