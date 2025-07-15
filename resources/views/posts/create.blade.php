@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 700px;">
    <h2>➕ Shto Raport Trafiku të Ri</h2>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titulli i Raportit</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}" required maxlength="255" autofocus>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="traffic_type" class="form-label">Lloji i Bllokimit</label>
            <select name="traffic_type" id="traffic_type" class="form-select @error('traffic_type') is-invalid @enderror" required>
                <option value="" disabled selected>Zgjidh llojin</option>
                <option value="Aksident" {{ old('traffic_type') == 'Aksident' ? 'selected' : '' }}>Aksident</option>
                <option value="Ndërtim" {{ old('traffic_type') == 'Ndërtim' ? 'selected' : '' }}>Ndërtim</option>
                <option value="Ngarkesë" {{ old('traffic_type') == 'Ngarkesë' ? 'selected' : '' }}>Ngarkesë</option>
                <option value="Mbyllje rruge" {{ old('traffic_type') == 'Mbyllje rruge' ? 'selected' : '' }}>Mbyllje rruge</option>
            </select>
            @error('traffic_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lokacioni</label>
            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror"
                value="{{ old('location') }}" required>
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="datetime" class="form-label">Data dhe Ora</label>
            <input type="datetime-local" name="datetime" id="datetime" class="form-control @error('datetime') is-invalid @enderror"
                value="{{ old('datetime') }}" required>
            @error('datetime')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Përshkrimi i Detajuar</label>
            <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror"
                required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Prioriteti</label>
            <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror" required>
                <option value="" disabled selected>Zgjidh prioritetin</option>
                <option value="Normal" {{ old('priority') == 'Normal' ? 'selected' : '' }}>Normal</option>
                <option value="Urgjent" {{ old('priority') == 'Urgjent' ? 'selected' : '' }}>Urgjent</option>
            </select>
            @error('priority')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Ruaj Raportin</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary ms-2">Anulo</a>
    </form>
</div>
@endsection
