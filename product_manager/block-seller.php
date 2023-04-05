<?php
include '../includes/conn.php';

// check if user is an admin, otherwise redirect to home page
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != "admin") {
    header('Location: ../index.php');
    exit();
}

// get seller id from query string
if (isset($_GET['seller_id'])) {
    $seller_id = $_GET['seller_id'];
} else {
    header('Location: ../manager.php');
    exit();
}

// update the product status in the database
$sql = "UPDATE user SET status = -1 WHERE user_id = $seller_id";
if (mysqli_query($conn, $sql)) {
    header('Location: ../manager.php');
} else {
    echo "Error Blocking Seller: " . mysqli_error($conn);
}