<?php
include "koneksi.php";


$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

if ($keyword != "") {
    $keyword_aman = mysqli_real_escape_string($koneksi, $keyword);
    $query = "SELECT * FROM siswa WHERE nama LIKE '%$keyword_aman%' 
              OR nis LIKE '%$keyword_aman%' 
              OR kelas LIKE '%$keyword_aman%' 
              OR jurusan LIKE '%$keyword_aman%'";
} else {
    $query = "SELECT * FROM siswa";
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
</head>
<body>

    <h2>Data Siswa</h2>

    <form method="GET" action="index.php">
        <input type="text" name="keyword" placeholder="Cari nama / nis / kelas / jurusan" value="<?php echo htmlspecialchars($keyword); ?>">
        <button type="submit">Cari</button>
        <a href="index.php">Reset</a>
    </form>

    <br>

   
    <a href="tambah.php">Tambah Data Siswa</a>

    <br><br>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
        </tr>

        <?php
        $no = 1;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['nis']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['kelas']) . "</td>";
                echo "<td>" . htmlspecialchars($row['jurusan']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Data tidak ditemukan</td></tr>";
        }
        ?>
    </table>

</body>
</html>