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

// get seller info
$query = "SELECT * FROM user WHERE user_id = '$seller_id'";
$result = $conn->query($query);
$seller = $result->fetch_assoc();

// check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get form data
    $name = $_POST['name'];
    $email = $_POST['email'];

    // update seller info in database
    $query = "UPDATE user SET name = '$name', email = '$email' WHERE user_id = '$seller_id'";
    if ($conn->query($query) === TRUE) {
        header('Location: ../manager.php');
        exit();
    } else {
        $error_msg = "Error updating seller info: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Seller</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <h1>Edit Seller</h1>

    <?php if (isset($error_msg)) { ?>
        <div class="error">
            <?php echo $error_msg; ?>
        </div>
    <?php } ?>

    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $seller['name']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $seller['email']; ?>" required>

        <input type="submit" value="Save">
    </form>
</body>

</html>