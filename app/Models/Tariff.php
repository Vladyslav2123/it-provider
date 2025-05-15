<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Queue\SerializesModels;

class Tariff extends Model
{
    use SerializesModels;

    protected $fillable = [
        'name',
        'description',
        'price',
        'speed',
        'period',
        'is_popular',
        'active',
        'order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_popular' => 'boolean',
        'active' => 'boolean',
        'order' => 'integer',
    ];

    public function connectionRequests(): HasMany
    {
        return $this->hasMany(ConnectionRequest::class);
    }
}
