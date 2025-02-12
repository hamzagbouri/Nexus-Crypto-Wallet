const modal = document.getElementById("tradeModal");
const modalTitle = document.getElementById("modalTitle");
const cryptoPrice = document.getElementById("cryptoPrice");
const usdtBalanceText = document.getElementById("usdtBalanceText");
const usdtBalance = document.getElementById("usdtBalance");
const confirmTrade = document.getElementById("confirmTrade");

document.querySelectorAll(".buy-btn, .sell-btn").forEach(button => {
    button.addEventListener("click", function () {
        const action = this.dataset.action;
        const cryptoName = this.dataset.name;
        const price = this.dataset.price;
        const balance = 5000; // Example balance, replace with real data

        // Set modal content
        modalTitle.textContent = `${action} ${cryptoName}`;
        cryptoPrice.textContent = price;

        if (action === "Sell") {
            usdtBalanceText.classList.remove("hidden");
            usdtBalance.textContent = balance;
        } else {
            usdtBalanceText.classList.add("hidden");
        }

        // Show modal
        modal.classList.remove("hidden");

        // Handle confirmation
        confirmTrade.onclick = () => {
            alert(`${action} confirmed for ${cryptoName}`);
            closeModal();
        };
    });
});


// Close modal function
function closeModal() {
    document.getElementById("tradeModal").classList.add("hidden");
}