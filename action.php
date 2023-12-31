
<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "NammaKadai");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// For Login page actions 

if (isset($_POST['loginAction'])) {
    $email = $_POST['email'];
    $enteredPassword = $_POST['password'];
    $result = mysqli_query($con, "SELECT * FROM `LoginDetails` WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $storedPassword = $row['password'];

        if (password_verify($enteredPassword, $storedPassword)) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $email;

            if ($_SESSION['id'] == 1) {
                $_SESSION["loggedInNotification"] = ["Admin Logged In!", "success"];
                $_SESSION['userType'] = "admin";
            } else {
                $_SESSION["loggedInNotification"] = ["Welcome To Our Home Page!", "success"];
                $_SESSION['userType'] = "customer";
            }

            header("location: home.php");
            exit();
        } else {
            $_SESSION['loginError'] = ['Password Invalid!', 'failure'];
            header("location: login.php");
            exit();
        }
    } else {
        $_SESSION['loginError'] = ['User Not signed Up. You need to signup First.', 'failure'];
        header("location: login.php");
        exit();
    }
}

    if(isset($_POST['gotoUserProfileUpdatePage'])) {
        header("location: updateProfile.php");
    }

    //*************************************************** For Signup page actions *************************************************************//

    function generateOTP($length = 4) {
        $characters = '123456789';
        $otp = '';

        $characterCount = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[rand(0, $characterCount - 1)];
        }

        return $otp;
    }

    function sendOTP($username, $email, $otp) {
        $mail = new PHPMailer(true);

        try {                                     
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.elasticemail.com;';
            $mail->SMTPAuth   = true;                            
            $mail->Username   = 'msquaremobilesofficial@gmail.com';
            $mail->Password   = '25B754F97C841650D244D8D0DDC4AB96E670';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 2525;
        
            $mail->setFrom('msquaremobilesofficial@gmail.com', 'Msquare Mobiles');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Verification OTP';
            $mail->Body    = "<center>Hi $username,<br>This is to signup Msquare Mobiles Official Website <br><h4>Your OTP</h4><br><h2>$otp</h2></center>";
            $mail->AltBody = 'message has been sent by Msquare Mobiles...';
            /* Disable some SSL checks. */
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );
        
            $mail->send();
            $_SESSION['signupStatus']=["Verification OTP sent to your Email...", "info"];
        }
        catch (Exception $e) {
            $_SESSION['signupStatus'] = [$e->errorMessage(),"failure"];
        }
        catch (\Exception $e) {
            $_SESSION['signupStatus'] = [$e->getMessage(),"info"];
        }
        
    }

    // For Signup page actions

    if (isset($_POST['signupAction']) || isset($_POST['Adduser_Details'])) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        if ($password == $confirmPassword) {
            $query = "SELECT * FROM `User_Details` WHERE userName = '$username' AND userEmail = '$email'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);

            if ($row === null) {
                $otp = generateOTP();
                $_SESSION['otp'] = $otp;
                sendOTP($username, $email, $otp);
                $_SESSION['showOTPVerificationForm'] = true;
            } else {
                $_SESSION['signupStatus'] = ["User Already Exists, go to the login page.", "failure"];
            }
        } else {
            $_SESSION['signupStatus'] = ["Passwords do not match.", "failure"];
        }

        header("location: signup.php");
    }

    if (isset($_POST['verifyOTP'])) {
        $enteredOTP = $_POST['otp'];
        if ($_SESSION['otp'] == $enteredOTP) {
            $username = $_SESSION['username'];
            $email = $_SESSION['email'];
            $password = $_SESSION['password'];
            unset($_SESSION['password']);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql= "INSERT INTO user_Details (userName, userPassword, userEmail) VALUES ('$username','$password','$email')";
            $result = mysqli_query($con, $sql);
            $sql= "SELECT * FROM user_Details WHERE userEmail = '$email' AND userPassword = '$password' ";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            $str = print_r($row,true);
            echo "<script>alert('$str')</script>";
            $id = $row['userId'];
            $result = mysqli_query($con, "INSERT INTO `logindetails`(`id`, `name`, `email`, `password`) VALUES ('$id','$username','$email','$password')");
            $_SESSION['signupStatus']=["SignUp successful...", "success"];
        } else {
            $_SESSION['signupStatus']=["Invalid OTP...", "failure"];
        }
        header("location: signup.php");
    }

    if (isset($_GET['resendOTP'])) {
        $otp = generateOTP();
        sendOTP($username, $email, $otp);
        $_SESSION['showOTPVerificationForm']=true;
        header("location: signup.php");
    }

    //*************************************************** For updateProfile page actions *******************************************************//

    if (isset($_POST['updateuser_Details'])) {
        $userName = mysqli_real_escape_string($con, $_POST["name"]);
        $userEmail = $_POST["email"];
        $userMobileNo = $_POST["mobileNumber"];
        $enteredPassword = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $profilePictureName = $_FILES["profilePicture"]["name"];
        $tempname = $_FILES["profilePicture"]["tmp_name"];
        $userId = $_SESSION['id'];
    
        if ($enteredPassword === $confirmPassword) {
            $result = mysqli_query($con, "SELECT * FROM `User_Details` WHERE userId = $userId");
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['userPassword'];
    
            if (password_verify($enteredPassword, $storedPassword)) {
                $newImageName = "uploads/profilePictures/" . uniqid() . "_" . $profilePictureName;
                move_uploaded_file($tempname, $newImageName);
    
                $sql = "UPDATE `User_Details` SET userName = '$userName', userEmail = '$userEmail', userMobileNo = '$userMobileNo' WHERE userId = $userId";

                $result1 = mysqli_query($con, $sql);
    
                $sql = "INSERT INTO User_Profile_Pic (userId, userProfileImage) VALUES ('$userId', '$newImageName') ON DUPLICATE KEY UPDATE userProfileImage = '$newImageName'";

                $result2 = mysqli_query($con, $sql);
                if ($result1 && $result2) {
                    $_SESSION['profileUpdateStatus'] = ["Profile Updated Successfully.", "success"];
                } else {
                    $_SESSION['profileUpdateStatus'] = [mysqli_error($con), "failure"];
                }
            } else {
                $_SESSION['profileUpdateStatus'] = ["Incorrect Password!", "failure"];
            }
        } else {
            $_SESSION['profileUpdateStatus'] = ["Passwords both are different!", "failure"];
        }
    
        header("location: profile.php");
    }

    //*************************************************** For Feedback Sending actions *******************************************************//

    if(isset($_POST['contact'])) {
        $name = $_POST['contactFormName'];
        $email = $_POST['contactFormEmail'];
        $subject = $_POST['contactFormSubject'];
        $message = $_POST['contactFormMessage'];

        $mail = new PHPMailer(true);

        try {                                     
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.elasticemail.com;';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'msquaremobilesofficial@gmail.com';
            $mail->Password   = '25B754F97C841650D244D8D0DDC4AB96E670';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 2525;

            $mail->setFrom('msquaremobilesofficial@gmail.com', 'For FeedBack');
            $mail->addAddress('msquaremobilesofficial@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = '<!DOCTYPE html>
                                <html>
                                <head>
                                    <style>
                                        body {
                                            font-family: Arial, sans-serif;
                                            background-color: #f0f0f0;
                                            margin: 0;
                                            padding: 0;
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            min-height: 100vh;
                                        }

                                        .product-container {
                                            background-color: #fff;
                                            padding: 20px;
                                            border-radius: 10px;
                                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                                            max-width: 400px;
                                            width: 100%;
                                        }

                                        .product-title {
                                            font-size: 40px;
                                            margin-bottom: 10px;
                                        }

                                        .product-price {
                                            font-size: 30px;
                                            color: #d80000;
                                            margin-bottom: 10px;
                                        }

                                        .product-description {
                                            font-size: 24px;
                                            margin-bottom: 20px;
                                        }

                                        .confirmation-message {
                                            font-size: 20px;
                                            text-align: center;
                                            color: #4caf50;
                                            margin-bottom: 20px;
                                        }

                                        .user-details {
                                            background-color: #f7f7f7;
                                            padding: 10px;
                                            border-radius: 5px;
                                            border: 1px solid #ddd;
                                        }

                                        .user-title {
                                            font-size: 18px;
                                            margin-bottom: 10px;
                                        }

                                        .user-info {
                                            font-size: 16px;
                                        }
                                    </style>
                                </head>
                                <body><center>
                                    <div class="product-container">
                                        <div class="product-title">FEEDBACK FORM</div><br>
                                        <div class="product-price">Email Id : '.$email.'</div><br>
                                        <div class="product-description">'.$message.'</div><br>
                                        <div class="confirmation-message"> Have A Good Day!</div><br>
                                    </div></center>
                                </body>
                                </html>';
            $mail->AltBody = 'message has been sent by Msquare Mobiles...';
            /* Disable some SSL checks. */
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );

            $mail->send();
            $_SESSION['contactFormNotification'] = ["Thanks for your Feedback!","success"];
        }
        catch (Exception $e) {
            $_SESSION['contactFormNotification'] = [$e->errorMessage(),"failure"];
        }
        catch (\Exception $e) {
            $_SESSION['contactFormNotification'] = [$e->getMessage(),"info"];
        }

        echo '<script>window.location.replace("home.php")</script>';
        
    }

    //*************************************************** For Add to card actions *******************************************************//

    if(isset($_GET['productId'])) {
        $email = $_SESSION['email'];
        $userName = $_SESSION['name'] ;
        $userId =  $_SESSION['id'];

        $productId = $_GET['productId'];
        $sql = "SELECT * FROM product_details INNER JOIN product_pic ON product_details.productId = product_pic.productId WHERE product_details.productId = $productId";
        $result = mysqli_query($con, $sql);
        echo"<script>alert($email)</script>";
        if($result) {
            $row = mysqli_fetch_assoc($result);
            $productName = $row['productName'];
            $productImage = $row['productImageLocation'];
            $productDescription = $row['productDescription'];
            $productQuantity = $row['quantity'];
            $productPrice = $row['sellingPrice'];
                
            $mail = new PHPMailer(true);

            try {                                    
                $mail->isSMTP();                                           
                $mail->Host       = 'smtp.elasticemail.com;';
                $mail->SMTPAuth   = true;                            
                $mail->Username   = 'msquaremobilesofficial@gmail.com';
                $mail->Password   = '25B754F97C841650D244D8D0DDC4AB96E670';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 2525;

                $mail->setFrom('msquaremobilesofficial@gmail.com', 'Msquare Mobiles');
                $mail->addAddress($email);
                
                $mail->isHTML(true);
                $mail->Subject = 'Your Order Confirmed!';
                $mail->Body    = '<!DOCTYPE html>
                                    <html>
                                    <head>
                                        <title>Product Booking Confirmation</title>
                                        <style>
                                            body {
                                                font-family: Arial, sans-serif;
                                                background-color: #f0f0f0;
                                                margin: 0;
                                                padding: 0;
                                                display: flex;
                                                justify-content: center;
                                                align-items: center;
                                                min-height: 100vh;
                                            }

                                            .product-container {
                                                background-color: #fff;
                                                padding: 20px;
                                                border-radius: 10px;
                                                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                                                max-width: 400px;
                                                width: 100%;
                                            }

                                            .product-title {
                                                font-size: 40px;
                                                margin-bottom: 10px;
                                            }

                                            .product-price {
                                                font-size: 30px;
                                                color: #d80000;
                                                margin-bottom: 10px;
                                            }

                                            .product-description {
                                                font-size: 24px;
                                                margin-bottom: 20px;
                                            }

                                            .confirmation-message {
                                                font-size: 20px;
                                                text-align: center;
                                                color: #4caf50;
                                                margin-bottom: 20px;
                                            }

                                            .user-details {
                                                background-color: #f7f7f7;
                                                padding: 10px;
                                                border-radius: 5px;
                                                border: 1px solid #ddd;
                                            }

                                            .user-title {
                                                font-size: 18px;
                                                margin-bottom: 10px;
                                            }

                                            .user-info {
                                                font-size: 16px;
                                            }
                                        </style>
                                    </head>
                                    <body><center>
                                        <div class="product-container">
                                            <div class="product-title">'.$productName.'</div><br>
                                            <div class="product-price">Price: Rs. '.$productPrice.' /- only</div><br>
                                            <div class="product-description">'.$productDescription.'</div><br>
                                            
                                            <div class="confirmation-message">Booking Confirmed!</div><br>
                                            
                                            <div class="user-details">
                                                <div class="user-title">Ordered User Details</div>
                                                <div class="user-info"><b>Name:</b> '.$userName.'</div>
                                                <div class="user-info"><b>Email:</b> '.$email.'</div>
                                            </div>
                                        </div></center>
                                    </body>
                                </html>';
                $mail->AltBody = ' message has been sent by Msquare Mobiles...';
                /* Disable some SSL checks. */
                $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                );

                $mail->send();
                $_SESSION['productOrderNotification'] = ["Your order Placed Successfully!","success"];
                $sql = "UPDATE product_details SET quantity = quantity - 1 WHERE productId = $productId";
                $result = mysqli_query($con, $sql);
                $sql = "UPDATE user_Details SET purchaseCount = FLOOR($productPrice/100) + 1 WHERE userId = $userId";
                $result = mysqli_query($con, $sql);
                echo "  <script>
                            document.getElementById('$productId').disabled = true;
                        </script>";
            }
            catch (Exception $e) {
                $_SESSION['productOrderNotification'] = [$e->errorMessage(),"failure"];
            }
            catch (\Exception $e) {
                $_SESSION['productOrderNotification'] = [$e->getMessage(),"info"];
            }
        }
        echo '<script>window.location.replace("home.php")</script>';
    }
?>
<script src="https://smtpjs.com/v3/smtp.js"></script>