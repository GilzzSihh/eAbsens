<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php if ($_SESSION['role'] == 'admin'): ?>
    <li><a href="users/data.php">Manajemen User</a></li>
<?php endif; ?>

<h2>Selamat datang, <?= $_SESSION['username'] ?> (<?= $_SESSION['role'] ?>)</h2>
<ul>
<?php if ($_SESSION['role'] == 'admin'): ?>
    <li><a href="siswa/data.php">Manajemen Siswa</a></li>
    <li><a href="kelas/data.php">Manajemen Kelas</a></li>
<?php endif; ?>
    <li><a href="absensi/form.php">Isi Absensi</a></li>
    <li><a href="absensi/riwayat.php">Riwayat Absensi</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

</body>
</html>