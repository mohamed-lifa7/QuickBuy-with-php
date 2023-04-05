<header>
    <div class="container">
        <a href="index.php" class="logo"><img src="img/logo/logo.png" alt="QuickBuy"></a>
        <form action="search.php" method="GET">
            <input type="text" name="q" placeholder="Search...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
        <div class="links">
            <i class="fas fa-bars toggle-menu"></i>
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <?php
                if (isset($_SESSION['user_id']) && $_SESSION['user_type'] === "seller") {
                    echo '<li><a href="seller-dashboard.php"><i class="fa fa-wrench" aria-hidden="true"></i> Seller</a></li>';
                }
                if ((isset($_SESSION['user_id']) && $_SESSION['user_type'] === "customer") || !isset($_SESSION['user_id'])) {
                    echo '<li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i> Cart</a></li>';
                }
                if (isset($_SESSION['user_id']) && $_SESSION['user_type'] === "admin") {
                    echo '<li><a href="manager.php">Admin <i class="fa fa-gear" aria-hidden="true"></i></a></li>';
                }
                ?>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<li><a href="profile.php">Profile <i class="fa fa-user" aria-hidden="true"></i></a></li>';
                    echo '<li><a href="signin/logout.php">Log-out <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>';
                } else {
                    echo '<li><a href="login.php">Log-in <i class="fa fa-sign-in" aria-hidden="true"></i></a></li>';
                    echo '<li><a href="signup.php">Sign-up <i class="fa fa-user-plus" aria-hidden="true"></i></a></li>';
                }
                ?>
            </ul>
        </div>

    </div>
</header>