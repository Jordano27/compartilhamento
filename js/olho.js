// olho.js
const olho = document.getElementById('olho');
const campo = document.querySelector('#senha');

olho.addEventListener('click', () => {
    campo.type = campo.type == 'password' ? 'text' : 'password';
});