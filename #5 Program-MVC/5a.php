<?php
// Konfigurasi koneksi
$host = "localhost";
$user = "root";    // ganti jika user MySQL berbeda
$pass = "";        // ganti jika ada password
$db   = "akademik_db";

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// ================= READ DATA =================
// Query untuk mengambil semua data mahasiswa
$sql = "SELECT id, nim, nama, umur FROM mahasiswa ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data Mahasiswa</title>
</head>
<body>
    <h1>Selamat datang di Blablabla Website</h1>
    <p><i>Diajukan untuk memenuhi salah satu tugas praktikum Mata Kuliah Proyek 3</i></p>
    <hr>

    <h2>Daftar Mahasiswa</h2>

    <!-- Tabel Mahasiswa -->
    <?php if ($result && $result->num_rows > 0): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Umur</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['nim']); ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['umur']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Tidak ada data mahasiswa.</p>
    <?php endif; ?>

</body>
</html>