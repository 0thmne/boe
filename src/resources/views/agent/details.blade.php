@extends('layouts.agent')

@section('content')
    <div class="container">
        

        <a href="{{ route('agent.requests') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> {{ __('agent-details.back_to_list') }}
        </a>

        <div class="detail-card">
            <div class="detail-header">
                <h1 class="detail-title">{{ __('agent-details.' . strtolower($requestDetails->type)) }}</h1>
                <div class="request-id">#{{ $requestDetails->uuid }}</div>
                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $requestDetails->status)) }}">
                    <i class="fas fa-clock"></i>
                    @if($requestDetails->status == 'In Progress')
                        {{ __('agent-details.in_progress') }}
                    @else
                        {{ __('agent-details.' . strtolower($requestDetails->status)) }}
                    @endif
                </span>
            </div>
            <div class="detail-body">
                <div class="info-grid">
                    <div class="info-section">
                        <h3><i class="fas fa-info-circle"></i> {{ __('agent-details.request_information') }}</h3>
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.type') }}:</div>
                            <div class="info-value">
                                @if ($requestDetails->type === 'codification')
                                    {{ __('app.codification') }}
                                @elseif ($requestDetails->type === 'processing')
                                    {{ __('app.processing') }}
                                @elseif ($requestDetails->type === 'loading')
                                    {{ __('app.loading') }}
                                @elseif ($requestDetails->type === 'sheets')
                                    {{ __('app.sheets') }}
                                @elseif ($requestDetails->type === 'nbe')
                                    {{ __('app.nbe') }}
                                @elseif ($requestDetails->type === 'documentation')
                                    {{ __('app.documentation') }}
                                @endif
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.created_on') }}:</div>
                            <div class="info-value">{{ $requestDetails->created_at ? $requestDetails->created_at->format('d/m/Y') : __('agent-details.not_set') }}</div>
                        </div>
                        @if($requestDetails->due_date)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.deadline') }}:</div>
                            <div class="info-value">{{ $requestDetails->due_date->format('d/m/Y') }}</div>
                        </div>
                        @endif
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.completed_on') }}:</div>
                            <div class="info-value">{{ $requestDetails->completed_at ? $requestDetails->completed_at->format('d/m/Y') : __('agent-details.not_set') }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.status') }}:</div>
                            <div class="info-value">
                                @if($requestDetails->status == 'In Progress')
                                    {{ __('agent-details.in_progress') }}
                                @else
                                    {{ __('agent-details.' . strtolower($requestDetails->status)) }}
                                @endif
                            </div>
                        </div>
                        @if($requestDetails->numberArticles)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.number_of_articles') }}:</div>
                            <div class="info-value">{{ $requestDetails->numberArticles }}</div>
                        </div>
                        @endif
                        @if($requestDetails->aocType)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.aoc_type') }}:</div>
                            <div class="info-value">{{ $requestDetails->aocType }}</div>
                        </div>
                        @endif
                        @if($requestDetails->documentSearch)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.document_search') }}:</div>
                            <div class="info-value">{{ $requestDetails->documentSearch }}</div>
                        </div>
                        @endif
                        @if($requestDetails->language)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.language') }}:</div>
                            <div class="info-value">
                                @php
                                $languageMap = [
                                    '3N' => 'English',
                                    'A7' => 'Australian',
                                    'AF' => 'Afrikaans',
                                    'AR' => 'Arabic',
                                    'BG' => 'Bulgarian',
                                    'CA' => 'Catalan',
                                    'CS' => 'Czech',
                                    'DA' => 'Danish',
                                    'DE' => 'German',
                                    'EL' => 'Greek',
                                    'EN' => 'English',
                                    'ES' => 'Spanish',
                                    'ET' => 'Estonian',
                                    'FI' => 'Finnish',
                                    'FR' => 'French',
                                    'HE' => 'Hebrew',
                                    'HI' => 'Hindi',
                                    'HR' => 'Croatian',
                                    'HU' => 'Hungarian',
                                    'ID' => 'Indonesian',
                                    'IS' => 'Icelandic',
                                    'IT' => 'Italian',
                                    'JA' => 'Japanese',
                                    'KK' => 'Kazakh',
                                    'KO' => 'Korean',
                                    'LT' => 'Lithuanian',
                                    'LV' => 'Latvian',
                                    'MS' => 'Malay',
                                    'NL' => 'Dutch',
                                    'NO' => 'Norwegian',
                                    'PL' => 'Polish',
                                    'RO' => 'Romanian',
                                    'RU' => 'Russian',
                                    'SH' => 'Serbian (Latin)',
                                    'SK' => 'Slovak',
                                    'SL' => 'Slovenian',
                                    'SR' => 'Serbian',
                                    'SV' => 'Swedish',
                                    'TH' => 'Thai',
                                    'TR' => 'Turkish',
                                    'UK' => 'Ukrainian',
                                    'VI' => 'Vietnamese',
                                    'Z1' => 'Client Reserve',
                                    'ZF' => 'Traditional Chinese',
                                    'ZH' => 'Chinese',
                                ];
                                @endphp
                                {{ $languageMap[$requestDetails->language] ?? $requestDetails->language }}
                            </div>
                        </div>
                        @endif
                        @if($requestDetails->nbeName)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.nbe_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->nbeName }}</div>
                        </div>
                        @endif
                        @if($requestDetails->documentSearchNom)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.document_search_nom') }}:</div>
                            <div class="info-value">{{ $requestDetails->documentSearchNom }}</div>
                        </div>
                        @endif
                        @if($requestDetails->languageName)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.language_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->languageName }}</div>
                        </div>
                        @endif
                        @if($requestDetails->nbeNameTrait)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.nbe_name_trait') }}:</div>
                            <div class="info-value">{{ $requestDetails->nbeNameTrait }}</div>
                        </div>
                        @endif
                        @if($requestDetails->job)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.job') }}:</div>
                            <div class="info-value">{{ $requestDetails->job }}</div>
                        </div>
                        @endif
                        @if($requestDetails->numberLines)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.number_of_lines') }}:</div>
                            <div class="info-value">{{ $requestDetails->numberLines }}</div>
                        </div>
                        @endif
                        @if($requestDetails->jobNbe)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.job_nbe') }}:</div>
                            <div class="info-value">{{ $requestDetails->jobNbe }}</div>
                        </div>
                        @endif
                        @if($requestDetails->sector)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.sector') }}:</div>
                            <div class="info-value">{{ $requestDetails->sector }}</div>
                        </div>
                        @endif
                        @if($requestDetails->projectName)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.project_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->projectName }}</div>
                        </div>
                        @endif
                        @if($requestDetails->typeMillion)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.type_million') }}:</div>
                            <div class="info-value">{{ $requestDetails->typeMillion }}</div>
                        </div>
                        @endif
                        @if($requestDetails->mainFunction)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.main_function') }}:</div>
                            <div class="info-value">{{ $requestDetails->mainFunction }}</div>
                        </div>
                        @endif
                        @if($requestDetails->elementaryFunction)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.elementary_function') }}:</div>
                            <div class="info-value">{{ $requestDetails->elementaryFunction }}</div>
                        </div>
                        @endif
                        @if($requestDetails->numberLinesNbe)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.number_of_lines_nbe') }}:</div>
                            <div class="info-value">{{ $requestDetails->numberLinesNbe }}</div>
                        </div>
                        @endif
                        @if($requestDetails->technicalPost)
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.technical_post') }}:</div>
                            <div class="info-value">{{ $requestDetails->technicalPost }}</div>
                        </div>
                        @endif
                    </div>

                    <div class="info-section">
                        <h3><i class="fas fa-user"></i> {{ __('agent-details.requester_information') }}</h3>
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.id') }}:</div>
                            <div class="info-value">{{ $requestDetails->uuid }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.last_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->surname }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.first_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->name }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{ __('agent-details.site') }}:</div>
                            <div class="info-value">{{ $requestDetails->site }}</div>
                        </div>
                    </div>
                </div>

                @if($requestDetails->description)
                <div class="description-section">
                    <h3><i class="fas fa-align-left"></i> {{ __('agent-details.description') }}</h3>
                    <div class="description-content">
                        {{ $requestDetails->description }}
                    </div>
                </div>
                @endif

                @if($requestDetails->file_client)
                <div class="file-download-section">
                    <h3 class="file-download-title">
                        <i class="fas fa-file-download"></i> {{ __('agent-details.attached_files') }}
                    </h3>
                    <div class="file-list">
                        @foreach(json_decode($requestDetails->file_client) as $file)
                        <div class="file-item">
                            <div class="file-info">
                                <div class="file-icon">
                                    <i class="fas fa-file"></i>
                                </div>
                                <div class="file-details">
                                    <div class="file-name">{{ basename($file) }}</div>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $file) }}" class="download-btn" download>
                                <i class="fas fa-download"></i> {{ __('agent-details.download') }}
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($requestDetails->comments)
                <div class="comments-section">
                    <h3><i class="fas fa-comments"></i> {{ __('agent-details.comments') }}</h3>
                    <div class="comments-list">
                        @foreach(explode("\n", $requestDetails->comments) as $comment)
                            @if(!empty(trim($comment)))
                                <div class="comment">
                                    <div class="comment-text">{{ $comment }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="action-buttons">
                    <button class="btn btn-primary" id="edit-request">
                        <i class="fas fa-edit"></i> {{ __('agent-details.edit_request') }}
                    </button>
                    @if($requestDetails->status != 'Completed')
                    <button class="btn btn-success" id="mark-completed">
                        <i class="fas fa-check"></i> {{ __('agent-details.mark_as_completed') }}
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    :root {
        --primary-color: #1e3a8a;
        --secondary-color: #172554;
        --background-color: #f8fafc;
        --border-color: #e2e8f0;
        --text-color: #1e293b;
        --hover-color: #f1f5f9;
        --success-color: #16a34a;
        --warning-color: #fbbf24;
        --danger-color: #dc2626;
        --info-color: #0ea5e9;

        /* Status colors */
        --nouveau-color: #2563eb;
        --encours-color: #ea580c;
        --termine-color: #15803d;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }

    body {
        background-color: var(--background-color);
        color: var(--text-color);
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        padding: 0.5rem 0;
        color: #64748b;
    }

    .breadcrumb a {
        color: #64748b;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        color: var(--primary-color);
    }

    .breadcrumb-separator {
        font-size: 0.8rem;
    }

    /* Back button */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        padding: 0.5rem 1rem;
        background-color: white;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        text-decoration: none;
        color: var(--text-color);
        font-weight: 500;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .back-button:hover {
        background-color: var(--hover-color);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    /* Detail card */
    .detail-card {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .detail-header {
        padding: 2rem;
        border-bottom: 1px solid var(--border-color);
        position: relative;
        background-color: #f8fafc;
    }

    .detail-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--primary-color);
    }

    .detail-subtitle {
        color: #64748b;
        font-size: 1.1rem;
        margin-right: 6rem;
        margin-bottom: 0.25rem;
    }

    .request-id {
        color: #94a3b8;
        font-size: 0.9rem;
    }

    .status-badge {
        position: absolute;
        top: 2rem;
        right: 2rem;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-new {
        background-color: rgba(37, 99, 235, 0.1);
        color: var(--nouveau-color);
    }

    .status-progress {
        background-color: rgba(234, 88, 12, 0.1);
        color: var(--encours-color);
    }

    .status-completed {
        background-color: rgba(21, 128, 61, 0.1);
        color: var(--termine-color);
    }

    .detail-body {
        padding: 2rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 2.5rem;
    }

    .info-section {
        margin-bottom: 2rem;
    }

    .info-section h3 {
        font-size: 1.1rem;
        color: #475569;
        margin-bottom: 1.25rem;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-row {
        display: flex;
        margin-bottom: 0.8rem;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-label {
        width: 150px;
        font-weight: 600;
        color: #64748b;
    }

    .info-value {
        flex: 1;
        color: #334155;
    }

    .description-section {
        margin-bottom: 2.5rem;
    }

    .description-section h3 {
        font-size: 1.1rem;
        color: #475569;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .description-content {
        padding: 1rem;
        background-color: #f8fafc;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    /* File download section */
    .file-download-section {
        background-color: #f8fafc;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
    }

    .file-download-title {
        font-size: 1.1rem;
        color: #475569;
        margin-bottom: 1.25rem;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .file-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1rem;
    }

    .file-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        width: 1000px;
        background-color: white;
        border-radius: 6px;
        border: 1px solid var(--border-color);
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .file-item:hover {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }

    .file-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex: 1;
        min-width: 0;
    }

    .file-icon {
        font-size: 1.5rem;
        color: var(--primary-color);
        flex-shrink: 0;
    }

    .file-details {
        min-width: 0;
    }

    .file-name {
        font-weight: 500;
        color: #334155;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .file-meta {
        color: #64748b;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }

    .download-btn {
        padding: 0.5rem 1rem;
        background-color: var(--primary-color);
        color: white;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        flex-shrink: 0;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .download-btn:hover {
        background-color: var(--secondary-color);
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Comments section */
    .comments-section {
        margin-top: 2.5rem;
    }

    .comments-section h3 {
        font-size: 1.1rem;
        color: #475569;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .comments-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .comment {
        margin-bottom: 0.5rem;
        padding: 1.25rem;
        background-color: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
        color: #64748b;
    }

    .comment-author {
        font-weight: 600;
        color: #334155;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .comment-date {
        color: #94a3b8;
    }

    .comment-text {
        color: #334155;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2.5rem;
    }

    .btn {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--secondary-color);
    }

    .btn-secondary {
        background-color: #f1f5f9;
        color: #475569;
    }

    .btn-secondary:hover {
        background-color: #e2e8f0;
    }

    .btn-success {
        background-color: var(--success-color);
        color: white;
    }

    .btn-success:hover {
        background-color: #15803d;
    }

    .timeline {
        position: relative;
        margin: 2rem 0;
        padding-left: 2rem;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 7px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e2e8f0;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }

    .timeline-dot {
        position: absolute;
        left: -2rem;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-color: white;
        border: 2px solid var(--primary-color);
        z-index: 1;
    }

    .timeline-content {
        padding: 1rem;
        background-color: #f8fafc;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    .timeline-date {
        color: #64748b;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
    }

    .timeline-text {
        color: #334155;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .status-badge {
            position: static;
            display: inline-flex;
            margin-top: 1rem;
        }

        .detail-header {
            padding: 1.5rem;
        }

        .detail-body {
            padding: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .file-list {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush