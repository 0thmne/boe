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
        <div class="grid">
            @foreach ($formData as $demand)
                @if ((!$selectedTypeFilter || $demand->type === $selectedTypeFilter) && 
                     (!$selectedStatusFilter || $demand->status === $selectedStatusFilter))
                    <div class="card card-{{ strtolower(str_replace(' ', '-', $demand->status)) }}">
                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $demand->status)) }}">{{ $demand->status }}</span>
                        
                        <div class="card-header">
                            <div class="client-flow">
                                <div class="client">
                                    <div class="client-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="personne-name">{{ $demand->surname }} {{ $demand->name }}</div>
                                        <div class="personne-assigne">
                                            <i class="fas fa-arrow-right"></i>
                                            @if($demand->assigned_to && $demand->assignedAgent)
                                                {{ $demand->assignedAgent->surname }} {{ $demand->assignedAgent->name }}
                                            @else
                                                Not assigned
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="request-details">
                                <div class="details-header" style="width: 100%;">
                                    <h3>Details</h3>
                                    <div class="request-id" style="text-align: right;">#{{ $demand->id }}</div>
                                </div>
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-tag"></i>
                                    </span>
                                    @switch($demand->type)
                                        @case('codification')
                                            Codification
                                            @break
                                        @case('processing')
                                            Nomenclature Processing
                                            @break
                                        @case('loading')
                                            Nomenclature Loading
                                            @break
                                        @case('sheets')
                                            Stamping Sheets
                                            @break
                                        @case('nbe')
                                            Equipment Number
                                            @break
                                        @case('documentation')
                                            Documentation Loading in Compass
                                            @break
                                    @endswitch
                                </div>
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    Created on: {{ $demand->created_at ? $demand->created_at->format('d/m/Y') : 'Not set' }}
                                </div>
                                @if ($demand->status === 'Completed')
                                    <div class="detail">
                                        <span class="detail-icon">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        Completed on: {{ $demand->completed_at ? $demand->completed_at->format('d/m/Y') : 'Not set' }}
                                    </div>
                                @else
                                    <div class="detail">
                                        <span class="detail-icon">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                        Deadline: {{ $demand->due_date ? $demand->due_date->format('d/m/Y') : 'Not set' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('admin/demande/details/' . $demand->uuid) }}" class="action-btn" title="View Details">
                                <i class="fas fa-eye" alt="Details"></i>
                            </a>
                            @if ($demand->status !== 'Completed')
                                <a href="{{ url('admin/demande/edit/' . $demand->uuid) }}" class="action-btn" title="Edit Request">
                                    <i class="fas fa-edit" alt="Edit"></i>
                                </a>
                            @else
                                <button class="action-btn" title="Archive">
                                    <i class="fas fa-archive" alt="Archive"></i>
                                </button>
                            @endif
                            <form id="deleteForm-{{ $demand->uuid }}" 
                                  action="{{ route('admin.delete', $demand->uuid) }}" 
                                  method="POST" 
                                  style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" 
                                        class="delete-btn" 
                                        onclick="showDeleteModal('{{ $demand->uuid }}')" 
                                        title="Delete">
                                    <i class="fas fa-trash-alt" alt="Delete"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach

            @if ($formData->isEmpty())
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>No Requests Found</h3>
                    <p>No requests match the selected filter criteria.</p>
                </div>
            @endif
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

    <!-- Add this right after your <body> tag -->
    <div id="deleteModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h3>Confirm Deletion</h3>
            <p>Are you sure you want to delete this request?</p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="delete-btn">Delete</button>
                <button id="cancelDelete" class="cancel-btn">Cancel</button>
            </div>
        </div>
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

    function showDeleteModal(uuid) {
        const modal = document.getElementById('deleteModal');
        modal.style.display = 'flex';
        
        document.getElementById('confirmDelete').onclick = function() {
            document.getElementById('deleteForm-' + uuid).submit();
        }
        
        document.getElementById('cancelDelete').onclick = function() {
            modal.style.display = 'none';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    }
</script>



</html>