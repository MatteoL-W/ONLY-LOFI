<section class="template4">
    
    <div class="template4__grid">

        @foreach ($collection as $item)
            @if (isset($item->url)) 
                <a class="template4__grid-card" href='/song/{{$item->idSong}}'>
            @else
                <a class="template4__grid-card" href='/playlist/{{$item->idPlaylist}}'>
            @endif
                <img src="{{$item->img}}" class='hover__listener' alt="{{$item->title}}">
                <p>{{$item->title}}</p>
            </a>
        @endforeach

    </div>
</section>


