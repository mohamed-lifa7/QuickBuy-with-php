<?php
include('includes/conn.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Product Detail</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- normalize css library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/all.min.css'>
    <!-- main css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='product-detail/prod-detail.css'>
    <!-- components css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/css_components/header-footer.css'>
</head>

<body>
    <!-- start header  -->
    <?php
    include 'includes/header.php';

    // get the product ID from the URL parameter
    $id = $_GET['id'];

    // retrieve the product information
    $sql = "SELECT * FROM products WHERE product_id = $id AND status = 1";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);

    // generate the HTML code
    echo '<main class="section">';
    echo '<div class="product-detail container">';
    echo '<img src="' . $product["image"] . '" alt="' . $product["name"] . '" class="product-image">';
    echo '<div class="product-info">';
    echo '<h1 class="product-title">' . $product["name"] . '</h1>';
    echo '<p class="product-description">' . $product["description"] . '</p>';
    echo '<span class="add-price">';
    echo '<span class="product-price">$' . $product["price"] . '</span>';
    echo '<form method="POST" action="cart.php" class="add-cart">
        <input type="hidden" name="product_id" value="' . $product["product_id"] . '">
        <button type="submit" class="add-to-cart">Add to Cart</button>
        </span>
        </div>
      </form>';
    echo '</div>';
    echo '</main>';

    // close the database connection
    mysqli_close($conn);
    ?>

    <!-- end datail -->
    <!-- start footer  -->
    <?php
    include 'includes/footer.php'
        ?>

    <!-- start footer  -->
</body>

</html>