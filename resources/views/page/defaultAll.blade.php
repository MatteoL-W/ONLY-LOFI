@extends('template')

@section('content')

<h2 class="container" style='margin-top: 50px'>{{$intitule}}</h2>

<div class="container" style='margin-top:50px;'>
    @include('partials/last4', ["collection" => $collection])
</div>

@endsection