<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Noto+Color+Emoji&display=swap" rel="stylesheet">
    <title>{{ __('app.request_form') }}</title>
    <link rel="stylesheet" href="{{ asset('css/pilote.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
</head>

<body>
    <!-- @include('components.header-admin') -->

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-title">
            <h2>{{ __('app.request_form') }}</h2>
        </div>

        <form id="stellantisForm" action="{{ url('/request') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="name" class="required">{{ __('form.name') }}</label>
                    <input type="text" id="name" name="name" placeholder="{{ __('form.enter_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="surname" class="required">{{ __('form.surname') }}</label>
                    <input type="text" id="surname" name="surname" placeholder="{{ __('form.enter_surname') }}" required>
                </div>
                <div class="form-group">
                    <label for="site" class="required">{{ __('form.site') }}</label>
                    <input type="text" id="site" name="site" placeholder="{{ __('form.enter_site') }}" required>
                </div>
                <div class="form-group">
                    <label for="id" class="required">{{ __('form.id') }}</label>
                    <input type="text" id="id" name="uuid" placeholder="{{ __('form.enter_id') }}" required>
                </div>
                <div class="form-group full-width">
                    <label for="type" class="required">{{ __('form.request_type') }}</label>
                    <select id="type" name="type" required>
                        <option value="">{{ __('form.select_type') }}</option>
                        <option value="codification">{{ __('form.codification') }}</option>
                        <option value="processing">{{ __('form.nomenclature_processing') }}</option>
                        <option value="loading">{{ __('form.nomenclature_loading') }}</option>
                        <option value="sheets">{{ __('form.stamping_sheets') }}</option>
                        <option value="nbe">{{ __('form.equipment_number') }}</option>
                        <option value="documentation">{{ __('form.documentation_loading') }}</option>
                    </select>
                </div>
            </div>

            <div id="codification" class="hidden">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="file-codif" class="required">{{ __('form.excel_zip_file') }}</label>
                        <input type="file" id="file-codif" name="file_codif" accept=".xlsx,.xls,.zip">
                    </div>
                    <div class="form-group">
                        <label for="number-articles" class="required">{{ __('form.number_articles') }}</label>
                        <input type="number" id="number-articles" name="numberArticles" min="1" placeholder="{{ __('form.enter_number_articles') }}">
                    </div>
                    <div class="form-group">
                        <label for="aoc-type">{{ __('form.aoc_type') }}</label>
                        <select id="aoc-type" name="aocType">
                            <option value="aoc">AOC</option>
                            <option value="aog">AOG</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="document-search">{{ __('form.document_search') }}</label>
                        <select id="document-search" name="documentSearch">
                            <option value="yes">{{ __('form.yes') }}</option>
                            <option value="no">{{ __('form.no') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">{{ __('form.language') }}</label>
                        <x-region-select />
                    </div>
                    <div class="form-group">
                        <label for="nbe-name">{{ __('form.nbe_name') }}</label>
                        <input type="text" id="nbe-name" name="nbeName" placeholder="{{ __('form.nbe_name_placeholder') }}">
                    </div>
                </div>
            </div>

            <div id="nomenclature" class="hidden">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="file-nom" class="required">{{ __('form.excel_zip_file') }}</label>
                        <input type="file" id="file-nom" name="file_nom" accept=".xlsx,.xls,.zip,.doc,.docx">
                    </div>
                    <div class="form-group">
                        <label for="document-search-nom">{{ __('form.document_search') }}</label>
                        <select id="document-search-nom" name="documentSearchNom">
                            <option value="yes">{{ __('form.yes') }}</option>
                            <option value="no">{{ __('form.no') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language-nom">{{ __('form.language') }}</label>
                        <x-region-select />
                    </div>
                    <div class="form-group">
                        <label for="nbe-name-trait" class="required">{{ __('form.nbe_name_trait') }}</label>
                        <input type="text" id="nbe-name-trait" name="nbeNameTrait" placeholder="{{ __('form.nbe_name_trait_placeholder') }}">
                    </div>
                    <div class="form-group">
                        <label for="job" class="required">{{ __('form.select') }}</label>
                        <select id="job" name="job">
                            <option value="">{{ __('form.select_option') }}</option>
                            <option value="mechanical">{{ __('form.mechanical') }}</option>
                            <option value="painting">{{ __('form.painting') }}</option>
                            <option value="assembly">{{ __('form.assembly') }}</option>
                            <option value="stamping">{{ __('form.stamping') }}</option>
                            <option value="automation">{{ __('form.automation') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="number-lines" class="required">{{ __('form.number_lines') }}</label>
                        <select id="number-lines" name="numberLines">
                            <option value="">{{ __('form.select_range') }}</option>
                            <option value="0-100">0-100</option>
                            <option value="101-300">101-300</option>
                            <option value="301-500">301-500</option>
                            <option value="501-1000">501-1000</option>
                            <option value="1000+">{{ __('form.more_than_1000') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div id="nbe" class="hidden">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="file-nbe" class="required">{{ __('form.excel_zip_file') }}</label>
                        <input type="file" id="file-nbe" name="file_nbe" accept=".xlsx,.xls,.zip">
                    </div>
                    <div class="form-group">
                        <label for="job-nbe" class="required">{{ __('form.job') }}</label>
                        <input type="text" id="job-nbe" name="jobNbe" placeholder="{{ __('form.enter_job') }}">
                    </div>
                    <div class="form-group">
                        <label for="sector" class="required">{{ __('form.sector') }}</label>
                        <input type="text" id="sector" name="sector" placeholder="{{ __('form.enter_sector') }}">
                    </div>
                    <div class="form-group">
                        <label for="project-name" class="required">{{ __('form.project_name') }}</label>
                        <input type="text" id="project-name" name="projectName" placeholder="{{ __('form.enter_project_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="type-million" class="required">{{ __('form.select') }}</label>
                        <select id="type-million" name="typeMillion">
                            <option value="">{{ __('form.select_option') }}</option>
                            <option value="million1">{{ __('form.million1') }}</option>
                            <option value="million2">{{ __('form.million2') }}</option>
                        </select>
                    </div>
                </div>

                <div id="million1" class="hidden">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="main-function" class="required">{{ __('form.main_function') }}</label>
                            <input type="text" id="main-function" name="mainFunction" placeholder="{{ __('form.enter_main_function') }}">
                        </div>
                        <div class="form-group">
                            <label for="elementary-function" class="required">{{ __('form.elementary_function') }}</label>
                            <input type="text" id="elementary-function" name="elementaryFunction" placeholder="{{ __('form.enter_elementary_function') }}">
                        </div>
                        <div class="form-group">
                            <label for="number-lines-nbe" class="required">{{ __('form.number_lines') }}</label>
                            <select id="number-lines-nbe" name="numberLinesNbe">
                                <option value="">{{ __('form.select_range') }}</option>
                                <option value="0-100">0-100</option>
                                <option value="101-300">101-300</option>
                                <option value="301-500">301-500</option>
                                <option value="501-1000">501-1000</option>
                                <option value="1000+">{{ __('form.more_than_1000') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="million2" class="hidden">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="technical-post">{{ __('form.technical_post') }}</label>
                            <input type="text" id="technical-post" placeholder="{{ __('form.enter_technical_post') }}" name="technicalPost">
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-wrapper">
                <button type="submit" class="submit-button">{{ __('form.create') }}</button>
            </div>

        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>