@if (isset($song->url)) 
<a class="user-component" href="/song/{{$song->id}}">
@else
<a class="user-component" href="/playlist/{{$song->id}}">
@endif
    <div class="user-component-avatar">
        <img src="{{$song->img}}" alt="{{$song->title}}">
    </div>
    <div class="user-component-info">
        <p class='name'>{{$song->title}}</p>
    </div>
</a>