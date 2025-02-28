@extends('layouts.app')

@section('content')
@include('components.header-admin')

<div class="container">
    <div class="board">
        <!-- In Progress Column -->
        <div class="column in-progress" id="in-progress">
            <div class="column-header">
                <div class="column-title">
                    <i class="fas fa-spinner"></i>
                    <span>Requests assigned</span>
                    <span class="column-count" id="in-progress-count">{{ count($requests) }}</span>
                </div>
            </div>
            
            <div class="grid" id="in-progress-grid">
                @forelse($requests as $request)
                <div class="card card-{{ str_replace(' ', '-', strtolower($request['status'])) }}">
                    <span class="status-badge status-{{ str_replace(' ', '-', strtolower($request['status'])) }}">
                        @if($request['status'] === 'In Progress')
                            {{ __('app.in_progress') }}
                        @else
                            {{ __('app.' . strtolower($request['status'])) }}
                        @endif
                    </span>
                    
                    <div class="card-header">
                        <div class="client-flow">
                            <div class="client">
                                <div class="client-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <div class="personne-name">{{ $request['name'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="request-details">
                            <div class="details-header">
                                <h3>{{ __('app.details') }}</h3>
                                <div class="request-id">#{{ $request['uuid'] }}</div>
                            </div>
                            <div class="detail">
                                <span class="detail-icon">
                                    <i class="fas fa-tag"></i>
                                </span>
                                {{ __('app.' . strtolower($request['type'])) }}
                            </div>
                            <div class="detail">
                                <span class="detail-icon">
                                    <i class="fas fa-calendar"></i>
                                </span>
                                {{ __('app.created_on') }}: {{ $request['created_at'] }}
                            </div>
                            @if ($request['status'] === 'Completed')
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    {{ __('app.completed_on') }}: {{ $request['updated_at'] }}
                                </div>
                            @else
                                <div class="detail">
                                    <span class="detail-icon">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                    {{ __('app.deadline') }}: {{ $request['due_date'] }}
                                </div>
                            @endif
                            @if($request['description'])
                            <div class="detail">
                                <span class="detail-icon">
                                    <i class="fas fa-file-alt"></i>
                                </span>
                                {{ Str::limit($request['description'], 100) }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('agent.requests.show', $request['uuid']) }}" class="action-btn view-btn" title="{{ __('app.view') }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button class="action-btn edit-btn" data-id="{{ $request['uuid'] }}" title="{{ __('app.edit') }}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
                @empty
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>{{ __('app.no_results') }}</h3>
                    <p>{{ __('app.no_results_desc') }}</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal-overlay" id="edit-modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">Edit Request</div>
            <button class="modal-close" id="close-modal">&times;</button>
        </div>
        <form id="edit-form" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <input type="hidden" id="demand-id" name="demand_id">
                
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Add a comment about the request"></textarea>
                </div>
                
                <div class="file-input-wrapper" id="file-drop-area">
                    <input type="file" id="file-input" class="file-input" name="files[]" multiple>
                    <label for="file-input" class="file-input-label">
                        <div class="file-input-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <strong>Choose files</strong> or drag and drop
                        <p>Accepted formats: PDF, DOC, XLS, JPG, PNG</p>
                    </label>
                </div>
                
                <ul class="file-list" id="file-list">
                    <!-- Selected files will appear here -->
                </ul>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="status-toggle" class="toggle-checkbox" name="status">
                    <label for="status-toggle" class="toggle-label">Mark as completed</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancel-edit">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

@push('styles')
    <style>
        :root {
            --primary-color: #1d2d6f;
            --secondary-color: #4267b2;
            --in-progress-color: #f57c00;
            --completed-color: #2e7d32;
            --new-color: #2196f3;
            --background-color: #f5f7fa;
            --header-color: #1d2d6f;
            --border-color: #e1e4e8;
            --text-color: #24292e;
            --light-text: #7f8c8d;
            --card-shadow: 0 2px 4px rgba(0,0,0,0.05);
            --hover-shadow: 0 4px 8px rgba(0,0,0,0.1);
            --transition-speed: 0.2s;
            --overlay-bg: rgba(0, 0, 0, 0.5);
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
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background-color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 8px;
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

        .board {
            display: grid;
            grid-template-columns: 1fr; /* Single column */
            gap: 20px;
        }

        .column {
            background-color: white;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .column-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--border-color);
        }

        .column-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--text-color);
        }

        .column-count {
            display: inline-block;
            border-radius: 12px;
            padding: 2px 8px;
            font-size: 0.8rem;
            color: white;
            background-color: var(--text-color);
        }

        .in-progress .column-title {
            color: inherit;
        }

        .in-progress .column-count {
            background-color: var(--text-color);
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
            box-shadow: var(--card-shadow);
            position: relative;
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
            padding-top: 0;
        }
        
        .card:hover {
            transform: translateY(-3px);
            box-shadow: var(--hover-shadow);
        }
        
        .card-new {
            border-left: 4px solid var(--new-color);
        }
        
        .card-in-progress, .card-inprogress {
            border-left: 4px solid #f57c00;
        }
        
        .card-completed {
            border-left: 4px solid var(--completed-color);
        }
        
        .card-header {
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f1f1f1;
            position: relative;
            padding-right: calc(40% + 24px); /* Add space for the status badge */
        }
        
        .client {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .client-info {
            display: flex;
            flex-direction: column;
        }

        .client-flow {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .flow-arrow {
            color: var(--light-text);
            margin: 0 8px;
        }
        
        .personne-name {
            font-weight: 600;
            font-size: 15px;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .request-id {
            font-size: 13px;
            color: var(--light-text);
            margin-top: 2px;
        }

        .request-position {
            font-size: 13px;
            color: var(--light-text);
        }

        .client-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .card-body {
            padding: 16px;
            display: flex;
            justify-content: space-between;
        }
        
        .request-details h3 {
            font-size: 14px;
            font-weight: 500;
            color: var(--light-text);
            margin-bottom: 12px;
        }
        
        .detail {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .detail-icon {
            margin-right: 8px;
            opacity: 0.6;
            width: 16px;
            text-align: center;
        }
        
        .status-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            z-index: 1;
            width: 30%;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .status-new {
            background-color: #e3f2fd;
            color: var(--new-color);
        }
        
        .status-in-progress, .status-inprogress {
            background-color: #fff3e0;
            color: #f57c00;
        }
        
        .status-completed {
            background-color: #e8f5e9;
            color: var(--completed-color);
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
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            color: var(--light-text);
            display: flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 4px;
            transition: color var(--transition-speed), background-color var(--transition-speed);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-btn:hover {
            color: var(--primary-color);
            background-color: rgba(29, 45, 111, 0.05);
        }
        
        .action-btn i {
            margin: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .board {
                grid-template-columns: 1fr;
            }
            
            .grid {
                grid-template-columns: 1fr;
            }
            
            .client-flow {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            
            .flow-arrow {
                transform: rotate(90deg);
                margin: 4px 0;
            }
        }
        .assigned-person{
            top: 42px; 
            font-size: 13px;
            color: #7f8c8d; 
            text-align: right;
        }
        .request-id-below-badge {
            position: absolute;
            top: 42px; 
            right: 16px;
            font-size: 12px;
            color: #7f8c8d; 
            text-align: right;
        }

        /* Modal styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--overlay-bg);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal {
            background-color: white;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            padding: 0;
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .modal-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .modal-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(29, 45, 111, 0.1);
        }

        .file-input-wrapper {
            border: 2px dashed var(--border-color);
            padding: 20px;
            text-align: center;
            border-radius: 4px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all var(--transition-speed);
        }

        .file-input-wrapper:hover {
            border-color: var(--primary-color);
            background-color: rgba(29, 45, 111, 0.05);
        }

        .file-input {
            position: absolute;
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            z-index: -1;
        }

        .file-input-label {
            display: block;
            cursor: pointer;
        }

        .file-input-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .file-list {
            margin-top: 10px;
            list-style: none;
        }

        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f5f7fa;
            padding: 8px 12px;
            border-radius: 4px;
            margin-bottom: 5px;
        }

        .file-item-name {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .file-item-remove {
            background: none;
            border: none;
            color: #e53935;
            cursor: pointer;
        }

        .modal-footer {
            padding: 16px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-speed);
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #14204d;
        }

        .btn-secondary {
            background-color: #e0e0e0;
            color: var(--text-color);
        }

        .btn-secondary:hover {
            background-color: #d0d0d0;
        }

        .checkbox-group {
            margin-top: 25px;
            display: flex;
            align-items: center;
        }

        .toggle-checkbox {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 50px;
            height: 26px;
            border-radius: 13px;
            background-color: #ccc;
            position: relative;
            cursor: pointer;
            outline: none;
            transition: background-color 0.3s;
        }

        .toggle-checkbox::before {
            content: '';
            position: absolute;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background-color: white;
            top: 2px;
            left: 2px;
            transition: left 0.3s;
        }

        .toggle-checkbox:checked {
            background-color: var(--completed-color);
        }

        .toggle-checkbox:checked::before {
            left: 26px;
        }

        .toggle-label {
            margin-left: 10px;
            font-weight: 500;
        }

        .details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            width: 100%;
        }

        .details-header h3 {
            font-size: 14px;
            font-weight: 500;
            color: var(--light-text);
            margin: 0;
        }

        .request-id {
            font-size: 13px;
            color: var(--light-text);
            text-align: right;
        }

        .client-flow {
            flex: 1;
        }

        /* Empty State */
        .no-results {
            text-align: center;
            padding: 40px;
            color: var(--light-text);
        }

        .no-results i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .no-results h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .no-results p {
            font-size: 14px;
        }

        /* Update header styles to match admin header */
        .admin-header {
            background-color: white !important;
            color: var(--text-color) !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            margin-bottom: 20px;
        }

        .admin-header-container {
            max-width: 100% !important;
            padding: 1rem 2rem !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        .admin-logo {
            color: var(--primary-color) !important;
            font-size: 1.5rem !important;
            font-weight: bold !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .admin-logo i {
            color: var(--primary-color) !important;
        }

        .admin-user-profile {
            color: var(--text-color) !important;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-user-profile span {
            font-weight: 600 !important;
            color: var(--text-color) !important;
        }

        .admin-user-avatar {
            background-color: var(--primary-color) !important;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white !important;
        }

        .admin-header-actions {
            display: flex !important;
            align-items: center !important;
            gap: 1.5rem !important;
        }

        .admin-logout-form {
            margin: 0;
            padding: 0;
            line-height: 0;
        }

        .admin-logout-btn {
            color: white !important;
            font-size: 1.2rem !important;
            padding: 0 !important;
            border-radius: 50% !important;
            background-color: var(--primary-color) !important;
            border: none !important;
            cursor: pointer !important;
            transition: background-color 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 40px !important;
            height: 40px !important;
            margin: 0 !important;
            line-height: 1 !important;
        }

        .admin-logout-btn:hover {
            background-color: var(--secondary-color) !important;
        }

        /* Language selector styling */
        .language-selector select {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            background-color: white;
            color: var(--text-color);
            font-size: 14px;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .language-selector select:hover {
            border-color: var(--primary-color);
        }

        .language-selector select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(36, 55, 130, 0.1);
        }

        /* Remove the old header styles */
        .header, .logo, .header-right, .user-actions {
            /* Override old styles */
            all: unset;
        }
    </style>
@endpush

@endsection