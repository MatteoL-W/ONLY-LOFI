@extends('template')

@section('content')

<div class="container" style='margin-top:50px;'>
    @include('partials/last4', ["collection" => $collection])
</div>

@endsection