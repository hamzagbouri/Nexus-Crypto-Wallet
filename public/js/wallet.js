// Calculate percentages
const btc = 0.0123;
const eth = 1.254;
const sol = 15.62;
const total = btc + eth + sol;

const btcPercentage = ((btc / total) * 100).toFixed(2);
const ethPercentage = ((eth / total) * 100).toFixed(2);
const solPercentage = ((sol / total) * 100).toFixed(2);

// Chart.js script for wallet statistics (Doughnut Chart)
console.log("aa");
const ctx = document.getElementById('walletChart').getContext('2d');
const walletChart = new Chart(ctx, {
    type: 'doughnut', // Changed from 'line' to 'doughnut'
    data: {
        labels: [
            `Bitcoin (BTC) ${btcPercentage}%`,
            `Ethereum (ETH) ${ethPercentage}%`,
            `Solana (SOL) ${solPercentage}%`
        ],
        datasets: [{
            label: 'Crypto Distribution',
            data: [btc, eth, sol], // Example data for each crypto
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',   // Red for Bitcoin
                'rgba(54, 162, 235, 0.6)',   // Blue for Ethereum
                'rgba(75, 192, 192, 0.6)'    // Green for Solana
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top',
            },
            tooltip: {
                enabled: true,
                callbacks: {
                    label: function (context) {
                        const label = context.label || '';
                        const value = context.raw || 0;
                        const percentage = ((value / total) * 100).toFixed(2);
                        return `${label}: ${value} (${percentage}%)`;
                    }
                }
            }
        },
        cutout: '70%', // Makes the chart look like a circle (not a full doughnut)
    }
});