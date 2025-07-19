<?php
include '../config/db.php';

$kelas = mysqli_query($conn, "SELECT * FROM kelas");

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $id_kelas = $_POST['id_kelas'];

    $query = mysqli_query($conn, "INSERT INTO siswa (nama, nis, id_kelas) VALUES ('$nama', '$nis', '$id_kelas')");
    
    if ($query) {
        echo "<script>alert('Data siswa berhasil ditambahkan!'); window.location='data.php';</script>";
    } else {
        echo "Gagal menambahkan data siswa.";
    }
}
?>

<div class="container">

<h2>Tambah Siswa</h2>
<form method="post">
    <label>Nama Siswa</label><br>
    <input type="text" name="nama" required><br><br>

    <label>NIS</label><br>
    <input type="text" name="nis" required><br><br>

    <label>Kelas</label><br>
    <select name="id_kelas" required>
        <option value="">-- Pilih Kelas --</option>

        <?php while ($r = mysqli_fetch_assoc($kelas)): ?>
            <option value="<?= $r['id'] ?>"><?= $r['nama_kelas'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <button type="submit" name="simpan">Simpan</button>
    <a href="data.php">Kembali</a>
</form>

</div>