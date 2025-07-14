@extends('layouts.app')
<br>
@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h2 class="fw-bold">📋 Postimet e Mia</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-lg shadow-sm">
                <i class="bi bi-plus-circle"></i> Shto Postim
            </a>
        </div>

        {{-- Kartela për statistika --}}
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card text-center border-0 shadow-sm rounded-4 bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Numri i Postimeve</h5>
                        <p class="display-4 text-primary fw-bold mb-0">{{ $posts->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('posts.index') }}" class="btn btn-outline-primary btn-lg mb-4 shadow-sm">
            📋 Shfaq të Gjitha Postimet
        </a>

        {{-- Tabela me postimet --}}
        @if($posts->count())
            <div class="table-responsive bg-white rounded-4 shadow-sm p-4 mb-5">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Titulli</th>
                            <th>Përmbajtja</th>
                            <th class="text-center" style="width: 140px;">Veprime</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td class="fw-semibold">{{ $post->title }}</td>
                                <td>{{ Str::limit($post->description, 100) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-warning me-2"
                                        title="Edito">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- Modal Fshirje -->
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $post->id }}" title="Fshij">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel{{ $post->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $post->id }}">
                                                        Konfirmo Fshirjen
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                        aria-label="Mbyll"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Je i sigurt që dëshiron të fshish postimin
                                                    <strong>"{{ $post->title }}"</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Anulo</button>
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Po, Fshi</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center rounded-3 shadow-sm p-4">
                Nuk ke postuar ende asgjë.
                <a href="{{ route('posts.create') }}" class="fw-bold">Shto postimin tënd të parë këtu!</a>
            </div>
        @endif

        <livewire:chat-bot />


    </div>
@endsection