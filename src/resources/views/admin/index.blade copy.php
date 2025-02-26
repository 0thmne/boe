<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilot Interface </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pilote.css') }}">
</head>

<body>

    @include('components.header-admin')

    <div class="container">
        <!-- Status -->
        <div class="stats-container">
            <div class="stat-card">
                <h3>New</h3>
                <div class="stat-value" style="color: var(--new-color);">{{ $countNew }}</div>
            </div>
            <div class="stat-card">
                <h3>In Progress</h3>
                <div class="stat-value" style="color: var(--in-progress-color);">{{ $countProgress }}</div>
            </div>
            <div class="stat-card">
                <h3>Completed</h3>
                <div class="stat-value" style="color: var(--completed-color);">{{ $countCompleted }}</div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <h2 class="filter-title">{{ $selectedStatusFilter ? 'Requests ' . $selectedStatusFilter : 'All Requests' }}</h2>

            <div class="filter-group">
                <span class="filter-label">Type:</span>
                <select id="typeFilter" class="filter-dropdown" onchange="handleFilterChange()">
                    <option value="" {{ $selectedTypeFilter === '' ? 'selected' : '' }}>All Types</option>
                    <option value="codification" {{ $selectedTypeFilter === 'codification' ? 'selected' : '' }}>Codification</option>
                    <option value="processing" {{ $selectedTypeFilter === 'processing' ? 'selected' : '' }}>Nomenclature Processing</option>
                    <option value="loading" {{ $selectedTypeFilter === 'loading' ? 'selected' : '' }}>Nomenclature Loading</option>
                    <option value="fiches" {{ $selectedTypeFilter === 'fiches' ? 'selected' : '' }}>Stamping Sheets</option>
                    <option value="nbe" {{ $selectedTypeFilter === 'nbe' ? 'selected' : '' }}>Equipment Number</option>
                    <option value="documentation" {{ $selectedTypeFilter === 'documentation' ? 'selected' : '' }}>Documentation Loading in Compass</option>
                </select>
            </div>

            <div class="filter-group">
                <span class="filter-label">Status:</span>
                <select id="statusFilter" class="filter-dropdown" onchange="handleFilterChange()">
                    <option value="" {{ $selectedStatusFilter === '' ? 'selected' : '' }}>All Status</option>
                    <option value="New" {{ $selectedStatusFilter === 'New' ? 'selected' : '' }}>New</option>
                    <option value="In Progress" {{ $selectedStatusFilter === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Completed" {{ $selectedStatusFilter === 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
        </div>

        <!-- Card Grid -->
        <!-- Card Grid -->
        <div class="grid">
            <?php
            $displayedCards = 0;
            foreach ($demands as $demand):
                // Skip this card if filters are active and it doesn't match
                if (($selectedTypeFilter && $demand['typedemande'] !== $selectedTypeFilter) ||
                    ($selectedStatusFilter && $demand['status'] !== $selectedStatusFilter)
                ) {
                    continue;
                }
                $displayedCards++;
            ?>
                <div class="card card-<?php echo $demand['statusClass']; ?>">
                    <span class="status-badge status-<?php echo $demand['statusClass']; ?>"><?php echo $demand['status']; ?></span>
                    <div class="request-id-below-badge">#<?php echo $demand['id']; ?></div>
                    <div class="card-header">
                        <div class="client-flow">
                            <div class="client">
                                <div class="client-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <div class="personne-name"><?php echo $demand['name']; ?></div>
                                    <div class="personne-assigne"><i class="fas fa-arrow-right"> </i> <?php echo $demand['id']; ?></div>
                                </div>
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
                                <?php echo $demand['typedemande']; ?>
                            </div>
                            <div class="detail">
                                <span class="detail-icon">
                                    <i class="fas fa-calendar"></i>
                                </span>
                                Créé le: <?php echo $demand['date']; ?>
                            </div>
                            <?php if (isset($demand['completedDate'])): ?>
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    Complété le: <?php echo $demand['completedDate']; ?>
                                </div>
                            <?php else: ?>
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                    Échéance: <?php echo $demand['dateech']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="action-btn">
                            <i class="fas fa-eye"></i>
                            <a href="" class="action-btn">Voir</a>
                        </button>
                        <?php if ($demand['status'] == 'Nouveau'): ?>
                            <button class="action-btn">
                                <i class="fas fa-edit"></i>
                                <a href="#" class="action-btn">Modifier</a>
                            </button>
                        <?php elseif ($demand['status'] == 'En cours'): ?>
                            <button class="action-btn">
                                <i class="fas fa-edit"></i>
                                <a href="#" class="action-btn">Modifier</a>
                            </button>
                        <?php elseif ($demand['status'] == 'Terminé'): ?>
                            <button class="action-btn">
                                <i class="fas fa-archive"></i>
                                Livrai
                            </button>
                        <?php endif; ?>
                        <button class="delete-btn">
                            <i class="fas fa-trash-alt"></i>
                            Supprimer
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if ($displayedCards === 0): ?>
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>Aucune demande trouvée</h3>
                    <p>Aucune demande ne correspond aux critères de filtrage sélectionnés.</p>
                </div>
            <?php endif; ?>
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