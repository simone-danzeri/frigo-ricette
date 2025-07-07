@extends('layouts.app')

@section('title', 'Nuova Ricetta')

@section('content')
    <div class="bg-light rounded-4 shadow-sm p-5 mb-4">
        <h1 class="display-6 mb-4 fw-semibold text-center text-primary">Crea una Nuova Ricetta ✨</h1>

        <form action="{{ route('recepies.store') }}" method="POST">
            @csrf

            {{-- Nome --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome Ricetta</label>
                <input type="text" name="name" id="name" class="form-control form-control-lg" required>
            </div>

            {{-- Process --}}
            <div class="mb-3">
                <label for="process" class="form-label">Procedimento</label>
                <textarea name="process" id="process" class="form-control" rows="5" required></textarea>
            </div>

            {{-- Ingredienti --}}
            <div class="mb-3">
                <label for="ingredient-search" class="form-label">Ingredienti</label>
                <div class="position-relative">
                    <input type="text" id="ingredient-search" class="form-control mb-2" placeholder="Cerca ingrediente...">
                    <div id="suggestions" class="list-group position-absolute w-100 z-3 d-none" style="top: 100%;"></div>
                </div>


                <div id="selected-ingredients" class="mb-3"></div>

                <div id="ingredient-not-found" class="text-danger small d-none">
                    Ingrediente inesistente.
                </div>
            </div>

            {{-- Pulsanti --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('recepies.index') }}" class="btn btn-outline-secondary">🔙 Indietro</a>
                <button type="submit" class="btn btn-success btn-lg">🍳 Crea Ricetta</button>
            </div>
        </form>
    </div>

    {{-- Script --}}
    <script>
    const searchInput = document.getElementById('ingredient-search');
    const selectedContainer = document.getElementById('selected-ingredients');
    const notFoundMsg = document.getElementById('ingredient-not-found');
    const suggestionsBox = document.getElementById('suggestions');

    const allIngredients = @json($ingredients);

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
        notFoundMsg.classList.add('d-none');
        suggestionsBox.classList.add('d-none');
        suggestionsBox.innerHTML = '';
    }

    searchInput.addEventListener('input', () => {
        const query = searchInput.value.trim().toLowerCase();
        suggestionsBox.innerHTML = '';

        if (query.length < 1) {
            suggestionsBox.classList.add('d-none');
            return;
        }

        const filtered = allIngredients.filter(i =>
            i.name.toLowerCase().includes(query)
        );

        if (filtered.length === 0) {
            suggestionsBox.classList.add('d-none');
            notFoundMsg.classList.remove('d-none');
            return;
        }

        notFoundMsg.classList.add('d-none');
        suggestionsBox.classList.remove('d-none');

        filtered.forEach(ingredient => {
            const item = document.createElement('button');
            item.type = 'button';
            item.className = 'list-group-item list-group-item-action';
            item.textContent = ingredient.name;
            item.addEventListener('click', () => addIngredient(ingredient));
            suggestionsBox.appendChild(item);
        });
    });

    searchInput.addEventListener('keydown', e => {
        if (e.key === 'Enter') {
            e.preventDefault();
            const query = searchInput.value.trim().toLowerCase();
            const match = allIngredients.find(i => i.name.toLowerCase() === query);
            if (match) addIngredient(match);
            else notFoundMsg.classList.remove('d-none');
        }
    });

    selectedContainer.addEventListener('click', e => {
        if (e.target.classList.contains('remove-ingredient')) {
            const id = e.target.dataset.id;
            e.target.closest('span').remove();
            [...document.querySelectorAll(`input[name="ingredient_ids[]"][value="${id}"]`)].forEach(i => i.remove());
        }
    });

    document.addEventListener('click', e => {
        if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.classList.add('d-none');
        }
    });
</script>


@endsection
