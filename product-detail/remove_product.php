<?php
session_start();

// check if the product ID is provided in the GET request
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    // check if the product exists in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // remove the product from the cart
        unset($_SESSION['cart'][$product_id]);
    }
}

// redirect the user back to the cart page
header("Location: ../cart.php");
exit;
?>