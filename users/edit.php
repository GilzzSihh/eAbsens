<?php
session_start();
if ($_SESSION['role'] != 'admin') exit('Akses ditolak!');
include '../config/db.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='$id'"));
$kelas = mysqli_query($conn, "SELECT * FROM kelas");

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $id_kelas = $_POST['id_kelas'] ?? 'NULL';

    $query = "UPDATE users SET username='$username', role='$role', id_kelas=" . ($id_kelas ? "'$id_kelas'" : "NULL") . " WHERE id='$id'";
    mysqli_query($conn, $query);
    header("Location: data.php");
}
?>

<h2>Edit User</h2>
<form method="post">
    Username: <input type="text" name="username" value="<?= $data['username'] ?>"><br>
    Role:
    <select name="role" id="roleSelect" onchange="toggleKelas()">
        <option value="admin" <?= $data['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="guru" <?= $data['role'] == 'guru' ? 'selected' : '' ?>>Guru</option>
    </select><br>
    <div id="kelasSelect" style="display:none;">
        Kelas:
        <select name="id_kelas">
            <option value="">- Pilih Kelas -</option>
            <?php while($k = mysqli_fetch_assoc($kelas)): ?>
                <option value="<?= $k['id'] ?>" <?= $data['id_kelas'] == $k['id'] ? 'selected' : '' ?>>
                    <?= $k['nama_kelas'] ?>
                </option>
            <?php endwhile; ?>
        </select><br>
    </div>
    <button name="update">Update</button>
</form>
<script>
function toggleKelas() {
    const role = document.getElementById('roleSelect').value;
    document.getElementById('kelasSelect').style.display = (role === 'guru') ? 'block' : 'none';
}
toggleKelas(); // inisialisasi
</script>
