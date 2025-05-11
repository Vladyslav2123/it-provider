<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConnectionRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'tariff_id',
        'message',
        'status',
    ];

    protected $casts = [
        'tariff_id' => 'integer',
    ];

    public function tariff(): BelongsTo
    {
        return $this->belongsTo(Tariff::class);
    }
}
