@extends('layouts.app')

@section('title', 'Modifica Ricetta')

@section('content')
    <div class="bg-light rounded-4 shadow-sm p-5 mb-4">
        <h1 class="display-6 mb-4 fw-semibold text-center text-primary">Modifica Ricetta 🍽️</h1>

        <form action="{{ route('recepies.update', $recepie) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nome --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome Ricetta</label>
                <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name', $recepie->name) }}" required>
            </div>

            {{-- Process --}}
            <div class="mb-3">
                <label for="process" class="form-label">Procedimento</label>
                <textarea name="process" class="form-control" rows="5" required>{{ old('process', $recepie->process) }}</textarea>
            </div>

            {{-- Ingredienti --}}
            <div class="mb-3">
                <label for="ingredient-search" class="form-label">Ingredienti</label>
                <div class="position-relative">
                    <input type="text" id="ingredient-search" class="form-control mb-2" placeholder="Cerca ingrediente...">
                    <ul class="list-group position-absolute w-100 shadow z-3" id="ingredient-suggestions" style="top: 100%;"></ul>
                </div>

                {{-- Lista pill degli ingredienti selezionati --}}
                <div id="selected-ingredients" class="mb-3">
                    @foreach($recepie->ingredients as $ingredient)
                        <span class="badge rounded-pill text-bg-primary me-1 mb-1 d-inline-flex align-items-center">
                            {{ $ingredient->name }}
                            <button type="button" class="btn-close btn-close-white btn-sm ms-2 remove-ingredient" aria-label="Remove" data-id="{{ $ingredient->id }}"></button>
                        </span>
                        <input type="hidden" name="ingredient_ids[]" value="{{ $ingredient->id }}">
                    @endforeach
                </div>

                {{-- Messaggio ingrediente non trovato --}}
                <div id="ingredient-not-found" class="text-danger small d-none">
                    Ingrediente inesistente.
                </div>
            </div>

            {{-- Pulsanti --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('recepies.index') }}" class="btn btn-outline-secondary">🔙 Indietro</a>
                <button type="submit" class="btn btn-primary btn-lg">💾 Salva Modifiche</button>
            </div>
        </form>
    </div>
{{-- Script per ricerca ingredienti --}}
<script>
    const searchInput = document.getElementById('ingredient-search');
    const suggestionsList = document.getElementById('ingredient-suggestions');
    const selectedContainer = document.getElementById('selected-ingredients');
    const notFoundMsg = document.getElementById('ingredient-not-found');

    const allIngredients = @json($allIngredients); // tutti gli ingredienti disponibili

    function addIngredient(ingredient) {
        if ([...document.querySelectorAll('input[name="ingredient_ids[]"]')].some(el => el.value == ingredient.id)) return;

        const span = document.createElement('span');
        span.className = 'badge rounded-pill text-bg-primary me-1 mb-1 d-inline-flex align-items-center';
        span.innerHTML = `
            ${ingredient.name}
            <button type="button" class="btn-close btn-close-white btn-sm ms-2 remove-ingredient" aria-label="Remove" data-id="${ingredient.id}"></button>
        `;

        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'ingredient_ids[]';
        hidden.value = ingredient.id;

        selectedContainer.appendChild(span);
        selectedContainer.appendChild(hidden);
        searchInput.value = '';
        suggestionsList.innerHTML = '';
        notFoundMsg.classList.add('d-none');
    }

    searchInput.addEventListener('input', () => {
        const query = searchInput.value.trim().toLowerCase();
        suggestionsList.innerHTML = '';

        if (query.length < 2) return;

        const matches = allIngredients.filter(i =>
            i.name.toLowerCase().includes(query)
        );

        if (matches.length === 0) {
            notFoundMsg.classList.remove('d-none');
            return;
        }

        notFoundMsg.classList.add('d-none');

        matches.forEach(match => {
            const li = document.createElement('li');
            li.className = 'list-group-item list-group-item-action';
            li.textContent = match.name;
            li.dataset.id = match.id;
            suggestionsList.appendChild(li);
        });
    });

    // Click su un suggerimento
    suggestionsList.addEventListener('click', e => {
        if (e.target.tagName === 'LI') {
            const id = e.target.dataset.id;
            const name = e.target.textContent;
            addIngredient({ id, name });
        }
    });

    // Premi invio per selezionare match esatto
    searchInput.addEventListener('keydown', e => {
        if (e.key === 'Enter') {
            e.preventDefault();
            const query = searchInput.value.trim().toLowerCase();
            const match = allIngredients.find(i => i.name.toLowerCase() === query);
            if (match) {
                addIngredient(match);
            } else {
                notFoundMsg.classList.remove('d-none');
            }
        }
    });

    // Rimuovi ingrediente selezionato
    selectedContainer.addEventListener('click', e => {
        if (e.target.classList.contains('remove-ingredient')) {
            const id = e.target.dataset.id;
            e.target.closest('span').remove();
            [...document.querySelectorAll(`input[name="ingredient_ids[]"][value="${id}"]`)].forEach(i => i.remove());
        }
    });

    // Chiudi dropdown se clicchi fuori
    document.addEventListener('click', e => {
        if (!searchInput.contains(e.target) && !suggestionsList.contains(e.target)) {
            suggestionsList.innerHTML = '';
        }
    });
</script>


@endsection
