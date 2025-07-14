<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TrafficNode;
use App\Models\TrafficStatus;
use App\Models\AIRecommendation;

class TrafficSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $node = TrafficNode::create([
            'location' => 'Rrethrrotullimi i Qendres',
            'city' => 'Prizren'
        ]);

        TrafficStatus::create([
            'traffic_node_id' => $node->id,
            'status' => 'heavy',
            'reported_at' => now()
        ]);

        AIRecommendation::create([
            'traffic_node_id' => $node->id,
            'recommendation' => 'Evito rrugën drejt Shatërvanit, përdor rrugën “Remzi Ademaj”.',
            'generated_at' => now()
        ]);
    }
}
