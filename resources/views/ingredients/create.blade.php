@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-12">
    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
        <h1 class="text-3xl font-semibold text-gray-800 my-5 text-center">Nuovo Ingrediente</h1>

        <form method="POST" action="{{ route('ingredients.store') }}" class="space-y-6">
            @csrf

            <!-- Nome -->
            <div class="d-flex justify-content-center align-items-center">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1 mx-3">Nome</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Es. Pomodori Secchi"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-800"
                    required
                    oninput="generateSlug(this.value)"
                >
            </div>
            <!-- Bottone -->
            <div class="pt-4 d-flex justify-content-center">
                <button
                    type="submit"
                    class="btn btn-dark px-4 py-2 rounded-pill shadow-sm my-5"
                >
                    Salva Ingrediente
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function generateSlug(value) {
        const slug = value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        document.getElementById('slug').value = slug;
    }
</script>
@endsection
