<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Noto+Color+Emoji&display=swap" rel="stylesheet">
    <title>Demande</title>
    <style>
        
        :root {
            --primary-color: #243782;
            --hover-color: #2a4098;
            --error-color: #ff4444;
            --border-color: #ddd;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            
        }

        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        form {
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px var(--shadow-color);
        }

        h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            position: relative;
            padding-bottom: 10px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), #90ebe398);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }

        .required::after {
            content: '*';
            color: var(--error-color);
            margin-left: 4px;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 5px rgba(36, 55, 130, 0.2);
        }

        .hidden {
            display: none;
        }

        .button-wrapper {
            text-align: center;
            margin-top: 30px;
        }

        .submit-button {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            background-color: var(--hover-color);
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            form {
                padding: 20px;
            }
        }
        .form-group select {
            font-family: 'Nunito', 'Noto Color Emoji', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <form id="stellantisForm" novalidate>
           <a href="./index.html"><h2>Demandez</h2></a> 
            
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
                        <input type="file" id="fichier-codif" name="fichier" required accept=".xlsx,.xls,.zip">
                    </div>
                    <div class="form-group">
                        <label for="nombre-articles" class="required">Nombre des articles à codifier</label>
                        <input type="number" id="nombre-articles" name="nombreArticles" min="1" placeholder="Entrez le nombre des articles à codifier" required>
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
                        <select id="recherche-doc" name="rechercheDoc" >
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="langue">Langue</label>
                        <select id="langue" name="langue" required>
                            <option value="3N">🇬🇧 Anglais SG</option>
                            <option value="A7">🇦🇺 Australien</option>
                            <option value="AF">🇿🇦 Afrikaans</option>
                            <option value="AR">🇸🇦 Arabe</option>
                            <option value="BG">🇧🇬 Bulgare</option>
                            <option value="CA">🇪🇸 Catalan</option>
                            <option value="CS">🇨🇿 Tchéque</option>
                            <option value="DA">🇩🇰 Danois</option>
                            <option value="DE">🇩🇪 Allemand</option>
                            <option value="EL">🇬🇷 Grec</option>
                            <option value="EN">🇬🇧 Anglais</option>
                            <option value="ES">🇪🇸 Espagnol</option>
                            <option value="ET">🇪🇪 Estonien</option>
                            <option value="FI">🇫🇮 Finnois</option>
                            <option value="FR">🇫🇷 Francais</option>
                            <option value="HE">🇮🇱 Hébreu</option>
                            <option value="HI">🇮🇳 Hindi</option>
                            <option value="HR">🇭🇷 Croate</option>
                            <option value="HU">🇭🇺 Hongrois</option>
                            <option value="ID">🇮🇩 Indonésien</option>
                            <option value="IS">🇮🇸 Islandais</option>
                            <option value="IT">🇮🇹 Italien</option>
                            <option value="JA">🇯🇵 Japonais</option>
                            <option value="KK">🇰🇿 Kazakh</option>
                            <option value="KO">🇰🇷 Coréen</option>
                            <option value="LT">🇱🇹 Lituanien</option>
                            <option value="LV">🇱🇻 Letton</option>
                            <option value="MS">🇲🇾 Malais</option>
                            <option value="NL">🇳🇱 Néerlandais</option>
                            <option value="NO">🇳🇴 Norvégien</option>
                            <option value="PL">🇵🇱 Polonais</option>
                            <option value="RO">🇷🇴 Roumain</option>
                            <option value="RU">🇷🇺 Russe</option>
                            <option value="SH">🇷🇸 Serbe (latin)</option>
                            <option value="SK">🇸🇰 Slovaque</option>
                            <option value="SL">🇸🇮 Slovène</option>
                            <option value="SR">🇷🇸 Serbe</option>
                            <option value="SV">🇸🇪 Suédois</option>
                            <option value="TH">🇹🇭 Thai</option>
                            <option value="TR">🇹🇷 Turc</option>
                            <option value="UK">🇺🇦 Ukrainien</option>
                            <option value="VI">🇻🇳 Vietnamien</option>
                            <option value="Z1">Z1 Réserve client</option>
                            <option value="ZF">🇹🇼 Chinois trad.</option>
                            <option value="ZH">🇨🇳 Chinois</option>
                        </select>
        
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
                        <input type="file" id="fichier-nom" name="fichierNom" required accept=".xlsx,.xls,.zip,.doc,.docx">
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
                        <select id="langue" name="langue" required>
                            <option value="3N">🇬🇧 Anglais SG</option>
                            <option value="A7">🇦🇺 Australien</option>
                            <option value="AF">🇿🇦 Afrikaans</option>
                            <option value="AR">🇸🇦 Arabe</option>
                            <option value="BG">🇧🇬 Bulgare</option>
                            <option value="CA">🇪🇸 Catalan</option>
                            <option value="CS">🇨🇿 Tchéque</option>
                            <option value="DA">🇩🇰 Danois</option>
                            <option value="DE">🇩🇪 Allemand</option>
                            <option value="EL">🇬🇷 Grec</option>
                            <option value="EN">🇬🇧 Anglais</option>
                            <option value="ES">🇪🇸 Espagnol</option>
                            <option value="ET">🇪🇪 Estonien</option>
                            <option value="FI">🇫🇮 Finnois</option>
                            <option value="FR">🇫🇷 Francais</option>
                            <option value="HE">🇮🇱 Hébreu</option>
                            <option value="HI">🇮🇳 Hindi</option>
                            <option value="HR">🇭🇷 Croate</option>
                            <option value="HU">🇭🇺 Hongrois</option>
                            <option value="ID">🇮🇩 Indonésien</option>
                            <option value="IS">🇮🇸 Islandais</option>
                            <option value="IT">🇮🇹 Italien</option>
                            <option value="JA">🇯🇵 Japonais</option>
                            <option value="KK">🇰🇿 Kazakh</option>
                            <option value="KO">🇰🇷 Coréen</option>
                            <option value="LT">🇱🇹 Lituanien</option>
                            <option value="LV">🇱🇻 Letton</option>
                            <option value="MS">🇲🇾 Malais</option>
                            <option value="NL">🇳🇱 Néerlandais</option>
                            <option value="NO">🇳🇴 Norvégien</option>
                            <option value="PL">🇵🇱 Polonais</option>
                            <option value="RO">🇷🇴 Roumain</option>
                            <option value="RU">🇷🇺 Russe</option>
                            <option value="SH">🇷🇸 Serbe (latin)</option>
                            <option value="SK">🇸🇰 Slovaque</option>
                            <option value="SL">🇸🇮 Slovène</option>
                            <option value="SR">🇷🇸 Serbe</option>
                            <option value="SV">🇸🇪 Suédois</option>
                            <option value="TH">🇹🇭 Thai</option>
                            <option value="TR">🇹🇷 Turc</option>
                            <option value="UK">🇺🇦 Ukrainien</option>
                            <option value="VI">🇻🇳 Vietnamien</option>
                            <option value="Z1">Z1 Réserve client</option>
                            <option value="ZF">🇹🇼 Chinois trad.</option>
                            <option value="ZH">🇨🇳 Chinois</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nbe-nom-trait" class="required">N BE et Nom N BE</label>
                        <input type="text" id="nbe-nom-trait" name="nbeNomTrait"  placeholder="Suivant les infos dans la demande Excel" required>
                    </div>
                    <div class="form-group">
                        <label for="metier" class="required">Sélectionner</label>
                        <select id="metier" name="metier" required>
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
                        <select id="nombre-lignes" name="nombreLignes"  required>
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
                        <input type="file" id="fichier-nbe" name="fichierNbe" required accept=".xlsx,.xls,.zip">
                    </div>
                    <div class="form-group">
                        <label for="metier-nbe" class="required">Métier</label>
                        <input type="text" id="metier-nbe" name="metierNbe" placeholder="Entrez la Métier" required>
                    </div>
                    <div class="form-group">
                        <label for="secteur" class="required">Secteur</label>
                        <input type="text" id="secteur" name="secteur" placeholder="Entrez le secteur" required>
                    </div>
                    <div class="form-group">
                        <label for="nom-projet" class="required">Nom Projet</label>
                        <input type="text" id="nom-projet" name="nomProjet" placeholder="Entrez le Nom du Projet" required>
                    </div>
                    <div class="form-group">
                        <label for="type-million" class="required">Sélectionnez</label>
                        <select id="type-million" name="typeMillion" required>
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
                            <input type="text" id="fonction-principale" name="fonctionPrincipale" placeholder="Entrez la fonction Principale" required>
                        </div>
                        <div class="form-group">
                            <label for="fonction-elementaire" class="required">Fonction Élémentaire</label>
                            <input type="text" id="fonction-elementaire" name="fonctionElementaire" placeholder="Entrez la Fonction Élémentaire" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre-lignes-nbe" class="required">Nombre des Lignes</label>
                            <select id="nombre-lignes-nbe" name="nombreLignesNbe" required>
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

    <!DOCTYPE html>
    <html lang="fr">
    <!-- Le reste du code HTML précédent reste identique jusqu'au script -->
    
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('stellantisForm');
                const typeSelect = document.getElementById('type');
                const typeMillionSelect = document.getElementById('type-million');
    
                function toggleVisibility(elementId, show) {
                    const element = document.getElementById(elementId);
                    if (element) {
                        element.classList.toggle('hidden', !show);
                    }
                }
    
                function resetForm() {
                    ['codification', 'nomenclature', 'nbe', 'million1', 'million2'].forEach(id => {
                        toggleVisibility(id, false);
                    });
                }
    
                typeSelect.addEventListener('change', function() {
                    resetForm();
                    const value = this.value;
                    
                    if (value === 'codification' || value === 'fiches') {
                        toggleVisibility('codification', true);
                    } else if (value === 'traitement') {
                        toggleVisibility('nomenclature', true);
                    } else if (value === 'nbe') {
                        toggleVisibility('nbe', true);
                    }
                });
    
                typeMillionSelect.addEventListener('change', function() {
                    ['million1', 'million2'].forEach(id => {
                        toggleVisibility(id, this.value === id);
                    });
                });
    
                // Fonction de validation des champs requis
                function validateRequiredFields(container) {
                    const requiredFields = container.querySelectorAll('[required]');
                    let isValid = true;
    
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.classList.add('error');
                            
                            // Ajouter un message d'erreur
                            let errorMsg = field.nextElementSibling;
                            if (!errorMsg || !errorMsg.classList.contains('error-message')) {
                                errorMsg = document.createElement('div');
                                errorMsg.className = 'error-message';
                                field.parentNode.insertBefore(errorMsg, field.nextSibling);
                            }
                            errorMsg.textContent = 'Ce champ est requis';
                        }
                    });
    
                    return isValid;
                }
    
                // Ajout des styles pour les erreurs
                const style = document.createElement('style');
                style.textContent = `
                    .error {
                        border-color: var(--error-color) !important;
                    }
                    .error-message {
                        color: var(--error-color);
                        font-size: 12px;
                        margin-top: 4px;
                    }
                    .success-message {
                        background-color: #4CAF50;
                        color: white;
                        padding: 15px;
                        border-radius: 8px;
                        margin-bottom: 20px;
                        display: none;
                    }
                `;
                document.head.appendChild(style);
    
                // Nettoyage des erreurs lors de la saisie
                form.addEventListener('input', function(e) {
                    if (e.target.classList.contains('error')) {
                        e.target.classList.remove('error');
                        const errorMsg = e.target.nextElementSibling;
                        if (errorMsg && errorMsg.classList.contains('error-message')) {
                            errorMsg.remove();
                        }
                    }
                });
    
                // Gestion de la soumission du formulaire
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Réinitialiser les messages précédents
                    document.querySelectorAll('.error-message').forEach(msg => msg.remove());
                    document.querySelectorAll('.error').forEach(field => field.classList.remove('error'));
    
                    // Valider le formulaire principal
                    let isValid = validateRequiredFields(form);
    
                    // Valider les sections visibles selon le type sélectionné
                    const type = typeSelect.value;
                    if (type === 'codification' || type === 'fiches') {
                        isValid = validateRequiredFields(document.getElementById('codification')) && isValid;
                    } else if (type === 'traitement') {
                        isValid = validateRequiredFields(document.getElementById('nomenclature')) && isValid;
                    } else if (type === 'nbe') {
                        isValid = validateRequiredFields(document.getElementById('nbe')) && isValid;
                        
                        // Valider la section million si applicable
                        const millionType = typeMillionSelect.value;
                        if (millionType === 'million1') {
                            isValid = validateRequiredFields(document.getElementById('million1')) && isValid;
                        } else if (millionType === 'million2') {
                            isValid = validateRequiredFields(document.getElementById('million2')) && isValid;
                        }
                    }
    
                    if (isValid) {
                        // Créer un message de succès
                        let successMsg = document.querySelector('.success-message');
                        if (!successMsg) {
                            successMsg = document.createElement('div');
                            successMsg.className = 'success-message';
                            form.insertBefore(successMsg, form.firstChild);
                        }
                        successMsg.style.display = 'block';
                        successMsg.textContent = 'Formulaire envoyé avec succès !';
    
                        // Vous pouvez ajouter ici le code pour envoyer les données au serveur
                        const formData = new FormData(form);
                        console.log('Données du formulaire:', Object.fromEntries(formData));
    
                        // Optionnel : réinitialiser le formulaire après un délai
                        setTimeout(() => {
                            form.reset();
                            successMsg.style.display = 'none';
                            resetForm();
                        }, 3000);
                    }
                });
            });
        </script>
    </body>
    </html>