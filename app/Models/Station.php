<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\TrafficLog;

class Station extends Model
{
    protected $fillable = ['name', 'location']; // ose fushat që i ke

    public function trafficLogs(): HasMany
    {
        return $this->hasMany(TrafficLog::class);
    }
}
