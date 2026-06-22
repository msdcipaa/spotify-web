<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id'];
$lagu_id = $_GET['lagu_id'];

$cek = mysqli_query($koneksi,"
SELECT * FROM favorit
WHERE user_id='$user_id'
AND lagu_id='$lagu_id'
");

if(mysqli_num_rows($cek) == 0){

    mysqli_query($koneksi,"
    INSERT INTO favorit(user_id, lagu_id)
    VALUES('$user_id','$lagu_id')
    ");

}

header("Location: dashboard.php");
exit;
?>