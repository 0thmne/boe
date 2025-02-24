document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('stellantisForm');
    const typeSelect = document.getElementById('type');
    const typeMillionSelect = document.getElementById('type-million');

    function toggleVisibility(elementId, show) {
        const element = document.getElementById(elementId);
        if (element) {
            element.classList.toggle('hidden', !show);
            // Gestion des champs obligatoires
            const fields = element.querySelectorAll('input, select');
            const labels = element.querySelectorAll('label');
            fields.forEach(field => {
                if (show) {
                    // Rendre les champs obligatoires uniquement pour la section visible
                    field.setAttribute('required', '');
                } else {
                    // Retirer l'attribut required pour les sections cachées
                    field.removeAttribute('required');
                }
            });

            labels.forEach(label => {
                if (show) {
                    label.classList.add('required');
                } else {
                    label.classList.remove('required');
                }
            });
        }
    }

    function resetForm() {
        // Cacher toutes les sections et retirer les attributs required
        ['codification', 'nomenclature', 'nbe', 'million1', 'million2'].forEach(id => {
            const section = document.getElementById(id);
            if (section) {
                section.classList.add('hidden');
                // Retirer les required des champs
                section.querySelectorAll('input, select').forEach(field => {
                    field.removeAttribute('required');
                });
                // Retirer la classe required des labels
                section.querySelectorAll('label').forEach(label => {
                    label.classList.remove('required');
                });
            }
        });
    }

    typeSelect.addEventListener('change', function () {
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

    typeMillionSelect?.addEventListener('change', function () {
        ['million1', 'million2'].forEach(id => {
            toggleVisibility(id, this.value === id);
        });
    });

    // Validation du formulaire
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        // Nettoyer les messages d'erreur précédents
        document.querySelectorAll('.error-message').forEach(msg => msg.remove());
        document.querySelectorAll('.error').forEach(field => field.classList.remove('error'));

        let isValid = true;
        // Valider uniquement la section visible
        const visibleSection = document.querySelector('.form-grid:not(.hidden)');
        if (visibleSection) {
            const requiredFields = visibleSection.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    // Ajouter un message d'erreur
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'error-message';
                    errorMsg.textContent = 'Ce champ est requis';
                    field.parentNode.insertBefore(errorMsg, field.nextSibling);
                }
            });
        }

        if (isValid) {
            // Afficher le message de succès
            let successMsg = document.querySelector('.success-message');
            if (!successMsg) {
                successMsg = document.createElement('div');
                successMsg.className = 'success-message';
                form.insertBefore(successMsg, form.firstChild);
            }
            successMsg.style.display = 'block';
            successMsg.textContent = 'Formulaire envoyé avec succès !';

            // Send the data to the server
            form.submit();
        }
    });

    // Nettoyage des erreurs lors de la saisie
    form.addEventListener('input', function (e) {
        if (e.target.classList.contains('error')) {
            e.target.classList.remove('error');
            const errorMsg = e.target.nextElementSibling;
            if (errorMsg && errorMsg.classList.contains('error-message')) {
                errorMsg.remove();
            }
        }
    });
});