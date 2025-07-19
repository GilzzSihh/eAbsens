<?php
include '../config/db.php';
$q = mysqli_query($conn, "SELECT s.*, k.nama_kelas FROM siswa s JOIN kelas k ON s.id_kelas = k.id");
?>

<div class="container">
<h2>Data Siswa</h2>
<a href="tambah.php">Tambah Siswa</a>
<table border="1">
<tr><th>No</th><th>Nama</th><th>NIS</th><th>Kelas</th></tr>
<?php $no=1; while($r = mysqli_fetch_assoc($q)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $r['nama'] ?></td>
    <td><?= $r['nis'] ?></td>
    <td><?= $r['nama_kelas'] ?></td>
</tr>
<?php endwhile; ?>
</table>

</div>