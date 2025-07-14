<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrafficNode extends Model
{
    public function statuses()
    {
        return $this->hasMany(TrafficStatus::class);
    }

    public function recommendations()
    {
        return $this->hasMany(AIRecommendation::class);
    }
    protected $fillable = ['location', 'city'];


}
