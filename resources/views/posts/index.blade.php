@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="mb-4">📝 Postimet e Përdoruesve</h2>

        {{-- Lista e shpejtë e postimeve --}}
        @if($posts->count())
            <ul class="list-group mb-4">
                @foreach($posts as $post)
                    <li class="list-group-item">
                        <strong>{{ $post->title }}</strong> nga
                        <em>{{ $post->user->name ?? 'Përdorues i fshirë' }}</em><br>
                        {{ $post->description }}<br>
                        <small class="text-muted">{{ $post->created_at->format('d.m.Y H:i') }}</small>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-warning">Asnjë postim nuk është gjetur.</div>
        @endif

        {{-- Buton për shtim --}}
        <div class="mb-4">
            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Shto Postim
            </a>
        </div>

        {{-- Tabela e postimeve --}}
        @if($posts->count())
            <div class="table-responsive mb-5">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Titulli</th>
                            <th>Përmbajtja</th>
                            <th class="text-center">Veprime</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ Str::limit($post->content, 100) }}</td>
                                <td class="text-center">
                                    @if(auth()->check() && (auth()->id() === $post->user_id || auth()->user()->role === 'admin'))
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-warning me-1"
                                            title="Edito">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $post->id }}" title="Fshij">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        @include('posts.partials.delete-modal', ['post' => $post])
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Nuk ka postime për t’u shfaqur.</p>
        @endif

        {{-- Seksioni i Sugjerimeve AI --}}
        <div class="card shadow-sm rounded-3 bg-white p-4 mb-5">
            <h4 class="mb-3">🤖 Sugjerimet nga AI</h4>
            <p class="text-muted">Shkruaj pyetjen tënde dhe merr përgjigje inteligjente për trafikun, tematika etj.</p>

            <form method="POST" action="{{ route('ai.suggestions.submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="ai_question" class="form-label">Pyetja juaj</label>
                    <textarea class="form-control @error('ai_question') is-invalid @enderror" id="ai_question"
                        name="ai_question" rows="3" required>{{ old('ai_question') }}</textarea>
                    @error('ai_question')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-send"></i> Dërgo Pyetjen
                </button>
            </form>

            @if(session('ai_response'))
                <hr>
                <h5 class="mt-4">🚀 Përgjigjja e AI-së:</h5>
                <div class="alert alert-secondary mt-2" style="white-space: pre-wrap;">
                    {{ session('ai_response') }}
                </div>
            @endif
        </div>

        {{-- Kthim në dashboard --}}
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kthehu në Dashboard
        </a>
    </div>
@endsection