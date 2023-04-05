<?php
include('includes/conn.php');
if ($_SESSION['user_type'] !== "admin")
    header('location: index.php');

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Product Manager Dashboard</title>
    <!-- normalize css library -->
    <link rel='stylesheet' type='text/css' href='css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' href='css/all.min.css'>
    <!-- <link rel='stylesheet' type='text/css'  href='../css/css_components/header-footer.css'> -->
    <link rel="stylesheet" type="text/css" href="product_manager/products-mngmnt.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
</head>

<body>
    <?php
    $admin_id = $_SESSION['user_id'];
    // retrieve the product manager name from the database
    $sql = "SELECT name FROM user WHERE user_id = '$admin_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $productManagerName = $row['name'];
    ?>

    <header>
        <h1>Welcome,
            <?php echo $productManagerName; ?>
        </h1>
    </header>

    <nav>
        <ul>
            <li><a href="#" onclick="toggleSection('pending-products')">Pending Products</a></li>
            <li><a href="#" onclick="toggleSection('product-management')">Product Management</a></li>
            <li><a href="#" onclick="toggleSection('seller-management')">Seller Management</a></li>
            <li><a href="#" onclick="toggleSection('category-management')">Category Management</a></li>
            <li><a href="#" onclick="toggleSection('profile')">Profile</a></li>
            <li><a href="signin/logout.php">Logout</a></li>
        </ul>
    </nav>

    <main>
        <section id="pending-products">
            <h2>Pending Products</h2>
            <p>Here are the products that are waiting for your review:</p>
            <ul>
                <?php
                $sql = "SELECT * FROM products WHERE status = 0 ";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>";
                    echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . " 'class='product-image'>";
                    echo "<h3>" . $row['name'] . "</h3>";
                    echo "<p>Price: $" . $row['price'] . "</p>";
                    echo "<button class='approve-btn' data-product-id='" . $row['product_id'] . "'>Approve</button>";
                    echo "<button class='reject-btn' data-product-id='" . $row['product_id'] . "'>Reject</button>";
                    echo "<button class='edit-btn' data-product-id='" . $row['product_id'] . "' onclick='editProduct(" . $row['product_id'] . ")'>Edit</button>";
                    echo "</li>";
                }
                ?>
            </ul>
        </section>
        <section id="seller-management" class="content">
            <h2>Seller Management</h2>
            <p>Manage your relationships with sellers:</p>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Seller ID</th>
                            <th>Seller Name</th>
                            <th>Actions</th>
                            <th>Status</th>
                            <th>Seller Since </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // query for all sellers
                        $query = "SELECT * FROM user where type = 2";
                        $result = $conn->query($query);

                        // loop through each seller and display their info and actions
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['user_id'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>';
                            echo '<a class="action-btn edit-btn" href="product_manager/edit-seller.php?seller_id=' . $row['user_id'] . '">Edit</a>';
                            echo '<a class="action-btn reject-btn" href="product_manager/delete-seller.php?seller_id=' . $row['user_id'] . '">Delete</a>';
                            if ($row['status'] == 1) {
                                echo '<a class="action-btn block-btn" href="product_manager/block-seller.php?seller_id=' . $row['user_id'] . '">Block</a>';
                            } elseif ($row['status'] == -1) {
                                echo '<a class="action-btn unblock-btn" href="product_manager/unblock-seller.php?seller_id=' . $row['user_id'] . '">UnBlock</a>';
                            } else {
                                echo '<a class="action-btn aprove-btn" href="product_manager/aprove-seller.php?seller_id=' . $row['user_id'] . '">Aprove</a>';
                            }
                            echo '</td>';
                            if ($row['status'] == -1) {
                                echo '<td>Blocked</td>';
                            } elseif ($row['status'] == 1) {
                                echo '<td>Open</td>';
                            } else {
                                echo '<td>Pending</td>';
                            }

                            echo '<td>' . $row['created_at'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <a class="action-btn add-btn" href="signup.php">Add New Seller</a>
        </section>



        <section id="product-management" class="content">
            <h2>Product Management</h2>
            <p>Here are the products that are waiting for your review:</p>
            <div class="container">
                <?php
                $sql = "SELECT * FROM products WHERE status = 0 OR status = 1 "; // Query to get products with status 1
                $result = $conn->query($sql); // Execute query
                
                if ($result->num_rows > 0) { // If there are products with status 1
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) { // Loop through each product
                                $id = $row['product_id'];
                                $name = $row['name'];
                                $type = $row['type'];
                                $image = $row['image'];
                                $price = $row['price'];
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
                                        <?php
                                        if ($row['status'] == 1) {
                                            echo 'Approved';
                                        } elseif ($row['status'] == -1) {
                                            echo 'Rejected';
                                        } else {
                                            echo 'Pending';
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        <?php echo "<button class='reject-btn' data-product-id='" . $row['product_id'] . "'>Remove</button>"; ?>
                                        <button class="action-btn edit-btn" data-product-id="<?php echo $row['product_id']; ?>"
                                            onclick="editProduct(<?php echo $row['product_id']; ?>)">Edit</button>

                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else { // If there are no products with status 1
                    echo "<p>No products found.</p>";
                }
                ?>
            </div>
        </section>
        <section id="category-management">
            <h2>Category Management</h2>
            <p>Here you can manage the categories:</p>
            <ul>
                <li>Add a new category</li>
                <li>Remove a category</li>
                <li>Edit a category</li>
            </ul>
        </section>

        <section id="profile">
            <?php
            $user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM user WHERE user_id = '$user_id'";
            $result = $conn->query($query);
            $user = $result->fetch_assoc();
            include('includes/profile-table.php') ?>
        </section>

    </main>

    <footer>
        <p>&copy; 2023 QuickBuy</p>
    </footer>


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
    <script>
        // add event listeners for the approve and reject buttons
        var approveBtns = document.querySelectorAll('.approve-btn');
        var rejectBtns = document.querySelectorAll('.reject-btn');

        approveBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                updateProductStatus(btn.getAttribute('data-product-id'), 1);
            });
        });

        rejectBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                updateProductStatus(btn.getAttribute('data-product-id'), -1);
            });
        });

        // function to update the product status in the database
        function updateProductStatus(productId, status) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'product_manager/update-product-status.php');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    window.location.reload();
                } else {
                    console.log('Request failed.  Returned status of ' + xhr.status);
                }
            };
            xhr.send('product_id=' + productId + '&status=' + status);
        }
        function editProduct(productId) {
            window.location.href = "product_manager/edit-product.php?product_id=" + productId;
        }

    </script>
    <script>
        // Get the edit button and the save/cancel buttons
        const editBtn = document.querySelector('.edit-btn');
        const saveBtn = document.querySelector('.save-btn');
        const cancelBtn = document.querySelector('.cancel-btn');

        // Get the plain text and input fields
        const plainTexts = document.querySelectorAll('.plain-text');
        const inputFields = document.querySelectorAll('.edit-field');

        // Hide the input fields and save/cancel buttons initially
        inputFields.forEach(input => {
            input.style.display = 'none';
        });
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';

        // Add a click event listener to the edit button
        editBtn.addEventListener('click', () => {
            // Hide the plain text and show the input fields
            plainTexts.forEach(text => {
                text.style.display = 'none';
            });
            inputFields.forEach(input => {
                input.style.display = 'block';
            });

            // Show the save/cancel buttons and hide the edit button
            saveBtn.style.display = 'inline-block';
            cancelBtn.style.display = 'inline-block';
            editBtn.style.display = 'none';
            inputFields[1].focus();
        });

        // Add a click event listener to the cancel button
        cancelBtn.addEventListener('click', () => {
            // Hide the input fields and save/cancel buttons and show the plain text
            inputFields.forEach(input => {
                input.style.display = 'none';
            });
            saveBtn.style.display = 'none';
            cancelBtn.style.display = 'none';
            plainTexts.forEach(text => {
                text.style.display = 'inline-block';
            });

            // Show the edit button
            editBtn.style.display = 'inline-block';
        });

        // Add a click event listener to the save button
        saveBtn.addEventListener('click', () => {
            // Hide the input fields and save/cancel buttons and show the plain text
            inputFields.forEach(input => {
                input.style.display = 'none';
                input.previousElementSibling.innerText = input.value;
            });
            saveBtn.style.display = 'none';
            cancelBtn.style.display = 'none';
            plainTexts.forEach(text => {
                text.style.display = 'inline-block';
            });

            // Show the edit button
            editBtn.style.display = 'inline-block';

            // Submit the form
            document.querySelector('.form-profile').submit();
        });
    </script>
    <?php
    // close the database connection
    mysqli_close($conn);
    ?>
</body>

</html>