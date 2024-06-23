<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username, email, and password from the form
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $telepon = mysqli_real_escape_string($connection, $_POST['telepon']);

    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Generate new user ID
    $query = "SELECT id_user FROM user ORDER BY id_user DESC LIMIT 1";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $last_id = $row['id_user'];
        $num = (int) substr($last_id, 2) + 1;
        $new_id = 'U-' . str_pad($num, 3, '0', STR_PAD_LEFT);
    } else {
        $new_id = 'U-001';
    }

    // Check if username already exists
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 0) {
        // Username does not exist, insert the new user
        $insert_query = "INSERT INTO user (id_user, name, username, email, password, telepon) VALUES ('$new_id', '$name', '$username', '$email', '$hashed_password', '$telepon')";
        if (mysqli_query($connection, $insert_query)) {
            echo "<script>alert('Registrasi Berhasil! Silahkan Login'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($connection) . "'); window.location.href='login.php';</script>";
        }
    } else {
        // Username already exists
        echo "<script>alert('Username telah dipakai!'); window.location.href='login.php';</script>";
    }
}
?>
