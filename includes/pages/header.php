<?php
session_start();

function displayPopup($message, $type) {
    if ($type === 'success') {
        $color = 'green';
        $textColor = 'white';
    } elseif ($type === 'info') {
        $color = 'yellow';
        $textColor = 'black';
    } else {
        $color = 'red';
        $textColor = 'white';
    }
    echo <<<HTML
      <div id="Popup" style="position: fixed; z-index: 1000; top: 30px; left: 0; width: 96%; background-color: {$color}; color: {$textColor}; text-align: center; padding: 10px; margin: 20px; border-radius: 10px;">
        $message
      </div>
      <script>
        setTimeout(function() {
          var popup = document.getElementById('Popup');
          if (popup) {
              popup.style.opacity = 0;
          }
        }, 2000);
      </script>
    HTML;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="cssStyles/header_page_style.css">
</head>
<body>
<!-- Navbar (sit on top) -->
<div class="top" id="topBar">
    <div class="bar box-shadow" style="color: black; background-color: white;" id="myNavbar">
        <a href="home.php" class="bar-item" style="letter-spacing: 4px;">M² MOBILES</a>
        <!-- Right-sided navbar links -->
        <div style="float: right;" class="right-sidelinks">
            <?php
                echo '<a href="home.php#about" class="bar-item">ABOUT</a>';
                echo '<a href="home.php#products" class="bar-item">PRODUCTS</a>';
                echo '<a href="home.php#contact" class="bar-item">CONTACT</a>';
                if(isset($_SESSION['userType'])) {
                    if($_SESSION['userType'] == 'admin') {
                        echo '<a href="addProducts.php" class="bar-item">ADD PRODUCTS</a>';
                        // echo '<a href="addDealer.php" class="bar-item">ADD DEALER</a>';
                        // echo '<a href="addCustomer.php" class="bar-item">ADD CUSTOMER</a>';
                    } else if($_SESSION['userType'] == 'dealer') {
                        echo '<a href="DealingInfo.php" class="bar-item">YOUR FINANCE</a>';
                    } else if($_SESSION['userType'] == "customer") {
                        echo "<a href='profile.php' class='bar-item'>PROFILE</a>";
                        //echo '<a href="cart.php" class="bar-item">CART</a>';
                    }
                }
                $log = isset($_SESSION['id']) ? 'logout' : 'login';
                $upperlog = strtoupper($log);
                if($log === 'login') {
                    echo '<a href="signup.php?getAction=gotoSignup" class="bar-item">SIGNUP</a>';
                }
                echo "<a href='$log.php' class='bar-item'>$upperlog</a>";
            ?>
        </div>
        <!-- Hide right-floated links on small screens and replace them with a menu icon -->
        <a class="bar-item hide-large hide-medium" style="float: right; " onclick="openSidebar()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="sidebar bar-block animate-left hide-medium hide-large  box-shadow white-txt" style="display:none;" id="mySidebar">
    <a onclick="closeSidebar()" class="bar-item white-txt" style="padding: 16px auto; font-size: 18px;">Close ×</a>
    <?php
        if(isset($_SESSION['userType'])) {
            if($_SESSION['userType'] == 'admin') {
                echo '<a href=addProducts.php" onclick="closeSidebar()" class="bar-item white-txt">ADD PRODUCTS</a>';
                // echo '<a href="addDealer.php" onclick="closeSidebar()" class="bar-item white-txt">ADD DEALER</a>';
                // echo '<a href="addCustomer.php" onclick="closeSidebar()" class="bar-item white-txt">ADD CUSTOMER</a>';
            } else if($_SESSION['userType'] == 'dealer') {
                echo '<a href="DealingInfo.php" onclick="closeSidebar()" class="bar-item white-txt">YOUR FINANCE</a>';
            } else if($_SESSION['userType'] == "customer") {
                echo "<a href='profile.php' onclick='closeSidebar()' class='bar-item white-txt'>PROFILE</a>";
                //echo '<a href="cart.php" onclick="closeSidebar()" class="bar-item white-txt">CART</a>';
            }
        }
        echo "<a href='home.php#about' onclick='closeSidebar()' class='bar-item white-txt'>ABOUT</a>";
        echo "<a href='home.php#products' onclick='closeSidebar()' class='bar-item white-txt'>PRODUCTS</a>";
        echo "<a href='home.php#contact' onclick='closeSidebar()' class='bar-item white-txt'>CONTACT</a>";
        if($log === 'login') {
            echo "<a href='signup.php?getAction=gotoSignup' onclick='closeSidebar()' class='bar-item white-txt'>SIGNUP</a>";
        }
        echo "<a href='$log.php' onclick='closeSidebar()' class='bar-item white-txt'>$upperlog</a>";
    ?>
</nav>

<script>
// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function openSidebar() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
    } else {
        mySidebar.style.display = 'block';
    }
}

// Close the sidebar with the close button
function closeSidebar() {
    mySidebar.style.display = "none";
}
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var topBar = document.getElementById('topBar');
    var lastScrollTop = 0;

    window.addEventListener('scroll', function () {
      var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

      if (scrollTop > lastScrollTop) {
        // Scrolling down, hide the top bar
        topBar.style.top = '-100px'; // Adjust the height of the top bar
      } else {
        // Scrolling up, show the top bar
        topBar.style.top = '0';
      }

      lastScrollTop = scrollTop;
    });
  });
</script>
</body>
</html>
