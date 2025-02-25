document.getElementById('toggleCategories').addEventListener('click', function() {
    var categories = document.getElementById('categories');
    // categories.toggleAttribute('hidden');
    // categories.classList.toggle('hidden');
    // categories.display = categories.display === 'flex' ? 'none' : 'flex';
    categories.classList.toggle("hide");

});