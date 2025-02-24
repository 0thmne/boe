document.addEventListener('DOMContentLoaded', function () {
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

    function validateRequiredFields(container) {
        let isValid = true;
        const requiredFields = container.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error');
                let errorMsg = field.nextElementSibling;
                if (!errorMsg || !errorMsg.classList.contains('error-message')) {
                    errorMsg = document.createElement('div');
                    errorMsg.className = 'error-message';
                    errorMsg.textContent = 'Ce champ est requis';
                    field.parentNode.insertBefore(errorMsg, field.nextSibling);
                }
            }
        });
        return isValid;
    }

    typeSelect.addEventListener('change', function () {
        resetForm();
        const value = this.value;

        if (value === 'codification') {
            toggleVisibility('codification', true);
        } else if (value === 'traitement' || value === 'chargement') {
            toggleVisibility('nomenclature', true);
        } else if (value === 'nbe') {
            toggleVisibility('nbe', true);
        }
    });

    typeMillionSelect.addEventListener('change', function () {
        const value = this.value;
        toggleVisibility('million1', value === 'million1');
        toggleVisibility('million2', value === 'million2');
    });

    // Add styles for errors
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

    // Clear errors on input
    form.addEventListener('input', function (e) {
        if (e.target.classList.contains('error')) {
            e.target.classList.remove('error');
            const errorMsg = e.target.nextElementSibling;
            if (errorMsg && errorMsg.classList.contains('error-message')) {
                errorMsg.remove();
            }
        }
    });

    // Handle form submission
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Clear previous messages
        document.querySelectorAll('.error-message').forEach(msg => msg.remove());
        document.querySelectorAll('.error').forEach(field => field.classList.remove('error'));

        // Validate the main form
        let isValid = validateRequiredFields(form);

        // Validate visible sections based on the selected type
        const type = typeSelect.value;
        if (type === 'codification' || type === 'fiches') {
            isValid = validateRequiredFields(document.getElementById('codification')) && isValid;
        } else if (type === 'traitement' || type === 'chargement') {
            isValid = validateRequiredFields(document.getElementById('nomenclature')) && isValid;
        } else if (type === 'nbe') {
            isValid = validateRequiredFields(document.getElementById('nbe')) && isValid;

            // Validate the million section if applicable
            const millionType = typeMillionSelect.value;
            if (millionType === 'million1') {
                isValid = validateRequiredFields(document.getElementById('million1')) && isValid;
            } else if (millionType === 'million2') {
                isValid = validateRequiredFields(document.getElementById('million2')) && isValid;
            }
        }

        if (isValid) {
            // Create a success message
            let successMsg = document.querySelector('.success-message');
            if (!successMsg) {
                successMsg = document.createElement('div');
                successMsg.className = 'success-message';
                form.insertBefore(successMsg, form.firstChild);
            }
            successMsg.style.display = 'block';
            successMsg.textContent = 'Formulaire envoyé avec succès !';

            // Send the data to the server
            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                // Optionally reset the form after a delay
                setTimeout(() => {
                    form.reset();
                    successMsg.style.display = 'none';
                    resetForm();
                }, 3000);
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('There was an error submitting the form. Please try again.');
            });
        }
    });
});