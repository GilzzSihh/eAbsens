<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] == 'guru') {
    $kelas_id = $_SESSION['id_kelas'];
    $q = mysqli_query($conn, "SELECT * FROM siswa WHERE id_kelas = '$kelas_id'");
} else {
    $q = mysqli_query($conn, "SELECT * FROM siswa");
}


include '../config/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['absen'] as $id_siswa => $ket) {
        $tanggal = date('Y-m-d');
        mysqli_query($conn, "INSERT INTO absensi (id_siswa, tanggal, keterangan) VALUES ('$id_siswa', '$tanggal', '$ket')");
    }
    echo "Absensi berhasil disimpan!";
}
$q = mysqli_query($conn, "SELECT * FROM siswa");
?>

<div class="container">
<form method="post">
<table border="1">
<tr><th>Nama</th><th>Keterangan</th></tr>
<?php while($r = mysqli_fetch_assoc($q)): ?>
<tr>
    <td><?= $r['nama'] ?></td>
    <td>
        <select name="absen[<?= $r['id'] ?>]">
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Alpa">Alpa</option>
        </select>
    </td>
</tr>
<?php endwhile; ?>
</table>
<button type="submit">Simpan</button>
</form>

</div>