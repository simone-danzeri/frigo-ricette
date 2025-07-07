@extends('layouts.app')

@section('title', 'Lista della Spesa')

@section('content')
    <div class="bg-light rounded-4 shadow-sm p-5 mb-4">
        <h1 class="display-6 fw-semibold text-center text-success mb-4">🛒 Lista della Spesa</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($groceries->isEmpty())
            <div class="text-center text-muted fs-5">Nessun ingrediente da comprare! 🎉</div>
        @else
            <ul class="list-group list-group-flush">
                @foreach($groceries as $ingredient)
                    <li class="list-group-item d-flex justify-content-between align-items-center px-3">
                        <span class="fs-5">{{ $ingredient->name }}</span>

                        <form action="{{ route('groceries.bought', $ingredient) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                ✅ Comprato
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="mt-4 text-center">
            <a href="{{ route('recepies.index') }}" class="btn btn-outline-secondary">🔙 Torna alle Ricette</a>
        </div>
    </div>
@endsection
