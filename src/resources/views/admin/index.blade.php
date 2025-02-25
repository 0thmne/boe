<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Pilote - Stellantis</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pilote.css') }}">
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
                <div class="stat-value" style="color: var(--nouveau-color);">{{ $countNew }}</div>
            </div>
            <div class="stat-card">
                <h3>En Cours</h3>
                <div class="stat-value" style="color: var(--encours-color);">{{ $countProgress }}</div>
            </div>
            <div class="stat-card">
                <h3>Terminé</h3>
                <div class="stat-value" style="color: var(--termine-color);">{{ $countCompleted }}</div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <h2 class="filter-title">{{ $selectedStatusFilter ? 'Demandes ' . $selectedStatusFilter : 'Tous les Demandes' }}</h2>
            
            <div class="filter-group">
                <span class="filter-label">Type:</span>
                <select id="typeFilter" class="filter-dropdown" onchange="handleFilterChange()">
                    <option value="" {{ $selectedTypeFilter === '' ? 'selected' : '' }}>Tous les Types</option>
                    <option value="codification" {{ $selectedTypeFilter === 'codification' ? 'selected' : '' }}>Codification</option>
                    <option value="traitement" {{ $selectedTypeFilter === 'traitement' ? 'selected' : '' }}>Traitement Nomenclature</option>
                    <option value="chargement" {{ $selectedTypeFilter === 'chargement' ? 'selected' : '' }}>Chargement Nomenclature</option>
                    <option value="fiches" {{ $selectedTypeFilter === 'fiches' ? 'selected' : '' }}>Fiches D'emboutissage</option>
                    <option value="nbe" {{ $selectedTypeFilter === 'nbe' ? 'selected' : '' }}>N BE</option>
                    <option value="documentation" {{ $selectedTypeFilter === 'documentation' ? 'selected' : '' }}>Chargement Documentation Dans Compas</option>
                </select>
            </div>
            
            <div class="filter-group">
                <span class="filter-label">Statut:</span>
                <select id="statusFilter" class="filter-dropdown" onchange="handleFilterChange()">
                    <option value="" {{ $selectedStatusFilter === '' ? 'selected' : '' }}>Tous les Statuts</option>
                    <option value="Nouveau" {{ $selectedStatusFilter === 'Nouveau' ? 'selected' : '' }}>Nouveau</option>
                    <option value="En cours" {{ $selectedStatusFilter === 'En cours' ? 'selected' : '' }}>En cours</option>
                    <option value="Terminé" {{ $selectedStatusFilter === 'Terminé' ? 'selected' : '' }}>Terminé</option>
                </select>
            </div>
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
                        <h3>Demande</h3>
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
                    <button class="action-btn" >
                        <i class="fas fa-eye"alt="Détails"></i>
                    </button>
                    @if ($demand->status == 'Nouveau' || $demand->status == 'En Cours')
                    <button class="action-btn">
                        <i class="fas fa-edit" alt="Modifier"></i>
                        
                    </button>
                    @elseif ($demand->status == 'Terminé')
                    <button class="action-btn">
                        <i class="fas fa-archive" alt="Livrai"></i>
                        
                    </button>
                    @endif
                </div>
            </div>
            @endif
            @endforeach
        </div>

        <!-- Pagination Links -->
        @if ($formData->total() > 4)
        <div class="pagination">
            @if ($formData->onFirstPage())
            <button class="page-button" disabled style="cursor: not-allowed;">&lsaquo;</button>
            @else
            <a href="{{ $formData->previousPageUrl() }}" class="page-button">&lsaquo;</a>
            @endif

            @foreach ($formData->getUrlRange(1, $formData->lastPage()) as $page => $url)
            @if ($page == $formData->currentPage())
                <button class="page-button active">{{ $page }}</button>
            @else
                <a href="{{ $url }}" class="page-button">{{ $page }}</a>
            @endif
            @endforeach

            @if ($formData->hasMorePages())
            <a href="{{ $formData->nextPageUrl() }}" class="page-button">&rsaquo;</a>
            @else
            <button class="page-button" disabled style="cursor: not-allowed;">&rsaquo;</button>
            @endif
        </div>
        @endif
    </div>
</body>
<script>
    // Function to handle filter change and redirect with proper parameter
    function handleFilterChange() {
        const typeFilter = document.getElementById('typeFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;
        
        let url = '?';
        if (typeFilter) url += `type=${encodeURIComponent(typeFilter)}`;
        if (statusFilter) {
            if (typeFilter) url += '&';
            url += `status=${encodeURIComponent(statusFilter)}`;
        }
        
        window.location.href = url;
    }
</script>

</html>