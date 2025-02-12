<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Wallet</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/watchList.css" />
    <link rel="stylesheet" href="../css/wallet.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-900 text-white">
<!-- Header -->
<?php require_once __DIR__. '/../inc/navbar.php'?>
<!-- Wallet Section -->
<section class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-6 bg-gray-800 rounded-lg shadow-lg p-6">
        <!-- Left Section: Chart -->
        <div class="w-full md:w-1/3 bg-gray-700 rounded-lg p-4"> <!-- Reduced width from 1/2 to 1/3 -->
            <h3 class="text-xl font-bold text-center mb-4">Wallet Statistics</h3>
            <canvas id="walletChart" class="max-w-full h-auto"></canvas> <!-- Responsive sizing -->
        </div>
        <!-- Right Section: Balance and Coins -->
        <div class="w-full md:w-2/3"> <!-- Increased width from 1/2 to 2/3 -->
            <div class="mb-4">
                <h3 class="text-2xl font-bold">My Wallet</h3>
            </div>
            <div class="mb-4">
                <span class="text-lg">👤 User: <strong>John Doe</strong></span>
            </div>
            <div class="flex justify-between items-center mb-6">
                <div class="text-lg">
                    <span>💰 Balance:</span>
                    <span class="font-bold text-green-500"><?=$data['balance']?> USDT</span>
                </div>
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Send
                </button>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-4">Other Cryptos</h4>
                <div class="space-y-4">
                    <div class="flex justify-between items-center bg-gray-700 rounded-lg p-4">
                        <span class="text-lg">Bitcoin (BTC):</span>
                        <div class="flex items-center space-x-2">
                            <span>0.0123 BTC</span>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded">
                                Send
                            </button>
                            <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-2 rounded">
                                Buy
                            </button>
                            <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded">
                                Sell
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-between items-center bg-gray-700 rounded-lg p-4">
                        <span class="text-lg">Ethereum (ETH):</span>
                        <div class="flex items-center space-x-2">
                            <span>1.254 ETH</span>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded">
                                Send
                            </button>
                            <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-2 rounded">
                                Buy
                            </button>
                            <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded">
                                Sell
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-between items-center bg-gray-700 rounded-lg p-4">
                        <span class="text-lg">Solana (SOL):</span>
                        <div class="flex items-center space-x-2">
                            <span>15.62 SOL</span>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded">
                                Send
                            </button>
                            <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-2 rounded">
                                Buy
                            </button>
                            <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded">
                                Sell
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer -->
<footer class="bg-gray-800 text-white py-8 mt-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <a href="/nexus-crypto-wallet">
                    <img src="../img/logo-white.png" alt="Logo" />
                </a>
                <p class="text-sm">
                    With no commissions and a simple user interface, Prouple is the most reliable way to trade for Cryptocurrency.
                </p>
                <div class="flex space-x-4 mt-4">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer">
                        <img src="https://cdn.jsdelivr.net/npm/simple-icons/icons/facebook.svg" alt="Facebook" class="w-6 h-6 fill-white" />
                    </a>
                    <!-- Twitter -->
                    <a href="https://www.twitter.com" target="_blank" rel="noopener noreferrer">
                        <img src="https://cdn.jsdelivr.net/npm/simple-icons/icons/twitter.svg" alt="Twitter" class="w-6 h-6 fill-white" />
                    </a>
                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer">
                        <img src="https://cdn.jsdelivr.net/npm/simple-icons/icons/linkedin.svg" alt="LinkedIn" class="w-6 h-6 fill-white" />
                    </a>
                    <!-- WhatsApp -->
                    <a href="https://www.whatsapp.com" target="_blank" rel="noopener noreferrer">
                        <img src="https://cdn.jsdelivr.net/npm/simple-icons/icons/whatsapp.svg" alt="WhatsApp" class="w-6 h-6 fill-white" />
                    </a>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Explore</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-blue-500">About us</a></li>
                    <li><a href="#" class="hover:text-blue-500">FAQ</a></li>
                    <li><a href="#" class="hover:text-blue-500">Blog</a></li>
                    <li><a href="#" class="hover:text-blue-500">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Service</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-blue-500">Mining</a></li>
                    <li><a href="#" class="hover:text-blue-500">Control Data</a></li>
                    <li><a href="#" class="hover:text-blue-500">Design</a></li>
                    <li><a href="#" class="hover:text-blue-500">Security</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Resource</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-blue-500">Style Guide</a></li>
                    <li><a href="#" class="hover:text-blue-500">Change Log</a></li>
                    <li><a href="#" class="hover:text-blue-500">License</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-8 text-sm">
            &copy; 2023 design and developed by
            <a href="#" class="text-blue-500 hover:underline">Programming Insider</a>.
        </div>
    </div>
</footer>
<script>
    // Calculate percentages
    const btc = 0.0123;
    const eth = 1.254;
    const sol = 15.62;
    const total = btc + eth + sol;

    const btcPercentage = ((btc / total) * 100).toFixed(2);
    const ethPercentage = ((eth / total) * 100).toFixed(2);
    const solPercentage = ((sol / total) * 100).toFixed(2);

    // Chart.js script for wallet statistics (Doughnut Chart)
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
</script>
</body>
</html>