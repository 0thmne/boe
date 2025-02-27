<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('details.title') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/details.css') }}">
    <style>
        .info-label::after {
            content: ':';
        }
    </style>
</head>

<body>
    @include('components.header-admin')

    <div class="container">
        <a href="{{ url('admin/') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> {{ trans('details.back_to_list') }}
        </a>

        <div class="detail-card">
            <div class="detail-header">
                <h1 class="detail-title">{{ trans('details.request') }} {{ trans('details.' . $requestDetails->type) }}</h1>
                <p class="detail-subtitle">{{ $requestDetails->uuid }}</p>
                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $requestDetails->status)) }}">
                    {{ trans('details.' . strtolower(str_replace(' ', '_', $requestDetails->status))) }}
                </span>
            </div>
            <div class="detail-body">
                <div class="info-grid">
                    <div class="info-section">
                        <h3>{{ trans('details.request_information') }}</h3>

                        <div class="info-row">
                            <div class="info-label">{{ trans('details.type') }}</div>
                            <div class="info-value">
                                {{ trans('details.' . $requestDetails->type) }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{ __('details.created_on') }}</div>
                            <div class="info-value">{{ $requestDetails->created_at->format('d/m/Y') }}</div>
                        </div>
                        @if ($requestDetails->dateech)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.deadline') }}</div>
                            <div class="info-value">{{ $requestDetails->due_date }}</div>
                        </div>
                        @endif
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.end_date') }}</div>
                            <div class="info-value">{{ $requestDetails->due_date->format('d/m/Y') }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{ __('details.status') }}</div>
                            <div class="info-value">{{ trans('details.' . strtolower(str_replace(' ', '_', $requestDetails->status))) }}</div>
                        </div>
                        @if ($requestDetails->numberArticles)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.number_of_articles') }}</div>
                            <div class="info-value">{{ $requestDetails->numberArticles }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->aocType)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.aoc_type') }}</div>
                            <div class="info-value">{{ $requestDetails->aocType }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->documentSearch)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.document_search') }}</div>
                            <div class="info-value">{{ $requestDetails->documentSearch }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->language)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.language') }}</div>
                            <div class="info-value">
                                {{ __('details.languages.' . $requestDetails->language) }}
                            </div>
                        </div>
                        @endif
                        @if ($requestDetails->nbeName)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.nbe_name') }}</div>
                            <div class="info-value">{{ $requestDetails->nbeName }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->documentSearchNom)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.document_search_nom') }}</div>
                            <div class="info-value">{{ $requestDetails->documentSearchNom }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->languageName)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.language_name') }}</div>
                            <div class="info-value">{{ $requestDetails->languageName }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->nbeNameTrait)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.nbe_name_trait') }}</div>
                            <div class="info-value">{{ $requestDetails->nbeNameTrait }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->job)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.job') }}</div>
                            <div class="info-value">{{ $requestDetails->job }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->numberLines)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.number_lines') }}</div>
                            <div class="info-value">{{ $requestDetails->numberLines }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->jobNbe)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.job_nbe') }}</div>
                            <div class="info-value">{{ $requestDetails->jobNbe }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->sector)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.sector') }}</div>
                            <div class="info-value">{{ $requestDetails->sector }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->projectName)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.project_name') }}</div>
                            <div class="info-value">{{ $requestDetails->projectName }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->typeMillion)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.type_million') }}</div>
                            <div class="info-value">{{ $requestDetails->typeMillion }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->mainFunction)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.main_function') }}</div>
                            <div class="info-value">{{ $requestDetails->mainFunction }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->elementaryFunction)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.elementary_function') }}</div>
                            <div class="info-value">{{ $requestDetails->elementaryFunction }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->numberLinesNbe)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.number_lines_nbe') }}</div>
                            <div class="info-value">{{ $requestDetails->numberLinesNbe }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->technicalPost)
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.technical_post') }}</div>
                            <div class="info-value">{{ $requestDetails->technicalPost }}</div>
                        </div>
                        @endif
                    </div>

                    <div class="info-section">
                        <h3>{{ trans('details.user_information') }}</h3>

                        <div class="info-row">
                            <div class="info-label">{{ __('details.id') }}</div>
                            <div class="info-value">{{ $requestDetails->id }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">{{ trans('details.last_name') }}</div>
                            <div class="info-value">{{ $requestDetails->surname }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{ trans('details.first_name') }}</div>
                            <div class="info-value">{{ $requestDetails->name }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">{{ trans('details.site') }}</div>
                            <div class="info-value">{{ $requestDetails->site }}</div>
                        </div>
                    </div>
                </div>

                <!-- New file download section -->
                <div class="file-download-section">
                    <h3 class="file-download-title">
                        <i class="fas fa-file-download"></i> {{ trans('details.files') }}
                    </h3>
                    @foreach (json_decode($requestDetails->file_client, true) as $file)
                    <div class="file-item">
                        <div class="file-info">
                            <div class="file-icon">
                                <i class="fas fa-file"></i>
                            </div>
                            <div>
                                <div class="file-name">{{ basename($file) }}</div>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $file) }}" class="download-btn" download="{{ basename($file) }}">
                            <i class="fas fa-download"></i> {{ trans('details.download') }}
                        </a>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</body>

</html>