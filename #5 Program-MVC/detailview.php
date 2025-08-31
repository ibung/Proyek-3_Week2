<?php
// Koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "akademik_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = (int) $_GET['id'];

// Query data mahasiswa
$sql = "SELECT * FROM mahasiswa WHERE id=$id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    die("Data mahasiswa tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
</head>
<body>
    <h1>Detail Data Mahasiswa</h1>
    <p><b>ID:</b> <?= htmlspecialchars($data['ID'] ?? $data['id'] ?? ''); ?></p>
    <p><b>NIM:</b> <?= htmlspecialchars($data['NIM'] ?? $data['nim'] ?? ''); ?></p>
    <p><b>Nama:</b> <?= htmlspecialchars($data['NAMA'] ?? $data['nama'] ?? ''); ?></p>
    <p><b>Umur:</b> <?= htmlspecialchars($data['UMUR'] ?? $data['umur'] ?? ''); ?></p>

    <a href="tugasproyek.php">← Kembali ke Daftar</a>
</body>
</html>