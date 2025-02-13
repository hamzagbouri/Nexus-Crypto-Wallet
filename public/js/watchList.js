const modal = document.getElementById("tradeModal");
const modalTitle = document.getElementById("modalTitle");
const cryptoPrice = document.getElementById("cryptoPrice");
const usdtBalanceText = document.getElementById("usdtBalanceText");
const usdtBalance = document.getElementById("usdtBalance");
const usdtInput = document.getElementById('usdtAmount');
const cryptoInput = document.getElementById('cryptoAmount');
const confirmTrade = document.getElementById("confirmTrade");

let currentTrade = {
    action: '',
    cryptoName: '',
    price: 0,
    cryptoId: ''
};

document.querySelectorAll(".btn").forEach(button => {
    button.addEventListener("click", function() {
        currentTrade.action = this.dataset.action;
        currentTrade.cryptoName = this.dataset.slug;
        currentTrade.price = parseFloat(this.dataset.price.replace(/,/g, ''));
        currentTrade.cryptoId = this.dataset.cryptoId;

        cryptoPrice.textContent = currentTrade.price;
        document.getElementById("action").value = currentTrade.action;
        document.getElementById("cryptoName").value = currentTrade.cryptoName;
        document.getElementById("cryptoPriceHidden").value = currentTrade.price;

        if (currentTrade.action === "Sell") {
            usdtBalanceText.classList.remove("hidden");
        } else {
            usdtBalanceText.classList.add("hidden");
        }

        modal.classList.remove("hidden");
    });
});

usdtInput.addEventListener('input', function() {
    const usdtValue = parseFloat(this.value);
    if (!isNaN(usdtValue)) {
        cryptoInput.value = (usdtValue / currentTrade.price).toFixed(8);
    } else {
        cryptoInput.value = '';
    }
});

cryptoInput.addEventListener('input', function() {
    const cryptoValue = parseFloat(this.value);
    if (!isNaN(cryptoValue)) {
        usdtInput.value = (cryptoValue * currentTrade.price).toFixed(2);
    } else {
        usdtInput.value = '';
    }
});

function closeModal() {
    modal.classList.add("hidden");
    usdtInput.value = '';
    cryptoInput.value = '';
}
