<?php

include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        /* Custom CSS */
        .mt-20 {
            margin-top: 60px;
        }
    </style>
</head>

<body>
    <?php include 'index.php'; ?>
    <div class="container mt-5">

        <div class="table-responsive mt-20">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Sl no.</th>
                        <th scope="col">User</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Password</th>
                        <th scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM crud";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $user_type = $row['user_type'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $mobile = $row['mobile'];
                            $password = $row['password'];

                            echo "<tr>";
                            echo "<td>$id</td>";
                            echo "<td>$user_type</td>";
                            echo "<td>$name</td>";
                            echo "<td>$email</td>";
                            echo "<td>$mobile</td>";
                            echo "<td>$password</td>";
                            echo '<td>
                                    <a href="update_user.php?updateid=' . $id . '" class="btn btn-info btn-sm">Update</a>
                                    <a href="delete_user.php?deleteid=' . $id . '" class="btn btn-danger btn-sm">Delete</a>
                                  </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="mb-2">
              <a href="register.php" class="btn btn-warning" role="button">Create account</a>

            </div>
        </div>
    </div>
</body>

</html>