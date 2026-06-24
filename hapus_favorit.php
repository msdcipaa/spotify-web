<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['id'];
$lagu_id = $_GET['lagu_id'];

mysqli_query($koneksi,"
DELETE FROM favorit
WHERE user_id='$user_id'
AND lagu_id='$lagu_id'
");

header("Location: favorit.php");
exit;
?>