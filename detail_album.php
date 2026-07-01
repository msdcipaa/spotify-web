<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id_album = $_GET['id'];

$album = mysqli_query($koneksi,"
SELECT *
FROM album
WHERE id='$id_album'
");

$a = mysqli_fetch_assoc($album);

$data = mysqli_query($koneksi,"
SELECT lagu.*, genre.nama_genre
FROM lagu
LEFT JOIN genre ON lagu.genre_id = genre.id
WHERE lagu.album_id='$id_album'
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?= $a['nama_album']; ?></title>

<style>

body{
    background:#121212;
    color:white;
    font-family:'Segoe UI',sans-serif;
    padding:30px;
}

.album-header{
    display:flex;
    gap:20px;
    margin-bottom:30px;
}

.album-header img{
    width:250px;
    height:250px;
    object-fit:cover;
    border-radius:10px;
}

.song{
    background:#181818;
    padding:15px;
    margin-bottom:10px;
    border-radius:10px;
}

.song:hover{
    background:#282828;
}

.btn{
    background:#1DB954;
    color:white;
    text-decoration:none;
    padding:8px 15px;
    border-radius:20px;
    margin-right:5px;
}

audio{
    width:100%;
    margin-top:10px;
}

</style>

</head>
<body>

<div class="album-header">

<img src="cover/<?= $a['cover_album']; ?>">

<div>

<h1><?= $a['nama_album']; ?></h1>

<p>
Album berisi lagu-lagu pilihan terbaik
</p>

</div>

</div>

<h2>Daftar Lagu</h2>

<?php while($d=mysqli_fetch_assoc($data)){ ?>

<div class="song">

<h3><?= $d['judul']; ?></h3>

<p>🎤 <?= $d['artis']; ?></p>

<p>🎼 <?= $d['nama_genre']; ?></p>

<a class="btn"
href="tambah_favorit.php?lagu_id=<?= $d['id']; ?>">
❤️ Favorit
</a>

<a class="btn"
href="tambah_playlist.php?lagu_id=<?= $d['id']; ?>">
➕ Playlist
</a>

<br><br>

<audio controls>

<source
src="lagu/<?= $d['file_mp3']; ?>"
type="audio/mpeg">

</audio>

</div>

<?php } ?>

<br>

<a class="btn" href="album.php">
⬅ Kembali
</a>

</body>
</html>