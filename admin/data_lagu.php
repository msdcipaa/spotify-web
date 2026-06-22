<?php
session_start();
include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

$data = mysqli_query($koneksi,"
SELECT lagu.*, genre.nama_genre
FROM lagu
LEFT JOIN genre ON lagu.genre_id = genre.id
ORDER BY lagu.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Lagu</title>

<style>

body{
    font-family:Arial;
    padding:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table, th, td{
    border:1px solid #ddd;
}

th{
    background:#1DB954;
    color:white;
}

th,td{
    padding:10px;
}

img{
    width:80px;
}

</style>

</head>
<body>

<h2>🎵 Data Lagu</h2>

<a href="tambah_lagu.php">
➕ Tambah Lagu
</a>

<br><br>

<table>

<tr>
    <th>No</th>
    <th>Cover</th>
    <th>Judul</th>
    <th>Artis</th>
    <th>Genre</th>
    <th>aksi</th>

</tr>

<?php

$no = 1;

while($d = mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td>

<?php if($d['cover']){ ?>

<img src="../cover/<?= $d['cover']; ?>">

<?php } ?>

</td>

<td><?= $d['judul']; ?></td>

<td><?= $d['artis']; ?></td>

<td><?= $d['nama_genre']; ?></td>
<td>
    <a href="edit_lagu.php?id=<?= $d['id']; ?>">✏ Edit</a>
    |
    <a href="hapus_lagu.php?id=<?= $d['id']; ?>"
       onclick="return confirm('Yakin ingin menghapus lagu ini?')">
       🗑 Hapus
    </a>
</td>

</tr>

<?php } ?>

</table>

<br>

<a href="dashboard.php">⬅ Kembali</a>

</body>
</html>