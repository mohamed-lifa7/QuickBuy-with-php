<?php
include('../includes/conn.php');
// Check if form was submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $type = $_POST["type"];
    $description = $_POST["desc"];
    $image = $_FILES["image"];
    $seller_id = $_POST["user_id"];

    // Validate form data
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($price)) {
        $errors[] = "Price is required";
    } else if (!is_numeric($price)) {
        $errors[] = "Price must be a number";
    }
    if (empty($quantity)) {
        $errors[] = "Quantity is required";
    } else if (!is_numeric($quantity)) {
        $errors[] = "Quantity must be a number";
    }
    if (empty($type)) {
        $errors[] = "Product category is required";
    }
    if (empty($description)) {
        $errors[] = "description is required";
    }
    if ($image["error"] != 0) {
        $errors[] = "Product image is required";
    } else {
        $allowedTypes = ["image/jpeg", "image/png", "image/webp"];
        if (!in_array($image["type"], $allowedTypes)) {
            $errors[] = "Product image must be a JPEG or PNG file";
        }
    }

    // If there are errors, display them
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    } else {
        // Save data to database
        $image_location = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        move_uploaded_file($image_location, '../images/' . $image_name);
        $image_up = "images/" . $image_name;
        $insert = "INSERT INTO products (name, price, quantity, type, image,status,description,user_id)
         VALUES ('$name', '$price', '$quantity', '$type', '$image_up',0,'$description','$seller_id')";
        if (mysqli_query($conn, $insert)) {
            header("Location: ../seller-dashboard.php");
            exit();
        } else {
            echo "Error: " . $insert . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>