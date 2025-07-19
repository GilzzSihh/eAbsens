<?php
require_once '../vendor/autoload.php';
include '../config/db.php';

use Dompdf\Dompdf;

$kelas = $_GET['kelas'] ?? '';
$tanggal = $_GET['tanggal'] ?? '';

$sql = "
    SELECT a.tanggal, s.nama, s.nis, k.nama_kelas, a.keterangan 
    FROM absensi a 
    JOIN siswa s ON a.id_siswa = s.id 
    JOIN kelas k ON s.id_kelas = k.id 
    WHERE 1
";

if (!empty($kelas)) {
    $sql .= " AND k.id = '$kelas'";
}
if (!empty($tanggal)) {
    $sql .= " AND a.tanggal = '$tanggal'";
}

$sql .= " ORDER BY a.tanggal DESC";

$data = mysqli_query($conn, $sql);

$html = "
<h2 style='text-align:center;'>Laporan Absensi Kelas</h2>
<table border='1' cellpadding='5' cellspacing='0' width='100%'>
    <tr>
        <th>Tanggal</th><th>NIS</th><th>Nama</th><th>Kelas</th><th>Keterangan</th>
    </tr>";

while($r = mysqli_fetch_assoc($data)) {
    $html .= "<tr>
        <td>{$r['tanggal']}</td>
        <td>{$r['nis']}</td>
        <td>{$r['nama']}</td>
        <td>{$r['nama_kelas']}</td>
        <td>{$r['keterangan']}</td>
    </tr>";
}

$html .= "</table>";

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("laporan_absensi.pdf", array("Attachment" => true));