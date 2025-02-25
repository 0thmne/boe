<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Pilote - Stellantis</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #243782;
            --secondary-color: #1d2d6f;
            --background-color: #f5f7fa;
            --border-color: #e1e4e8;
            --text-color: #24292e;
            --hover-color: #f6f8fa;
            --success-color: #28a745;
            --warning-color: #ffd700;
            --danger-color: #dc3545;
            --info-color: #17a2b8;

            /* Statut colors */
            --nouveau-color: #1976d2;
            /* Bleu */
            --encours-color: #f57c00;
            /* Orange */
            --termine-color: #2e7d32;
            /* Vert */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            padding: 20px;
        }

        /* Header Styles */
        .header {
            background-color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Dashboard Stats */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin: 2rem 0;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        /* Filter Section */
        .filter-section {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .filter-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .filter-dropdown {
            padding: 0.5rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            min-width: 200px;
        }

        /* Card Grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .card-new {
            border-left: 4px solid var(--nouveau-color);
        }

        .card-progress {
            border-left: 4px solid var(--encours-color);
        }

        .card-completed {
            border-left: 4px solid var(--termine-color);
        }

        .card-header {
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f1f1f1;
        }

        .client {
            display: flex;
            align-items: center;
        }

        .client-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: white;
        }

        .personne-name {
            font-weight: 600;
            font-size: 15px;
        }

        .request-id {
            font-size: 13px;
            color: #7f8c8d;
            margin-top: 2px;
        }

        .card-body {
            padding: 16px;
            display: flex;
            justify-content: space-between;
        }

        .request-details h3 {
            font-size: 14px;
            font-weight: 500;
            color: #7f8c8d;
            margin-bottom: 8px;
        }

        .detail {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .detail-icon {
            margin-right: 8px;
            opacity: 0.6;
        }

        .status-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-nouveau {
            background-color: var(--nouveau-color);
            color: white;
        }

        .status-en-cours {
            background-color: var(--encours-color);
            color: white;
        }

        .status-terminé {
            background-color: var(--termine-color);
            color: white;
        }

        .card-footer {
            padding: 12px 16px;
            background-color: #f9fafb;
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #f1f1f1;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            color: #7f8c8d;
            display: flex;
            align-items: center;
        }

        .action-btn:hover {
            color: var(--primary-color);
        }

        .action-btn i {
            margin-right: 4px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            padding: 1rem;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .page-button {
            padding: 0.5rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            background: white;
            cursor: pointer;
        }

        .page-button.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
    </style>

</head>

<body>
    <header class="header">
        <div class="logo">
            <i class="fas fa-tasks"></i> Stellantis Pilote
        </div>
        <div class="user-profile">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <span>Admin</span>
        </div>
    </header>

    <div class="container">
        <!-- Status -->
        <div class="stats-container">
            <div class="stat-card">
                <h3>Nouveau</h3>
                <div class="stat-value" style="color: var(--nouveau-color);">{{ $formData->where('status', 'Nouveau')->count() }}</div>
            </div>
            <div class="stat-card">
                <h3>En Cours</h3>
                <div class="stat-value" style="color: var(--encours-color);">{{ $formData->where('status', 'En Cours')->count() }}</div>
            </div>
            <div class="stat-card">
                <h3>Terminé</h3>
                <div class="stat-value" style="color: var(--termine-color);">{{ $formData->where('status', 'Terminé')->count() }}</div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <h2 class="filter-title">Demandes en cours</h2>
            <select class="filter-dropdown" onchange="handleFilterChange(this)">
                <option value="" {{ request('filter') === '' ? 'selected' : '' }}>Tous les Demandes</option>
                <option value="Codification" {{ request('filter') === 'Codification' ? 'selected' : '' }}>Codification</option>
                <option value="Traitement Nomenclature" {{ request('filter') === 'Traitement Nomenclature' ? 'selected' : '' }}>Traitement Nomenclature</option>
                <option value="Fiche d'emboutissage" {{ request('filter') === 'Fiche d\'emboutissage' ? 'selected' : '' }}>Fiche d'emboutissage</option>
                <option value="Creation Numero de bien d'equipement" {{ request('filter') === 'Creation Numero de bien d\'equipement' ? 'selected' : '' }}>Creation Numero de bien d'equipement</option>
                <option value="Chargement Nomenclature" {{ request('filter') === 'Chargement Nomenclature' ? 'selected' : '' }}>Chargement Nomenclature</option>
            </select>
        </div>

        <!-- Card Grid -->
        <div class="grid">
            @foreach ($formData as $demand)
            @if (!request('filter') || $demand->type === request('filter'))
            <div class="card card-{{ strtolower(str_replace(' ', '-', $demand->status)) }}">
                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $demand->status)) }}">{{ $demand->status }}</span>
                <div class="card-header">
                    <div class="client">
                        <div class="client-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <div class="personne-name">{{ $demand->nom }} {{ $demand->prenom }}</div>
                            <div class="request-id">#{{ $demand->id }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="request-details">
                        <h3>Détails</h3>
                        <div class="detail">
                            <span class="detail-icon">
                                <i class="fas fa-tag"></i>
                            </span>
                            {{ $demand->type }}
                        </div>
                        <div class="detail">
                            <span class="detail-icon">
                                <i class="fas fa-calendar"></i>
                            </span>
                            Créé le: {{ $demand->created_at->format('d/m/Y') }}
                        </div>
                        @if ($demand->status === 'Terminé')
                        <div class="detail">
                            <span class="detail-icon">
                                <i class="fas fa-check"></i>
                            </span>
                            Complété le: {{ $demand->updated_at->format('d/m/Y') }}
                        </div>
                        @else
                        <div class="detail">
                            <span class="detail-icon">
                                <i class="fas fa-clock"></i>
                            </span>
                            Échéance: {{ $demand->dateech }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button class="action-btn">
                        <i class="fas fa-eye"></i>
                        Voir
                    </button>
                    @if ($demand->status == 'Nouveau' || $demand->status == 'En Cours')
                    <button class="action-btn">
                        <i class="fas fa-edit"></i>
                        Modifier
                    </button>
                    @elseif ($demand->status == 'Terminé')
                    <button class="action-btn">
                        <i class="fas fa-archive"></i>
                        Livrai
                    </button>
                    @endif
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</body>
<script>
    // Function to handle filter change and redirect with proper parameter
    function handleFilterChange(select) {
        const selectedValue = select.value;
        window.location.href = selectedValue ? `?filter=${encodeURIComponent(selectedValue)}` : '?';
    }
</script>

</html>