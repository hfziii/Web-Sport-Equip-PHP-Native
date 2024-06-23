<?php
session_start();
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Query to check if the user exists in 'user' table
    $query_user = "SELECT * FROM user WHERE username = '$username'";
    $result_user = mysqli_query($connection, $query_user);

    if ($result_user) {
        if (mysqli_num_rows($result_user) == 1) {
            $row_user = mysqli_fetch_assoc($result_user);

            // Verify the password using password_verify
            if (password_verify($password, $row_user['password'])) {
                // Password is correct, start a session
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                // Password is incorrect
                echo "<script>alert('Password anda salah!'); window.location.href='login.php';</script>";
            }
        } else {
            // Username doesn't exist in 'user' table
            // Check in 'admin' table
            $query_admin = "SELECT * FROM admin WHERE username = '$username'";
            $result_admin = mysqli_query($connection, $query_admin);

            if ($result_admin && mysqli_num_rows($result_admin) == 1) {
                $row_admin = mysqli_fetch_assoc($result_admin);
                
                // Verify the password using password_verify
                if (password_verify($password, $row_admin['password'])) {
                    // Password is correct, start a session
                    $_SESSION['username'] = $username;
                    header("Location: dashboard.php");
                    exit();
                } else {
                    // Password is incorrect
                    echo "<script>alert('Password anda salah!'); window.location.href='login.php';</script>";
                }
            } else {
                // Username doesn't exist in 'admin' table as well
                echo "<script>alert('Username tidak tersedia!'); window.location.href='login.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Query failed: " . mysqli_error($connection) . "'); window.location.href='login.php';</script>";
    }
}
?>
