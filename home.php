<?php
include "includes/pages/header.php";
echo "<script>
        function scrollToProducts() {
            window.location.href = 'home.php#products';
        }
    </script>
    ";
if(!isset($_SESSION["id"])) {
    $_SESSION["userIdNotSet"] = ["Login to make a connection...","info"];
    echo "<script>window.location.href = 'login.php'</script>";
}
if (isset($_SESSION["id"]) && isset($_SESSION["loggedInNotification"])) {
    displayPopup($_SESSION["loggedInNotification"][0], $_SESSION["loggedInNotification"][1]);
    unset($_SESSION["loggedInNotification"]);
}

if (isset($_SESSION['contactFormNotification'])) {
    displayPopup($_SESSION["contactFormNotification"][0], $_SESSION["contactFormNotification"][1]);
    unset($_SESSION["contactFormNotification"]);
}

if (isset($_SESSION['productOrderNotification'])) {
    displayPopup($_SESSION["productOrderNotification"][0], $_SESSION["productOrderNotification"][1]);
    unset($_SESSION["productOrderNotification"]);
}

if (isset($_SESSION['clearFilter'])) {
    if ($_SESSION['clearFilter'] == true) {
        echo "<script>scrollToProducts();</script>";
        $_SESSION['clearFilter'] = false; // Corrected typo
    }
}

if (isset($_SESSION['selectedOptions'])) {
    if ($_SESSION['selectedOptions'] == true) {
        echo "<script>scrollToProducts();</script>";
        $_SESSION['selectedOptions'] = null;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="cssStyles/home_page_style.css">
    <link rel="shortcut icon" href="includes/Msquare.ico" type="image/x-icon">
    <title>M² Mobiles</title>
</head>

<body>
    <?php
    include "includes/pages/homePageBanner.php";
    include "includes/pages/products.php";
    include "includes/pages/about.php";
    include "includes/pages/contactSection.php";
    include "includes/pages/footer.php";
    ?>

    <?php
    if (isset($_GET['productId'])) {
        require_once "path/to/PHPMailerAutoload.php";

        $email = $_SESSION['email'];
        $userName = $_SESSION['name'];
        $userId = $_SESSION['id'];

        $productId = $_GET['productId'];

        $con = mysqli_connect("localhost", "root", "", "NammaKadai");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM Product_Details WHERE productId = $productId";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $productName = $row['productName'];
            $productDescription = $row['productDescription'];
            $productQuantity = $row['quantity'];
            $productPrice = $row['sellingPrice'];

            $mail = new PHPMailer(true);

            try {
                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host = 'smtp.elasticemail.com;';
                $mail->SMTPAuth = true;
                $mail->Username = 'msquaremobilesofficial@gmail.com';
                $mail->Password = '25B754F97C841650D244D8D0DDC4AB96E670';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 2525;

                $mail->setFrom('msquaremobilesofficial@gmail.com', 'Msquare Mobiles');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Your Order Confirmed!';
                $mail->Body = "<!DOCTYPE html>
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
                                  <div class=\"product-container\">
                                      <div class=\"product-title\">$productName</div><br>
                                      <div class=\"product-price\">Price: Rs. $productPrice /- only</div><br>
                                      <div class=\"product-description\">$productDescription</div><br>
                                      
                                      <div class=\"confirmation-message\">Booking Confirmed!</div><br>
                                      
                                      <div class=\"user-details\">
                                          <div class=\"user-title\">Ordered User Details</div>
                                          <div class=\"user-info\"><b>Name:</b> $userName</div>
                                          <div class=\"user-info\"><b>Email:</b> $email</div>
                                      </div>
                                  </div></center>
                              </body>
                          </html>";
                $mail->AltBody = '';
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $mail->send();
                $_SESSION['productOrderNotification'] = ["Your order Placed Successfully!", "success"];
            } catch (Exception $e) {
                $_SESSION['productOrderNotification'] = [$e->errorMessage(), "failure"];
            } catch (\Exception $e) {
                $_SESSION['productOrderNotification'] = [$e->getMessage(), "failure"];
            }

            $sql = "UPDATE Product_Details SET quantity = quantity - 1 WHERE productId = $productId";
            $result = mysqli_query($con, $sql);

            $sql = "UPDATE user_Details 
                SET purchaseCount = FLOOR($productPrice/100) + 1 
                WHERE userId = $userId";
            $result = mysqli_query($con, $sql);

            echo "<script>
              document.getElementById('$productId').disabled = true;
          </script>";
        }
        mysqli_close($con);
        header("location: home.php");
    }
    ?>
</body>

</html>
