<?php
include('includes/conn.php');

if ($_SESSION['user_type'] !== "seller")
    header('location: index.php');
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>QuickBuy | Seller</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- normalize css library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/all.min.css'>
    <!-- components css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/css_components/header-footer.css'>
    <!-- main css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='seller/seller.css'>

</head>

<body>
    <?php

    $seller_id = $_SESSION['user_id'];
    // retrieve the product manager name from the database
    $sql = "SELECT name FROM user WHERE user_id = '$seller_id'";
    $sql_status = "SELECT status FROM user WHERE user_id = '$seller_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $result1 = mysqli_query($conn, $sql_status);
    $row2 = mysqli_fetch_assoc($result1);
    $_SESSION['user_status'] = $row2['status'];
    $seller_name = $row['name'];

    include('includes/header.php');
    ?>


    <nav>
        <ul>
            <li><a href="#" onclick="toggleSection('products')">Products</a></li>
            <li><a href="#" onclick="toggleSection('sales')">Seles Management</a></li>
            <li><a href="#" onclick="toggleSection('seller-form')">Insert New Product</a></li>
        </ul>
    </nav>
    <main>

        <section id="products" class="content">
            <h2>Your Products in QuickBuy</h2>
            <p>Here are the products you have added to QuickBuy:</p>
            <div class="container">
                <?php
                $sql = "SELECT * FROM products WHERE user_id = '$seller_id'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    ?>
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['product_id'];
                                $name = $row['name'];
                                $type = $row['type'];
                                $image = $row['image'];
                                $price = $row['price'];
                                $status = '';

                                if ($row['status'] == 1) {
                                    $status = '<div class="product-status accepted">Accepted</div>';
                                } elseif ($row['status'] == -1) {
                                    $status = '<div class="product-status rejected">Rejected</div>';
                                } else {
                                    $status = '<div class="product-status pending">Pending</div>';
                                }
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $id; ?>
                                    </td>
                                    <td>
                                        <?php echo $name; ?>
                                    </td>
                                    <td>
                                        <?php echo $type; ?>
                                    </td>
                                    <td><img src="<?php echo $image; ?>" alt="<?php echo $name; ?>" class="product-image"></td>
                                    <td>
                                        $
                                        <?php echo $price; ?>
                                    </td>
                                    <td>
                                        <?php echo $status; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo "<p>No products found.</p>";
                }

                $conn->close();
                ?>
            </div>
        </section>


        <!-- ================================================================== -->
        <?php
        if ($_SESSION['user_status'] == 1) {
            echo '<section id="seller-form" class="content">
    <h2>Insert Your Product</h2>
    <div class="holder">
        <form action="seller/insert.php" method="post" enctype="multipart/form-data">
            <h2>Fill this Form</h2>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" required>

            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" name="quantity" id="quantity" required>
            </div>

            <div class="form-group">
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
                    </select>
            </div>
            <div class="form-group">
                <label for="image">Product Description</label>
                <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" id="image" name="image" required>
            </div>
            <input type="hidden" name="user_id" value="' . $_SESSION['user_id'] . '">
            <button type="submit" name="save">Submit</button>
        </form>
    </div>
</section>';
        } else {
            echo '<section id="seller-form" class="content">
    <h2>You have been Blocked</h2>
    <p>Sorry, your account has been blocked from adding new products. If you have any questions or concerns, please contact our support team.</p>
    </div>
</section>';
        }
        ?>

    </main>
    <script>
        function toggleSection(sectionId) {
            var sections = document.getElementsByTagName('section');
            for (var i = 0; i < sections.length; i++) {
                if (sections[i].id === sectionId) {
                    sections[i].style.display = 'block';
                } else {
                    sections[i].style.display = 'none';
                }
            }
        }

    </script>
    <?php
    include('includes/footer.php')
        ?>
</body>

</html>