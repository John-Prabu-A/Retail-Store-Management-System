<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="cssStyles/products_page_style.css">
    <style>
        .dropdown {
            display: inline-block;
        }

        .dropdown-toggle {
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 4em;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            border-radius: 1em;
            z-index: 1;
        }

        .dropdown-menu div {
            padding: 8px 16px;
        }

        .dropdown.open .dropdown-menu {
            display: block;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var dropdown = document.querySelector('.dropdown');
            dropdown.addEventListener('click', function (event) {
                if (!event.target.matches('.dropdown-toggle')) {
                    event.stopPropagation(); 
                } else {
                    dropdown.classList.toggle('open');
                }
            });

            // Handle checkbox clicks without closing the dropdown
            dropdown.addEventListener('click', function (event) {
                if (event.target.type === 'checkbox') {
                    event.stopPropagation(); 
                }
            });

            // Close the dropdown when clicking outside
            document.addEventListener('click', function (event) {
                if (!dropdown.contains(event.target)) {
                    dropdown.classList.remove('open');
                }
            });
        });
    </script>
    <script>
        function resizeImage(image) {
            var width = image.width;
            image.style.height = width * 0.6 + 'px';
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sortOptionSelect = document.getElementById('sortOption');

            // Add an event listener to the select element
            sortOptionSelect.addEventListener('change', function () {
                // Check if it's not the default option before submitting
                if (sortOptionSelect.value !== '') {
                    document.getElementById('sortForm').submit();
                }
            });

            // Trigger change event on page load to handle default selection
            sortOptionSelect.dispatchEvent(new Event('change'));
        });
    </script>
</head>
<body>
<!-- Product Section -->

