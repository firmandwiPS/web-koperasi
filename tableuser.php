<?php
// Konfigurasi database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'koperasi_smk';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

// Buat tabel user jika belum ada
$sql = "CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'anggota') NOT NULL DEFAULT 'anggota'
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabel user berhasil dibuat atau sudah ada.";
} else {
    echo "Error membuat tabel: " . $conn->error;
}

// Fungsi CREATE (Tambah User)
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    
    $sql = "INSERT INTO user (nama, email, password, role) VALUES ('$nama', '$email', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "User berhasil ditambahkan.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fungsi UPDATE (Ubah User)
if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    
    $sql = "UPDATE user SET nama='$nama', email='$email', role='$role' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "User berhasil diubah.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fungsi DELETE (Hapus User)
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "DELETE FROM user WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "User berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fungsi READ (Tampilkan Data User)
echo "<h2>Data User</h2>";
$result = $conn->query("SELECT * FROM user");
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['nama'] . "</td><td>" . $row['email'] . "</td><td>" . $row['role'] . "</td>";
        echo "<td><a href='?hapus=" . $row['id'] . "'>Hapus</a> | <a href='edit.php?id=" . $row['id'] . "'>Edit</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data user.";
}

$conn->close();
?>
