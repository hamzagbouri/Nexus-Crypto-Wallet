<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/wallet.css">
</head>
<body>
<?php require_once __DIR__. './../inc/navbar.php'?>
    <div class="login-page">
      <div class="login-container">
          <div class="login-form">
              <h2>Login</h2>
              <form>
                  <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" id="username" name="username" placeholder="Enter your username">
                  </div>
                  <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" id="password" name="password" placeholder="Enter your password">
                  </div>
                  <button type="submit" class="login-btn">Log In</button>
              </form>
              <p class="signup-link">Don't have an account? <a href="signup.html">Sign Up</a></p>
          </div>
          <div class="login-image">
              <img src="your-image.jpg" alt="Login Image">
          </div>
      </div>
    </div>
<script src="../js/wallet.js"></script>
</body>
</html>