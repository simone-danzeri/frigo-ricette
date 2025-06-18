@extends('layouts.app')

@section('title', 'Ingredienti')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="display-6 fw-semibold">Gestione Ingredienti</h1>
        <a href="{{ route('ingredients.create') }}" class="btn btn-dark px-4 py-2 rounded-pill shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Nuovo Ingrediente
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success rounded-pill px-4 py-2 fw-medium">
            {{ session('success') }}
        </div>
    @endif

    @if ($ingredients->isEmpty())
        <div class="text-center py-5">
            <h4 class="text-muted">😕 Nessun ingrediente trovato</h4>
            <p class="text-secondary">Inizia aggiungendo un nuovo ingrediente.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-borderless align-middle shadow-sm rounded bg-white">
                <thead class="border-bottom">
                    <tr class="text-secondary text-uppercase small">
                        <th>Nome</th>
                        <th>Disponibilità</th>
                        <th>Quantità</th>
                        <th class="text-end">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredients as $ingredient)
                        <tr class="border-bottom">
                            <td class="fw-medium fs-6">
                                <a class="text-dark text-decoration-none" href="{{route('ingredients.show', $ingredient->slug)}}">
                                    <span class="font-weight-bolder">
                                        {{ $ingredient->name }}
                                    </span>
                                </a>
                            </td>
                            <td>
                                @if ($ingredient->is_available)
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                        Disponibile
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">
                                        Non disponibile
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="text-muted">{{ $ingredient->quantity }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('ingredients.edit', $ingredient->slug) }}"
                                   class="btn btn-outline-dark btn-sm rounded-pill me-2">
                                    ✏️ Modifica
                                </a>
                                <form action="{{ route('ingredients.destroy', $ingredient->slug) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Sei sicuro di voler eliminare questo ingrediente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-pill">🗑️ Elimina</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
