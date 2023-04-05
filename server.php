<?php
include 'includes/conn.php';
$errors = array();

// handle user registration
if (isset($_POST['sign_user'])) {

    // receive all input values from the form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password2']);
    $type = mysqli_real_escape_string($conn, $_POST['user_type']);
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
    if (empty($password_1)) {
        array_push($errors, "Passwoed is required");
    }

    if ($password_1 != $password_2) {
        array_push($errors, "Password not match");
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
            $image_up = "images/profiles/" . $photo;

        } else {
            $image_location = $_FILES['image']['tmp_name'];
            $image_name = $_FILES['image']['name'];
            move_uploaded_file($image_location, 'images/profiles/' . $image_name);
            $image_up = "images/profiles/" . $image_name;
        }


        $password = password_hash($password_1, PASSWORD_DEFAULT);
        $query = "insert into user (name,user_name,email,password,type,photo,status) Values ('$name','$user_name','$email','$password','$type','$image_up','1')";
        mysqli_query($conn, $query);

        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_status'] = $user['status'];
        $_SESSION['email'] = $email;
        if ($user['type'] == 1) {
            $_SESSION['user_type'] = "admin";
        } elseif ($user['type'] == 2) {
            $_SESSION['user_status'] = $user['status'];
            $_SESSION['user_type'] = "seller";
        } else {
            $_SESSION['user_type'] = "customer";
        }
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        $_SESSION['success'] = "Login is successful";
        header('location: check.php');
    }
}



// LOGIN USER
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM user WHERE email='$email'";
        $results = mysqli_query($conn, $query);

        if (mysqli_num_rows($results) == 1) {
            $user = mysqli_fetch_assoc($results);
            if (password_verify($password, $user['password'])) {
                if ($user['type'] == 1) {
                    $_SESSION['user_type'] = "admin";
                } elseif ($user['type'] == 2) {
                    $_SESSION['user_type'] = "seller";
                    $_SESSION['user_status'] = $user['status'];
                } else {
                    $_SESSION['user_type'] = "customer";
                }
                $_SESSION['user_id'] = $user['user_id'];
                header('location: check.php');
            } else {
                array_push($errors, "Invalid email or password");
            }
        } else {
            array_push($errors, "Invalid email or password");
        }

    }
}