<?php

namespace App\Services;

use App\Models\Station;
use App\Models\TrafficLog;


class TrafficService
{
    // Pikat më të ngarkuara në 10 minutat e fundit
    public static function getHotspots()
    {
        return Station::withCount([
            'trafficLogs as vehicle_count' => function ($query) {
                $query->where('logged_at', '>=', now()->subMinutes(10));
            }
        ])
            ->orderByDesc('vehicle_count')
            ->take(5)
            ->get();
    }

    // Statistikat ditore, javore, mujore
    public static function getStatistics()
    {
        return [
            'daily' => TrafficLog::whereDate('logged_at', today())->sum('vehicle_count'),
            'weekly' => TrafficLog::whereBetween('logged_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('vehicle_count'),
            'monthly' => TrafficLog::whereMonth('logged_at', now()->month)->sum('vehicle_count'),
        ];
    }

    // Sugjerime nga AI (simuluar për tani)
    public static function getAISuggestions()
    {
        return [
            [
                'from' => 'Prishtinë',
                'to' => 'Fushë Kosovë',
                'suggested_route' => 'Rruga A',
                'eta' => '5 min'
            ],
            [
                'from' => 'Prizren',
                'to' => 'Gjakovë',
                'suggested_route' => 'Rruga Dardania',
                'eta' => '45 min'
            ]
        ];
    }
}
