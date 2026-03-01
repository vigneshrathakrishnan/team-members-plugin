document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.ts-card').forEach(function(card) {
        card.addEventListener('click', function() {
            card.classList.toggle('expanded');
        });
    });
});