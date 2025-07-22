<?php
session_start();
if ($_SESSION['role'] != 'admin') exit('Akses ditolak!');
include '../config/db.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
header("Location: data.php");
