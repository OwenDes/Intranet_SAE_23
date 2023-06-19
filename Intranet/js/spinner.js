//recupere les éléments
const bouton = document.getElementById('bouton-spinner');
const spinner = document.getElementById('spinner');

bouton.addEventListener('click', () => {
bouton.style.display = 'none';
spinner.style.display = 'block';
    setTimeout(() => {
        bouton.style.display = 'block';
        spinner.style.display = 'none';
    }, 1000); //1 secondes avant de revenir à l'etat initiale
});
