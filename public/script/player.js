$(document).ready(function() {
    /*$("a.song").click(function(e) {
         e.preventDefault();
         var audio = $('#audio')[0]
         audio.src =  $(this).attr('data-file')
         audio.play();
         document.getElementById('play_button').className = 'fas fa-pause';
         document.getElementById('title').innerHTML = $(this).attr('data-title')
         document.getElementById('artist').innerHTML = "|&ensp; Upload by "+$(this).attr('data-artist')
    })*/
    var audio = $('#audio')[0]
    /*Bouton play - pause*/ 
    let play = true;
    document.getElementById('play_button').addEventListener('click', function(){
        if(play == true){
            audio.pause();
            document.getElementById('play_button').className = 'fas fa-play';
            play = false
        } else {
            audio.play();
            document.getElementById('play_button').className = 'fas fa-pause';
            play = true;
        }
    });

    
    document.getElementById('mute-icon').addEventListener('click', function(){
        var balAudio = document.getElementsByTagName('audio')[0];
        var savedvolume = document.getElementById('volume-slider').value;

        if(balAudio.volume == 0) {
            balAudio.volume = savedvolume;
            document.getElementById('mute-icon').className = 'fas fa-volume-up';
        } else {
            balAudio.volume = 0;
            document.getElementById('mute-icon').className = 'fas fa-volume-mute';
        }
    });

    /* Barre de progression */

    var myAudio = document.getElementById('audio');
    var totalDuration = document.getElementById('duration');
    var currentTime = document.getElementById('currentTime');

    myAudio.addEventListener('progress', function() {
      var duration =  myAudio.duration;
      if (duration > 0) {
        for (var i = 0; i < myAudio.buffered.length; i++) {
              if (myAudio.buffered.start(myAudio.buffered.length - 1 - i) < myAudio.currentTime) {
                  document.getElementById("buffered-amount").style.width = (myAudio.buffered.end(myAudio.buffered.length - 1 - i) / duration) * 100 + "%";
                  break;
              }
          }
      }
    });

    myAudio.addEventListener('timeupdate', function() {
        var duration =  myAudio.duration;
        var s = parseInt(myAudio.currentTime % 60);
          var m = parseInt((myAudio.currentTime / 60) % 60);
          if(s < 10){
            currentTime.innerHTML = m + ':0' + s ;
          }else{
            currentTime.innerHTML = m + ':' + s ;
          }
        if (duration > 0) {
          document.getElementById('progress-amount').style.width = ((myAudio.currentTime / duration)*100) + "%";
        }
      });

      myAudio.addEventListener("durationchange", function(){
        var s = parseInt(myAudio.duration % 60);
        var m = parseInt((myAudio.duration / 60) % 60);
        if(s < 10){
            totalDuration.innerHTML = m + ':0' + s ;
        } else {
            totalDuration.innerHTML = m + ':' + s ;
        }
      });

      $('.progress').on('click', function(e) {
        // e = Mouse click event.
        var rect = e.target.getBoundingClientRect();
        var x = e.clientX - rect.left; //x position within the element.
        var y = e.clientY - rect.top;  //y position within the element.
        console.log("Left? : " + x + " ; Top? : " + y + ".");
        var duration = audio.duration;
        var ratio = x / $('.progress').width(); 
        var newCurrentTime = ratio * duration
        audio.currentTime = newCurrentTime;
      })


})

/* Volume */

function volume(amount){
    var balAudio = document.getElementsByTagName('audio')[0];
    balAudio.volume = amount;
    if(balAudio.volume == 0){
        document.getElementById('mute-icon').className = 'fas fa-volume-mute';
    } else {
      document.getElementById('mute-icon').className = 'fas fa-volume-up';
    }
}

