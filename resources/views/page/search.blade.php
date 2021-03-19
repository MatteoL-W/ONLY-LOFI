@extends('template')

@section('content')

    <section class="recherche">
    
    <h2>Research results for <u>{{$search}}</u></h2>

        @if (count($users) !== 0)    
            <h3>Users</h3>

            <div class="grid-3">
                @foreach ($users as $user)
                    @include('partials/userComponent')
                @endforeach
            </div>
        @else
            <h3>No user found</h3>
        @endif

        @if (count($songs) !== 0) 
            <h3>Songs</h3>

            <div class="grid-3">
                @foreach ($songs as $song)
                    @include('partials/songComponent')
                @endforeach
            </div>
        @else
            <h3>No song found</h3>
        @endif

        @if (count($playlists) !== 0) 
            <h3>Playlists</h3>

            <div class="grid-3">
                @foreach ($playlists as $song)
                    @include('partials/songComponent')
                @endforeach
            </div>
        @else
            <h3>No playlist found</h3>
        @endif

    </section>

@endsection