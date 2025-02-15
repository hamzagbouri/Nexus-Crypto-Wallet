<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Transactions</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/transaction.css">
    <link rel="stylesheet" href="../css/wallet.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<?php require_once __DIR__. '/../inc/navbar.php'; ?>

<div class="watchlist-container bg-gray-900 text-white p-6 rounded-lg shadow-lg w-full max-w-5xl mx-auto">
    <h2 class="watchlist-header text-2xl font-semibold mb-4">My Transactions</h2>

    <table class="w-full border-collapse">
        <thead>
        <tr class="bg-gray-800 text-gray-300">
            <th class="p-3 text-left">#</th>
            <th class="p-3 text-left">Type</th>
            <th class="p-3 text-left">Crypto</th>
            <th class="p-3 text-left">Amount</th>
            <th class="p-3 text-left">Price per Crypto</th>
            <th class="p-3 text-left">Receiver (if Send)</th>
            <th class="p-3 text-left">Date</th>
        </tr>
        </thead>
            <tbody>
            <?php
            // Static transactions array
            $transactions = [
                [
                    "id" => 1,
                    "transaction_type" => "Buy",
                    "crypto_name" => "Bitcoin",
                    "symbol" => "BTC",
                    "amount" => "0.5",
                    "prix_crypto" => "30000",
                    "transaction_date" => "2025-02-10",
                    "receiver_id" => null
                ],
                [
                    "id" => 2,
                    "transaction_type" => "Sell",
                    "crypto_name" => "Ethereum",
                    "symbol" => "ETH",
                    "amount" => "0.2",
                    "prix_crypto" => "2000",
                    "transaction_date" => "2025-02-11",
                    "receiver_id" => null
                ],
                [
                    "id" => 3,
                    "transaction_type" => "Send",
                    "crypto_name" => "USDT",
                    "symbol" => "USDT",
                    "amount" => "100",
                    "prix_crypto" => "1",
                    "transaction_date" => "2025-02-12",
                    "receiver_id" => "123456" // Example receiver ID
                ],
            ];
            $index=1;
            foreach ($data['transactions'] as $transaction): ?>
                <tr class="border-b border-gray-700">
                    <td class="p-3"><?= $index ?></td>
                    <td class="p-3"><?= htmlspecialchars($transaction->getTransactionType()) ?></td>
                    <td class="p-3"><?= htmlspecialchars($transaction->getCrypto()) ?> </td>
                    <td class="p-3"><?= htmlspecialchars($transaction->getAmount())?></td>
                    <td class="p-3">$<?= htmlspecialchars($transaction->getPrixCrypto()) ?></td>
                    <td class="p-3">
                        <?= $transaction->getTransactionType() === "Send" ? htmlspecialchars($transaction->getReceiver()->getEmail()) : "-" ?>
                    </td>
                    <td class="p-3"><?= htmlspecialchars($transaction->getDateTransaction()) ?></td>
                </tr>
            <?php $index++; endforeach; ?>
            </tbody>
    </table>
</div>
</body>
</html>
