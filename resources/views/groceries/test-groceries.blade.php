<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Test Lista Spesa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Ingredienti da comprare</h1>
    <ul id="grocery-list">
        <li>Caricamento...</li>
    </ul>

    <script>
        async function loadGroceries() {
            const res = await fetch('/api/groceries');
            const data = await res.json();
            const ul = document.getElementById('grocery-list');
            ul.innerHTML = '';
            if (data.length === 0) {
                ul.innerHTML = '<li>Nessun ingrediente nella lista della spesa.</li>';
            } else {
                data.forEach(ingredient => {
                    const li = document.createElement('li');
                    li.innerHTML = `${ingredient.name}
                        <button onclick="markAsBought(${ingredient.id}, this)">Comprato</button>`;
                    ul.appendChild(li);
                });
            }
        }

        async function markAsBought(ingredientId, btn) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const res = await fetch(`/grocery/${ingredientId}/bought`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                }
            });
            if (res.ok) {
                btn.parentElement.remove(); // rimuove la voce dalla lista
            }
        }

        loadGroceries();
    </script>
</body>
</html>
