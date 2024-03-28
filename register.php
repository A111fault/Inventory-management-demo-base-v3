<?php

include 'config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];

    $select_users = mysqli_query($conn, "SELECT * FROM `crud` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'user already exist!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password not matched!';
        } else {
            mysqli_query($conn, "INSERT INTO `crud`(name, mobile, email, password, user_type) VALUES('$name','$mobile', '$email', '$cpass', '$user_type')") or die('query failed');
            $message[] = 'registered successfully!';
            header('location:login.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>



    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
        }
    }
    ?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="" method="post">
                <h3>Register Now</h3>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="mobile" placeholder="Enter your mobile" required>
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" name="cpassword" placeholder="Confirm your password" required>
                </div>
                <div class="form-group mb-3">
                    <select name="user_type">
                        <option value="Employee">Employee</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <input type="submit" name="submit" value="Register Now" class="btn btn-primary">
                <p>Already have an account? <a href="login.php">Login Now</a></p>
            </form>
        </div>
    </div>
</div>

</body>

</html>