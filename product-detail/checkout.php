<?php
include('../includes/conn.php');
?>
<!DOCTYPE html>
<html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Check Out</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- normalize css library -->
    <link rel='stylesheet' type='text/css' media='screen' href='../css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' media='screen' href='../css/all.min.css'>
    <!-- main css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='checkout.css'>
</head>

<body>
    <?php
    // session_start();
    
    // check if the cart is not empty
    if (!empty($_SESSION['cart'])) {
        $user_id = $_SESSION['user_id'];
        $query = "SELECT name, email FROM user WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        $name = $user['name'];
        $email = $user['email'];
        // calculate the total amount
        $total = 0;
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $total += $product['price'] * $product['quantity'];
        }
        $tax = $total * 0.05;
        $total += $tax;

        // display the checkout form
        echo '<h1>Checkout</h1>';
        echo '<form method="post" action="place_order.php">';
        echo '<label for="name">Name:</label>';
        echo '<input type="text" name="name" id="name" value="' . $name . '" readonly>';
        echo '<label for="email">Email:</label>';
        echo '<input type="email" name="email" id="email" value="' . $email . '" readonly>';
        echo '<label for="address">Address:</label>';
        echo '<textarea name="address" id="address" required></textarea>';
        echo '<label for="total">Total Amount:</label>';
        echo '<input type="text" name="total" id="total" value="' . $total . '" readonly>';
        echo '<input type="hidden" name="user_id" value=' . $user_id . ' >';
        echo '<input type="submit" value="Place Order">';
        echo '</form>';
    } else {
        // if the cart is empty, display an error message
        echo '<h1>Your cart is empty</h1>';
    }
    ?>
</body>

</html>