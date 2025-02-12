const modal = document.getElementById("tradeModal");
const modalTitle = document.getElementById("modalTitle");
const cryptoPrice = document.getElementById("cryptoPrice");
const usdtBalanceText = document.getElementById("usdtBalanceText");
const usdtBalance = document.getElementById("usdtBalance");
const usdtInput = document.getElementById('usdtAmount');
const betqueenInput = document.getElementById('cryptoAmount');
const confirmTrade = document.getElementById("confirmTrade");

console.log(document.querySelectorAll(".btn"))
document.querySelectorAll(".btn").forEach(button => {
    button.addEventListener("click", function () {
        const action = this.dataset.action;
        const cryptoName = this.dataset.name;
        const pricee = this.dataset.price;
         price = pricee.replace(/,/g, '');
        const balance = 5000; 
        console.log(price)
        modalTitle.textContent = `${action} ${cryptoName}`;
        cryptoPrice.textContent = price;

        if (action === "Sell") { 
            usdtBalanceText.classList.remove("hidden");
            usdtBalance.textContent = balance;

        } else {
            usdtInput.addEventListener('input', function() {
                const usdtValue = usdtInput.value.trim();
                if (usdtValue ) {

                    const betqueenValue = parseFloat(usdtValue)/parseFloat(price);
                    betqueenInput.value = betqueenValue;
                } else {
                    betqueenInput.value = ''; 
                }
            });
        
            betqueenInput.addEventListener('input', function() {
                const betqueenValue = parseFloat(betqueenInput.value);
                if (betqueenValue && !isNaN(betqueenValue)) {
                    // Convert BetQueen to USDT
                    const usdtValue = betqueenValue * price;
                    usdtInput.value = usdtValue.toFixed(2);
                } else {
                    usdtInput.value = ''; // Clear if invalid or empty input
                }
            });
            usdtBalanceText.classList.add("hidden");
        }

        // Show modal
        modal.classList.remove("hidden");

        // Handle confirmation
        confirmTrade.onclick = () => {
            // alert(`${action} confirmed for ${cryptoName}`);
            closeModal();
        };
    });
});


// Close modal function
function closeModal() {
    document.getElementById("tradeModal").classList.add("hidden");
}

// Handle trade confirmation
// confirmTrade.addEventListener('click', function() {
//     const formData = new FormData();
//     formData.append('cryptoId', currentCryptoId);
//     formData.append('amount', betqueenInput.value);
//     formData.append('usdtAmount', usdtInput.value);
//     formData.append('transactionType', currentAction);
//     formData.append('status', 'confirmed');
//     formData.append('cryptoPrice', currentPrice);

//     const xhr = new XMLHttpRequest();
//     xhr.open('POST', '/nexus-crypto-wallet/Transaction/buyCrypto', true);
    
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState === 4) {
//             if (xhr.status === 200) {
//                 try {
//                     const response = JSON.parse(xhr.responseText);
//                     if (response.status === 'success') {
//                         alert('Transaction Successful!');
//                         closeModal();
//                         // Optionally reload the page
//                         window.location.reload();
//                     } else {
//                         alert('Transaction Failed: ' + (response.message || 'Unknown error'));
//                     }
//                 } catch (error) {
//                     alert('Transaction Failed: Invalid response');
//                 }
//             } else {
//                 alert('Transaction Failed: Server error');
//             }
//         }
//     };

//     xhr.send(formData);
// });


document.addEventListener("DOMContentLoaded", function () {
    window.selectedAction = ""; 
    window.selectedName = "";  
    window.selectedPrice = "";  

    const buyButtons = document.querySelectorAll(".buy-btn");
    const sellButtons = document.querySelectorAll(".sell-btn");
    const confirmTrade = document.getElementById("confirmTrade");
    const tradeModal = document.getElementById("tradeModal");
    const modalTitle = document.getElementById("modalTitle");
    const cryptoPrice = document.getElementById("cryptoPrice");

    function openModal(action, name, price) {
        window.selectedAction = action;
        window.selectedName = name;
        window.selectedPrice = price;

        modalTitle.textContent = `${action} ${name}`;
        cryptoPrice.textContent = price;
        tradeModal.classList.remove("hidden");
    }

    buyButtons.forEach(button => {
        button.addEventListener("click", function () {
            openModal("Buy", this.dataset.name, this.dataset.price);
        });
    });

    sellButtons.forEach(button => {
        button.addEventListener("click", function () {
            openModal("Sell", this.dataset.name, this.dataset.price);
        });
    });

    confirmTrade.addEventListener("click", function () {
        fetch("/nexus-crypto-wallet/Transaction/buyCrypto", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                action: window.selectedAction,
                name: window.selectedName,
                price: window.selectedPrice
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("✅ Transaction successful!");
            } else {
                alert("❌ " + data.message);
            }
            tradeModal.classList.add("hidden"); 
        })
        .catch(error => console.error("Error:", error));
    });

    window.closeModal = function () {
        tradeModal.classList.add("hidden");
    };
});
