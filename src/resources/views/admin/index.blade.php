<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('app.pilot_interface') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pilote.css') }}">
</head>

<body>

    @include('components.header-admin')

    <div class="container">
        <!-- Status -->
        <div class="stats-container">
            <div class="stat-card">
                <h3>{{ __('app.new') }}</h3>
                <div class="stat-value">{{ $countNew }}</div>
            </div>
            <div class="stat-card">
                <h3>{{ __('app.in_progress') }}</h3>
                <div class="stat-value">{{ $countProgress }}</div>
            </div>
            <div class="stat-card">
                <h3>{{ __('app.completed') }}</h3>
                <div class="stat-value">{{ $countCompleted }}</div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <h2 class="filter-title">
                {{ $selectedStatusFilter ? __('app.requests') . ' ' . __('app.' . strtolower(str_replace(' ', '-', $selectedStatusFilter))) : __('app.all_requests') }}
            </h2>

            <div class="filter-group">
                <span class="filter-label">{{ __('app.type') }}:</span>
                <select id="typeFilter" class="filter-dropdown" onchange="handleFilterChange()">
                    <option value="" {{ $selectedTypeFilter === '' ? 'selected' : '' }}>{{ __('app.all_types') }}</option>
                    <option value="codification" {{ $selectedTypeFilter === 'codification' ? 'selected' : '' }}>{{ __('app.codification') }}</option>
                    <option value="processing" {{ $selectedTypeFilter === 'processing' ? 'selected' : '' }}>{{ __('app.processing') }}</option>
                    <option value="loading" {{ $selectedTypeFilter === 'loading' ? 'selected' : '' }}>{{ __('app.loading') }}</option>
                    <option value="fiches" {{ $selectedTypeFilter === 'fiches' ? 'selected' : '' }}>{{ __('app.sheets') }}</option>
                    <option value="nbe" {{ $selectedTypeFilter === 'nbe' ? 'selected' : '' }}>{{ __('app.nbe') }}</option>
                    <option value="documentation" {{ $selectedTypeFilter === 'documentation' ? 'selected' : '' }}>{{ __('app.documentation') }}</option>
                </select>
            </div>

            <div class="filter-group">
                <span class="filter-label">{{ __('app.status') }}:</span>
                <select id="statusFilter" class="filter-dropdown" onchange="handleFilterChange()">
                    <option value="" {{ $selectedStatusFilter === '' ? 'selected' : '' }}>{{ __('app.all_status') }}</option>
                    <option value="New" {{ $selectedStatusFilter === 'New' ? 'selected' : '' }}>{{ __('app.new') }}</option>
                    <option value="In Progress" {{ $selectedStatusFilter === 'In Progress' ? 'selected' : '' }}>{{ __('app.in_progress') }}</option>
                    <option value="Completed" {{ $selectedStatusFilter === 'Completed' ? 'selected' : '' }}>{{ __('app.completed') }}</option>
                </select>
            </div>
        </div>

        <!-- Grid Section -->
        <div class="grid">
            @foreach ($formData as $demand)
                @if ((!$selectedTypeFilter || $demand->type === $selectedTypeFilter) && 
                     (!$selectedStatusFilter || $demand->status === $selectedStatusFilter))
                    <div class="card card-{{ strtolower(str_replace(' ', '-', $demand->status)) }}">
                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $demand->status)) }}">
                            @if($demand->status === 'In Progress')
                                {{ __('app.in_progress') }}
                            @else
                                {{ __('app.' . strtolower($demand->status)) }}
                            @endif
                        </span>
                        
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
                                                {{ __('app.not_assigned') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="request-details">
                                <div class="details-header" style="width: 100%;">
                                    <h3>{{ __('app.details') }}</h3>
                                    <div class="request-id" style="text-align: right;">#{{ $demand->id }}</div>
                                </div>
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-tag"></i>
                                    </span>
                                    {{ __('app.' . strtolower($demand->type)) }}
                                </div>
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    {{ __('app.created_on') }}: {{ $demand->created_at->format('d/m/Y') }}
                                </div>
                                @if ($demand->status === 'Completed')
                                    <div class="detail">
                                        <span class="detail-icon">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        {{ __('app.completed_on') }}: {{ $demand->updated_at->format('d/m/Y') }}
                                    </div>
                                @else
                                    <div class="detail">
                                        <span class="detail-icon">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                        {{ __('app.deadline') }}: {{ $demand->due_date ? $demand->due_date->format('d/m/Y') : __('app.not_set') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('admin/demande/details/' . $demand->uuid) }}" class="action-btn" title="{{ __('app.view') }}">
                                <i class="fas fa-eye" alt="{{ __('app.view') }}"></i>
                            </a>
                            @if ($demand->status !== 'Completed')
                                <a href="{{ url('admin/demande/edit/' . $demand->uuid) }}" class="action-btn" title="{{ __('app.edit') }}">
                                    <i class="fas fa-edit" alt="{{ __('app.edit') }}"></i>
                                </a>
                            @else
                                <button class="action-btn" title="{{ __('app.archive') }}">
                                    <i class="fas fa-archive" alt="{{ __('app.archive') }}"></i>
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
                                        title="{{ __('app.delete') }}">
                                    <i class="fas fa-trash-alt" alt="{{ __('app.delete') }}"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach

            @if ($formData->isEmpty())
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>{{ __('app.no_results') }}</h3>
                    <p>{{ __('app.no_results_desc') }}</p>
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
            <h3>{{ __('app.confirm_delete') }}</h3>
            <p>{{ __('app.delete_confirm_message') }}</p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="delete-btn">{{ __('app.delete') }}</button>
                <button id="cancelDelete" class="cancel-btn">{{ __('app.cancel') }}</button>
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