<?php
include '../config/db.php';

// Ambil data filter
$kelas_filter = isset($_GET['kelas']) ? $_GET['kelas'] : '';
$tanggal_filter = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';

// Ambil data kelas untuk dropdown
$kelas = mysqli_query($conn, "SELECT * FROM kelas");

// Query dasar
$sql = "
    SELECT a.tanggal, s.nama, s.nis, k.nama_kelas, a.keterangan 
    FROM absensi a 
    JOIN siswa s ON a.id_siswa = s.id 
    JOIN kelas k ON s.id_kelas = k.id 
    WHERE 1
";

// Tambahkan filter kelas jika ada
if (!empty($kelas_filter)) {
    $sql .= " AND k.id = '$kelas_filter'";
}

// Tambahkan filter tanggal jika ada
if (!empty($tanggal_filter)) {
    $sql .= " AND a.tanggal = '$tanggal_filter'";
}

$sql .= " ORDER BY a.tanggal DESC";

$data = mysqli_query($conn, $sql);
?>

<div class="container">
<h2>Riwayat Absensi</h2>

<!-- Form Filter -->
<form method="get">
    <label>Kelas:</label>
    <select name="kelas">
        <option value="">-- Semua Kelas --</option>
        <?php while($k = mysqli_fetch_assoc($kelas)): ?>
            <option value="<?= $k['id'] ?>" <?= $kelas_filter == $k['id'] ? 'selected' : '' ?>>
                <?= $k['nama_kelas'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Tanggal:</label>
    <input type="date" name="tanggal" value="<?= $tanggal_filter ?>">

    <button type="submit">Tampilkan</button>
</form>
<br>

<button onclick="window.print()">🖨️ Cetak Halaman</button>
<br><br>


<!-- Tabel Riwayat -->
<table border="1">
<tr>
    <th>Tanggal</th><th>NIS</th><th>Nama</th><th>Kelas</th><th>Keterangan</th>
</tr>
<?php while($r = mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $r['tanggal'] ?></td>
    <td><?= $r['nis'] ?></td>
    <td><?= $r['nama'] ?></td>
    <td><?= $r['nama_kelas'] ?></td>
    <td><?= $r['keterangan'] ?></td>
</tr>
<?php endwhile; ?>
</table>

<?php
$url = "cetak_pdf.php?kelas=$kelas_filter&tanggal=$tanggal_filter";
?>
<a href="<?= $url ?>" target="_blank">
    <button type="button">📥 Download PDF</button>
</a>
</div>