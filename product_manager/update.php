<?php
include '../includes/conn.php';
$errors = array();

// handle user registration
if (isset($_POST['submit'])) {
    // receive all input values from the form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
    $re_password = mysqli_real_escape_string($conn, $_POST['re_password']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $image = $_FILES["image"];
    echo $user_id;

    //check empty stack 
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    if (empty($user_name)) {
        $errors[] = 'User_name is required';
    }
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }

    if (!empty($old_password)) {
        $query = "SELECT password FROM user WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

        if (!password_verify($old_password, $stored_password)) {
            $errors[] = 'Old password is incorrect';
        }
        if (empty($new_password)) {
            $errors[] = 'New password is required';
        } elseif (strlen($new_password) < 6) {
            $errors[] = 'New password must be at least 6 characters long';
        } elseif ($new_password !== $re_password) {
            $errors[] = 'Passwords do not match';
        }
    }
    if ($image["error"] != 0 && $image["size"] == 0) {
        // No image uploaded, set default photo
        $photo = "default_profile_photo.jpg";
    } else {
        $allowedTypes = ["image/jpeg", "image/png", "image/webp"];
        if (!in_array($image["type"], $allowedTypes)) {
            array_push($errors, "Profile photo must be a JPEG or PNG file");
        }
    }


    //==========================================================================
    if (count($errors) == 0) {
        if ($image == "default_profile_photo.jpg") {
            $image_up = "images/profiles/" . $image;

        } else {
            $image_location = $_FILES['image']['tmp_name'];
            $image_name = $_FILES['image']['name'];
            move_uploaded_file($image_location, '../images/profiles/' . $image_name);
            $image_up = "images/profiles/" . $image_name;
        }

        $query = "UPDATE user SET name='$name', user_name='$user_name', email='$email', photo= '$image_up' where user_id = '$user_id'";
        mysqli_query($conn, $query);

        header('location: ../check.php');
    }
}



//==============================================================================

// display errors if any
if (count($errors) > 0) {
    echo '<div class="errors">';
    foreach ($errors as $error) {
        echo '<p>' . $error . '</p>';
    }
    echo '</div>';
}