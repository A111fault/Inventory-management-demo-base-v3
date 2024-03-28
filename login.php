<?php

include 'config.php';
session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select_users = mysqli_query($conn, "SELECT * FROM `crud` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {

        $row = mysqli_fetch_assoc($select_users);
        $_SESSION['user_name'] = $row['name'];
        
                if ($row['user_type'] == 'Admin') {

            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:index.php');
        } elseif ($row['user_type'] == 'Employee') {

            $_SESSION['emp_name'] = $row['name'];
            $_SESSION['emp_email'] = $row['email'];
            $_SESSION['emp_id'] = $row['id'];
            header('location:index.php');
        }
    } else {
        $message[] = 'incorrect email or password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
                    <h3>login now</h3>
                    <div class="form-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="enter your email" required class="box">
                    </div>
                    <div class="form-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="enter your password" required class="box">
                    </div>
                    <input type="submit" name="submit" value="login now" class="btn btn-primary">
                    <p>Don't have an account? Contact admin! </p>
                </form>

            </div>
        </div>
    </div>

</body>

</html>