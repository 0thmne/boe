<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('admin.pilot_interface') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pilote.css') }}">
</head>

<body>

    @include('components.header-admin')

    <div class="container">
        <!-- Status -->
        <div class="stats-container">
            <div class="stat-card">
                <h3>{{ __('admin.new') }}</h3>
                <div class="stat-value" style="color: var(--new-color);">{{ $countNew }}</div>
            </div>
            <div class="stat-card">
                <h3>{{ __('admin.in_progress') }}</h3>
                <div class="stat-value" style="color: var(--in-progress-color);">{{ $countProgress }}</div>
            </div>
            <div class="stat-card">
                <h3>{{ __('admin.completed') }}</h3>
                <div class="stat-value" style="color: var(--completed-color);">{{ $countCompleted }}</div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <h2 class="filter-title">
                {{ $selectedStatusFilter ? __('admin.requests') . ' ' . __('admin.' . strtolower($selectedStatusFilter)) : __('admin.all_requests') }}
            </h2>

            <div class="filter-group">
                <span class="filter-label">{{ __('admin.type') }}:</span>
                <select id="typeFilter" class="filter-dropdown" onchange="handleFilterChange()">
                    <option value="" {{ $selectedTypeFilter === '' ? 'selected' : '' }}>{{ __('admin.all_types') }}</option>
                    <option value="codification" {{ $selectedTypeFilter === 'codification' ? 'selected' : '' }}>{{ __('admin.codification') }}</option>
                    <option value="processing" {{ $selectedTypeFilter === 'processing' ? 'selected' : '' }}>{{ __('admin.nomenclature_processing') }}</option>
                    <option value="loading" {{ $selectedTypeFilter === 'loading' ? 'selected' : '' }}>{{ __('admin.nomenclature_loading') }}</option>
                    <option value="fiches" {{ $selectedTypeFilter === 'fiches' ? 'selected' : '' }}>{{ __('admin.stamping_sheets') }}</option>
                    <option value="nbe" {{ $selectedTypeFilter === 'nbe' ? 'selected' : '' }}>{{ __('admin.equipment_number') }}</option>
                    <option value="documentation" {{ $selectedTypeFilter === 'documentation' ? 'selected' : '' }}>{{ __('admin.documentation_loading') }}</option>
                </select>
            </div>

            <div class="filter-group">
                <span class="filter-label">{{ __('admin.status') }}:</span>
                <select id="statusFilter" class="filter-dropdown" onchange="handleFilterChange()">
                    <option value="" {{ $selectedStatusFilter === '' ? 'selected' : '' }}>{{ __('admin.all_status') }}</option>
                    <option value="New" {{ $selectedStatusFilter === 'New' ? 'selected' : '' }}>{{ __('admin.new') }}</option>
                    <option value="In Progress" {{ $selectedStatusFilter === 'In Progress' ? 'selected' : '' }}>{{ __('admin.in_progress') }}</option>
                    <option value="Completed" {{ $selectedStatusFilter === 'Completed' ? 'selected' : '' }}>{{ __('admin.completed') }}</option>
                </select>
            </div>
        </div>

        <!-- Card Grid -->
        <div class="grid">
            @foreach ($formData as $demand)
                @if ((!$selectedTypeFilter || $demand->type === $selectedTypeFilter) && 
                     (!$selectedStatusFilter || $demand->status === $selectedStatusFilter))
                    <div class="card card-{{ strtolower(str_replace(' ', '-', $demand->status)) }}">
                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $demand->status)) }}">
                            {{ __('admin.' . strtolower(str_replace(' ', '_', $demand->status))) }}
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
                                                {{ __('admin.not_assigned') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="request-details">
                                <div class="details-header" style="width: 100%;">
                                    <h3>{{ __('admin.details') }}</h3>
                                    <div class="request-id" style="text-align: right;">#{{ $demand->id }}</div>
                                </div>
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-tag"></i>
                                    </span>
                                    @switch($demand->type)
                                        @case('codification')
                                            {{ __('admin.codification') }}
                                            @break
                                        @case('processing')
                                            {{ __('admin.nomenclature_processing') }}
                                            @break
                                        @case('loading')
                                            {{ __('admin.nomenclature_loading') }}
                                            @break
                                        @case('sheets')
                                            {{ __('admin.stamping_sheets') }}
                                            @break
                                        @case('nbe')
                                            {{ __('admin.equipment_number') }}
                                            @break
                                        @case('documentation')
                                            {{ __('admin.documentation_loading') }}
                                            @break
                                    @endswitch
                                </div>
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                    {{ __('admin.created_on') }}: {{ $demand->created_at->format('d/m/Y') }}
                                </div>
                                @if ($demand->status === 'Completed')
                                    <div class="detail">
                                        <span class="detail-icon">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        {{ __('admin.completed_on') }}: {{ $demand->updated_at->format('d/m/Y') }}
                                    </div>
                                @else
                                    <div class="detail">
                                        <span class="detail-icon">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                        {{ __('admin.deadline') }}: {{ $demand->due_date ? $demand->due_date->format('d/m/Y') : __('admin.not_set') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('admin/demande/details/' . $demand->uuid) }}" class="action-btn" title="{{ __('admin.view_details') }}">
                                <i class="fas fa-eye" alt="{{ __('admin.details') }}"></i>
                            </a>
                            @if ($demand->status !== 'Completed')
                                <a href="{{ url('admin/demande/edit/' . $demand->uuid) }}" class="action-btn" title="{{ __('admin.edit_request') }}">
                                    <i class="fas fa-edit" alt="{{ __('admin.edit') }}"></i>
                                </a>
                            @else
                                <button class="action-btn" title="{{ __('admin.archive') }}">
                                    <i class="fas fa-archive" alt="{{ __('admin.archive') }}"></i>
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
                                        title="{{ __('admin.delete') }}">
                                    <i class="fas fa-trash-alt" alt="{{ __('admin.delete') }}"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach

            @if ($formData->isEmpty())
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>{{ __('admin.no_requests_found') }}</h3>
                    <p>{{ __('admin.no_requests_match') }}</p>
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
            <h3>{{ __('admin.confirm_deletion') }}</h3>
            <p>{{ __('admin.confirm_delete_message') }}</p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="delete-btn">{{ __('admin.delete') }}</button>
                <button id="cancelDelete" class="cancel-btn">{{ __('admin.cancel') }}</button>
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