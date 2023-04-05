<?php
include('../includes/conn.php');

// check if the checkout form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $total = $_POST['total'];
    $user_id = $_POST['user_id'];

    // insert the order into the database
    $query = "INSERT INTO orders (full_name, user_id, email, address, total) VALUES ('$name', '$user_id' ,'$email', '$address', '$total')";
    mysqli_query($conn, $query);
    // get the order id
    $order_id = mysqli_insert_id($conn);
    $_SESSION['order_id'] = $order_id;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['address'] = $address;
    $_SESSION['total'] = $total;

    // insert the order items into the database
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $quantity = $product['quantity'];
        $price = $product['price'];
        $query = "INSERT INTO order_items (order_id, prod_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
        mysqli_query($conn, $query);
    }

    // redirect to the thank you page
    header('Location: thank_you.php');
    exit();
} else {
    // if the form wasn't submitted, redirect to the checkout page
    header('Location: checkout.php');
    exit();
}