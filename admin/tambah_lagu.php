<?php
session_start();
include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

if(isset($_POST['simpan'])){

    $judul = $_POST['judul'];
    $artis = $_POST['artis'];
    $genre = $_POST['genre'];

    $cover = $_FILES['cover']['name'];
    $tmp_cover = $_FILES['cover']['tmp_name'];

    $lagu = $_FILES['lagu']['name'];
    $tmp_lagu = $_FILES['lagu']['tmp_name'];

    move_uploaded_file($tmp_cover,"../cover/".$cover);
    move_uploaded_file($tmp_lagu,"../lagu/".$lagu);

    mysqli_query($koneksi,"
    INSERT INTO lagu
    (judul,artis,genre_id,file_mp3,cover)
    VALUES
    ('$judul','$artis','$genre','$lagu','$cover')
    ");

    echo "<script>
    alert('Lagu berhasil ditambahkan');
    window.location='tambah_lagu.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload Lagu</title>
</head>
<body>

<h2>Upload Lagu</h2>

<form method="POST" enctype="multipart/form-data">

<p>Judul Lagu</p>
<input type="text" name="judul" required>

<p>Nama Artis</p>
<input type="text" name="artis" required>

<p>Genre</p>

<select name="genre">

<?php
$genre = mysqli_query($koneksi,"SELECT * FROM genre");

while($g = mysqli_fetch_assoc($genre)){
?>

<option value="<?= $g['id']; ?>">
<?= $g['nama_genre']; ?>
</option>

<?php } ?>

</select>

<p>Cover Album</p>
<input type="file" name="cover" required>

<p>File MP3</p>
<input type="file" name="lagu" required>

<br><br>

<button name="simpan">
Upload Lagu
</button>

</form>

<br>

<a href="dashboard.php">Kembali</a>

</body>
</html>