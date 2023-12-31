<?php
    include "includes/pages/header.php";
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
    if(isset($_GET['getAction'])) {
        if($_GET['getAction'] == 'gotoSignup') {
            $_SESSION = array();
        }
    }
    if(isset($_SESSION['signupStatus'])) {
        if ($_SESSION['signupStatus'][1] == 'success') {
            header("location: login.php");
        }
        else {
            displayPopup($_SESSION['signupStatus'][0],$_SESSION['signupStatus'][1]);
            unset($_SESSION['signupStatus']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Signup Page Layout -->
    <title>SignUp Page</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssStyles/signup_page_style.css">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST" action="action.php" id="formToGetDetails">
        <h3><i class="fas fa-paperclip"></i> SignUp</h3>
        <label for="fullName">Full Name</label>
        <input type="text" placeholder="Name" name="username" required>

        <label for="email">Email</label>
        <input type="email" placeholder="john@gmail.com" name="email" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" required>

        <label for="Confirmpassword">Confirm Password</label>
        <input type="password" placeholder="Confirm Password" name="confirmPassword" required>

        <button type="submit" name="signupAction" class="Formbutton">Sign Up ➤</button>

        <div class="goto">
            <a href="login.php"><div name="gotoLogin" style="margin-left: 5px;"><i class="fas fa-arrow-circle-left"></i> Goto Login Page</div></a>
        </div>
    </form>
    <form method='POST' id="formToVerifyOTP" class="hide" action='action.php'>
        <h3><i class="fas fa-paperclip"></i>Verify Email Address</h3><br>
        <h4>Please Enter the OTP we've send to <br> <?php echo $email; ?><h4>
        <br><br><br><br>
        <label for="otp" style="text-align: left;">OTP</label>
        <input type="password" placeholder="****" name="otp" required>
        <button class="Formbutton" type='submit' name='verifyOTP'>Verify&ensp;➤</button>
        <div class="goto">
            <a href="signup.php?getAction=gotoSignup"><div name= "gotosignup" style="margin-right: 5px;"><i class="fas fa-arrow-circle-left"></i> Goto Signup</div></a>
            <a href="action.php?resendOTP"><div name= "resendOTP" style="margin-left: 5px;"><i class="fas fa-arrow-circle-right"></i> Resend OTP</div></a>
        </div>
    </form>
</body>
</html>

<?php
    if(isset($_SESSION['showOTPVerificationForm'])) {
        if($_SESSION['showOTPVerificationForm']) {
            $otp = $_SESSION['otp'];
            echo <<<HTML
                    <script>
                        document.getElementById("formToGetDetails").classList.add("hide");
                        document.getElementById("formToVerifyOTP").classList.remove("hide");
                        alert($otp);
                    </script>
            HTML;
        }
    } else {
        echo <<<HTML
                    <script>
                        document.getElementById("formToGetDetails").classList.remove("hide");
                        document.getElementById("formToVerifyOTP").classList.add("hide");
                    </script>
    HTML;
    }
?> 