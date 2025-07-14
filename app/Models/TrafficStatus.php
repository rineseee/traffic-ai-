<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrafficStatus extends Model
{
    public function node()
    {
        return $this->belongsTo(TrafficNode::class);
    }
    protected $fillable = ['traffic_node_id', 'status', 'reported_at'];

}
