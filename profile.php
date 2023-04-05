<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>QuickBuy | User Profile</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- normalize css library  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/all.min.css'>
    <!-- components css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/css_components/header-footer.css'>
    <!-- main css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/profile.css'>
</head>

<?php
// include database connection file
include 'includes/conn.php';

// check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// get user info
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = $conn->query($query);
$user = $result->fetch_assoc();

// get user's order history
$query = "SELECT * FROM orders WHERE user_id = '$user_id'";
$result = $conn->query($query);
?>

<body>
    <?php
    include("includes/header.php")
        ?>
    <main>


        <?php
        include('includes/profile-table.php');
        if ($_SESSION['user_type'] === "customer") {
            echo '<div class="my-orders container">
        <h2>My Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Order Total</th>
                    <th>Address</th>
                    <th>Products</th>
                </tr>
            </thead>
            <tbody>';
            while ($row = $result->fetch_assoc()) {
                $order_id = $row['id'];
                $query1 = "SELECT p.name, oi.quantity, oi.price FROM order_items oi INNER JOIN products p ON oi.prod_id = p.product_id WHERE oi.order_id = '$order_id'";
                $result1 = $conn->query($query1);

                echo '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['order_date'] . '</td>
                <td>' . $row['total'] . '</td>
                <td>' . $row['address'] . '</td>
                <td>';
                while ($row1 = $result1->fetch_assoc()) {
                    echo $row1['name'] . " x " . $row1['quantity'] . "<br>";
                }
                echo '</td>
            </tr>';
            }
            echo '</tbody>
        </table>
    </div>';
        }
        ?>


    </main>
    <?php
    include('includes/footer.php');
    ?>

</body>

</html>