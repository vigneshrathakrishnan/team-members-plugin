document.addEventListener('DOMContentLoaded', function () {

    const button = document.getElementById('toggleBio');
    const fullBio = document.getElementById('full-bio');

    if (!button || !fullBio) return;

    button.addEventListener('click', function () {

        fullBio.classList.toggle('active');

        if (fullBio.classList.contains('active')) {
            button.textContent = 'Read Less';
        } else {
            button.textContent = 'Read More';
        }
    });

});