<header>
    <div id="logo">
        <a href="./index.html">
            <img src="../img/logo-white.png" alt="">
        </a>
    </div>
    <ul class="nav" id="nav">
        <ul class="navLogo">
            <a href="/nexus-crypto-wallet">
                <img src="../img/logo-white.png" alt="" />
            </a>
        </ul>
        <li class="nav-link"><a href="/nexus-crypto-wallet/">Home</a></li>
        <li class="nav-link"><a href="/nexus-crypto-wallet/home/watchList">My Watch list</a></li>
        <li class="nav-link" id="walletIcon"><a href="#">Wallet</a></li>

        <!-- Add Login and Signup buttons here -->
        <li class="nav-link">
            <a href="/nexus-crypto-wallet/home/login" class="login-button">Login</a>
        </li>
        <li class="nav-link">
            <a href="/nexus-crypto-wallet/home/register" class="signup-button">Sign Up</a>
        </li>
    </ul>
    <div id="barContainer">
        <i id="bar" class="fa-solid fa-bars"></i>
    </div>
</header>

<div class="wallet-container card">
    <div class="wallet-header">
        <h3>My Wallet</h3>
    </div>

    <div class="user-info">
        <span class="username">👤 User: <strong>John Doe</strong></span>
    </div>

    <div class="balance-section">
        <div class="crypto-balance">
            <span>💰 Balance:</span>
            <span class="usdt-balance">500 USDT</span>
        </div>
        <button class="send-button">Send</button>
    </div>

    <div class="crypto-list">
        <h4>Other Cryptos</h4>

        <div class="crypto-item">
            <span>Bitcoin (BTC):</span>
            <span>0.0123 BTC</span>
            <button class="view-button">View</button>
        </div>

        <div class="crypto-item">
            <span>Ethereum (ETH):</span>
            <span>1.254 ETH</span>
            <button class="view-button">View</button>
        </div>

        <div class="crypto-item">
            <span>Solana (SOL):</span>
            <span>15.62 SOL</span>
            <button class="view-button">View</button>
        </div>
    </div>
</div>

<script src="../js/wallet.js"></script>
