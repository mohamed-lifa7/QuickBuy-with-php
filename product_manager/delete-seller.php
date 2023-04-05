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

// delete seller from database
$query = "DELETE FROM user WHERE user_id = '$seller_id'";
if ($conn->query($query) === TRUE) {
    $select_max = "SELECT MAX( `user_id` ) FROM `user`";
    $result = $conn->query($select_max);
    $row = $result->fetch_assoc();
    $max_id = $row['MAX( `user_id` )'];
    $reset = "ALTER TABLE `user` AUTO_INCREMENT = $max_id";
    if ($conn->query($reset) === TRUE) {
        header('Location: ../manager.php');
        exit();
    }
}
?>