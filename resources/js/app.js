import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {

    //Menú desplegable de Header al pulsar el botón para categorías
    const dropdownButton = document.getElementById('mega-menu-dropdown-button');
    const dropdownMenu = document.getElementById('mega-menu-dropdown');

    dropdownButton.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');
    });


    //Menú desplegable en vista de móvil
    const toggleButton = document.querySelector('[data-collapse-toggle="mega-menu"]');
    const megaMenu = document.getElementById('mega-menu');

    toggleButton.addEventListener('click', function () {
        megaMenu.classList.toggle('hidden');
    });
});
