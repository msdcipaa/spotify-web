<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id_playlist = $_GET['id'];

$playlist = mysqli_query($koneksi,"
SELECT * FROM playlist
WHERE id='$id_playlist'
");

$p = mysqli_fetch_assoc($playlist);

$data = mysqli_query($koneksi,"
SELECT lagu.*
FROM playlist_detail
JOIN lagu ON playlist_detail.lagu_id = lagu.id
WHERE playlist_detail.playlist_id='$id_playlist'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Detail Playlist</title>
</head>
<body>

<h2>🎵 <?= $p['nama_playlist']; ?></h2>

<table border="1" cellpadding="10">

<tr>
    <th>No</th>
    <th>Judul</th>
    <th>Artis</th>
</tr>

<?php
$no = 1;

while($d = mysqli_fetch_assoc($data)){
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['judul']; ?></td>
    <td><?= $d['artis']; ?></td>
</tr>

<?php } ?>

</table>

<br>

<a href="playlist.php">⬅ Kembali ke Playlist</a>

</body>
</html>