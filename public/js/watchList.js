const modal = document.getElementById("tradeModal");
const modalTitle = document.getElementById("modalTitle");
const cryptoPrice = document.getElementById("cryptoPrice");
const usdtBalanceText = document.getElementById("usdtBalanceText");
const usdtBalance = document.getElementById("usdtBalance");
const confirmTrade = document.getElementById("confirmTrade");
const cryptoAmount = document.getElementById('cryptoAmount');
const usdtAmount = document.getElementById('usdtAmount');

// Fonction d'affichage du modal
document.querySelectorAll(".btn").forEach(button => {
    button.addEventListener("click", function () {
        const action = this.dataset.action;
        const cryptoName = this.dataset.slug;
        const price = parseFloat(this.dataset.price);
        const balance = parseFloat(this.dataset.amount) || 0;

        // Vérifier si le prix est bien défini
        if (isNaN(price) || price <= 0) {
            alert("Erreur : prix invalide !");
            return;
        }

        // Mise à jour du modal
        modalTitle.textContent = `${action} ${cryptoName}`;
        cryptoPrice.textContent = price
        document.getElementById('crypto').value = cryptoName;
        document.getElementById('cPrice').value = price

        if (action === "Sell") {
            usdtBalanceText.classList.remove("hidden");
            usdtBalance.textContent = balance
            document.getElementById('action').value = "sell";
        } else {
            usdtBalanceText.classList.add("hidden");
            document.getElementById('action').value = "buy";
        }

        // Réinitialiser les champs d'entrée
        cryptoAmount.value = "";
        usdtAmount.value = "";

        // Afficher le modal
        modal.classList.remove("hidden");
    });
});

// Fonction de conversion automatique
function updateConversion() {
    const price = parseFloat(cryptoPrice.textContent);
    let cryptoVal = parseFloat(cryptoAmount.value) || 0;
    let usdtVal = parseFloat(usdtAmount.value) || 0;

    if (cryptoAmount === document.activeElement) {
        usdtAmount.value = (cryptoVal * price);
    } else if (usdtAmount === document.activeElement) {
        cryptoAmount.value = (usdtVal / price);
    }
}

// Écouteurs d'événements pour la conversion
cryptoAmount.addEventListener('input', updateConversion);
usdtAmount.addEventListener('input', updateConversion);

// Fonction pour fermer le modal
function closeModal() {
    modal.classList.add("hidden");
}
