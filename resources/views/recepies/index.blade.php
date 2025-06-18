@extends('layouts.app')

@section('title', 'Tutte le ricette')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-6 fw-bold text-dark">🍽️ Tutte le Ricette</h1>
        <a href="{{ route('recepies.create') }}" class="btn btn-dark rounded-pill px-4 py-2">
            ➕ Nuova Ricetta
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    @endif

    <div class="table-responsive shadow rounded-4">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">#</th>
                    <th>Nome</th>
                    <th>Procedimento</th>
                    <th class="text-end pe-4">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recepies as $recepie)
                    <tr>
                        <td class="ps-4">{{ $loop->iteration }}</td>
                        <td>{{ $recepie->name }}</td>
                        <td style="max-width: 400px;">
                            <small class="text-muted">
                                {{ Str::limit($recepie->process, 150) }}
                            </small>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('recepies.edit', $recepie->slug) }}" class="btn btn-outline-dark btn-sm rounded-pill mx-2">
                                ✏️ Modifica
                            </a>
                            <form action="{{ route('recepies.destroy', $recepie->slug) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Sei sicuro di voler eliminare questa ricetta?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded-pill mx-2">
                                    🗑️ Elimina
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            Nessuna ricetta trovata.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
