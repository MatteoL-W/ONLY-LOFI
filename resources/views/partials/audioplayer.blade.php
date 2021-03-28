<span id="player_state" class="fas fa-angle-down"></span>
<div id="lecteur">
    

    <audio src="" preload="metadata" id="audio"></audio>
    
    <button class="fas fa-play" id="play_button"></button>

    <button class="fas fa-backward" id="prev"></button>

    <span id="currentTime" class="time">0:00</span>
    
    <div id="textnbar">
        <div id="text">
            <span id="title"></span>
            <span id="artist"></span>
        </div>
        <div id="bar">
            <div class="buffered">
                <span id="buffered-amount"></span>
            </div>
            <div class="progress">
                <span id="progress-amount"></span>
            </div>
        </div>
    </div>

    <span id="duration" class="time">0:00</span>

    <button class="fas fa-forward" id="next"></button>

    <button class="fas fa-random" id="random"></button>


    <button class="fas fa-volume-up" id="mute-icon"></button>
    <input type="range" id="volume-slider" class="volume-slider" min="0" max="1" step="0.01" value="1" onchange="volume(this.value);">

</div>
