<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$data = mysqli_query($koneksi,"
SELECT *
FROM lagu
ORDER BY jumlah_putar DESC
LIMIT 20
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Top Charts</title>

<style>

body{
    background:#121212;
    color:white;
    font-family:Arial;
    padding:30px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#1DB954;
    padding:15px;
}

td{
    background:#181818;
    padding:15px;
    border-bottom:1px solid #333;
}

a{
    color:#1DB954;
}

</style>

</head>
<body>

<h1>🔥 Top Charts</h1>

<table>

<tr>
<th>#</th>
<th>Judul</th>
<th>Artis</th>
<th>Diputar</th>
</tr>

<?php
$no=1;

while($d=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['judul']; ?></td>

<td><?= $d['artis']; ?></td>

<td><?= $d['jumlah_putar']; ?> kali</td>

</tr>

<?php } ?>

</table>

<br>

<a href="dashboard.php">
⬅ Kembali
</a>

</body>
</html>