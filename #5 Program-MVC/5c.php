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

// ================= DELETE =================
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $conn->query("DELETE FROM mahasiswa WHERE id=$id");
    header("Location: tugasproyek.php");
    exit;
}

// ================= CREATE =================
if (isset($_POST['tambah'])) {
    $nim  = $conn->real_escape_string($_POST['nim']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $umur = (int) $_POST['umur'];

    $sql = "INSERT INTO mahasiswa (nim, nama, umur) VALUES ('$nim', '$nama', '$umur')";
    $conn->query($sql);
    header("Location: tugasproyek.php");
    exit;
}

// ================= UPDATE =================
if (isset($_POST['update'])) {
    $id   = (int) $_POST['id'];
    $nim  = $conn->real_escape_string($_POST['nim']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $umur = (int) $_POST['umur'];

    $sql = "UPDATE mahasiswa SET nim='$nim', nama='$nama', umur='$umur' WHERE id=$id";
    
    // Debug: uncomment line below to see the query
    // echo "Query: " . $sql . "<br>";
    
    if ($conn->query($sql)) {
        // echo "Update berhasil!"; // uncomment for debug
        header("Location: tugasproyek.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// ================= READ + SEARCH =================
$keyword = "";
if (isset($_GET['search'])) {
    $keyword = $conn->real_escape_string($_GET['search']);
    $sql     = "SELECT id, nim, nama, umur 
                FROM mahasiswa 
                WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%'
                ORDER BY id ASC";
} else {
    $sql = "SELECT id, nim, nama, umur FROM mahasiswa ORDER BY id ASC";
}
$result = $conn->query($sql);

// ================= EDIT MODE =================
$editData = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $q  = $conn->query("SELECT * FROM mahasiswa WHERE id=$id");
    if ($q && $q->num_rows > 0) {
        $editData = $q->fetch_assoc();
        // Debug: uncomment line below to see what keys are available
        // var_dump($editData);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Proyek 3</title>
</head>
<body>
    <h1>Selamat datang di Blablabla Website</h1>
    <p><i>Diajukan untuk memenuhi salah satu tugas praktikum Mata Kuliah Proyek 3</i></p>
    <hr>

    <!-- Form Search -->
    <h2>Daftar Mahasiswa</h2>
    <form method="get" action="">
        <input type="text" name="search" placeholder="Cari nama atau NIM..." value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">Cari</button>
        <a href="tugasproyek.php">Reset</a>
    </form>
    <br>

    <!-- Form Tambah / Edit -->
    <?php if ($editData): ?>
        <h3>Edit Mahasiswa</h3>
        <form method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($editData['id'] ?? $editData['ID'] ?? '') ?>">

            <label>NIM:</label><br>
            <input type="text" name="nim" value="<?= htmlspecialchars($editData['NIM'] ?? $editData['nim'] ?? '') ?>" required><br><br>

            <label>Nama:</label><br>
            <input type="text" name="nama" value="<?= htmlspecialchars($editData['NAMA'] ?? $editData['nama'] ?? '') ?>" required><br><br>

            <label>Umur:</label><br>
            <input type="number" name="umur" value="<?= htmlspecialchars($editData['UMUR'] ?? $editData['umur'] ?? '') ?>" required><br><br>

            <button type="submit" name="update">Update</button>
            <a href="tugasproyek.php">Batal</a>
        </form>
    <?php else: ?>
        <h3>Tambah Mahasiswa</h3>
        <form method="post">
            <label>NIM:</label><br>
            <input type="text" name="nim" required><br><br>

            <label>Nama:</label><br>
            <input type="text" name="nama" required><br><br>

            <label>Umur:</label><br>
            <input type="number" name="umur" required><br><br>

            <button type="submit" name="tambah">Simpan</button>
        </form>
    <?php endif; ?>
    <br><hr>

    <!-- Tabel Mahasiswa -->
    <?php if ($result && $result->num_rows > 0): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['nim']); ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['umur']); ?></td>
                    <td>
                        <a href="detailview.php?id=<?= $row['id']; ?>">Detail</a> | 
                        <a href="tugasproyek.php?edit=<?= $row['id']; ?>">Edit</a> | 
                        <a href="tugasproyek.php?delete=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Tidak ada data mahasiswa.</p>
    <?php endif; ?>

</body>
</html>