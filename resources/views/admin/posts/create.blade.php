@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2>Shto Postim si Admin</h2>
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titulli</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Përshkrimi</label>
                <textarea name="description" rows="5" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">📤 Publiko</button>
        </form>
    </div>
@endsection