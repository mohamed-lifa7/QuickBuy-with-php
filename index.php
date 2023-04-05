<?php
include('includes/conn.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>QuickBuy</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- normalize css library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/all.min.css'>
    <!-- main css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <!-- components css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/css_components/header-footer.css'>
</head>

<body>
    <!-- start header  -->
    <?php
    include 'includes/header.php'
        ?>
    <button id="scroll-to-top" class="fas fa-arrow-up"></button>

    <!-- end header  -->
    <!-- start landing -->
    <div class="landing slideshow-container">
        <div class="mySlides fade">
            <img src="img/landing/banner1.jpg">
        </div>

        <div class="mySlides fade">
            <img src="img/landing/banner2.jpg">
        </div>

        <div class="mySlides fade">
            <img src="img/landing/banner8.jpg">
        </div>
    </div>
    <!-- end landing -->
    <!-- start categories  -->
    <?php
    include 'includes/nav-bar.php';
    ?>

    <!-- end categories  -->
    <!-- start new products  -->
    <!-- <div class="top-products section">
        <div class="container">
            <div class="main-heading">
                <h4>new products</h4>
                <a href="view-all.php">view all</a>
            </div>
            <div class="products">
                <ul class="products-grid">
                    <?php
                    $sql = "SELECT * FROM products WHERE status = 1"; // Query to get products with status 1
                    $result = $conn->query($sql); // Execute query
                    
                    if ($result->num_rows > 0) { // If there are products with status 1
                        while ($row = $result->fetch_assoc()) { // Loop through each product
                            $id = $row['product_id'];
                            $name = $row['name'];
                            $type = $row['type'];
                            $image = $row['image'];
                            $price = $row['price'];
                            ?>
                            <li class="product-item">
                                <a href="prod-detail.php?id=<?php echo $id; ?>" class="product-link">
                                    <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>" class="product-image">
                                    <h2 class="product-title">
                                        <?php echo $name; ?>
                                    </h2>
                                    <p class="product-description">
                                        <?php echo $type; ?>
                                    </p>
                                    <span class="product-price">$
                                        <?php echo $price; ?>
                                    </span>
                                </a>
                            </li>
                            <?php
                        }
                    } else { // If there are no products with status 1
                        echo "<p>No products found.</p>";
                    }

                    // $conn->close(); // Close database connection
                    ?>
                </ul>
            </div>
        </div>
    </div> -->
    <div class="top-products section">
        <div class="container">
            <?php
            // Get the list of categories
            $sql_categories = "SELECT DISTINCT type FROM products WHERE status = 1";
            $result_categories = $conn->query($sql_categories);
            ?>
            <?php while ($row_categories = $result_categories->fetch_assoc()) { ?>
                <div id="<?php echo $row_categories['type']; ?>">
                    <div class="main-heading">
                        <h4>
                            <?php echo $row_categories['type']; ?>
                        </h4>

                    </div>
                    <div class="products">
                        <ul class="products-grid">
                            <?php
                            // Get the 5 or 6 new products in the current category
                            $sql_products = "SELECT * FROM products WHERE status = 1 AND type = '{$row_categories['type']}' AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) ORDER BY created_at DESC LIMIT 4";
                            $result_products = $conn->query($sql_products);
                            ?>

                            <?php while ($row_products = $result_products->fetch_assoc()) { ?>
                                <li class="product-item">
                                    <a href="prod-detail.php?id=<?php echo $row_products['product_id']; ?>"
                                        class="product-link">
                                        <img src="<?php echo $row_products['image']; ?>"
                                            alt="<?php echo $row_products['name']; ?>" class="product-image">
                                        <div class="product-info">
                                            <h2 class="product-title">
                                                <?php echo $row_products['name']; ?>
                                            </h2>
                                            <p class="product-description">
                                                <?php echo $row_products['type']; ?>
                                            </p>
                                            <span class="product-price">$
                                                <?php echo $row_products['price']; ?>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <a class="view-all" href="view-all.php?type=<?php echo $row_categories['type']; ?>">View all</a>
                </div>
            <?php } ?>

        </div>
    </div>

    <!-- ebd top products  -->

    <!-- start footer  -->
    <?php
    include 'includes/footer.php'
        ?>
    <script src="js/main.js"></script>
    <!-- start footer  -->
</body>

</html>