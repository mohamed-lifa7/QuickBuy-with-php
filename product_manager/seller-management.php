<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'myMagazine');

// Retrieve all registered sellers from the database
$sql = "SELECT * FROM users WHERE user_type = 'seller'";
$result = mysqli_query($conn, $sql);

// Display a table of all registered sellers
echo "<table>";
echo "<tr><th>User ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['user_id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td><a href='approve-seller.php?user_id=" . $row['user_id'] . "'>Approve</a> | <a href='reject-seller.php?user_id=" . $row['user_id'] . "'>Reject</a> | <a href='view-seller-products.php?user_id=" . $row['user_id'] . "'>View Products</a> | <a href='view-seller-sales.php?user_id=" . $row['user_id'] . "'>View Sales</a></td>";
    echo "</tr>";
}
echo "</table>";

// Close the database connection
mysqli_close($conn);
?>