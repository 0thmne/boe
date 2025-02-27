<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Details - Pilot</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/details.css') }}">
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="{{ url('/admin') }}">
                <i class="fas fa-tasks"></i> Pilot
            </a>
        </div>
        <div class="user-profile">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <span>Admin</span>
        </div>
    </header>

    <div class="container">
        <a href="{{ url('admin/') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to list
        </a>

        <div class="detail-card">
            <div class="detail-header">
                <h1 class="detail-title">{{ __('app.request_details') }}</h1>
                <p class="detail-subtitle">{{ $requestDetails->uuid }}</p>
                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $requestDetails->status)) }}">{{ $requestDetails->status }}</span>
            </div>
            <div class="detail-body">
                <div class="info-grid">
                    <div class="info-section">
                        <h3>{{ __('app.request_information') }}</h3>

                        <div class="info-row">
                            <div class="info-label">{{ __('app.type') }}:</div>
                            <div class="info-value">
                                @if ($requestDetails->type === 'codification')
                                Codification
                                @elseif ($requestDetails->type === 'processing')
                                Nomenclature Processing
                                @elseif ($requestDetails->type === 'loading')
                                Nomenclature Loading
                                @elseif ($requestDetails->type === 'fiches')
                                Stamping Sheets
                                @elseif ($requestDetails->type === 'nbe')
                                Equipment Number
                                @elseif ($requestDetails->type === 'documentation')
                                Documentation Loading in Compass
                                @endif
                            </div>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">{{ __('app.created_on') }}:</span>
                            <span class="info-value">{{ $requestDetails->created_at ? $requestDetails->created_at->format('d/m/Y') : __('app.not_set') }}</span>
                        </div>
                        @if ($requestDetails->dateech)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.deadline') }}:</div>
                            <div class="info-value">{{ $requestDetails->due_date ? $requestDetails->due_date->format('d/m/Y') : __('app.not_set') }}</div>
                        </div>
                        @endif
                        <div class="info-row">
                            <span class="info-label">{{ __('app.completed_on') }}:</span>
                            <span class="info-value">{{ $requestDetails->completed_at ? $requestDetails->completed_at->format('d/m/Y') : __('app.not_set') }}</span>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{ __('app.status') }}:</div>
                            <div class="info-value">{{ __('app.' . strtolower($requestDetails->status)) }}</div>
                        </div>
                        @if ($requestDetails->numberArticles)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.number_of_articles') }}:</div>
                            <div class="info-value">{{ $requestDetails->numberArticles }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->aocType)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.aoc_type') }}:</div>
                            <div class="info-value">{{ $requestDetails->aocType }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->documentSearch)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.document_search') }}:</div>
                            <div class="info-value">{{ $requestDetails->documentSearch }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->language)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.language') }}:</div>
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
                            <div class="info-label">{{ __('app.nbe_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->nbeName }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->documentSearchNom)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.document_search_nom') }}:</div>
                            <div class="info-value">{{ $requestDetails->documentSearchNom }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->languageName)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.language_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->languageName }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->nbeNameTrait)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.nbe_name_trait') }}:</div>
                            <div class="info-value">{{ $requestDetails->nbeNameTrait }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->job)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.job') }}:</div>
                            <div class="info-value">{{ $requestDetails->job }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->numberLines)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.number_of_lines') }}:</div>
                            <div class="info-value">{{ $requestDetails->numberLines }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->jobNbe)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.job_nbe') }}:</div>
                            <div class="info-value">{{ $requestDetails->jobNbe }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->sector)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.sector') }}:</div>
                            <div class="info-value">{{ $requestDetails->sector }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->projectName)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.project_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->projectName }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->typeMillion)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.type_million') }}:</div>
                            <div class="info-value">{{ $requestDetails->typeMillion }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->mainFunction)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.main_function') }}:</div>
                            <div class="info-value">{{ $requestDetails->mainFunction }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->elementaryFunction)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.elementary_function') }}:</div>
                            <div class="info-value">{{ $requestDetails->elementaryFunction }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->numberLinesNbe)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.number_of_lines_nbe') }}:</div>
                            <div class="info-value">{{ $requestDetails->numberLinesNbe }}</div>
                        </div>
                        @endif
                        @if ($requestDetails->technicalPost)
                        <div class="info-row">
                            <div class="info-label">{{ __('app.technical_post') }}:</div>
                            <div class="info-value">{{ $requestDetails->technicalPost }}</div>
                        </div>
                        @endif
                    </div>

                    <div class="info-section">
                        <h3>{{ __('app.user_information') }}</h3>

                        <div class="info-row">
                            <div class="info-label">{{ __('app.id') }}:</div>
                            <div class="info-value">{{ $requestDetails->id }}</div>
                        </div>


                        <div class="info-row">
                            <div class="info-label">{{ __('app.last_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->surname }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{ __('app.first_name') }}:</div>
                            <div class="info-value">{{ $requestDetails->name }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">{{ __('app.site') }}:</div>
                            <div class="info-value">{{ $requestDetails->site }}</div>
                        </div>

                    </div>
                </div>

                <!-- New file download section -->
                <div class="file-download-section">
                    <h3 class="file-download-title">
                        <i class="fas fa-file-download"></i> {{ __('app.files') }}
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
                            <i class="fas fa-download"></i> {{ __('app.download') }}
                        </a>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</body>

</html>