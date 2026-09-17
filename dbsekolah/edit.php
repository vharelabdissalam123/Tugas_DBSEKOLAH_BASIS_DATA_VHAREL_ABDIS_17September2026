<?php
include "koneksi.php";

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id_siswa']);
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);

    $query = "UPDATE siswa SET nis='$nis', nama='$nama', kelas='$kelas', jurusan='$jurusan' WHERE id_siswa='$id'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengubah data: " . mysqli_error($koneksi);
    }
}

// Ambil data lama berdasarkan id yang dikirim lewat URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = "SELECT * FROM siswa WHERE id_siswa = '$id'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan";
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Siswa</title>
</head>
<body>

    <h2>Edit Data Siswa</h2>

    <form method="POST" action="edit.php">
        <input type="hidden" name="id_siswa" value="<?php echo htmlspecialchars($data['id_siswa']); ?>">

        <label>NIS:</label><br>
        <input type="text" name="nis" value="<?php echo htmlspecialchars($data['nis']); ?>" required><br><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required><br><br>

        <label>Kelas:</label><br>
        <input type="text" name="kelas" value="<?php echo htmlspecialchars($data['kelas']); ?>" required><br><br>

        <label>Jurusan:</label><br>
        <input type="text" name="jurusan" value="<?php echo htmlspecialchars($data['jurusan']); ?>" required><br><br>

        <button type="submit">Update</button>
    </form>

    <br>
    <a href="index.php">Kembali ke Data Siswa</a>

</body>
</html>
