<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Noto+Color+Emoji&display=swap" rel="stylesheet">
    <title>Demande</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container">
        <form id="stellantisForm" action="{{ url('/demande') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <a href="/">
                <h2>Demandez</h2>
            </a>

            <div class="form-grid">
                <div class="form-group">
                    <label for="nom" class="required">Nom</label>
                    <input type="text" id="nom" name="nom" placeholder="Entrez votre nom " required>
                </div>
                <div class="form-group">
                    <label for="prenom" class="required">Prénom</label>
                    <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prenom " required>
                </div>
                <div class="form-group">
                    <label for="site" class="required">Site</label>
                    <input type="text" id="site" name="site" placeholder="Entrez le site " required>
                </div>
                <div class="form-group">
                    <label for="id" class="required">ID</label>
                    <input type="text" id="id" name="id" placeholder="Entrez votre ID  " required>
                </div>
                <div class="form-group full-width">
                    <label for="type" class="required">Type de Demande</label>
                    <select id="type" name="type" required>
                        <option value="">Sélectionnez un type</option>
                        <option value="codification">Codification</option>
                        <option value="traitement">Traitement Nomenclature</option>
                        <option value="chargement">Chargement Nomenclature</option>
                        <option value="fiches">Fiches D'emboutissage</option>
                        <option value="nbe">N BE</option>
                        <option value="documentation">Chargement Documentation Dans Compas</option>
                    </select>
                </div>
            </div>

            <div id="codification" class="hidden">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="fichier-codif" class="required">Fichier Excel/ZIP</label>
                        <input type="file" id="fichier-codif" name="fichier" accept=".xlsx,.xls,.zip">
                    </div>
                    <div class="form-group">
                        <label for="nombre-articles" class="required">Nombre des articles à codifier</label>
                        <input type="number" id="nombre-articles" name="nombreArticles" min="1" placeholder="Entrez le nombre des articles à codifier">
                    </div>
                    <div class="form-group">
                        <label for="aoc-type">AOC/AOG</label>
                        <select id="aoc-type" name="aocType">
                            <option value="aoc">AOC</option>
                            <option value="aog">AOG</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recherche-doc">Recherche Document</label>
                        <select id="recherche-doc" name="rechercheDoc">
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="langue">Langue</label>
                        <x-region-select />
                    </div>
                    <div class="form-group">
                        <label for="nbe-nom">NBE et Nom NBE</label>
                        <input type="text" id="nbe-nom" name="nbeNom" placeholder="Suivant les infos dans la demande Excel">
                    </div>
                </div>
            </div>

            <div id="nomenclature" class="hidden">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="fichier-nom" class="required">Fichier Excel/ZIP/Word</label>
                        <input type="file" id="fichier-nom" name="fichierNom" accept=".xlsx,.xls,.zip,.doc,.docx">
                    </div>
                    <div class="form-group">
                        <label for="recherche-doc-nom">Recherche Document</label>
                        <select id="recherche-doc-nom" name="rechercheDocNom">
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="langue-nom">Langue</label>
                        <x-region-select />
                    </div>
                    <div class="form-group">
                        <label for="nbe-nom-trait" class="required">N BE et Nom N BE</label>
                        <input type="text" id="nbe-nom-trait" name="nbeNomTrait" placeholder="Suivant les infos dans la demande Excel">
                    </div>
                    <div class="form-group">
                        <label for="metier" class="required">Sélectionner</label>
                        <select id="metier" name="metier">
                            <option value="">Sélectionnez une option</option>
                            <option value="mecanique">Mécanique</option>
                            <option value="peinture">Peinture</option>
                            <option value="montage">Montage</option>
                            <option value="emboutissage">Emboutissage</option>
                            <option value="automatisme">Automatisme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre-lignes" class="required">Nombre des Lignes</label>
                        <select id="nombre-lignes" name="nombreLignes">
                            <option value="">Sélectionnez une plage</option>
                            <option value="0-100">0-100</option>
                            <option value="101-300">101-300</option>
                            <option value="301-500">301-500</option>
                            <option value="501-1000">501-1000</option>
                            <option value="1000+">Plus de 1000</option>
                        </select>
                    </div>
                </div>
            </div>

            <div id="nbe" class="hidden">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="fichier-nbe" class="required">Fichier Excel/ZIP</label>
                        <input type="file" id="fichier-nbe" name="fichierNbe" accept=".xlsx,.xls,.zip">
                    </div>
                    <div class="form-group">
                        <label for="metier-nbe" class="required">Métier</label>
                        <input type="text" id="metier-nbe" name="metierNbe" placeholder="Entrez la Métier">
                    </div>
                    <div class="form-group">
                        <label for="secteur" class="required">Secteur</label>
                        <input type="text" id="secteur" name="secteur" placeholder="Entrez le secteur">
                    </div>
                    <div class="form-group">
                        <label for="nom-projet" class="required">Nom Projet</label>
                        <input type="text" id="nom-projet" name="nomProjet" placeholder="Entrez le Nom du Projet">
                    </div>
                    <div class="form-group">
                        <label for="type-million" class="required">Sélectionnez</label>
                        <select id="type-million" name="typeMillion">
                            <option value="">Sélectionnez une option</option>
                            <option value="million1">1 million</option>
                            <option value="million2">2 million</option>
                        </select>
                    </div>
                </div>

                <div id="million1" class="hidden">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="fonction-principale" class="required">Fonction Principale</label>
                            <input type="text" id="fonction-principale" name="fonctionPrincipale" placeholder="Entrez la fonction Principale">
                        </div>
                        <div class="form-group">
                            <label for="fonction-elementaire" class="required">Fonction Élémentaire</label>
                            <input type="text" id="fonction-elementaire" name="fonctionElementaire" placeholder="Entrez la Fonction Élémentaire">
                        </div>
                        <div class="form-group">
                            <label for="nombre-lignes-nbe" class="required">Nombre des Lignes</label>
                            <select id="nombre-lignes-nbe" name="nombreLignesNbe">
                                <option value="">Sélectionnez une plage</option>
                                <option value="0-100">0-100</option>
                                <option value="101-300">101-300</option>
                                <option value="301-500">301-500</option>
                                <option value="501-1000">500-1000</option>
                                <option value="1000+">Plus de 1000</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="million2" class="hidden">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="poste-technique">Poste Technique</label>
                            <input type="text" id="poste-technique" placeholder="Entrez le Poste Technique" name="posteTechnique">
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-wrapper">
                <button type="submit" class="submit-button">Créer !</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>