@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>📢 Menaxho Njoftimet dhe Postimet</h2>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-plus-circle"></i> Shto Njoftim si Admin
            </a>
        </div>

        {{-- Search bar --}}
        <form action="{{ route('admin.posts.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="🔍 Kërko në titujt e postimeve..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Kërko</button>
            </div>
        </form>

        @if($posts->count())
            <div class="list-group">
                @foreach($posts as $post)
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                        <div>
                            <h5>{{ $post->title }}</h5>
                            <p class="mb-1 text-muted">Nga: {{ $post->user->name }} | {{ $post->created_at->format('d M Y, H:i') }}
                            </p>
                            <p>{{ Str::limit($post->content, 100) }}</p>
                        </div>
                        <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('A jeni i sigurt që doni ta fshini këtë postim?')">
                                🗑️ Fshi
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info mt-4">Nuk ka postime për t'u shfaqur.</div>
        @endif
    </div>
@endsection