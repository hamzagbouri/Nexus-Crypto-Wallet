<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Watch List</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/watchList.css" />
      <link rel="stylesheet" href="../css/wallet.css" />
      <script src="https://cdn.tailwindcss.com"></script>

  </head>
  <body>

    <?php require_once __DIR__. '/../inc/navbar.php'?>


    <div class="watchlist-container bg-gray-900 text-white p-6 rounded-lg shadow-lg w-full max-w-5xl mx-auto">
        <h2 class="watchlist-header text-2xl font-semibold mb-4">My Watchlist</h2>

        <table class="w-full border-collapse">
            <thead>
            <tr class="bg-gray-800 text-gray-300">
                <th class="p-3 text-left">#</th>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Price</th>
                <th class="p-3 text-left">Change (24h)</th>
                <th class="p-3 text-center">Actions</th>
            </tr>
            </thead>
            <tbody id="watchlist-body">
            <?php if (!empty($data)): ?>
            <?php foreach ($data as $index => $crypto): ?>
            <?php

            // Extraction du prix et du changement en 24h depuis la description
            preg_match('/The last known price of .* is ([\d,\.]+) USD and is (down|up) ([\d\.]+) over the last 24 hours/', $crypto['description'], $matches);

            $price = isset($matches[1]) ? floatval(str_replace(',', '', $matches[1])) : 0;
            $change_24h = isset($matches[3]) ? ($matches[2] === 'down' ? -floatval($matches[3]) : floatval($matches[3])) : 0;
            ?>
            <tr class="border-b border-gray-700">
                <td class="p-3"><?= $index + 1 ?></td>
                <td class="p-3"><?= htmlspecialchars($crypto['name']) ?> (<?= strtoupper(htmlspecialchars($crypto['symbol'])) ?>)</td>
                <td class="p-3">$<?= $crypto['price'] ?></td>
                <td class="p-3 <?= $crypto['change_24h'] >= 0 ? 'text-green-500' : 'text-red-500' ?>">
                    <?= $crypto['change_24h'] ?>%
                </td>
                <td class="p-3 flex justify-center gap-2">
                    
                <button class="btn buy-btn"
                    data-action="Buy" 
                    data-name="<?= htmlspecialchars($crypto['name']) ?>" 
                    data-price="<?= $crypto['price'] ?>">
                        Buy
                    </button>

                    <button class="btn sell-btn px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                            data-action="Sell" data-name="<?= htmlspecialchars($crypto['name']) ?>" data-price="<?= $crypto['price'] ?>">
                        Sell
                    </button>
                    <a href="/nexus-crypto-wallet/watchlist/supprimer/<?=$crypto['slug']?>" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Remove</a>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php else: ?>
                <tr>
                    <td colspan="5" class="p-3 text-center text-gray-400">No cryptos in your watchlist.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Modal Background -->
    <!-- Trade Modal -->
<div id="tradeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-gray-900 text-white p-6 rounded-lg shadow-lg w-96">
        <h2 id="modalTitle" class="text-xl font-semibold mb-4"></h2>
        <form action="/nexus-crypto-wallet/Transaction/buyCrypto" method="POST">
            <p class="mb-2">Price: <span id="cryptoPrice" class="font-bold"></span> USDT</p>
            <p id="usdtBalanceText" class="mb-2 hidden">Your Balance: <span id="usdtBalance" class="font-bold"></span> USDT</p>

            <!-- Hidden Inputs -->
            <input type="hidden" id="action" name="action" value="">
            <input type="hidden" id="cryptoName" name="cryptoName" value="">  <!-- Using only cryptoName -->
            <input type="hidden" id="cryptoPriceHidden" name="price" value="">

            <div class="mb-4">
                <label for="cryptoAmount" class="block text-sm">Amount:</label>
                <input name="amount" type="number" id="cryptoAmount" class="w-full p-2 text-black rounded" placeholder="Enter amount" step="any">
            </div>

            <div class="mb-4">
                <label for="usdtAmount" class="block text-sm">USDT:</label>
                <input name="usdtAmount" type="number" id="usdtAmount" class="w-full p-2 text-black rounded" placeholder="Enter USDT" step="any">
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                <button type="submit" id="confirmTrade" class="px-4 py-2 bg-green-500 text-white rounded">Confirm</button>
            </div>
        </form>
    </div>
</div>


    <script src="../js/wallet.js"></script>
    <script src="../js/watchList.js"></script>
    <script>

   
    </script>
  </body>
</html>
