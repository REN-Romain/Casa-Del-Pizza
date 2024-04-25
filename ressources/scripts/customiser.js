const small = document.getElementById('small');
const medium = document.getElementById('medium');
const large = document.getElementById('large');

const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

const numPizza = urlParams.get('numPizza');

function handleSelection(clickedElement) {
    small.classList.remove('selected', 'b');
    medium.classList.remove('selected');
    large.classList.remove('selected', 'b');

    clickedElement.classList.add('selected');

    if(clickedElement === medium) {
        small.classList.add('b');
        large.classList.add('b');
    }
}


document.addEventListener('DOMContentLoaded', () => {
    const plusButtons = document.querySelectorAll('.fa-plus');
    const minusButtons = document.querySelectorAll('.fa-minus');

    function updateQuantity(element, increment, isTotal) {
        let currentVal = parseInt(element.innerText);
        if (increment) {
            currentVal = isTotal ? Math.min(currentVal + 1, 9) : Math.min(currentVal + 1, 3);
        } else {
            currentVal = isTotal ? Math.max(currentVal - 1, 1) : Math.max(currentVal - 1, 0);
        }
        element.innerText = currentVal;
        calculateTotalPrice();
    }

    function calculateTotalPrice() {
        const selectedSizePrice = parseFloat(document.querySelector('.sizes .selected').getAttribute('id-price'));

        let supplementsTotal = 0;
        document.querySelectorAll('.customise-ingredient #numeric').forEach(ingredient => {
            const quantity = parseInt(ingredient.innerText);
            const price = parseFloat(ingredient.getAttribute('data-price'));
            const isBase = ingredient.closest('.customise-ingredient').classList.contains('customise-base');

            // Compter toutes les unités pour les extras, compter comme supplément à partir de 2 pour les bases
            if (isBase && quantity > 1) {
                supplementsTotal += (quantity-1) * price; // Compter comme un seul supplément
            } else if (!isBase) {
                supplementsTotal += quantity * price;
            }
        });

        const totalQuantity = parseInt(document.querySelector('#numeric[data-id="total"]').innerText);
        const finalPrice = (selectedSizePrice + supplementsTotal) * totalQuantity;
        document.querySelector('.final-pizza .total').innerText = finalPrice.toFixed(2) + '€';
    }

    plusButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const numericElement = document.querySelector(`#numeric[data-id='${id}']`);
            const isTotal = id === "total";
            updateQuantity(numericElement, true, isTotal);
        });
    });

    minusButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const numericElement = document.querySelector(`#numeric[data-id='${id}']`);
            const isTotal = id === "total";
            updateQuantity(numericElement, false, isTotal);
        });
    });

    document.querySelectorAll('.sizes div').forEach(sizeElement => {
        sizeElement.addEventListener('click', () => {
            document.querySelector('.sizes .selected').classList.remove('selected');
            sizeElement.classList.add('selected');
            calculateTotalPrice();
        });
    });

    const submitButton = document.getElementById('submit');

    submitButton.addEventListener('click', (event) => {
        event.preventDefault(); // Empêche le comportement par défaut du lien

        // Récupérer la taille de la pizza sélectionnée
        const selectedSize = document.querySelector('.sizes .selected').getAttribute('data-id');
        const ingredientsData = { numTaille: selectedSize };

        // Récupérer les quantités des ingrédients
        document.querySelectorAll('.customise-ingredient #numeric').forEach(ingredient => {
            const ingredientId = ingredient.getAttribute('data-id');
            const quantity = parseInt(ingredient.innerText);
            const isExtra = ingredient.closest('.customise-ingredient').classList.contains('customise-extra');

            // Ajouter l'ingrédient seulement s'il n'est pas un extra à 0
            if (!isExtra && quantity != 1) {
                ingredientsData[`numIngredient-${ingredientId}`] = quantity-1;
            }else if(isExtra && quantity > 0){
                ingredientsData[`numIngredient-${ingredientId}`] = quantity;
            }
        });

        // Ajouter la quantité totale
        const totalQuantity = parseInt(document.querySelector('#numeric[data-id="total"]').innerText);
        ingredientsData['totalQuantity'] = totalQuantity;

        // Convertir l'objet des ingrédients en chaîne de requête URL
        const queryString = Object.keys(ingredientsData).map(key => `${encodeURIComponent(key)}=${encodeURIComponent(ingredientsData[key])}`).join('&');

        // Construire l'URL finale
        const finalUrl = `?action=ajouterAuPanierCustom&numPizza=${numPizza}&${queryString}`;

        // Redirection vers l'URL finale
        window.location.href = finalUrl;
    });
    calculateTotalPrice();
});
