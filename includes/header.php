<?php 
require 'config/config.php';

// $query = mysqli_query($con, "INSERT INTO test VALUES(NULL, 'testing')");

if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
} else {
    header("Location: register.php");
}

//Checks if username variable has a value, if it doesnt it means the user is not logged in hence sent back to register.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swirlfeed</title>

    <!-- JAVASCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

<div class="top_bar">
    <div class="logo">
        <a href="index.php">Swirlfeed</a>
    </div>

    <nav>
    <a href="<?php echo $userLoggedIn?>">
        <?php
            echo $user['first_name'];
        ?>
    </i></a>
        <a href=""><i class="fa fa-home fa-lg"></i></a>
        <a href=""><i class="fa fa-envelope fa-lg"></i></a>
        <a href=""><i class="fa fa-bell fa-lg"></i></a>
        <a href=""><i class="fa fa-users fa-lg"></i></a>
        <a href=""><i class="fa fa-cog fa-lg"></i></a>
        <a href="includes/handlers/logout.php"><i class="fas fa-sign-out-alt fa-lg"></i></a>

    </nav>
</div>

<div class="wrapper">

