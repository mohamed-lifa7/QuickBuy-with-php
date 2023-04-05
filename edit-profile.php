<?php
include 'includes/conn.php';
$errors = array();

// handle user registration
if (isset($_POST['save'])) {

    // receive all input values from the form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $image = $_FILES["image"];

    //check empty stack 
    if (empty($name)) {
        array_push($errors, "Fullname is requiered");
    }
    if (empty($user_name)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }

    // validate the profile photo
    if ($image["error"] != 0 && $image["size"] == 0) {
        // No image uploaded, set default photo
        $photo = "default_profile_photo.jpg";
    } else {
        $allowedTypes = ["image/jpeg", "image/png", "image/webp"];
        if (!in_array($image["type"], $allowedTypes)) {
            array_push($errors, "Profile photo must be a JPEG or PNG file");
        }
    }


    if (count($errors) == 0) {
        if ($photo == "default_profile_photo.jpg") {
            $image_path = "images/profiles/" . $photo;

        } else {
            // Generate unique file name for uploaded image
            $image_ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $image_name = uniqid() . "." . $image_ext;
            $image_path = "images/profiles/" . $image_name;

            // Move uploaded file to specified directory with unique file name
            move_uploaded_file($image['tmp_name'], $image_path);
        }

        $query = "UPDATE  user SET name='$name', user_name='$user_name', email='$email', photo='$image_path' WHERE user_id = '$user_id'";
        mysqli_query($conn, $query);


        // redirect to profile page after saving data
        header("Location: profile.php");
        exit;
    }
}