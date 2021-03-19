$(document).ready(function() {
    $("a.song").click(function(e) {
         e.preventDefault();
         var audio = $('#audio')[0]
         audio.src =  $(this).attr('data-file')
         audio.play();
    })
})