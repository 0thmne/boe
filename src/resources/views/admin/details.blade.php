<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Professional Request Processing Interface">
    <title>{{ __('app.pilot_interface') }} - {{ __('details.request_details') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/details.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pilote.css') }}">

</head>

<body>
    @include('components.header-admin')

    <div class="container">
        <a href="{{ url('admin/') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> {{ __('details.back_to_list') }}
        </a>

        <div class="detail-card">
            <div class="detail-header">
                <h1 class="detail-title">{{ __('details.request_details') }}</h1>
                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $requestDetails->status)) }}">
                    @if($requestDetails->status == 'In Progress')
                    {{ __('app.in_progress') }}
                    @else
                    {{ __('app.' . strtolower($requestDetails->status)) }}
                    @endif
                </span>
                <div class="assigned-to">
                    <span class="info-label">{{ __('details.assigned_to') }}:</span>
                    <span class="info-value">
                        @if($requestDetails->assigned_to && $requestDetails->assignedAgent)
                        {{ $requestDetails->assignedAgent->surname }} {{ $requestDetails->assignedAgent->name }}
                        @else
                        {{ __('details.not_assigned') }}
                        @endif
                    </span>
                </div>
            </div>

            <div class="detail-body">
                <div class="info-grid">
                    <div class="info-section">
                        <h3>{{ __('details.request_information') }}</h3>

                        <div class="info-row">
                            <div class="info-label">{{ __('details.type') }}:</div>
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
                            <span class="info-label">{{ __('details.created_on') }}:</span>
                            <span class="info-value">{{ $requestDetails->created_at ? $requestDetails->created_at->format('d/m/Y') : __('details.not_set') }}</span>
                        </div>
                        @if ($requestDetails->dateech)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.deadline') }}:</div>
                            <div class="info-value">{{ $requestDetails->due_date ? $requestDetails->due_date->format('d/m/Y') : __('details.not_set') }}</div>
                        </div>
                        @endif
                        <div class="info-row">
                            <span class="info-label">{{ __('details.completed_on') }}:</span>
                            <span class="info-value">{{ $requestDetails->completed_at ? $requestDetails->completed_at->format('d/m/Y') : __('details.not_set') }}</span>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{ __('details.status') }}:</div>
                            <div class="info-value">
                                @if($requestDetails->status == 'In Progress')
                                {{ __('app.in_progress') }}
                                @else
                                {{ __('app.' . strtolower($requestDetails->status)) }}
                                @endif
                            </div>
                        </div>
                        @if ($requestDetails->numberArticles)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.number_of_articles') }}:</div>
                            <div class="info-value">{{ $requestDetails->numberArticles }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->aocType)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.aoc_type') }}:</div>
                            <div class="info-value">{{ $requestDetails->aocType }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->documentSearch)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.document_search') }}:</div>
                            <div class="info-value">{{ $requestDetails->documentSearch }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->language)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.language') }}:</div>
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
                        @if ($requestDetails->nbeName)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.nbe_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->nbeName }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->documentSearchNom)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.document_search_nom') }}:</div>
                            <div class="info-value">{{ $requestDetails->documentSearchNom }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->languageName)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.language_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->languageName }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->nbeNameTrait)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.nbe_name_trait') }}:</div>
                            <div class="info-value">{{ $requestDetails->nbeNameTrait }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->job)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.job') }}:</div>
                            <div class="info-value">{{ $requestDetails->job }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->numberLines)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.number_of_lines') }}:</div>
                            <div class="info-value">{{ $requestDetails->numberLines }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->jobNbe)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.job_nbe') }}:</div>
                            <div class="info-value">{{ $requestDetails->jobNbe }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->sector)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.sector') }}:</div>
                            <div class="info-value">{{ $requestDetails->sector }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->projectName)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.project_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->projectName }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->typeMillion)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.type_million') }}:</div>
                            <div class="info-value">{{ $requestDetails->typeMillion }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->mainFunction)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.main_function') }}:</div>
                            <div class="info-value">{{ $requestDetails->mainFunction }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->elementaryFunction)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.elementary_function') }}:</div>
                            <div class="info-value">{{ $requestDetails->elementaryFunction }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->numberLinesNbe)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.number_of_lines_nbe') }}:</div>
                            <div class="info-value">{{ $requestDetails->numberLinesNbe }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->technicalPost)
                        <div class="info-row">
                            <div class="info-label">{{ __('details.technical_post') }}:</div>
                            <div class="info-value">{{ $requestDetails->technicalPost }}</div>
                        </div>
                        @endif
                    </div>

                    <div class="info-section">
                        <h3>{{ __('details.user_information') }}</h3>

                        <div class="info-row">
                            <div class="info-label">{{ __('details.id') }}:</div>
                            <div class="info-value">{{ $requestDetails->uuid }}</div>
                        </div>


                        <div class="info-row">
                            <div class="info-label">{{ __('details.last_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->surname }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{ __('details.first_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->name }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">{{ __('details.site') }}:</div>
                            <div class="info-value">{{ $requestDetails->site }}</div>
                        </div>

                    </div>
                </div>

                <!-- New file download section -->
                <div class="file-download-section">
                    <h3 class="file-download-title">
                        <i class="fas fa-file-download"></i> {{ __('details.files') }}
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
                            <i class="fas fa-download"></i> {{ __('details.download') }}
                        </a>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</body>

</html>