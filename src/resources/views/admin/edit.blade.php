<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('app.pilot_interface') }} - {{ __('app.edit') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/pilote.css') }}">

</head>

<body>
    @include('components.header-admin')

    <div class="container">
        <a href="{{ url('admin/') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to list
        </a>

        <form action="{{ route('edit.update', $requestDetails->uuid) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h2>Edit Request</h2>

            <div class="form-grid">
                <!-- Request Information -->
                <div class="form-section full-width">
                    <h3>Request Information</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" value="{{ $requestDetails->type }}" readonly disabled>
                        </div>

                        <div class="form-group">
                            <label>Creation Date</label>
                            <input type="text" value="{{ $requestDetails->created_at->format('d/m/Y') }}" readonly disabled>
                        </div>
                    </div>

                    @if ($requestDetails->numberArticles || $requestDetails->aocType)
                    <div class="form-row">
                        @if ($requestDetails->numberArticles)
                        <div class="form-group">
                            <label>Number of Articles</label>
                            <input type="text" value="{{ $requestDetails->numberArticles }}" readonly disabled>
                        </div>
                        @endif

                        @if ($requestDetails->aocType)
                        <div class="form-group">
                            <label>AOC Type</label>
                            <input type="text" value="{{ $requestDetails->aocType }}" readonly disabled>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if ($requestDetails->documentSearch || $requestDetails->language)
                    <div class="form-row">
                        @if ($requestDetails->documentSearch)
                        <div class="form-group">
                            <label>Document Search</label>
                            <input type="text" value="{{ $requestDetails->documentSearch }}" readonly disabled>
                        </div>
                        @endif

                        @if ($requestDetails->language)
                        <div class="form-group">
                            <label>Language</label>
                            @php
                                $languageMap = [
                                    '3N' => 'English SG',
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
                            <input type="text" value="{{ $languageMap[$requestDetails->language] ?? $requestDetails->language }}" readonly disabled>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if ($requestDetails->nbeName)
                    <div class="form-group">
                        <label>NBE Name</label>
                        <input type="text" value="{{ $requestDetails->nbeName }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->documentSearchNom)
                    <div class="form-group">
                        <label>Document Search Nom</label>
                        <input type="text" value="{{ $requestDetails->documentSearchNom }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->languageName)
                    <div class="form-group">
                        <label>Language Name</label>
                        <input type="text" value="{{ $requestDetails->languageName }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->nbeNameTrait)
                    <div class="form-group">
                        <label>NBE Name Trait</label>
                        <input type="text" value="{{ $requestDetails->nbeNameTrait }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->job)
                    <div class="form-group">
                        <label>Job</label>
                        <input type="text" value="{{ $requestDetails->job }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->numberLines)
                    <div class="form-group">
                        <label>Number of Lines</label>
                        <input type="text" value="{{ $requestDetails->numberLines }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->jobNbe)
                    <div class="form-group">
                        <label>Job NBE</label>
                        <input type="text" value="{{ $requestDetails->jobNbe }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->sector)
                    <div class="form-group">
                        <label>Sector</label>
                        <input type="text" value="{{ $requestDetails->sector }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->projectName)
                    <div class="form-group">
                        <label>Project Name</label>
                        <input type="text" value="{{ $requestDetails->projectName }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->typeMillion)
                    <div class="form-group">
                        <label>Type Million</label>
                        <input type="text" value="{{ $requestDetails->typeMillion }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->mainFunction)
                    <div class="form-group">
                        <label>Main Function</label>
                        <input type="text" value="{{ $requestDetails->mainFunction }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->elementaryFunction)
                    <div class="form-group">
                        <label>Elementary Function</label>
                        <input type="text" value="{{ $requestDetails->elementaryFunction }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->numberLinesNbe)
                    <div class="form-group">
                        <label>Number of Lines NBE</label>
                        <input type="text" value="{{ $requestDetails->numberLinesNbe }}" readonly disabled>
                    </div>
                    @endif

                    @if ($requestDetails->technicalPost)
                    <div class="form-group">
                        <label>Technical Post</label>
                        <input type="text" value="{{ $requestDetails->technicalPost }}" readonly disabled>
                    </div>
                    @endif
                </div>

                <!-- Editable Fields -->
                <div class="form-section full-width">
                    <h3>Management Information</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="assigned_to">Assigned to</label>
                            <select name="assigned_to" id="assigned_to">
                                <option value="">Select Agent</option>
                                @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ $requestDetails->assigned_to == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->surname }} {{ $agent->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">{{ __('details.status') }}</label>
                            <select name="status" id="status" class="status-select" required onchange="updateStatusStyle(this)">
                                <option value="New" {{ $requestDetails->status == 'New' ? 'selected' : '' }}>{{ __('app.new') }}</option>
                                <option value="In Progress" {{ $requestDetails->status == 'In Progress' ? 'selected' : '' }}>{{ __('app.in_progress') }}</option>
                                <option value="Completed" {{ $requestDetails->status == 'Completed' ? 'selected' : '' }}>{{ __('app.completed') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="date" id="due_date" name="due_date" value="{{ $requestDetails->due_date ? $requestDetails->due_date->format('Y-m-d') : '' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Request Description</label>
                        <textarea id="description" name="description" rows="4">{{ $requestDetails->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <textarea id="comments" name="comments" rows="4">{{ $requestDetails->comments }}</textarea>
                    </div>

                    <!-- Add File Section -->
                    @if($requestDetails->file_client && json_decode($requestDetails->file_client, true))
                    <div class="form-section full-width">
                        <h3>Files Management</h3>
                        <div class="form-grid">
                            <div class="form-group full-width">
                                <div class="files-management-container">

                                    <div class="current-files-section">
                                        <label>Current Files</label>
                                        <div class="file-list">
                                            @foreach (json_decode($requestDetails->file_client, true) as $file)
                                            <div class="file-item">
                                                <div class="file-info">
                                                    <i class="fas fa-file"></i>
                                                    <span class="file-name">{{ basename($file) }}</span>
                                                </div>
                                                <a href="{{ asset('storage/' . $file) }}" class="download-btn" download="{{ basename($file) }}">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>


                                    <div class="new-files-section">
                                        <label for="new_files">New Files</label>
                                        <input type="file"
                                            id="new_files"
                                            name="new_files[]"
                                            multiple
                                            accept=".xlsx,.xls,.zip,.doc,.docx"
                                            class="custom-file-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endif

            <div class="button-wrapper">
                <button type="submit" class="submit-button">Update Request</button>
            </div>
        </form>
    </div>

    <script>
        function updateStatusStyle(select) {
            // Remove all existing status classes
            select.classList.remove('status-New', 'status-In-Progress', 'status-Completed');

            // Add the appropriate class based on selection
            let statusClass = 'status-' + select.value.replace(' ', '-');
            select.classList.add(statusClass);
        }

        // Initialize status style on page load
        document.addEventListener('DOMContentLoaded', function() {
            let statusSelect = document.getElementById('status');
            updateStatusStyle(statusSelect);
        });
    </script>
</body>

</html>