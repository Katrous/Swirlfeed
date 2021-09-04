<?php 

$con = mysqli_connect("localhost", "root", "", "social");

if(mysqli_connect_errno()){
    echo "Failed to connect" . mysqli_connect_errno();
}

// Declaring Variables to prevent errors
$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = "";

if(isset($_POST['register_button'])){
    // Register form values
    
    // First Name
    $fname = strip_tags($_POST['reg_fname']); // remove html tags
    $fname = str_replace(' ', '', $fname); //remove spaces
    $fname = ucfirst(strtolower($fname)); //uppercase first letter

    //Last name
    $lname = strip_tags($_POST['reg_lname']); // remove html tags
    $lname = str_replace(' ', '', $lname); //remove spaces
    $lname = ucfirst(strtolower($lname)); //uppercase first letter

    //email 
    $em = strip_tags($_POST['reg_email']); // remove html tags
    $em = str_replace(' ', '', $em); //remove spaces
    $em = ucfirst(strtolower($em)); //uppercase first letter

    $em2 = strip_tags($_POST['reg_email2']); // remove html tags
    $em2 = str_replace(' ', '', $em2); //remove spaces
    $em2 = ucfirst(strtolower($em2)); //uppercase first letter
    // Password
    $password = strip_tags($_POST['reg_password']); // remove html tags

    // Password2
    $password2 = strip_tags($_POST['reg_password2']); // remove html tags

    $date = date("Y-m-d");

    if($em === $em2) {
    //    check if email is in valid format
    if(filter_var($em, FILTER_VALIDATE_EMAIL)){
        $em = filter_var($em, FILTER_VALIDATE_EMAIL);

        // check if email already exists
        $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");
        // Count the number of rows returned
        $num_rows = mysqli_num_rows($e_check);

        if ($num_rows > 0) {
            echo "Email already in use";
        }

    } else{
        echo "Invalid format";
    }
    } else {
        echo "emails dont match ";
     
    }

    if(strlen($fname) > 25 || strlen($fname) < 2) {
        echo "Your first name must be between 2 and 25 characters";
    }

    
    if(strlen($lname) > 25 || strlen($fname) < 2) {
        echo "Your last name must be between 2 and 25 characters";
    }

    if($password != $password2){
        echo "Your passwords do not match";
    } else {
        if(preg_match('/[^A-Za-z0-9]/', $password)){
            echo "Your password can only contain english characters or numbers";
        }
    }

    if(strlen($password > 30 || strlen($password) < 5)) {
        echo "Your password must be between 5 and 30 characters";
    }

}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To Swirlfeed</title>
</head>
<body>
    <form action="register.php" method="POST">
        <input type="text" name="reg_fname" placeholder="First Name" required>
        <br>
        <input type="text" name="reg_lname" placeholder="Last Name" required>
        <br>
        <input type="email" name="reg_email" placeholder="example@gmail.com" required>
        <br>
        <input type="email" name="reg_email2" placeholder="Confirm Email" required>
        <br>
        <input type="password" name="reg_password" placeholder="Password" required>
        <br>
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <br>
        <input type="submit" name="register_button" value="Register">
    </form>
</body>
</html>