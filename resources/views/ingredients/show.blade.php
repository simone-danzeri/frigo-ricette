@extends('layouts.app')

@section('title', 'Dettagli Ingrediente')

@section('content')
    <div class="mb-4">
        <a href="{{ route('ingredients.index') }}" class="text-decoration-none text-muted">
            ← Torna alla lista
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="card-body">
            <h2 class="card-title display-6 fw-semibold mb-4">
                {{ $ingredient->name }}
            </h2>

            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    <span class="text-secondary">Disponibilità</span>
                    <span class="fw-medium">
                        @if($ingredient->is_available)
                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                Disponibile
                            </span>
                        @else
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">
                                Non disponibile
                            </span>
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span class="text-secondary">Quantità</span>
                    <span class="fw-medium">{{ $ingredient->quantity }}</span>
                </li>
            </ul>

            <div class="mt-4 d-flex justify-content-end">
                <a href="{{ route('ingredients.edit', $ingredient->id) }}"
                   class="btn btn-outline-dark rounded-pill me-2">
                    ✏️ Modifica
                </a>
                <form action="{{ route('ingredients.destroy', $ingredient->id) }}"
                      method="POST"
                      onsubmit="return confirm('Sei sicuro di voler eliminare questo ingrediente?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger rounded-pill">
                        🗑️ Elimina
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
