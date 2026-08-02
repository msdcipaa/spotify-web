<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id'];

$query = mysqli_query($koneksi,"
SELECT *
FROM user
WHERE id='$id'
");

$user = mysqli_fetch_assoc($query);

$status = $user['status_akun'];

$expired = "-";

if(!empty($user['premium_expired'])){
    $expired = date(
        "d F Y H:i",
        strtotime($user['premium_expired'])
    );
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Profil Saya | Spotify Web</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:#121212;
color:white;
}

.container{
width:90%;
max-width:1100px;
margin:40px auto;
}

.header{
display:flex;
align-items:center;
gap:30px;
background:#181818;
padding:30px;
border-radius:20px;
}

.foto{

width:180px;
height:180px;
border-radius:50%;
overflow:hidden;
background:#2d2d2d;
display:flex;
align-items:center;
justify-content:center;
font-size:70px;

}

.foto img{

width:100%;
height:100%;
object-fit:cover;

}

.info h1{

font-size:36px;
margin-bottom:10px;

}

.info p{

color:#b3b3b3;
margin:6px 0;

}

.badge{

display:inline-block;
margin-top:15px;
padding:8px 18px;
border-radius:30px;
font-weight:bold;

}

.free{

background:#555;

}

.premium{

background:#1DB954;
color:#fff;

}

.card{

margin-top:30px;
background:#181818;
padding:25px;
border-radius:20px;

}

.card h2{

margin-bottom:20px;

}

table{

width:100%;
border-collapse:collapse;

}

table td{

padding:15px;
border-bottom:1px solid #333;

}

.label{

width:220px;
color:#b3b3b3;

}

.btn{

display:inline-block;
margin-top:25px;
padding:12px 25px;
background:#1DB954;
color:white;
text-decoration:none;
border-radius:30px;
font-weight:bold;

}

.btn:hover{

opacity:.9;

}

</style>

</head>

<body>

<div class="container">

<div class="header"><div class="foto">

<?php if(!empty($user['foto'])){ ?>

<img src="foto_profil/<?= $user['foto']; ?>">

<?php }else{ ?>

👤

<?php } ?>

</div>

<div class="info">

<p>Profil Pengguna</p>

<h1><?= htmlspecialchars($user['nama']); ?></h1>

<p>📧 <?= htmlspecialchars($user['username']); ?></p>

<p>📱 <?= !empty($user['no_hp']) ? htmlspecialchars($user['no_hp']) : '-'; ?></p>

<p>📍 <?= !empty($user['alamat']) ? htmlspecialchars($user['alamat']) : '-'; ?></p>

<?php if($status=="Premium"){ ?>

<span class="badge premium">
⭐ Premium
</span>

<?php }else{ ?>

<span class="badge free">
Free
</span>

<?php } ?>

</div>

</div>

<div class="card">

<h2>Informasi Akun</h2>

<table>

<tr>

<td class="label">Nama</td>

<td><?= htmlspecialchars($user['nama']); ?></td>

</tr>

<tr>

<td class="label">username</td>

<td><?= htmlspecialchars($user['username']); ?></td>

</tr>

<tr>

<td class="label">Nomor HP</td>

<td><?= !empty($user['no_hp']) ? htmlspecialchars($user['no_hp']) : '-'; ?></td>

</tr>

<tr>

<td class="label">Alamat</td>

<td><?= !empty($user['alamat']) ? nl2br(htmlspecialchars($user['alamat'])) : '-'; ?></td>

</tr>

<tr>

<td class="label">Status Akun</td>

<td><?= $status; ?></td>

</tr>

<tr>

<td class="label">Premium Berakhir</td>

<td><?= $expired; ?></td>

</tr>

</table>

<a href="edit_profil.php" class="btn">
✏ Edit Profil
</a>

<a href="dashboard.php" class="btn" style="background:#333;margin-left:10px;">
🏠 Kembali
</a>

</div>

</div>

</body>
</html>