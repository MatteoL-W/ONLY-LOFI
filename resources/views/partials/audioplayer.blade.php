<div id="lecteur">

    <audio src="" preload="metadata" id="audio" loop></audio>

    <span id="title"></span>
    <span id="artist"></span>

    <button class="fas fa-play" id="play_button"></button>

    <!--<button class="fas fa-previous" id="prev"></button>-->
    <span id="currentTime" class="time">0:00</span>
    <div class="buffered">
        <span id="buffered-amount"></span>
    </div>
    <div class="progress">
        <span id="progress-amount"></span>
    </div>
    <span id="duration" class="time">0:00</span>
    <!--<button class="fas fa-next" id="next"></button>-->

    <output id="volume-output"></output>
    <input type="range" id="volume-slider" min="0" max="1" step="0.01" onchange="volume(this.value);">
    <button class="fas fa-volume-up" id="mute-icon" onclick="mute();"></button> 

</div>
