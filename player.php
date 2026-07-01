<div id="spotify-player">

    <div class="player-left">

        <img
        id="cover-player"
        src="assets/default-cover.png"
        alt="cover">

        <div class="song-info">

            <h4 id="judul-player">
                Belum ada lagu diputar
            </h4>

            <p id="artis-player">
                Spotify Web
            </p>

        </div>

    </div>

    <div class="player-center">

        <div class="player-control">

            <button id="shuffle">
                🔀
            </button>

            <button id="prev">
                ⏮
            </button>

            <button id="playPause">
                ▶
            </button>

            <button id="next">
                ⏭
            </button>

            <button id="repeat">
                🔁
            </button>

        </div>

        <div class="progress-area">

            <span id="currentTime">
                0:00
            </span>

            <input
            type="range"
            id="progress"
            min="0"
            value="0">

            <span id="duration">
                0:00
            </span>

        </div>

    </div>

    <div class="player-right">

        🔊

        <input
        type="range"
        id="volume"
        min="0"
        max="100"
        value="100">

    </div>

</div>

<audio id="audio-player"></audio>