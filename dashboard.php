<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

if($cari != ''){

    $data = mysqli_query($koneksi,"
    SELECT lagu.*, genre.nama_genre
    FROM lagu
    LEFT JOIN genre ON lagu.genre_id = genre.id
    WHERE judul LIKE '%$cari%'
    OR artis LIKE '%$cari%'
    ORDER BY lagu.id DESC
    ");

}else{

    $data = mysqli_query($koneksi,"
    SELECT lagu.*, genre.nama_genre
    FROM lagu
    LEFT JOIN genre ON lagu.genre_id = genre.id
    ORDER BY lagu.id DESC
    ");

}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Spotify Web</title>

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
    display:flex;
}

.sidebar{
    width:250px;
    height:100vh;
    background:#000;
    padding:25px;
    position:fixed;
}

.sidebar h2{
    color:#1DB954;
    margin-bottom:40px;
}

.sidebar a{
    display:block;
    color:#b3b3b3;
    text-decoration:none;
    margin:15px 0;
    font-size:17px;
    transition:.3s;
}

.sidebar a:hover{
    color:white;
}

.content{
    margin-left:250px;
    width:100%;
    padding:30px;
    padding-bottom:120px;
}

.welcome{
    margin-bottom:20px;
}

.welcome p{
    color:#b3b3b3;
}

.search-box{
    margin-bottom:30px;
}

.search-box input{
    width:350px;
    padding:12px;
    border:none;
    border-radius:25px;
    outline:none;
}

.search-box button{
    padding:12px 20px;
    border:none;
    border-radius:25px;
    background:#1DB954;
    color:white;
    cursor:pointer;
}

.song-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
    gap:20px;
}

.card{
    background:#181818;
    padding:15px;
    border-radius:15px;
    transition:.3s;
}

.card:hover{
    background:#282828;
    transform:translateY(-5px);
}

.card img{
    width:100%;
    height:250px;
    object-fit:cover;
    border-radius:12px;
}

.card h3{
    margin-top:10px;
}

.card p{
    color:#b3b3b3;
    margin-top:5px;
}

.btn-playlist{
    display:inline-block;
    margin-top:10px;
    text-decoration:none;
    color:white;
    background:#1DB954;
    padding:8px 15px;
    border-radius:20px;
}

.btn-play{
    margin-top:10px;
    margin-left:5px;
    padding:8px 15px;
    border:none;
    border-radius:20px;
    background:white;
    color:black;
    cursor:pointer;
}

#player-bar{
    position:fixed;
    bottom:0;
    left:250px;
    right:0;
    height:90px;
    background:#181818;
    border-top:1px solid #333;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 30px;
}

#audio-player{
    width:450px;
}

</style>

</head>
<body>

<div class="sidebar">

<h2>🎵 Spotify Web</h2>

<a href="dashboard.php">🏠 Home</a>

<a href="playlist.php">❤️ Playlist</a>

<a href="logout.php">🚪 Logout</a>

</div>

<div class="content">

<div class="welcome">
<h1>Selamat Datang, <?= $_SESSION['nama']; ?> 👋</h1>
<p>Nikmati musik favoritmu hari ini</p>
</div>

<div class="search-box">

<form method="GET">

<input
type="text"
name="cari"
placeholder="Cari lagu atau artis..."
value="<?= $cari; ?>">

<button type="submit">
Cari
</button>

</form>

</div>

<?php if(mysqli_num_rows($data) == 0){ ?>

<h3>Tidak ada lagu yang ditemukan.</h3>

<?php } ?>

<div class="song-grid">

<?php while($d = mysqli_fetch_assoc($data)){ ?>

<div class="card">

<?php if(!empty($d['cover'])){ ?>
<img src="cover/<?= $d['cover']; ?>">
<?php } ?>

<h3><?= $d['judul']; ?></h3>

<p>🎤 <?= $d['artis']; ?></p>

<p>🎼 <?= $d['nama_genre']; ?></p>

<a
class="btn-playlist"
<a class="btn-playlist"
href="tambah_favorit.php?lagu_id=<?= $d['id']; ?>">
❤️ Favorit
</a>

<a class="btn-playlist"
href="tambah_playlist.php?lagu_id=<?= $d['id']; ?>">
➕ Playlist
</a>

<?php if(!empty($d['file_mp3'])){ ?>

<button
class="btn-play"
onclick="putarLagu(
'<?= htmlspecialchars($d['judul'], ENT_QUOTES); ?>',
'<?= htmlspecialchars($d['artis'], ENT_QUOTES); ?>',
'lagu/<?= $d['file_mp3']; ?>'
)">
▶ Putar
</button>

<?php } ?>
</div>

<?php } ?>

</div>

</div>

<div id="player-bar">

<div>
<h3 id="judul-player">Belum ada lagu diputar</h3>
<p id="artis-player"></p>
</div>

<audio
id="audio-player"
controls>
</audio>

</div>

<script>

function putarLagu(judul, artis, file){

    document.getElementById('judul-player').innerHTML =
    "🎵 " + judul;

    document.getElementById('artis-player').innerHTML =
    artis;

    let player =
    document.getElementById('audio-player');

    player.src = file;

    player.play();
}

</script>

</body>
</html>