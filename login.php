<?php
include('server.php');
if (isset($_SESSION['user_type'])) {
    header('location: check.php');
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>QuickBuy | Log in</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- normalize css library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/all.min.css'>
    <!-- main css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='signin/login.css'>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="logo">
                <a href="index.php"><img src="img/logo/logo.png" alt="QuickBuy"></a>
            </div>
            <form action="login.php" method="post">
                <h4>Log in</h4>
                <div class="email">
                    <input type="email" name="email" value="" placeholder="Email" required>
                    <span></span>
                </div>
                <div class="password">
                    <input type="password" name="password" value="" placeholder="Password" required>
                    <span></span>
                </div>
                <div class="remember">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <input type="submit" name="login" value="Log in">
                <div class="help">
                    <a href="#" class="forgot-pswd">Forgot Password?</a>
                    <a href="signup.php" class="new-acc">Create new account?</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>