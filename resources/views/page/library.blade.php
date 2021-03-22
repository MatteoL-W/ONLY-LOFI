@extends('template')

@section('content')

<section class="library">

    <h2>Your lasts playlists listened</h2>
    @include('partials/last4', ["collection" => $PlastsListened])
    <a class='see-all' href="#">See all your playlists...</a>

    <h2>Your lasts playlist created</h2>
    @include('partials/last4', ["collection" => $PlastsCreated])
    <a class='see-all' href="#">See all your playlists...</a>

    <h2>Your lasts songs listened</h2>
    @include('partials/last4', ["collection" => $SlastsListened])

    <h2>Your likes</h2>
    @include('partials/last4', ["collection" => $SlastsLikes])
    <a class='see-all' href="/likes">See all your likes...</a>
</section>

@endsection