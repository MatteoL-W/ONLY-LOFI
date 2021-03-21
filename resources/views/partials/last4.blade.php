<section class="template4">
    
    <div class="template4__grid">

        @foreach ($collection as $item)
            @if (isset($item->url)) 
                <a class="template4__grid-card" href='/song/{{$item->idListened}}'>
            @else
                <a class="template4__grid-card" href='/playlist/{{$item->idListened}}'>
            @endif
            
                <img src="{{$item->img}}" class='hover__listener' alt="{{$item->title}}">
                <p>{{$item->title}}</p>
            </a>
        @endforeach

        

        <!--<a class="template4__grid-card" href='#'>
            <img src="/assets/lofistream.png" class='hover__listener' alt="">
            <p>beats to relax/study to</p>
        </a>

        <a class="template4__grid-card" href='#'>
            <img src="/assets/lofistream.png" class='hover__listener' alt="">
            <p>beats to relax/study to</p>
        </a>

        <a class="template4__grid-card" href='#'>
            <img src="/assets/lofistream.png" class='hover__listener' alt="">
            <p>beats to relax/study to</p>
        </a>-->

    </div>
</section>


