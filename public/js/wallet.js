// const walletIcon = document.getElementById('walletIcon');
// const card = document.querySelector('.card');

// walletIcon.addEventListener('click', () => {
//     card.classList.toggle('show'); 
// });
document.addEventListener('DOMContentLoaded', () => {
  const userId = window.userId/* ID de l'utilisateur, à récupérer dynamiquement */;
  
  // Écouteur d'événements pour le bouton walletIcon
  const walletIcon = document.getElementById('walletIcon');
  const card = document.querySelector('.card');

  walletIcon.addEventListener('click', () => {
      card.classList.toggle('show'); // Toggle visibility on click
  });

  // Récupérer les données du portefeuille
  fetch(`/nexus-crypto-wallet/wallet/data/${userId}`)
      .then(response => response.json())
      .then(data => {
          // Mettre à jour le solde USDT
          document.querySelector('.usdt-balance').textContent = `${data.usdt_balance} USDT`;

          // Mettre à jour la liste des cryptomonnaies
          const cryptoList = document.querySelector('.crypto-list');
          data.cryptos.forEach(crypto => {
              const cryptoItem = document.createElement('div');
              cryptoItem.classList.add('crypto-item');
              cryptoItem.innerHTML = `
                  <span>${crypto.symbol}:</span>
                  <span>${crypto.balance} ${crypto.symbol}</span>
                  <button class="view-button">View</button>
              `;
              cryptoList.appendChild(cryptoItem);
          });

          // Préparer les données pour Chart.js
          const ctx = document.getElementById('portfolioChart').getContext('2d');
          const portfolioChart = new Chart(ctx, {
              type: 'doughnut', // Type de graphique
              data: {
                  labels: data.labels,
                  datasets: [{
                      label: 'Portfolio Distribution',
                      data: data.data,
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(255, 206, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(255, 159, 64, 0.2)'
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(153, 102, 255, 1)',
                          'rgba(255, 159, 64, 1)'
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  responsive: true,
                  plugins: {
                      legend: {
                          position: 'top',
                      },
                      title: {
                          display: true,
                          text: 'Portfolio Statistics'
                      }
                  }
              }
          });
      })
      .catch(error => console.error('Error fetching wallet data:', error));
});

