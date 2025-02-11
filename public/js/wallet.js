const walletIcon = document.getElementById('walletIcon');
const card = document.querySelector('.card');

walletIcon.addEventListener('click', () => {
    card.classList.toggle('show'); // Toggle visibility on click
});
