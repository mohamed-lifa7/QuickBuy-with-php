<?php
// connect to the database
include('../includes/conn.php');

// check if the form has been submitted and the product ID and status have been provided
if (isset($_POST['product_id']) && isset($_POST['status'])) {
    $productId = $_POST['product_id'];
    $status = $_POST['status'];

    // update the product status in the database
    $sql = "UPDATE products SET status = $status WHERE product_id = $productId";
    if (mysqli_query($conn, $sql)) {
        echo "Product status updated successfully!";
    } else {
        echo "Error updating product status: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

// close the database connection
mysqli_close($conn);
?>