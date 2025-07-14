<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezultatet e Trafikut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Rezultatet e kërkimit për qytetin: <strong>{{ ucfirst($city) }}</strong></h2>

        @forelse($nodes as $node)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    📍 {{ $node->location }} - {{ $node->city }}
                </div>
                <div class="card-body">
                    <p><strong>Statusi aktual:</strong>
                        @php $lastStatus = $node->statuses->last(); @endphp
                        @if($lastStatus)
                            <span class="badge bg-warning text-dark">{{ ucfirst($lastStatus->status) }}</span>
                        @else
                            <span class="text-muted">Nuk ka të dhëna</span>
                        @endif
                    </p>

                    <p><strong>Rekomandimi nga AI:</strong>
                        {{ optional($node->recommendations->last())->recommendation ?? 'Asnjë rekomandim' }}
                    </p>

                    <p class="text-muted">
                        <small>Data e raportimit: {{ optional($lastStatus)->reported_at ?? '—' }}</small>
                    </p>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                Nuk u gjetën të dhëna për qytetin "{{ $city }}".
            </div>
        @endforelse

        @php
            try {
                $aiAnalysis = app(\App\Http\Controllers\TrafficController::class)->generateAIRecommendation($city);
            } catch (\Exception $e) {
                $aiAnalysis = 'AI nuk është në dispozicion për momentin.';
            }
        @endphp

        <div id="map" style="height: 400px;" class="mb-4"></div>

        <div class="alert alert-secondary">
            <strong>🤖 Analiza AI:</strong> {{ $aiAnalysis }}
        </div>

        <a href="/" class="btn btn-outline-secondary mt-3">⬅️ Kthehu mbrapa</a>
    </div>

    <script>
        var map = L.map('map').setView([42.66, 21.16], 8);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        @foreach($nodes as $node)
            L.marker([
                    {{ $node->latitude ?? '42.66' }},
                {{ $node->longitude ?? '21.16' }}
            ])
                .addTo(map)
                .bindPopup("<strong>{{ $node->location }}</strong><br>{{ $node->city }}<br>Status: {{ optional($node->statuses->last())->status ?? 'N/A' }}");
        @endforeach
    </script>
</body>

</html>