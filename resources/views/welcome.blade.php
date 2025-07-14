<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AI Traffic Management | Kosovo</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
            color: #212529;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        .navbar-brand {
            color: #0d6efd;
            font-weight: 600;
        }

        .navbar-nav .nav-link {
            color: #333 !important;
        }

        .hero {
            background-color: #e9ecef;
            padding: 100px 20px;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.1rem;
            color: #555;
        }

        .btn-custom {
            background-color: #0d6efd;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #0b5ed7;
        }

        .card {
            border: none;
            border-radius: 12px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        footer {
            background-color: #f1f3f5;
            color: #555;
            padding: 25px 0;
            text-align: center;
            border-top: 1px solid #ddd;
            font-size: 0.9rem;
        }

        footer a {
            color: #0d6efd;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">🚦 AI Traffic KS</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Kyçu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Regjistrohu</a>
                        </li>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <h1>Menaxhimi Inteligjent i Trafikut</h1>
        <p class="mt-3">Sistem i avancuar për monitorim, analiza dhe optimizim të rrugëve në kohë reale.</p>
        @guest
            <a href="{{ route('login') }}" class="btn btn-custom mt-4">🚀 Fillo Tani</a>
        @endguest
    </section>

    <!-- FEATURES -->
    <div class="container my-5">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="feature-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <h5>Pikat e Trafikut</h5>
                    <p class="text-muted small">Gjurmim i pikave më të ngarkuara në rrugë në kohë reale.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="feature-icon"><i class="bi bi-bar-chart-line"></i></div>
                    <h5>Statistika</h5>
                    <p class="text-muted small">Analiza ditore, javore dhe mujore për intensitetin e trafikut.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="feature-icon"><i class="bi bi-cpu"></i></div>
                    <h5>Sugjerime AI</h5>
                    <p class="text-muted small">AI rekomandon rrugët më të shpejta dhe të lira në kohë reale.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CHART -->
    <div class="container my-5">
        <h4 class="text-center mb-4">📈 Trafiku gjatë 24 orëve</h4>
        <canvas id="trafficChart" height="100"></canvas>


        <!-- FOOTER -->
        <footer>
            <div class="container">
                © {{ date('Y') }} AI Traffic KS • Të gjitha të drejtat e rezervuara.
            </div>
        </footer>

        <!-- Scripts -->
        <script>
            const ctx = document.getElementById('trafficChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00', '24:00'],
                    datasets: [{
                        label: 'Intensiteti i Trafikut',
                        data: [10, 25, 80, 90, 60, 40, 15],
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13,110,253,0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { color: '#666' },
                            grid: { color: '#eee' }
                        },
                        x: {
                            ticks: { color: '#666' },
                            grid: { color: '#eee' }
                        }
                    }
                }
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>