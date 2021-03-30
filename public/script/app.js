jQuery(function () {
    setTimeout(function () { document.getElementById('random').classList.toggle("quick") }, 1700);


    /* PARTIE PJAX */
    $(document).pjax('a:not(.song)', '#pjax-container')

    $('#search').on('submit', function (e) {
        e.preventDefault();
        if ($.support.pjax)
            $.pjax({ url: "/search/" + e.target.elements[0].value, container: '#pjax-container' });
        else
            window.location.href = "/search/" + e.target.elements[0].value;
    })

    $(document).on('submit', 'form[data-pjax]', function (event) {
        $.pjax.submit(event, '#pjax-container')
    })

    /* BLOC ADD PLAYLIST */
    $(document).on('click', '#addButton', function (e) {
        let dimensionBouton = document.querySelector('#addButton').getBoundingClientRect();
        e.preventDefault();

        document.querySelector('#bloc_playlist').classList.toggle('active');
        document.querySelector('#bloc_playlist').style.left = dimensionBouton.x + 72 + "px";
        document.querySelector('#bloc_playlist').style.top = dimensionBouton.y + "px";
    })


    var balAudio = document.getElementsByTagName('audio')[0];
    $("#pjax-container").on("click", "a.song", function (e) { //click sur "play"

        e.preventDefault();
        songlist = []; // initialisation du tableau des sons
        var savedvolume = document.getElementById('volume-slider').value;
        var audio = $('#audio')[0];

        audio.src = $(this).attr('data-file'); 
        solosong = $(this).attr('data-file');
        solotitle = $(this).attr('data-title')
        soloartist = "|&ensp; Upload by " + $(this).attr('data-artist');

        balAudio.volume = savedvolume;
        audio.play();


        /* AJOUT A LA BDD "LISTENED" */
        let songId = audio.src;
        songId = songId.split('/');

        if ($(this).attr('data-playlist') == 1) {
            $.ajax({
                url: '/addListenedPlaylist/' + $(this).attr('data-listened'), // La ressource ciblée
                type: 'GET', // Le type de la requête HTTP
            });
        }

        $.ajax({
            url: '/addListenedSong/' + songId[4], // La ressource ciblée
            type: 'GET', // Le type de la requête HTTP
        });


        current = parseInt($(this).attr("data-nb"));
        length = [];
        length.push(current);

        document.getElementById('play_button').className = 'fas fa-pause';
        document.getElementById('title').innerHTML = $(this).attr('data-title');
        document.getElementById('artist').innerHTML = "|&ensp; Upload by " + $(this).attr('data-artist');

        if (typeof document.getElementsByClassName('songlist') != undefined) {
            for (let i = 0; i < document.getElementsByClassName('songlist').length; i++) {
                songlist[i] = [0], [1], [2];
                songlist[i][0] = $("a.song[data-nb='" + i + "']").attr("data-file");
                songlist[i][1] = $("a.song[data-nb='" + i + "']").attr("data-title");
                songlist[i][2] = $("a.song[data-nb='" + i + "']").attr("data-artist");

            } return songlist;

        }
    })


    let play = true;
    var audio = $('#audio')[0]
    /*Bouton play - pause*/
    document.getElementById('play_button').addEventListener('click', function () {
        if (play == true) {
            audio.pause();
            document.getElementById('play_button').className = 'fas fa-play';
            play = false;
        } else {
            audio.play();
            document.getElementById('play_button').className = 'fas fa-pause';
            play = true;
        }
    });

    // gestion du son
    document.getElementById('mute-icon').addEventListener('click', function () {
        var balAudio = document.getElementsByTagName('audio')[0];
        var savedvolume = document.getElementById('volume-slider').value;

        if (balAudio.volume == 0) {
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

    myAudio.addEventListener('progress', function () {
        var duration = myAudio.duration;
        if (duration > 0) {
            for (var i = 0; i < myAudio.buffered.length; i++) {
                if (myAudio.buffered.start(myAudio.buffered.length - 1 - i) < myAudio.currentTime) {
                    document.getElementById("buffered-amount").style.width = (myAudio.buffered.end(myAudio.buffered.length - 1 - i) / duration) * 100 + "%";
                    break;
                }
            }
        }
    });

    myAudio.addEventListener('timeupdate', function () {
        var duration = myAudio.duration;
        var s = parseInt(myAudio.currentTime % 60);
        var m = parseInt((myAudio.currentTime / 60) % 60);
        if (s < 10) {
            currentTime.innerHTML = m + ':0' + s;
        } else {
            currentTime.innerHTML = m + ':' + s;
        }
        if (duration > 0) {
            document.getElementById('progress-amount').style.width = ((myAudio.currentTime / duration) * 100) + "%";
        }
    });

    myAudio.addEventListener("durationchange", function () {
        var s = parseInt(myAudio.duration % 60);
        var m = parseInt((myAudio.duration / 60) % 60);
        if (s < 10) {
            totalDuration.innerHTML = m + ':0' + s;
        } else {
            totalDuration.innerHTML = m + ':' + s;
        }
    });

    $('.progress').on('click', function (e) {
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


    allsongs = document.getElementsByClassName('songlist');


    // fin de la lecture d'une musique
    audio.addEventListener('ended', function () {

        var audio = $('#audio')[0];

        if (songlist.length > 1) {

            // SI FONCTION RANDOM EST ACTIVE 
            if (random == true) {

                if (length.length == songlist.length) {
                    length = [];
                    current = getRandomInt(0, songlist.length);
                    length.push(current);
                    audio.src = songlist[current][0];
                    document.getElementById('title').innerHTML = songlist[current][1];
                    document.getElementById('artist').innerHTML = "|&ensp; Upload by " + songlist[current][2];
                    audio.play();
                } 
                
                else {
                    current = getRandomInt(0, songlist.length);

                    if (length.indexOf(current) == -1) {
                        length.push(current);
                        audio.src = songlist[current][0];
                        document.getElementById('title').innerHTML = songlist[current][1];
                        document.getElementById('artist').innerHTML = "|&ensp; Upload by " + songlist[current][2];
                        audio.play();
                    } 
                    
                    else {
                        while (length.indexOf(current) != -1) {
                            current = getRandomInt(0, songlist.length);
                        }
                        length.push(current);
                        audio.src = songlist[current][0];
                        document.getElementById('title').innerHTML = songlist[current][1];
                        document.getElementById('artist').innerHTML = "|&ensp; Upload by " + songlist[current][2];
                        audio.play();
                    }
                }

            // SI FONCTION RANDOM N EST PAS ACTIVE
            } else {
                current++
                if (current == songlist.length) {
                    current = 0;
                }
                audio.src = songlist[current][0];
                document.getElementById('title').innerHTML = songlist[current][1];
                document.getElementById('artist').innerHTML = "|&ensp; Upload by " + songlist[current][2];
                audio.play();

            }
        } else {
            audio.src = solosong;
            document.getElementById('title').innerHTML = solotitle;
            document.getElementById('artist').innerHTML = soloartist;
            audio.play();

        }

    });

    // bouton next
    document.getElementById('next').addEventListener('click', function () {
        var audio = $('#audio')[0];
        if (songlist.length > 1) {
            if (random == true) {
                if (length.length == songlist.length) {
                    length = [];
                    current = getRandomInt(0, songlist.length);
                    length.push(current);
                    audio.src = songlist[current][0];
                    document.getElementById('title').innerHTML = songlist[current][1];
                    document.getElementById('artist').innerHTML = "|&ensp; Upload by " + songlist[current][2];
                    audio.play();
                } else {
                    current = getRandomInt(0, songlist.length);
                    if (length.indexOf(current) == -1) {
                        length.push(current);
                        audio.src = songlist[current][0];
                        document.getElementById('title').innerHTML = songlist[current][1];
                        document.getElementById('artist').innerHTML = "|&ensp; Upload by " + songlist[current][2];
                        audio.play();
                    } else {
                        while (length.indexOf(current) != -1) {
                            current = getRandomInt(0, songlist.length);
                        }
                        length.push(current);
                        audio.src = songlist[current][0];
                        document.getElementById('title').innerHTML = songlist[current][1];
                        document.getElementById('artist').innerHTML = "|&ensp; Upload by " + songlist[current][2];
                        audio.play();
                    }
                }

            } else {
                current++
                if (current == songlist.length) {
                    current = 0;
                }
                audio.src = songlist[current][0];
                document.getElementById('title').innerHTML = songlist[current][1];
                document.getElementById('artist').innerHTML = "|&ensp; Upload by " + songlist[current][2];
                audio.play();

            }
        } else {
            audio.src = solosong;
            document.getElementById('title').innerHTML = solotitle;
            document.getElementById('artist').innerHTML = soloartist;
            audio.play();

        }

        let songId = audio.src;
        songId = songId.split('/');

        $.ajax({
            url: '/addListenedSong/' + songId[4], // La ressource ciblée
            type: 'GET', // Le type de la requête HTTP
        });
        
        play = true;
        return play;
    });

    document.getElementById('prev').addEventListener('click', function () {
        var audio = $('#audio')[0];
        /* On vérifie si l'on est sur une playlist ou un son seul*/
        if (songlist.length > 1) {
            /* On vérifie si le bouton random est acrif*/
            if (random == true) {
                /* On vérifie si l'on a déjà passé toute les musiques de la playlist */
                if (length.length == songlist.length) {
                    length = [];
                    current = getRandomInt(0, songlist.length);
                    length.push(current);
                    audio.src = songlist[current][0];
                    document.getElementById('title').innerHTML = songlist[current][1];
                    document.getElementById('artist').innerHTML = "|&ensp; Upload by " + songlist[current][2];
                    audio.play();
                } else {
                    current = getRandomInt(0, songlist.length);
                    if (length.indexOf(current) == -1) {
                        length.push(current);
                        audio.src = songlist[current][0];
                        document.getElementById('title').innerHTML = songlist[current][1];
                        document.getElementById('artist').innerHTML = "|&ensp; Upload by " + songlist[current][2];
                        audio.play();
                    } else {
                        while (length.indexOf(current) != -1) {
                            current = getRandomInt(0, songlist.length);
                        }
                        length.push(current);
                        audio.src = songlist[current][0];
                        document.getElementById('title').innerHTML = songlist[current][1];
                        document.getElementById('artist').innerHTML = "|&ensp; Upload by " + songlist[current][2];
                        audio.play();
                    }
                }

            } else {
                current--;
                if (current < 0) {
                    current = songlist.length - 1;
                }
                audio.src = songlist[current][0];
                document.getElementById('title').innerHTML = songlist[current][1];
                document.getElementById('artist').innerHTML = "|&ensp; Upload by " + songlist[current][2];
                audio.play();
            }
        } else {
            audio.src = solosong;
            document.getElementById('title').innerHTML = solotitle;
            document.getElementById('artist').innerHTML = soloartist;
            audio.play();
        }
    });

    random = false;
    document.getElementById('random').addEventListener('click', function () {
        if (random == false) {
            random = true;
            document.getElementById('random').style.color = "#F85049";
        } else {
            random = false;
            document.getElementById('random').style.color = "white";
        }
    });


    document.getElementById('player_state').addEventListener('click', function () {
        button = document.getElementById('player_state');
        lecteur = document.getElementById('lecteur');

        lecteur.classList.toggle("inactive");

        button.classList.toggle("inactive");

    });
})

function volume(amount) {
    var balAudio = document.getElementsByTagName('audio')[0];
    balAudio.volume = amount;
    if (balAudio.volume == 0) {
        document.getElementById('mute-icon').className = 'fas fa-volume-mute';
    } else {
        document.getElementById('mute-icon').className = 'fas fa-volume-up';
    }
}

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min;
}
