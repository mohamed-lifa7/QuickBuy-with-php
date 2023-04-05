<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title></title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- normalize css library -->
    <link rel='stylesheet' type='text/css' media='screen' href='../css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' media='screen' href='../css/all.min.css'>
    <!-- main css file -->
    <link rel='stylesheet' type='text/css' media='screen' href='thank_you.css'>
</head>

<body>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    // check if the order was placed successfully
    if (isset($_SESSION['order_id'])) {
        $order_id = $_SESSION['order_id'];
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $address = $_SESSION['address'];
        $total = $_SESSION['total'];
        $items = $_SESSION['cart'];
        // display a thank you message and the order details
        echo "<div class='container'>";
        echo "<h1 class='title'>Thank you for your order!</h1>";
        echo "<p class='parag'>Your order has been placed successfully.</p>";
        echo "<h2 class='detail'>Order Details:</h2>";
        // echo "<p><strong>Order ID:</strong> $order_id</p>";
        echo "<p class='info'><span>Name:</span> $name</p>";
        echo "<p class='info'><span>Email:</span> $email</p>";
        echo "<p class='info'><span>Address:</span> $address</p>";
        echo "<p class='info'><span>Total:</span> $total</p>";
        echo "<h class='items'>Items:</h3>";
        echo "<ul>";
        foreach ($items as $product) {
            echo "<li class='li-item'>{$product['name']} ({$product['quantity']} x {$product['price']})</li>";
        }
        echo "</ul>";
        echo "</div>";

        // unset the session variables
        unset($_SESSION['cart']);
    } else {
        // if the order was not placed successfully, display an error message
        echo "<h1>Oops! Something went wrong.</h1>";
        echo "<p>Sorry, we could not process your order. Please try again later.</p>";
    }
    ?>
</body>

</html>