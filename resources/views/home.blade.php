@extends('layouts.app')

@section('title', 'Benvenuto nel tuo Frigo Smart 🧊')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-semibold">🍏 Frigo Smart</h1>
        <p class="lead text-muted">Organizza i tuoi ingredienti. Crea ricette. Evita sprechi.</p>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <a href="{{ route('ingredients.index') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm border-0 h-100 hover-lift">
                    <div class="card-body text-center py-5">
                        <h2 class="h4 fw-bold mb-3">🧺 Ingredienti</h2>
                        <p class="text-muted">Gestisci tutti gli ingredienti presenti nel tuo frigo, aggiorna disponibilità e quantità.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('recepies.index') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm border-0 h-100 hover-lift">
                    <div class="card-body text-center py-5">
                        <h2 class="h4 fw-bold mb-3">👩‍🍳 Ricette</h2>
                        <p class="text-muted">Consulta e modifica le ricette create, scopri cosa puoi cucinare con ciò che hai.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('groceries.index')}}" class="text-decoration-none text-dark">
                <div class="card shadow-sm border-0 h-100 hover-lift">
                    <div class="card-body text-center py-5">
                        <h2 class="h4 fw-bold mb-3">🛒 Lista Spesa</h2>
                        <p class="text-muted">Visualizza automaticamente cosa manca e genera la tua lista della spesa.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15);
    }
</style>
@endpush
