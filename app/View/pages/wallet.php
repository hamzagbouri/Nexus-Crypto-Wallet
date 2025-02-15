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
        <div class="w-full md:w-1/3 bg-gray-700 rounded-lg p-4">
            <h3 class="text-xl font-bold text-center mb-4">Wallet Statistics</h3>
            <canvas id="walletChart" class="max-w-full h-auto"></canvas>
        </div>

        <!-- Right Section: Balance and Coins -->
        <div class="w-full md:w-2/3">
            <div class="mb-4">
                <h3 class="text-2xl font-bold">My Wallet</h3>
            </div>
            <div class="mb-4">
                <span class="text-lg">👤 User: <strong><?=$data['user']->getNom()?> <?=$data['user']->getPrenom()?></strong></span>
            </div>
            <div class="flex justify-between items-center mb-6">
                <div class="text-lg">
                    <span>💰 Balance:</span>
                    <span class="font-bold text-green-500"><?=$data['balance']?> USDT</span>
                </div>
                <button id="sendUsdtBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Send USDT
                </button>
            </div>

            <div>
                <h4 class="text-xl font-bold mb-4">Other Cryptos</h4>
                <?php if(isset($data['cryptos'])): ?>
                    <div class="space-y-4">
                        <?php $wallets = $data['cryptos'];?>
                        <?php $cryptos = $wallets->getAllBalances();?>
                        <?php foreach ($cryptos as $id_crypto => $amount): ?>
                            <div class="flex justify-between items-center bg-gray-700 rounded-lg p-4">
                                <span class="text-lg"><?= $id_crypto?>:</span>
                                <div class="flex items-center space-x-2">
                                    <span><?=$amount?></span>
                                    <button class="sendCryptoBtn bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded" data-crypto="<?= $id_crypto ?>" data-amount="<?= $amount ?>">
                                        Send
                                    </button>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else:?>
                    <div class="flex justify-between items-center bg-gray-700 rounded-lg p-4">
                        <p>You don't have other cryptos</p>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>

<!-- Modal for Sending Crypto -->
<div id="sendModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-96">
        <form action="/nexus-crypto-wallet/crypto/send" method="post">
        <h3 class="text-xl font-bold mb-4">Send <span id="cryptoName"></span></h3>
        <label class="block text-sm mb-2">Nexus ID or Email</label>
            <input type="hidden" id="cryptoSlug" name="slug">
        <input type="text" id="recipient" name="receiver" class="w-full p-2 rounded bg-gray-700 text-white mb-4" placeholder="Enter Nexus ID or Email">

        <label class="block text-sm mb-2">Amount</label>
        <input type="number" id="sendAmount" name="amount" class="w-full p-2 rounded bg-gray-700 text-white mb-4" placeholder="Enter amount">

        <div class="flex justify-end space-x-2">
            <button id="closeModal" type="button" class="bg-gray-600 text-white px-4 py-2 rounded">Cancel</button>
            <button id="confirmSend" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Send</button>
        </div>
        </form>
    </div>
</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-8 mt-8">
    <div class="container mx-auto px-4 text-center">
        &copy; 2023 Designed and Developed by Programming Insider.
    </div>
</footer>

<script>
    // Get PHP Data for Chart
    const cryptoData = <?= json_encode($cryptos ?? []) ?>;
    const cryptoLabels = Object.keys(cryptoData);
    const cryptoAmounts = Object.values(cryptoData);
    const total = cryptoAmounts.reduce((sum, value) => sum + parseFloat(value), 0);

    // Convert to percentages
    const cryptoPercentages = cryptoAmounts.map(value => ((value / total) * 100).toFixed(2));

    // Create Chart.js Doughnut Chart
    console.log("qqq"+document.getElementById('walletChart'))
    const ctx = document.getElementById('walletChart').getContext('2d');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: cryptoLabels.map((label, index) => `${label} ${cryptoPercentages[index]}%`),
                datasets: [{
                    data: cryptoAmounts,
                    backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(75, 192, 192, 0.6)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' },
                    tooltip: { enabled: true }
                },
                cutout: '70%',
            }
        });
    } else {
        console.error("Canvas element not found!");
    }

    // Modal Handling
    const sendModal = document.getElementById('sendModal');
    const cryptoName = document.getElementById('cryptoName');
    const recipientInput = document.getElementById('recipient');
    const sendAmountInput = document.getElementById('sendAmount');
    let selectedCrypto = "USDT";

    document.querySelectorAll('.sendCryptoBtn').forEach(button => {
        button.addEventListener('click', () => {
            selectedCrypto = button.dataset.crypto;
            cryptoName.innerText = selectedCrypto;
            document.getElementById('cryptoSlug').value = selectedCrypto; // Set slug
            sendModal.classList.remove('hidden');
        });
    });

    document.getElementById('sendUsdtBtn').addEventListener('click', () => {
        selectedCrypto = "USDT";
        cryptoName.innerText = selectedCrypto;
        document.getElementById('cryptoSlug').value = "usdt"; // Set slug to USDT
        sendModal.classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', () => {
        sendModal.classList.add('hidden');
    });


</script>
</body>
</html>
