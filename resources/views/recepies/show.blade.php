@extends('layouts.app')

@section('title', $recepie->name)

@section('content')
<div class="bg-light p-5 rounded-4 shadow-sm border position-relative">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h1 class="display-5 fw-semibold mb-1">{{ $recepie->name }}</h1>
        </div>
        <div>
            <form action="{{ route('groceries.generate', $recepie) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-lg btn-outline-success">
                    🍳 Cucina questo piatto
                </button>
            </form>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('recepies.edit', $recepie) }}" class="btn btn-outline-primary">
                ✏️ Modifica
            </a>
            <form action="{{ route('recepies.destroy', $recepie) }}" method="POST" onsubmit="return confirm('Sicuro di voler eliminare questa ricetta?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger">🗑️ Elimina</button>
            </form>
        </div>
    </div>

    <div class="mb-4">
        <h5 class="text-uppercase text-secondary fw-bold">Procedimento</h5>
        <p class="lead mt-2" style="white-space: pre-line;">{{ $recepie->process }}</p>
    </div>

    <div>
        <h5 class="text-uppercase text-secondary fw-bold">Ingredienti</h5>
        @if ($recepie->ingredients->count())
            <div class="d-flex flex-wrap gap-2 mt-2">
                @foreach ($recepie->ingredients as $ingredient)
                    <span class="badge rounded-pill bg-dark px-3 py-2">
                        {{ $ingredient->name }}
                    </span>
                @endforeach
            </div>
        @else
            <p class="fst-italic text-muted mt-2">Nessun ingrediente associato.</p>
        @endif
    </div>
</div>

<div class="mt-4 text-center">
    <a href="{{ route('recepies.index') }}" class="btn btn-secondary">
        ⬅️ Torna alla lista ricette
    </a>
</div>
@endsection
