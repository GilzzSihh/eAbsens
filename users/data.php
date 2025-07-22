<?php
session_start();
if ($_SESSION['role'] != 'admin') exit('Akses ditolak!');
include '../config/db.php';

$data = mysqli_query($conn, "SELECT u.*, k.nama_kelas FROM users u 
LEFT JOIN kelas k ON u.id_kelas = k.id");

?>
<h2>Manajemen User</h2>
<a href="tambah.php">+ Tambah User</a> | <a href="../index.php">Kembali</a>
<br><br>
<table border="1" cellpadding="8">
<tr>
    <th>Username</th>
    <th>Role</th>
    <th>Kelas (jika guru)</th>
    <th>Aksi</th>
</tr>
<?php while ($d = mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $d['username'] ?></td>
    <td><?= $d['role'] ?></td>
    <td><?= $d['nama_kelas'] ?? '-' ?></td>
    <td>
        <a href="edit.php?id=<?= $d['id'] ?>">Edit</a> | 
        <a href="hapus.php?id=<?= $d['id'] ?>" onclick="return confirm('Hapus user?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
