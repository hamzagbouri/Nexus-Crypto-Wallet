<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Top Crypto Coins</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="top10.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <header>
      <div id="logo">
        <a href="./index.html">
          <img src="./img/logo-white.png" alt="" />
        </a>
      </div>
      <ul class="nav" id="nav">
        <ul class="navLogo">
          <a href="./index.html">
            <img src="./img/logo-white.png" alt="" />
          </a>
        </ul>
        <li class="nav-link"><a href="index.html">Home</a></li>
        <li class="nav-link"><a href="watchList.html">Watch list</a></li>
        <li class="nav-link"><a href="#">Wollet</a></li>
        <li class="nav-link"><a href="contact.html">Contact</a></li>
        <!-- Add Login and Signup buttons here -->
        <li class="nav-link">
          <a href="login.html" class="login-button">Login</a>
        </li>
        <li class="nav-link">
          <a href="signup.html" class="signup-button">Sign Up</a>
        </li>
      </ul>
      <div id="barContainer">
        <i id="bar" class="fa-solid fa-bars"></i>
      </div>
    </header>

    <main>
      <div class="crypto-table-section">
        <table class="crypto-table">
          <thead>
            <tr>
              <th>Rank</th>
              <th>Name</th>
              <th>Price</th>
              <th>Change (24h)</th>
              <th>Chart</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Bitcoin (BTC)</td>
              <td class="up">$34,000</td>
              <td class="up">+2.5%</td>
              <td><img src="bitcoin-chart.png" alt="Bitcoin Chart" /></td>
              <td>
                <i class="fa fa-star"></i>
                <i class="fa fa-info-circle"></i>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Ethereum (ETH)</td>
              <td class="down">$1,800</td>
              <td class="down">-1.2%</td>
              <td><img src="ethereum-chart.png" alt="Ethereum Chart" /></td>
              <td>
                <i class="fa fa-star"></i>
                <i class="fa fa-info-circle"></i>
              </td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table>
      </div>
    </main>

    <footer>
      <div class="joinSection">
        <div class="joinDesc">
          <h1 class="sectionHeader">Join with us</h1>
          <p class="sectionPara">
            Once you have created your account, you can purchase coins from
            website
          </p>
        </div>
        <button class="btn primaryBtn">JOIN NOW</button>
      </div>

      <div class="footerlinksContainer">
        <div class="footerAboutus">
          <img src="./img/logo-white.png" alt="" />
          <p class="darkPara">
            With no commissions and a simple user interface, Prouple is the most
            reliable way to trade for Cryptocurrency.
          </p>
          <div class="footersociallinkContainer">
            <img class="sociallink" src="./img/fabook-icon-white.svg" alt="" />
            <img class="sociallink" src="./img/twitter-icon-white.svg" alt="" />
            <img class="sociallink" src="./img/inkedin-icon-white.svg" alt="" />
            <img
              class="sociallink"
              src="./img/whatsapp-icon-white.svg"
              alt=""
            />
          </div>
        </div>

        <div class="footerlink">
          <h1 class="linkTitle">Explore</h1>
          <a href="#" class="eachLink">About us</a>
          <a href="#" class="eachLink">FAQ</a>
          <a href="#" class="eachLink">Blog</a>
          <a href="#" class="eachLink">Contact</a>
        </div>

        <div class="footerlink">
          <h1 class="linkTitle">Service</h1>
          <a href="#" class="eachLink">Mining</a>
          <a href="#" class="eachLink">Control Data</a>
          <a href="#" class="eachLink">Design</a>
          <a href="#" class="eachLink">Security</a>
        </div>

        <div class="footerlink">
          <h1 class="linkTitle">Resource</h1>
          <a href="#" class="eachLink">Style Guide</a>
          <a href="#" class="eachLink">Change Log</a>
          <a href="#" class="eachLink">License</a>
        </div>
      </div>

      <div class="footerCopyright">
        <p>
          &copy; 2023 design and developed by
          <a href="#" class="developedBy">Programming Insider</a>.
        </p>
      </div>
    </footer>
  </body>
</html>
