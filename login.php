<?php
session_start();
include 'config/db.php';

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['admin'] = $user;
        header("Location: index.php");
    } else {
        echo "Login gagal!";
    }
}
?>
<link rel="stylesheet" href="../assets/style.css">
<div class="container">
<form method="post">
    <input type="text" name="username" placeholder="Username"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button name="login">Login</button>
</form>

</div>