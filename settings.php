<?php
    include("includes/header.php");
    include("includes/form_handlers/settings_handler.php");

?>

<div class="main_column settings-page">
    <h4 class='page-heading'>Account Settings</h4>

    <?php
        echo "<img src='./" . $user['profile_pic'] ."' class='settings_profile_pic'>";
    ?>
    <br>
    <a href="upload.php" class='profile-change'> Upload New Profile Picture </a><br><br><br>

    <?php 
        $user_data_query = mysqli_query($con, "SELECT first_name, last_name, email FROM users WHERE username='$userLoggedIn'");
        $row = mysqli_fetch_array($user_data_query);

        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];

    ?> 
    
    <form action="settings.php" method="POST">
    <label for="first_name"> First Name:</label>
    <input type="text" name="first_name" value="<?php echo $first_name; ?>" id="settings_input"><br>
    <label for="last_name"> Last Name:</label><input type="text" name="last_name" value="<?php echo $last_name;?>" id="settings_input"><br>
    <label for="email">  Email: </label> <input type="text" name="email" value="<?php echo $email;?>" id="settings_input"><br>
        <?php echo $message; ?>
        <input type="submit" name='update_details' id='save_details' value='Update Details' class="info settings_submit"> <br>
    </form>

    <form action="settings.php" method="POST">
        <h4 class='form-heading'>Change Password</h4>
    <label for="old_password"> Old Password: </label> <input type="password" name="old_password" id="settings_input"><br>
    <label for="new_password_1"> New Password: </label>  <input type="password" name="new_password_1" id="settings_input"><br>
    <label for="new_password_2"> Confirm New Password: </label> <input type="password" name="new_password_2" id="settings_input"><br>
        <?php echo $password_message; ?>
        <input type="submit" name='update_password' id='save_details' value='Update Password'class="info settings_submit"> <br>
    </form>

    <form action="settings.php" class='close-account-form' method="POST">
        <h4 class='form-heading'>Close Account</h4>
        <input type="submit" name='close_account' id='close_account' value='Close Account' class="danger settings_submit">
    </form>
</div>