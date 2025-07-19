<?php
include '../inc/header.php';
include '../inc/footer.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<link rel="stylesheet" href="../assets/style.css">
<div class="container">
    
<h2>Selamat datang, <?= $_SESSION['admin'] ?>!</h2>
<ul>
    <li><a href="siswa/data.php">Manajemen Siswa</a></li>
    <li><a href="kelas/data.php">Manajemen Kelas</a></li>
    <li><a href="absensi/form.php">Isi Absensi</a></li>
    <li><a href="absensi/riwayat.php">Riwayat Absensi</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
</div>