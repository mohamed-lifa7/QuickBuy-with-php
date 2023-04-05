<?php
// session_start();
include 'includes/conn.php';
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); // initialize the cart if it does not exist
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cart</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- normalize css library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/all.min.css'>
    <!-- components css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/css_components/header-footer.css'>
    <!-- main css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='product-detail/cart.css'>
</head>

<body>
    <?php
    include 'includes/header.php'
        ?>
    <?php
    if (($_SESSION['user_type']) !== "customer") {
        header('location: login.php');
        exit();
    }
    // check if the product ID is provided in the POST request
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        // retrieve the product information
        $sql = "SELECT * FROM products WHERE product_id = $product_id AND status = 1";
        $result = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($result);
        // add the product to the cart
        if (isset($_SESSION['cart'][$product_id])) {
            // update the quantity of the existing item
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            // add the new item to the cart
            $_SESSION['cart'][$product_id] = array(
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
                // default quantity is 1
                'image' => $product['image']
            );
        }

    }
    echo '<main class="section main">';
    echo '<div class="cart container">';
    echo '<h1 class="cart-title">Shopping Cart</h1>';
    if (isset($_SESSION['cart'])) {
        echo '<form method="post">';
        echo '<table class="cart-table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Product</th>';
        echo '<th>Image</th>';
        echo '<th>Price</th>';
        echo '<th>Quantity</th>';
        echo '<th>Total</th>';
        echo '<th>Remove</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $total = 0;
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $quant = $product['quantity'];
            echo '<tr>';
            echo '<td class="cart-product">';
            echo '<h2 class="cart-product-title">' . $product['name'] . '</h2>';
            echo '</td>';
            echo '<td class="cart-image">';
            echo '<img src="' . $product["image"] . '" alt="' . $product["name"] . '" class="product-image">';
            echo '</td>';
            echo '<td class="cart-price">$' . $product['price'] . '</td>';
            echo '<td class="cart-quantity">';
            if (isset($_POST['quantity'])) {
                $quantity = $_POST['quantity'];
                // update the quantity in the cart
                $_SESSION['cart'][$product_id]['quantity'] = $quantity;

                $quant = $_SESSION['cart'][$product_id]['quantity'];
            }
            echo '<input type="number" min="1" name="quantity" value="' . $product['quantity'] . '" id="quantity-' . $product_id . '">';
            echo '</td>';
            $subtotal = $product['price'] * $product['quantity'];
            echo '<td class="cart-total">$' . $subtotal . '</td>';
            echo '<td class="cart-remove"><a href="product-detail/remove_product.php?product_id=' . $product_id . '"><i class="fa fa-remove"></i></a></td>';
            echo '</tr>';
            $total += $subtotal;
        }
        echo '</tbody>';
        echo '</table>';
        echo '<div class="cart-summary">';
        echo '<h2 class="cart-summary-title">Order Summary</h2>';
        echo '<table class="cart-summary-table">';
        echo '<tr>';
        echo '<td>Subtotal</td>';
        echo '<td>$' . $total . '</td>';
        echo '</tr>';
        $tax = $total * 0.05;
        echo '<tr>';
        echo '<td>Tax</td>';
        echo '<td>$' . $tax . '</td>';
        echo '</tr>';
        $total += $tax;
        echo '<tr>';
        echo '<td>Total</td>';
        echo '<td>$' . $total . '</td>';
        echo '</tr>';
        echo '</table>';
        echo '<button type="submit" class="update-button">Update Cart</button>';
        echo '<a href="product-detail/checkout.php" class="checkout-button">Checkout</a>';
        echo '</div>';
        echo '</div>';
        echo '</form>';
    } else {
        // display a message indicating that the cart is empty
        echo '<h3>You Cart is empty</h3>';
    }
    echo '</main>';
    mysqli_close($conn);
    include 'includes/footer.php'
        ?>
    <script>
        const quantityInputs = document.querySelectorAll('input[name="quantity"]');
        quantityInputs.forEach(input => {
            input.addEventListener('change', event => {
                const product_id = input.id.split('-')[1];
                const quantity = input.value;
                updateCartQuantity(product_id, quantity);
            });
        });

        function updateCartQuantity(product_id, quantity) {
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        const subtotal = response.subtotal;
                        const total = response.total;
                        document.getElementById('subtotal-' + product_id).textContent = '$' + subtotal.toFixed(2);
                        document.getElementById('total').textContent = '$' + total.toFixed(2);
                    } else {
                        console.error(response.error);
                    }
                }
            };
            xhr.open('POST', 'product-detail/update_cart_quantity.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('product_id=' + product_id + '&quantity=' + quantity);
        }
    </script>

</body>

</html>