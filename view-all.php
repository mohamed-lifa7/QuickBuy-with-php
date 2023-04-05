<?php
include('includes/conn.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>QuickBuy | View-All</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- normalize css library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/all.min.css'>
    <!-- main css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <!-- components css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/css_components/header-footer.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/search.css'>
</head>


<body>
    <!-- start header  -->
    <?php
    include 'includes/header.php';
    // include 'includes/nav-bar.php';
    ?>

    <div class="top-products section">
        <div class="container">
            <?php
            $category = $_GET['type'];
            ?>

            <div class="main-heading">
            </div>
            <div class="products">
                <ul class="products-grid">
                    <?php
                    $sql = "SELECT * FROM products WHERE status = 1 and type = '$category'"; // Query to get products with status 1
                    $result = $conn->query($sql); // Execute query
                    
                    if ($result->num_rows > 0) { // If there are products with status 1
                        while ($row = $result->fetch_assoc()) { // Loop through each product
                            $id = $row['product_id'];
                            $name = $row['name'];
                            // $type = $row['type'];
                            $image = $row['image'];
                            $price = $row['price'];
                            ?>
                            <li class="product-item">
                                <a href="prod-detail.php?id=<?php echo $id; ?>" class="product-link">
                                    <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>" class="product-image">
                                    <div class="product-info">
                                        <h2 class="product-title">
                                            <?php echo $name; ?>
                                        </h2>
                                        <p class="product-description">
                                            <!-- <?php echo $type; ?> -->
                                        </p>
                                        <span class="product-price">$
                                            <?php echo $price; ?>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <?php
                        }
                    } else { // If there are no products with status 1
                        echo "<p>No products found.</p>";
                    }

                    $conn->close(); // Close database connection
                    ?>
                </ul>
            </div>
        </div>
    </div>


    <?php
    include 'includes/footer.php'
        ?>
</body>

</html>