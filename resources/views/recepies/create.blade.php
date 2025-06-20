@extends('layouts.app')

@section('title', 'Nuova Ricetta')

@section('content')
    <div class="bg-white p-5 rounded shadow-sm">
        <h1 class="mb-4 display-6">🍝 Crea una nuova ricetta</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('recepies.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nome ricetta</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="process" class="form-label fw-semibold">Procedimento</label>
                <textarea class="form-control" id="process" name="process" rows="6" required>{{ old('process') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Ingredienti</label>

                {{-- Pills --}}
                <div class="mb-3 d-flex flex-wrap gap-2" id="ingredient-pills">
                    {{-- dinamico via JS --}}
                </div>

                {{-- Search Input --}}
                <input type="text" class="form-control" id="ingredient-search" placeholder="Cerca un ingrediente...">
                <div class="form-text">Premi Invio per aggiungere. Gli ingredienti devono esistere.</div>

                <div class="text-danger mt-2 d-none" id="ingredient-error">Ingrediente non trovato.</div>
            </div>

            <button type="submit" class="btn btn-dark px-4">➕ Crea Ricetta</button>
            <a href="{{ route('recepies.index') }}" class="btn btn-outline-secondary ms-2">← Annulla</a>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    const ingredients = @json($allIngredients);
    const pillsContainer = document.getElementById('ingredient-pills');
    const searchInput = document.getElementById('ingredient-search');
    const errorDiv = document.getElementById('ingredient-error');

    searchInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const term = searchInput.value.trim().toLowerCase();
            const found = ingredients.find(i => i.name.toLowerCase() === term);
            if (!found) {
                errorDiv.classList.remove('d-none');
                return;
            }
            errorDiv.classList.add('d-none');

            if (document.querySelector(`input[value="${found.id}"]`)) {
                searchInput.value = '';
                return;
            }

            const pill = document.createElement('span');
            pill.className = 'badge bg-primary rounded-pill me-2 mb-2';
            pill.innerHTML = `${found.name}
                <button type="button" class="btn-close btn-close-white btn-sm ms-2 remove-pill" data-id="${found.id}"></button>
                <input type="hidden" name="ingredient_ids[]" value="${found.id}">`;
            pillsContainer.appendChild(pill);
            searchInput.value = '';
        }
    });

    pillsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-pill')) {
            e.target.closest('span').remove();
        }
    });
</script>
@endsection
