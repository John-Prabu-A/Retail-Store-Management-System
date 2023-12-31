<?php
include "includes/pages/header.php";

if (!isset($_SESSION["id"])) {
    header("location: login.php");
} else {
    $userId = $_SESSION['id'];
}

$con = mysqli_connect("localhost", "root", "", "NammaKadai");

$sql = "SELECT * FROM User_Details WHERE userId = $userId";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['userName'];
$email = $row['userEmail'];
$mobileNo = $row['userMobileNo'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Profile Update Page</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssStyles/updateProfile_page_style.css">
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <br>
    <form id='form' style="display: flex; flex-direction: column; align-items: center;" enctype="multipart/form-data" method='POST' action="action.php">
        <h3><i class="fas fa-paperclip"></i> Profile</h3>
        <label for="profilePicture">Profile Picture</label>
        <input type="file" name="profilePicture" accept="image/*">
        <label for="fullName">Name</label>
        <input value="<?php echo $name; ?>" name="name">

        <label for="email">Email</label>
        <input value="<?php echo $email; ?>" name="email">

        <label for="mobileNo">Mobile Number</label>
        <input type="text" value="<?php echo $mobileNo; ?>" name="mobileNumber">

        <label for="password">Password</label>
        <input type="password" name="password">

        <label for="confirmPassword">Confirm Password</label>
        <input type="password" name="confirmPassword">

        <button type='submit' name='updateuser_Details'>Update&ensp;➤</button>
    </form>
</body>

</html>
<?php mysqli_close($con); ?>
