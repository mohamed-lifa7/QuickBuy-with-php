<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'myMagazine');

// Retrieve the user ID from the URL parameter
$user_id = $_GET['user_id'];

// Update the user status to rejected
$sql = "UPDATE users SET status = -1 WHERE user_id = '$user_id'";
mysqli_query($conn, $sql);

// Redirect back to the seller management page
header('location: seller-management.php');

// Close the database connection
mysqli_close($conn);
?>