<header>
    <?php  if (isset($_SESSION['userData']))
    {
        $logged = true;
    }?>
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
        <?php if($logged):?>
        <li class="nav-link"><a href="/nexus-crypto-wallet/home/watchList">My Watch list</a></li>
            <li class="nav-link"><a href="/nexus-crypto-wallet/home/transaction">Transactions</a></li>
            <li class="nav-link" id="walletIcon"><a href="/nexus-crypto-wallet/home/wallet">Wallet</a></li>
        <?php endif; ?>

        <!-- Add Login and Signup buttons here -->
        <?php if(!$logged):?>
        <li class="nav-link">
            <a href="/nexus-crypto-wallet/home/login" class="login-button">Login</a>
        </li>
        <li class="nav-link">
            <a href="/nexus-crypto-wallet/home/register" class="signup-button">Sign Up</a>
        </li>
        <?php else: ?>
        <li class="nav-link">
            <a href="/nexus-crypto-wallet/auth/logout" class="signup-button">Logout</a>
        </li>
        <?php endif; ?>
    </ul>
    <div id="barContainer">
        <i id="bar" class="fa-solid fa-bars"></i>
    </div>
</header>



