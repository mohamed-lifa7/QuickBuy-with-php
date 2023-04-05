<?php
// session_start();
include '../includes/conn.php';

if (isset($_POST['product_id'], $_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    }

    $subtotal = 0;
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $subtotal += $product['price'] * $product['quantity'];
    }
    $tax = $subtotal * 0.05;
    $total = $subtotal + $tax;

    $response = array(
        'success' => true,
        'subtotal' => $subtotal,
        'total' => $total
    );

    echo json_encode($response);
} else {
    $response = array(
        'success' => false,
        'error' => 'Product ID or quantity not provided'
    );
    echo json_encode($response);
}
?>