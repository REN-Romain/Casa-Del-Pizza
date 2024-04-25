document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('#btn-details').forEach(function(btn) {
        btn.addEventListener('click', function(event) {
            event.preventDefault();

            var produitElement = btn.closest('.produit-element');


            var detailsRow = produitElement.querySelector('.row-details');


            if (detailsRow.style.display === 'none' || detailsRow.style.display === '') {
                detailsRow.style.display = 'flex';
                btn.textContent = 'Masquer les détails';
            } else {
                detailsRow.style.display = 'none'; // Cache les détails
                btn.textContent = 'Voir les détails'; // Rétablit le texte du bouton
            }
        });
    });
});
