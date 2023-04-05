<?php
session_start();
if ($_SESSION['user_type'] == "admin") {
    header('location: manager.php');
} elseif (($_SESSION['user_type'] == "seller")) {
    header('location: seller-dashboard.php');
} else {
    header('location: index.php');
}