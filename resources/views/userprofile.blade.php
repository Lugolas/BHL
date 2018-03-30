@extends('layouts.masterProfile')


@section('nomUtilisation')
<div class="container">
    l'email 
</div>
@endsection

@section('option')
<div class="container">
    les options 
</div>
@endsection

@section('listeAvatars')
<div class="container">
    la liste des Avatarss
    {!! $emails !!}
    @foreach ($emails as $email => $image)
        <p>L'email {{ $email }} puis le l'image </p>
        <img src={{$image}} height="100" width="100" alt="tu peux pas voir tant pis"></img>
    @endforeach
    
</div>
@endsection
