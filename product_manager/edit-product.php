<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// check if the product ID is set in the URL
if (isset($_GET['product_id'])) {
    // get the product ID from the URL and sanitize it
    $product_id = filter_var($_GET['product_id'], FILTER_SANITIZE_NUMBER_INT);

    // connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'myMagazine');

    // query the database for the product information using a prepared statement
    $stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE product_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // check if the form has been submitted
    if (isset($_POST['submit'])) {
        // sanitize and validate the form data
        $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $type = $_POST['type'];
        $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // validate the form data
        if (empty($name) || empty($price) || empty($description)) {
            echo "Please fill in all the fields.";
            exit();
        }
        if (!is_numeric($price)) {
            echo "Please enter a valid price.";
            exit();
        }

        // update the product information in the database using a prepared statement
        $stmt = mysqli_prepare($conn, "UPDATE products SET name = ?, type = ?, price = ?, description = ? WHERE product_id = ?");
        mysqli_stmt_bind_param($stmt, "ssdsi", $name, $type, $price, $description, $product_id);
        mysqli_stmt_execute($stmt);

        // redirect the user back to the admin panel
        header('Location: ../manager.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Product</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- normalize css library -->
    <link rel='stylesheet' type='text/css' media='screen' href='../css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' media='screen' href='../css/all.min.css'>
    <!-- main css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='edit-product.css'>
</head>

<body>
    <h1 class="edit-product-heading">Edit Product</h1>
    <form method="post" class="edit-product-form">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>"><br><br>
            <span></span>
        </div>
        <div class="form-group">
            <label>Price:</label>
            <input type="text" name="price" value="<?php echo htmlspecialchars($row['price']); ?>"><br><br>
            <span></span>
        </div>
        <div>
            <label for="product-category">Product Category</label>
            <select id="product-category" name="type" required>
                <option value="">-- Please select --</option>
                <option value="Electronics">Electronics</option>
                <option value="Fashion">Fashion</option>
                <option value="Home and Garden">Home and Garden</option>
                <option value="Beauty and Personal care">Beauty and Personal care</option>
                <option value="Sports and Outdoors">Sports and Outdoors</option>
                <option value="Books and Stationery">Books and Stationery</option>
                <option value="Baby and Kids">Baby and Kids</option>

            </select><br><br>
            <span></span>
        </div>
        <div class="form-group">
            <label>Description:</label><br>
            <textarea name="description"><?php echo htmlspecialchars($row['description']); ?></textarea><br><br>
        </div>
        <input type="submit" name="submit" value="Save Changes">
    </form>
</body>

</html>