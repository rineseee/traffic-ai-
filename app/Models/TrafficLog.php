<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrafficLog extends Model
{
    protected $fillable = [
        'station_id',
        'logged_at',
        'vehicle_count', // nëse ke ndonjë fushë tjetër shtoje këtu
    ];

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }
}