<div class="container" style="text-align: center; background-color: #616161;" id="products">
    <div style="position:relative; text-align: center; display:inline-block;">
        <!-- Product Sort Box -->
        <div style="position: sticky; display: inline-block; padding-top: 50px; height: 60px;">
            <form id="sortForm" method="post" style="text-align: left;">
                <label style="color: white;"> Sort By : </label>
                <select name="sortOption" id="sortOption" style="border-radius: .3em; padding: 5px;">
                    <option value="">Select option</option>
                    <option value="default">Default</option>
                    <option value="lowToHigh">Low to high</option>
                    <option value="highToLow">High to low</option>
                </select>
            </form>
        </div>
        <!-- Product Filter Box -->
        <div class="filter-dropdown" style="position: sticky; display: inline-block; height:60px;">
            <form method="post" style="text-align: left; display: inline">
                <label for="selectOption" style="color: white;">Filter : </label>
                <div class="dropdown">
                    <button class="dropdown-toggle" style="border-radius: .3em;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Options
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div>
                            <input type="checkbox" id="Earphones" name="selectOption[]" value="Earphones">
                            <label for="Earphones">Earphones</label>
                        </div>
                        <div>
                            <input type="checkbox" id="Power-Adapters" name="selectOption[]" value="Power-Adapters">
                            <label for="Power-Adapters">Power Adapters</label>
                        </div>
                        <div>
                            <input type="checkbox" id="Storage-Devices" name="selectOption[]" value="Storage-Devices">
                            <label for="Storage-Devices">Storage Devices</label>
                        </div>
                        <div>
                            <input type="checkbox" id="Tempered-Glass" name="selectOption[]" value="Tempered-Glass">
                            <label for="Tempered-Glass">Tempered Glass</label>
                        </div>
                    </div>
                </div>
                <input type="submit" style="border-radius: .3em;" value="Submit">
            </form>
            <form method="post" style="text-align: left; display: inline">
                <input type="submit" name="clearFilter" style="border-radius: .3em; display: inline" value="Clear Filter">
            </form>

        </div>
        <h2 style="color: white; padding: 0 auto; margin: 0 auto;">Products</h2>
        <h4 style="padding: 0 auto; color: white; margin: 0 auto;">Choose a best Product that fits your needs.</h4>
    </div>
    <div style="margin-top: 0px; padding: 0;">
    <?php

        $con = mysqli_connect("localhost", "root", "", "nammakadai");

        function queryRun($con, $sql)
        {
            $result = mysqli_query($con, $sql);
            $output = '';

            while ($row = mysqli_fetch_assoc($result)) {
                $productId = $row['productId'];

                $productName = $row['productName'];
                $sqlPic = "SELECT * FROM product_pic WHERE productId = '$productId'";
                $result_pic = mysqli_query($con, $sqlPic);
                $row1 = mysqli_fetch_assoc($result_pic);
                $productImage = $row1['productImageLocation'];
                $productDescription = $row['productDescription'];
                $shortProductDescription = substr($productDescription, 0, 47) . "...";
                $productQuantity = $row['quantity'];
                $productPrice = $row['sellingPrice'];

                $output .= '
                    <div class="card">
                        <ul class="ul" style="background-color: white;">
                            <li class="productHeading">' . $productName . '</li>
                            <img src="' . $productImage . '" alt="image" onload="resizeImage(this);" style="width: 100%; object-fit: cover; background-color: rgba(0, 0, 0, 50%);">
                            <li class="descShort" style="padding: 16px auto;"><b>Description</b><br>' . $shortProductDescription . '</li>
                            <li style="padding: 16px auto;">Stock Available<br> <b>' . $productQuantity . ' items</b> </li>
                            <li style="padding: 16px auto;">
                                <span style="opacity: 0.6;">Price</span>
                                <h2 style="letter-spacing: 4px; padding: 2px; margin:0px;"><b>Rs. ' . $productPrice . '/- only</b></h2>
                            </li>
                            <li style="color: black; background-color: #f1f1f1; padding: 24px auto;">
                                <a class="a" href="action.php?productId=' . $productId . '">Add to Cart</a>
                            </li>
                        </ul>
                    </div>
                ';
            }

            return $output;
        }

        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['selectOption'])) {
                $selectedOptions = $_POST['selectOption'];

                // Store selected options in session
                $_SESSION['selectedOptions'] = $selectedOptions;
            }
        }
        if(isset($_POST["clearFilter"])) {
            $sql = "SELECT * FROM product_details order by rand()";
            echo queryRun($con, $sql);
            $_SESSION['clearFilter'] = true;
        } else if (isset($_SESSION['selectedOptions']) && is_array($_SESSION['selectedOptions'])) {
            $selectedOptions = $_SESSION['selectedOptions'];
            $conditions = [];
            foreach ($selectedOptions as $option) {
                $escapedOption = mysqli_real_escape_string($con, $option);
                $conditions[] = "product_type = '$escapedOption'";
            }
            $conditionString = implode(" OR ", $conditions);
            $sql = "SELECT * FROM product_details WHERE $conditionString order by rand()";

            // Display products based on selected options
            echo queryRun($con, $sql);
        } elseif(isset($_POST['sortOption'])) {
            $sortOption = $_POST['sortOption'];
            $orderByClause = '';

            switch ($sortOption) {
                case 'lowToHigh':
                    $orderByClause = 'ORDER BY sellingPrice ASC';
                    break;
                case 'highToLow':
                    $orderByClause = 'ORDER BY sellingPrice DESC';
                    break;

                default:
                    $orderByClause = '';
                    break;
            }

            // Use the $orderByClause in your SQL query
            $sql = "SELECT * FROM product_details $orderByClause";
            echo queryRun($con, $sql);
        } else {
            $sql = "SELECT * FROM product_details order by rand()";
            echo queryRun($con, $sql);
        }
    
    ?>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('form');

        // Reset form and checkboxes after PHP execution
        form.reset();

        // Uncheck all checkboxes
        var checkboxes = form.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = false;
        });
    });
</script>

<script src="https://smtpjs.com/v3/smtp.js"></script>
</body>
</html>
