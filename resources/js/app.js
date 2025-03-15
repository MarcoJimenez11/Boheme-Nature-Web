import './bootstrap';

/**
 * Menú desplegable de Header al pulsar el botón
 */
document.addEventListener('DOMContentLoaded', function () {
    const dropdownButton = document.getElementById('mega-menu-dropdown-button');
    const dropdownMenu = document.getElementById('mega-menu-dropdown');

    dropdownButton.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');
    });
});
