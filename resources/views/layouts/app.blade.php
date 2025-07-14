<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AI Traffic Management | @yield('title', 'Kosovo')</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #0d6efd;
            --gray-light: #f8f9fa;
            --gray-dark: #212529;
        }

        body {
            background-color: var(--gray-light);
            font-family: 'Inter', sans-serif;
            color: var(--gray-dark);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #e0e0e0;
        }

        .navbar-brand {
            color: var(--primary);
            font-weight: 600;
            font-size: 1.25rem;
        }

        .navbar-nav .nav-link {
            color: #555 !important;
            transition: color 0.2s;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary) !important;
        }

        main {
            padding-top: 30px;
            flex-grow: 1;
        }

        footer {
            background-color: #f1f3f5;
            color: #6c757d;
            padding: 25px 0;
            border-top: 1px solid #dee2e6;
            font-size: 0.9rem;
            text-align: center;
            margin-top: auto;
        }

        footer a {
            color: var(--primary);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .search-form {
            max-width: 400px;
            margin: 0 auto 20px;
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">🚦 AI Traffic KS</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">


                    @auth

                        <li class="nav-item">
                            <span class="nav-link">👋 {{ auth()->user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">🔒 Dil</button>
                            </form>
                        </li>

                    @endauth

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

    <!-- SEARCH FORM -->
    <div class="container search-form">
        <form action="{{ route('posts.search') }}" method="GET" class="d-flex" role="search">
            <input class="form-control me-2" type="search" name="query" placeholder="Kërko ndër postimet..."
                value="{{ request('query') }}">
            <button class="btn btn-outline-primary" type="submit">Kërko</button>
        </form>
    </div>

    <!-- MAIN CONTENT -->
    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            © {{ date('Y') }} AI Traffic KS • Të gjitha të drejtat e rezervuara.
        </div>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>