@extends('template')

@section('content')

<section class="library">

    <section class="template2">
        <div class="template2__grid">
            <h2>Your lasts playlists listened</h2>
            @include('partials/last2', ["collection" => $PlastsListened])
        </div>

        <div class="template2__grid">
            <h2>Your lasts playlists created</h2>
            @include('partials/last2', ["collection" => $PlastsCreated])
        </div>
    </section>
    
    <a class='see-all' href="/playlists">See all your playlists...</a>

    <h2>Your lasts songs listened</h2>
    @include('partials/last4', ["collection" => $SlastsListened])

    <h2>Your likes</h2>
    @include('partials/last4', ["collection" => $SlastsLikes])
    <a class='see-all' href="/likes">See all your likes...</a>
</section>

@endsection