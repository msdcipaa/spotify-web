<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    exit;
}

$user_id = $_SESSION['id'];
$lagu_id = $_POST['lagu_id'];

mysqli_query($koneksi,"
INSERT INTO history(user_id, lagu_id)
VALUES('$user_id','$lagu_id')
");

mysqli_query($koneksi,"
UPDATE lagu
SET jumlah_putar = jumlah_putar + 1
WHERE id='$lagu_id'
");
?>