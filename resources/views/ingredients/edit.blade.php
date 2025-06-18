@extends('layouts.app')

@section('title', 'Modifica ingrediente')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-5">
                    <h1 class="h3 mb-5 text-center fw-semibold">✏️ Modifica ingrediente</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('ingredients.update', $ingredient->id) }}" method="POST" class="vstack gap-4">
                        @csrf
                        @method('PUT')

                        <div class="form-floating">
                            <input type="text" name="name" id="name" value="{{ old('name', $ingredient->name) }}"
                                class="form-control rounded-3 @error('name') is-invalid @enderror" placeholder="Nome ingrediente" required>
                            <label for="name">Nome ingrediente</label>
                        </div>

                        <div class="form-floating">
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $ingredient->quantity) }}"
                                class="form-control rounded-3 @error('quantity') is-invalid @enderror" placeholder="Quantità">
                            <label for="quantity">Quantità</label>
                        </div>

                        <div class="form-check form-switch d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" role="switch" id="is_available" name="is_available"
                                {{ old('is_available', $ingredient->is_available) ? 'checked' : '' }}>
                            <label class="form-check-label ms-1" for="is_available">Disponibile</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-3">
                            <a href="{{ route('ingredients.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                ← Annulla
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                💾 Salva modifiche
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
