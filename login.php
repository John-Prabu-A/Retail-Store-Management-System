<?php
include "includes/pages/header.php";

if(isset($_SESSION["id"])) {
    header("location: home.php");
}

if(isset($_SESSION['signupStatus'])) {
    displayPopup($_SESSION['signupStatus'][0],$_SESSION['signupStatus'][1]);
    unset($_SESSION['signupStatus']);
}

if(isset($_SESSION['loginError'])) {
    displayPopup($_SESSION['loginError'][0], $_SESSION['loginError'][1]);
    unset($_SESSION['loginError']);
}
if (!isset($_SESSION["id"]) && isset($_SESSION["userIdNotSet"])) {
    displayPopup($_SESSION["userIdNotSet"][0], $_SESSION["userIdNotSet"][1]);
    unset($_SESSION["userIdNotSet"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Login Page</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssStyles/login_page_style.css">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST" action="action.php">
        <h3><i class="fab fa-connectdevelop"></i> Login</h3>
        <label for="email">Email</label>
        <input type="email" placeholder="Email id" name="email" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" required>

        <button type="submit" name="loginAction">Log In&nbsp;➤</button>
        <div class="goto">
            <a href="signup.php?getAction=gotoSignup"><div name="gotoSignup"><i class="fas fa-arrow-circle-left"></i> Goto Signup Page</div></a>
        </div>
    </form>
</body>
</html>
