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
    <header class="header">
        <div class="logo">
            <i class="fas fa-tasks"></i> Pilot
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
                            <div class="personne-name">{{ $demand->name }} {{ $demand->surname }}</div>
                            <div class="request-id">#{{ $demand->id }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="request-details">
                        <h3>Request</h3>
                        <div class="detail">
                            <span class="detail-icon">
                                <i class="fas fa-tag"></i>
                                
                            </span>
                            @if ($demand->type === 'codification')
                            Codification
                            @elseif ($demand->type === 'processing')
                            Nomenclature Processing
                            @elseif ($demand->type === 'loading')
                            Nomenclature Loading
                            @elseif ($demand->type === 'fiches')
                            Stamping Sheets
                            @elseif ($demand->type === 'nbe')
                            Equipment Number
                            @elseif ($demand->type === 'documentation')
                            Documentation Loading in Compass
                            @endif
                        </div>
                        <div class="detail">
                            <span class="detail-icon">
                                <i class="fas fa-calendar"></i>
                            </span>
                            Created on: {{ $demand->created_at->format('d/m/Y') }}
                        </div>
                        @if ($demand->status === 'Completed')
                        <div class="detail">
                            <span class="detail-icon">
                                <i class="fas fa-check"></i>
                            </span>
                            Completed on: {{ $demand->updated_at->format('d/m/Y') }}
                        </div>
                        @else
                        <div class="detail">
                            <span class="detail-icon">
                                <i class="fas fa-clock"></i>
                            </span>
                            Deadline: {{ $demand->dateech }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('admin/demande/details/' . $demand->uuid) }}" class="action-btn">
                        <i class="fas fa-eye" alt="Details"></i>
                    </a>
                    @if ($demand->status == 'New' || $demand->status == 'In Progress')
                    <a class="action-btn" href="{{ url('admin/demande/edit/' . $demand->uuid) }}">
                        <i class="fas fa-edit" alt="Edit"></i>
                    </a>
                    @elseif ($demand->status == 'Completed')
                    <a class="action-btn">
                        <i class="fas fa-archive" alt="Archive"></i>
                    </a>
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