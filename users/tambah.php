<?php
session_start();
if ($_SESSION['role'] != 'admin') exit('Akses ditolak!');
include '../config/db.php';

$kelas = mysqli_query($conn, "SELECT * FROM kelas");

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    $id_kelas = $_POST['id_kelas'] ?? 'NULL';

    $sql = "INSERT INTO users (username, password, role, id_kelas) 
            VALUES ('$username', '$password', '$role', " . ($id_kelas ? "'$id_kelas'" : "NULL") . ")";
    mysqli_query($conn, $sql);
    header("Location: data.php");
}
?>

<h2>Tambah User</h2>
<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Role:
    <select name="role" id="roleSelect" onchange="toggleKelas()">
        <option value="admin">Admin</option>
        <option value="guru">Guru</option>
    </select><br>
    <div id="kelasSelect" style="display:none;">
        Kelas:
        <select name="id_kelas">
            <option value="">- Pilih Kelas -</option>
            <?php while($k = mysqli_fetch_assoc($kelas)): ?>
                <option value="<?= $k['id'] ?>"><?= $k['nama_kelas'] ?></option>
            <?php endwhile; ?>
        </select><br>
    </div>
    <button name="simpan">Simpan</button>
</form>
<script>
function toggleKelas() {
    const role = document.getElementById('roleSelect').value;
    document.getElementById('kelasSelect').style.display = (role === 'guru') ? 'block' : 'none';
}
toggleKelas(); // inisialisasi
</script>
