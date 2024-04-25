const ids = ["btnALaUne", "btnPizzas", "btnBoissons", "btnDesserts"];
const classNameToAdd = "selected";


function handleClick(event) {

    ids.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.classList.remove(classNameToAdd);
        }
    });

    event.currentTarget.classList.add(classNameToAdd);
}

ids.forEach(id => {
    const element = document.getElementById(id);
    if (element) {
        element.addEventListener('click', handleClick);
    }
});
const paires = [["a-la-une", "btnALaUne"], ["pizzas", "btnPizzas"], ["boissons", "btnBoissons"], ["desserts", "btnDesserts"]]; // Remplacez avec vos IDs
const idDivFixe = "categories";
function verifierEtAjusterClasses() {
    const divFixe = document.getElementById(idDivFixe);
    const positionDivFixe = divFixe.getBoundingClientRect().top;

    paires.forEach(pair => {
        const divQuiScroll = document.getElementById(pair[0]);
        const divAssociee = document.getElementById(pair[1]);

        if (divQuiScroll && divAssociee) {
            const positionDivQuiScroll = divQuiScroll.getBoundingClientRect().top - 300;
            console.log(positionDivQuiScroll, positionDivFixe)
            if (positionDivQuiScroll < positionDivFixe) {
                divAssociee.classList.add(classNameToAdd);
                paires.forEach(otherPair => {
                    if (otherPair[1] !== pair[1]) {
                        const otherDivAssociee = document.getElementById(otherPair[1]);
                        if (otherDivAssociee) {
                            otherDivAssociee.classList.remove(classNameToAdd);
                        }
                    }
                });
            } else {
                divAssociee.classList.remove(classNameToAdd);
            }
        }
    });
}
window.addEventListener('scroll', verifierEtAjusterClasses);



document.addEventListener('DOMContentLoaded', function() {
    var elements = document.querySelectorAll('[data-objet][data-id]');

    elements.forEach(function(element) {
        element.addEventListener('click', function() {
            var objet = this.getAttribute('data-objet');
            var id = this.getAttribute('data-id');
            window.location.href = '?objet=' + objet + '&action=customiser&numPizza=' + id;
        });
    });
});