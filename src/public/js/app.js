document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('stellantisForm');
    const typeSelect = document.getElementById('type');
    const typeMillionSelect = document.getElementById('type-million');

    function toggleVisibility(elementId, show) {
        const element = document.getElementById(elementId);
        if (element) {
            element.classList.toggle('hidden', !show);
            const fields = element.querySelectorAll('input, select');
            const labels = element.querySelectorAll('label');
            fields.forEach(field => {
                if (show) {
                    
                    field.setAttribute('required', '');
                } else {
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
        ['codification', 'nomenclature', 'nbe', 'million1', 'million2'].forEach(id => {
            const section = document.getElementById(id);
            if (section) {
                section.classList.add('hidden');
                section.querySelectorAll('input, select').forEach(field => {
                    field.removeAttribute('required');
                });
                section.querySelectorAll('label').forEach(label => {
                    label.classList.remove('required');
                });
            }
        });
    }

    typeSelect.addEventListener('change', function () {
        resetForm();
        const value = this.value;
        if (value === 'codification') {
            toggleVisibility('codification', true);
        } else if (value === 'processing') {
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

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        document.querySelectorAll('.error-message').forEach(msg => msg.remove());
        document.querySelectorAll('.error').forEach(field => field.classList.remove('error'));

        let isValid = true;
        const visibleSection = document.querySelector('.form-grid:not(.hidden)');
        if (visibleSection) {
            const requiredFields = visibleSection.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'error-message';
                    errorMsg.textContent = 'Ce champ est requis';
                    field.parentNode.insertBefore(errorMsg, field.nextSibling);
                }
            });
        }

        if (isValid) {
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