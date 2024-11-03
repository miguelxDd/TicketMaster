const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.querySelector('.container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

// JavaScript para habilitar validación en Bootstrap
(() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();

//validacion de empresa
function toggleCompanyFields() {
    const isCompany = document.getElementById('is_company').checked;
    const birthdateField = document.getElementById('birthdate-field');
    const duiField = document.getElementById('dui-field');
    const nitField = document.getElementById('nit-field');

    if (isCompany) {
        birthdateField.style.display = 'none';
        duiField.style.display = 'none';
        nitField.querySelector('input').setAttribute('required', 'required');
        nitField.style.display = 'block';
    } else {
        birthdateField.style.display = 'block';
        duiField.style.display = 'block';
        nitField.querySelector('input').removeAttribute('required');
        nitField.style.display = 'none';
    }
}

document.addEventListener("DOMContentLoaded", function() {
    toggleCompanyFields();
});
//foto de perfil
function previewProfilePic(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById('profile-pic-preview');
        preview.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
//mensajes de registro
