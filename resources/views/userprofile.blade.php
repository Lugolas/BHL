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
    la liste des Avatars
    </br>
    <div class="container">
        <div class="row">
            @foreach ($emails as $email => $image)
                <div class="col-md-4">
                    <img src="{!! $image !!}" alt="" width="100px" height="100px"/><br />
                    <p>{!! $email !!}</p>
                </div>
            @endforeach
         </div>
    </div>
</div>
@endsection
