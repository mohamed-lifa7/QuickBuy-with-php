<?php
include('server.php');

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>QuickBuy | Sign Up</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- normalize css library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/normalize.css'>
    <!-- fontAweseme(icons) library -->
    <link rel='stylesheet' type='text/css' media='screen' href='css/all.min.css'>
    <!-- main css file  -->
    <link rel='stylesheet' type='text/css' media='screen' href='signin/signup.css'>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="logo">
                <a href="index.php"><img src="img/logo/logo.png" alt="QuickBuy"></a>
            </div>
            <form action="signup.php" method="post" enctype="multipart/form-data">
                <h4>Sign up</h4>
                <div class="name">
                    <input type="text" name="name" placeholder="Full name" required>
                    <span></span>
                </div>
                <div class="user-name">
                    <input type="text" name="user_name" placeholder="User name" required>
                    <span></span>
                </div>
                <div class="email">
                    <input type="email" name="email" placeholder="Your email" required>
                    <span></span>
                </div>
                <div class="password">
                    <input type="password" name="password1" placeholder="Password" required>
                    <span class="new"></span>
                </div>
                <p>Minimum 6 characters</p>
                <div class="confirm-pswd">
                    <input type="password" name="password2" placeholder="Re-enter password" required>
                    <span class="confirm"></span>
                </div>
                <div class="photo-profile">
                    <label for="profile_photo">Profile Photo:</label><br><br>
                    <input type="file" name="image"><br><br><br>
                </div>
                <div class="account_type">
                    <span>Account Type:</span><br><br>
                    <label>
                        <input type="radio" name="user_type" value="0" checked> Customer
                    </label>
                    <label>
                        <input type="radio" name="user_type" value="2"> Seller
                    </label>
                </div>


                <div class="submit">
                    <input type="submit" name="sign_user" value="Sign up">
                    <p>By creating an account, you agree to QuickBuy's <a href="#">Conditions of Use</a> and <a
                            href="#">Privacy Notice</a>. </p>
                </div>

                <div class="help">
                    <a href="login.php" class="log-in">Already has an account</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        const radioButtons = document.querySelectorAll('.account_type input[type="radio"]');
        const labels = document.querySelectorAll('.account_type label');

        radioButtons.forEach((radioButton, index) => {
            radioButton.addEventListener('click', () => {
                labels.forEach((label, labelIndex) => {
                    if (labelIndex === index) {
                        label.style.boxShadow = 'rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px';
                    } else {
                        label.style.backgroundColor = '';
                        label.style.boxShadow = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>