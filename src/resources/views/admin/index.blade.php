<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Demandes</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #243782;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        .container {
            padding: 20px;
        }
        .filter-section {
            margin-bottom: 20px;
        }
        .filter-section input, .filter-section select {
            padding: 10px;
            margin-right: 10px;
        }
        .widget {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .widget h3 {
            margin-top: 0;
        }
        .details {
            display: none;
        }
        .show-details {
            color: #243782;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-brand">
            <a href="#">Admin Panel</a>
        </div>
        <div class="navbar-links">
            <a href="#">Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="filter-section">
            <form action="{{ url('/admin/demandes') }}" method="GET">
                <input type="text" name="search" placeholder="Search...">
                <select name="type">
                    <option value="">All Types</option>
                    <option value="codification">Codification</option>
                    <option value="traitement">Traitement</option>
                    <option value="chargement">Chargement</option>
                    <option value="fiches">Fiches</option>
                    <option value="nbe">N BE</option>
                </select>
                <button type="submit">Filter</button>
            </form>
        </div>

        @foreach ($demandes as $demande)
            <div class="widget">
                <h3>{{ $demande->nom }} {{ $demande->prenom }}</h3>
                <p>Type: {{ $demande->type }}</p>
                <p>Site: {{ $demande->site }}</p>
                <p class="details">ID: {{ $demande->id }}</p>
                <p class="details">Project: {{ $demande->nomProjet }}</p>
                <span class="show-details">Show Details</span>
            </div>
        @endforeach

        {{ $demandes->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const showDetailsButtons = document.querySelectorAll('.show-details');
            showDetailsButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const details = this.previousElementSibling;
                    details.style.display = details.style.display === 'none' ? 'block' : 'none';
                    this.textContent = details.style.display === 'none' ? 'Show Details' : 'Hide Details';
                });
            });
        });
    </script>
</body>
</html>