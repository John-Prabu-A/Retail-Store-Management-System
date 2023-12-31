<?php
include 'includes/pages/header.php';

if (isset($_SESSION["id"])) {
    $userId = $_SESSION["id"];
} else {
    header("location: login.php");
}

if (isset($_SESSION['profileUpdateStatus'])) {
    displayPopup($_SESSION['profileUpdateStatus'][0], $_SESSION['profileUpdateStatus'][1]);
    if ($_SESSION['profileUpdateStatus'][1] == 'success') {
        // Additional actions after a successful profile update
    }
    unset($_SESSION['profileUpdateStatus']);
}

$con = mysqli_connect('localhost', 'root', '', 'NammaKadai'); // Adjust database connection details

$sql = "SELECT ud.*, upp.userProfileImage FROM User_Details ud LEFT JOIN User_Profile_Pic upp ON ud.userId = upp.userId WHERE ud.userId = $userId"; // Adjust table name
$result = mysqli_query($con, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $image = ($row['userProfileImage'] == null) ? 'includes/defaultProfile.jpg' : $row['userProfileImage'];
    $name = $row['userName'];
    $email = $row['userEmail'];
    $mobileNo = $row['userMobileNo'];
    $coins = $row['purchaseCount'];
    $date = $row['lastVisited'];
}
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Profile Page</title>
    <link rel='preconnect' href='https://fonts.gstatic.com'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='cssStyles/profile_page_style.css'>
</head>

<body>
    <div class='background'>
        <div class='shape'></div>
        <div class='shape'></div>
    </div>
    <br>
    <form class='profileForm' action="action.php" method="POST">
        <h3><i class='fas fa-paperclip'></i> Profile</h3>
        <div class='profilePictureContainer'>
            <img src="<?php echo $image; ?>" alt='Profile Picture' class='profilePicture'>
        </div>
        <label for='fullName'>Name</label>
        <input value="<?php echo $name; ?>" name='name' disabled>

        <label for='email'>Email</label>
        <input value="<?php echo $email; ?>" name='email' disabled>

        <label for='mobileNo'>Mobile Number</label>
        <input type='text' value="<?php echo $mobileNo; ?>" name='mobileNo' disabled>

        <label for='goldenCoin' style='color: goldenrod;'>Golden Coins</label>
        <input value="<?php echo $coins; ?>" name='goldenCoin' disabled>

        <label for='date'>Last Purchased Date</label>
        <input value="<?php echo $date; ?>" name='lastPurchased' disabled>

        <button type='submit' name='gotoUserProfileUpdatePage'>Update Details&ensp;➤</button>
    </form>
</body>

</html>
