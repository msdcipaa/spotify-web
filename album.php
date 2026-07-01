<?php
session_start();
include 'koneksi.php';

$data = mysqli_query($koneksi,"
SELECT * FROM album
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Album</title>

<style>

body{
    background:#121212;
    color:white;
    font-family:Segoe UI;
}

.album{
    width:250px;
    display:inline-block;
    margin:20px;
    background:#181818;
    padding:15px;
    border-radius:10px;
}

.album img{
    width:100%;
    height:250px;
    object-fit:cover;
}

a{
    color:white;
    text-decoration:none;
}

</style>

</head>
<body>

<h2>🎼 Album</h2>

<?php while($a=mysqli_fetch_assoc($data)){ ?>

<div class="album">

<a href="detail_album.php?id=<?= $a['id']; ?>">

<img src="cover/<?= $a['cover_album']; ?>">

<h3><?= $a['nama_album']; ?></h3>

</a>

</div>

<?php } ?>

</body>
</html>