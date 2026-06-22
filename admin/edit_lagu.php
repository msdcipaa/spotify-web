<?php
session_start();
include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];

$data = mysqli_query($koneksi,
"SELECT * FROM lagu WHERE id='$id'");

$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $judul = $_POST['judul'];
    $artis = $_POST['artis'];
    $genre = $_POST['genre'];

    mysqli_query($koneksi,"
    UPDATE lagu SET
    judul='$judul',
    artis='$artis',
    genre_id='$genre'
    WHERE id='$id'
    ");

    echo "<script>
    alert('Data lagu berhasil diupdate');
    window.location='data_lagu.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Lagu</title>
</head>
<body>

<h2>Edit Lagu</h2>

<form method="POST">

<p>Judul Lagu</p>
<input type="text"
name="judul"
value="<?= $d['judul']; ?>"
required>

<p>Artis</p>
<input type="text"
name="artis"
value="<?= $d['artis']; ?>"
required>

<p>Genre</p>

<select name="genre">

<?php
$genre = mysqli_query($koneksi,
"SELECT * FROM genre");

while($g = mysqli_fetch_assoc($genre)){
?>

<option value="<?= $g['id']; ?>"
<?= ($g['id']==$d['genre_id']) ? 'selected' : ''; ?>>
<?= $g['nama_genre']; ?>
</option>

<?php } ?>

</select>

<br><br>

<button name="update">
Simpan Perubahan
</button>

</form>

<br>

<a href="data_lagu.php">
Kembali
</a>

</body>
</html>