<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Watch List</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/watchList.css" />
  </head>
  <body>

    <?php require_once __DIR__. './../inc/navbar.php'?>


    <div class="watchlist-container">
      <h2 class="watchlist-header">My Watchlist</h2>
      <div class="watchlist-items">
        <!-- Watchlist Item 1 -->
        <div class="watchlist-item">
          <div class="asset-info">
            <img src="bitcoin-icon.png" alt="Bitcoin" class="asset-icon" />
            <span class="asset-name">Bitcoin (BTC)</span>
          </div>
          <div class="asset-price">
            <span class="current-price">$34,000</span>
            <span class="price-change positive">+2.5%</span>
          </div>
          <div class="asset-marketcap">
            <span class="marketcap">$650B</span>
          </div>
          <div class="asset-actions">
            <button class="favorite-btn">⭐</button>
            <button class="action-btn buy">Buy</button>
            <button class="action-btn sell">Sell</button>
          </div>
        </div>

        <!-- Watchlist Item 2 -->
        <div class="watchlist-item">
          <div class="asset-info">
            <img src="ethereum-icon.png" alt="Ethereum" class="asset-icon" />
            <span class="asset-name">Ethereum (ETH)</span>
          </div>
          <div class="asset-price">
            <span class="current-price">$1,800</span>
            <span class="price-change negative">-1.2%</span>
          </div>
          <div class="asset-marketcap">
            <span class="marketcap">$220B</span>
          </div>
          <div class="asset-actions">
            <button class="favorite-btn">⭐</button>
            <button class="action-btn buy">Buy</button>
            <button class="action-btn sell">Sell</button>
          </div>
        </div>


        <div class="watchlist-item">
          <div class="asset-info">
            <img src="ethereum-icon.png" alt="Ethereum" class="asset-icon" />
            <span class="asset-name">Tether (USDT)</span>
          </div>
          <div class="asset-price">
            <span class="current-price">$1</span>
            <span class="price-change positive">+0.01%</span>
          </div>
          <div class="asset-marketcap">
            <span class="marketcap">$5B</span>
          </div>
          <div class="asset-actions">
            <button class="favorite-btn">⭐</button>
            <button class="action-btn buy">Buy</button>
            <button class="action-btn sell">Sell</button>
          </div>
        </div>

        <!-- Add more items as needed -->
      </div>
    </div>
  </body>
</html>
