@extends('layouts.app')

@section('content')
    <div class="container py-4">
        {{-- Titulli dhe butoni për shtim --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>📋 Postimet e Mia</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-lg"></i> Shto Postim
            </a>
        </div>

        {{-- Link për të shfaqur të gjitha postimet (p.sh., admini) --}}
        <a href="{{ route('posts.index') }}" class="btn btn-outline-primary btn-lg mb-4">
            📋 Shfaq të Gjitha Postimet
        </a>

        {{-- Mesazhet e suksesit ose gabimeve --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif


        {{-- Sugjerimet nga AI --}}
        {{-- Sugjerimet nga AI --}}
        <livewire:chat-bot />
    </div>
@endsection