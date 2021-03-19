<a class="user-component" href="/user/{{$user->id}}">
    <div class="user-component-avatar">
        <img src="{{$user->avatar}}" alt="{{$user->name}}">
    </div>
    <div class="user-component-info">
        <p class='name'>{{$user->name}}</p>
        <p>{{$user->description}}</p>
    </div>
</a>