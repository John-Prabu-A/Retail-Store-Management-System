<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Add Products</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssStyles/addProducts_page_style.css">
</head>
<body>
    <?php include "includes/pages/header.php"; ?>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" enctype="multipart/form-data" id="addProducts">
        <br><br>
        <h3><i class="fas fa-people-carry"></i> Add Products</h3>

        <label for="productName">Product Name</label>
        <input type="text" placeholder="Product Name" name="productName">

        <label for="productImage">Product Image</label>
        <input type="file" name="productImage">

        <label for="originalPrice">Original Price</label>
        <input type="number" placeholder="Product Price in Rs." name="originalPrice">

        <label for="sellingPrice">Selling Price</label>
        <input type="number" placeholder="Product Selling Price in Rs." name="sellingPrice">

        <label for="quantity">Quantity</label>
        <input type="number" placeholder="Quantity" name="quantity">

        <label for="productDescription">Product Description</label>
        <textarea style="resize: none;" rows="15" placeholder="Product Description" name="productDescription"></textarea>

        <button type="submit" name="addProduct">Add Product</button>
    </form>
    <?php
    function showSuccessMessage($message) {
        echo <<<HTML
        <div id="successPopup">
            $message
        </div>
        <script>
            setTimeout(function() {
                var popup = document.getElementById('successPopup');
                if (popup) {
                    popup.style.display = 'none';
                }
            }, 2000);
        </script>
        HTML;
    }

    if (isset($_POST['addProduct'])) {
        $con = mysqli_connect("localhost", "root", "", "NammaKadai");

        // Sanitize and validate inputs
        $productName = mysqli_real_escape_string($con, $_POST["productName"]);
        $originalPrice = floatval($_POST["originalPrice"]);
        $sellingPrice = floatval($_POST["sellingPrice"]);
        $quantity = intval($_POST["quantity"]);
        $productDescription = mysqli_real_escape_string($con, $_POST["productDescription"]);

        // Process uploaded image
        $productImageName = $_FILES["productImage"]["name"];
        $tempname = $_FILES["productImage"]["tmp_name"];
        $newImageName = "uploads/productImages/" . uniqid() . "_" . $productImageName;
        move_uploaded_file($tempname, $newImageName);

        // Insert product details into the database
        $sql = "INSERT INTO `Product_Details` (productName, originalPrice, sellingPrice, quantity, productDescription)
                VALUES ('$productName', $originalPrice, $sellingPrice, $quantity, '$productDescription')";

        $result = mysqli_query($con, $sql);

        if ($result) {
            $productId = mysqli_insert_id($con);  // Get the auto-generated product ID
            // Insert product image details into the database
            $sqlImage = "INSERT INTO `Product_Pic` (productId, productImageLocation)
                         VALUES ($productId, '$newImageName')";
            $resultImage = mysqli_query($con, $sqlImage);

            if ($resultImage) {
                showSuccessMessage("Product Added Successfully!");
            } else {
                echo "Error inserting product image: " . mysqli_error($con);
            }
        } else {
            echo "Error inserting product details: " . mysqli_error($con);
        }

        mysqli_close($con);
    }
    ?>
</body>
</html>
