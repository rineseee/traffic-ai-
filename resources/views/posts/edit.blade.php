@extends('layouts.app')

@section('content')
    <div class="container py-4" style="max-width: 700px;">
        <h2>✏️ Edito Postimin</h2>

        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titulli</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $post->title) }}" required maxlength="255" autofocus>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Përmbajtja</label>
                <textarea name="content" id="content" rows="6" class="form-control @error('content') is-invalid @enderror"
                    required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Ruaj Ndryshimet</button>
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary ms-2">Anulo</a>
        </form>
    </div>
@endsection