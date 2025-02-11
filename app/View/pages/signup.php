<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
<?php require_once __DIR__. './../inc/navbar.php'?>
    <div class="signup-page">
        <div class="signup-container">
            <div class="signup-form">
                <h2>Sign Up</h2>
                <form>
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" placeholder="Enter your first name">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Enter your last name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Choose a username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password">
                    </div>
                    <button type="submit" class="signup-btn">Sign Up</button>
                </form>
                <p class="login-link">Already have an account? <a href="login.html">Log In</a></p>
            </div>
            <div class="signup-image">
                <img src="your-image.jpg" alt="Sign Up Image">
            </div>
        </div>
    </div>

</body>
</html>