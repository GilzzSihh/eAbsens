<?php
include '../config/db.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_kelas'];
    mysqli_query($conn, "INSERT INTO kelas (nama_kelas) VALUES ('$nama')");
    header("Location: data.php");
}
?>

<div class="container">
<h2>Data Kelas</h2>
<form method="post">
    <input type="text" name="nama_kelas" placeholder="Nama Kelas" required>
    <button name="simpan">Tambah</button>
</form>
<br>
<table border="1">
<tr><th>No</th><th>Nama Kelas</th></tr>
<?php
$kelas = mysqli_query($conn, "SELECT * FROM kelas");
$no = 1;
while ($r = mysqli_fetch_assoc($kelas)):
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $r['nama_kelas'] ?></td>
</tr>
<?php endwhile; ?>
</table>

</div>