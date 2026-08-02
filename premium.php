<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}

$data = mysqli_query($koneksi,"SELECT * FROM membership ORDER BY harga ASC");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Spotify Premium</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Segoe UI,sans-serif;
}

body{

background:#121212;
color:white;

}

.header{

padding:50px 20px;

text-align:center;

background:linear-gradient(135deg,#1DB954,#191414);

}

.header h1{

font-size:45px;

margin-bottom:10px;

}

.header p{

color:#ddd;

font-size:18px;

}

.container{

width:1200px;

max-width:95%;

margin:auto;

padding:50px 0;

display:grid;

grid-template-columns:repeat(auto-fit,minmax(280px,1fr));

gap:30px;

}

.card{

background:#181818;

border-radius:20px;

padding:30px;

transition:.3s;

box-shadow:0 10px 25px rgba(0,0,0,.35);

}

.card:hover{

transform:translateY(-8px);

}

.card h2{

margin-bottom:15px;

color:#1DB954;

}

.harga{

font-size:40px;

font-weight:bold;

margin-bottom:20px;

}

.card ul{

margin-left:20px;

margin-bottom:30px;

}

.card li{

margin-bottom:10px;

}

.btn{

display:block;

text-align:center;

padding:15px;

background:#1DB954;

color:white;

text-decoration:none;

border-radius:50px;

font-weight:bold;

transition:.3s;

}

.btn:hover{

background:#1ed760;

}

</style>

</head>

<body>

<div class="header">

<h1>Spotify Premium</h1>

<p>

Nikmati musik tanpa batas.

Tanpa iklan.

Kualitas audio lebih tinggi.

</p>

</div>

<div class="container">

<?php

while($d=mysqli_fetch_assoc($data)){

?>

<div class="card">

<h2>

<?= $d['nama_paket']; ?>

</h2>

<div class="harga">

Rp <?= number_format($d['harga'],0,',','.'); ?>

</div>

<ul>

<li>✔ Tanpa Iklan</li>

<li>✔ Audio Berkualitas Tinggi</li>

<li>✔ Playlist Unlimited</li>

<li>✔ Favorit Unlimited</li>

<li>✔ Download Lagu</li>

</ul>

<a

class="btn"

href="checkout.php?id=<?= $d['id']; ?>"

>

Pilih Paket

</a>

</div>

<?php

}

?>

</div>

</body>

</html>