<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Noto+Color+Emoji&display=swap" rel="stylesheet">
    <title>Request</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container">
        <form id="stellantisForm" action="{{ url('/request') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <a href="/">
                <h2>Request</h2>
            </a>

            <div class="form-grid">
                <div class="form-group">
                    <label for="name" class="required">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="surname" class="required">Surname</label>
                    <input type="text" id="surname" name="surname" placeholder="Enter your surname" required>
                </div>
                <div class="form-group">
                    <label for="site" class="required">Site</label>
                    <input type="text" id="site" name="site" placeholder="Enter the site" required>
                </div>
                <div class="form-group">
                    <label for="id" class="required">ID</label>
                    <input type="text" id="id" name="uuid" placeholder="Enter your ID" required>
                </div>
                <div class="form-group full-width">
                    <label for="type" class="required">Request Type</label>
                    <select id="type" name="type" required>
                        <option value="">Select a type</option>
                        <option value="codification">Codification</option>
                        <option value="processing">Nomenclature Processing</option>
                        <option value="loading">Nomenclature Loading</option>
                        <option value="sheets">Stamping Sheets</option>
                        <option value="nbe">N BE</option>
                        <option value="documentation">Documentation Loading in Compass</option>
                    </select>
                </div>
            </div>

            <div id="codification" class="hidden">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="file-codif" class="required">Excel/ZIP File</label>
                        <input type="file" id="file-codif" name="file_codif" accept=".xlsx,.xls,.zip">
                    </div>
                    <div class="form-group">
                        <label for="number-articles" class="required">Number of articles to codify</label>
                        <input type="number" id="number-articles" name="numberArticles" min="1" placeholder="Enter the number of articles to codify">
                    </div>
                    <div class="form-group">
                        <label for="aoc-type">AOC/AOG</label>
                        <select id="aoc-type" name="aocType">
                            <option value="aoc">AOC</option>
                            <option value="aog">AOG</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="document-search">Document Search</label>
                        <select id="document-search" name="documentSearch">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Language</label>
                        <x-region-select />
                    </div>
                    <div class="form-group">
                        <label for="nbe-name">NBE and NBE Name</label>
                        <input type="text" id="nbe-name" name="nbeName" placeholder="According to the information in the Excel request">
                    </div>
                </div>
            </div>

            <div id="nomenclature" class="hidden">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="file-nom" class="required">Excel/ZIP File</label>
                        <input type="file" id="file-nom" name="file_nom" accept=".xlsx,.xls,.zip,.doc,.docx">
                    </div>
                    <div class="form-group">
                        <label for="document-search-nom">Document Search</label>
                        <select id="document-search-nom" name="documentSearchNom">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language-nom">Language</label>
                        <x-region-select />
                    </div>
                    <div class="form-group">
                        <label for="nbe-name-trait" class="required">N BE and N BE Name</label>
                        <input type="text" id="nbe-name-trait" name="nbeNameTrait" placeholder="According to the information in the Excel request">
                    </div>
                    <div class="form-group">
                        <label for="job" class="required">Select</label>
                        <select id="job" name="job">
                            <option value="">Select an option</option>
                            <option value="mechanical">Mechanical</option>
                            <option value="painting">Painting</option>
                            <option value="assembly">Assembly</option>
                            <option value="stamping">Stamping</option>
                            <option value="automation">Automation</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="number-lines" class="required">Number of Lines</label>
                        <select id="number-lines" name="numberLines">
                            <option value="">Select a range</option>
                            <option value="0-100">0-100</option>
                            <option value="101-300">101-300</option>
                            <option value="301-500">301-500</option>
                            <option value="501-1000">501-1000</option>
                            <option value="1000+">More than 1000</option>
                        </select>
                    </div>
                </div>
            </div>

            <div id="nbe" class="hidden">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="file-nbe" class="required">Excel/ZIP File</label>
                        <input type="file" id="file-nbe" name="file_nbe" accept=".xlsx,.xls,.zip">
                    </div>
                    <div class="form-group">
                        <label for="job-nbe" class="required">Job</label>
                        <input type="text" id="job-nbe" name="jobNbe" placeholder="Enter the Job">
                    </div>
                    <div class="form-group">
                        <label for="sector" class="required">Sector</label>
                        <input type="text" id="sector" name="sector" placeholder="Enter the sector">
                    </div>
                    <div class="form-group">
                        <label for="project-name" class="required">Project Name</label>
                        <input type="text" id="project-name" name="projectName" placeholder="Enter the Project Name">
                    </div>
                    <div class="form-group">
                        <label for="type-million" class="required">Select</label>
                        <select id="type-million" name="typeMillion">
                            <option value="">Select an option</option>
                            <option value="million1">1 million</option>
                            <option value="million2">2 million</option>
                        </select>
                    </div>
                </div>

                <div id="million1" class="hidden">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="main-function" class="required">Main Function</label>
                            <input type="text" id="main-function" name="mainFunction" placeholder="Enter the Main Function">
                        </div>
                        <div class="form-group">
                            <label for="elementary-function" class="required">Elementary Function</label>
                            <input type="text" id="elementary-function" name="elementaryFunction" placeholder="Enter the Elementary Function">
                        </div>
                        <div class="form-group">
                            <label for="number-lines-nbe" class="required">Number of Lines</label>
                            <select id="number-lines-nbe" name="numberLinesNbe">
                                <option value="">Select a range</option>
                                <option value="0-100">0-100</option>
                                <option value="101-300">101-300</option>
                                <option value="301-500">301-500</option>
                                <option value="501-1000">501-1000</option>
                                <option value="1000+">More than 1000</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="million2" class="hidden">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="technical-post">Technical Post</label>
                            <input type="text" id="technical-post" placeholder="Enter the Technical Post" name="technicalPost">
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-wrapper">
                <button type="submit" class="submit-button">Create!</button>
            </div>
            
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>