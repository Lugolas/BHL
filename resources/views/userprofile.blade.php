@extends('layouts.masterProfile')


@section('nomUtilisation')
<div id="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                Vous etes connecté en tant que : {{ Auth::user()->name }}.</div>
            <div class="panel-body">
                Voici votre liste d'avatars avec les adresses mails correspondant</div>
        </div>
    </div>
</div>
    
@endsection

@section('listeAvatars')
                    
    </br>
    <div class="container" id="avatarsContainer">
        {!! Form::open(array('route' => 'deleteAvatars', 'method' => 'post')) !!}
            <div class="row">
                <div class="col-md-2 col-md-offset-10">
                    <input type="submit" value="Supprimer sélection" class="btn btn-primary mb-2" id="JeanJacques" onClick="if(confirm('Voulez-vous vraiment supprimer les images sélectionnées ?')) commentDelete(1); return false">
                </div>
            </div>
            <div class="row">
                @foreach ($emails as $email)
                    <div class="col-md-3">
                        <label class="containerCheck">
                            {!! Form::checkbox('ch[]', $email->mail , false) !!}
                            <span class="checkmark"></span>
                            <img src="{!! $email->link !!}" alt="" class="card-img-top" width="100px" height="100px"/>
                        </label>
                        <h5 class="img-title"><a href="{{ url('/formEmail/'.str_replace('/', '', $email->mail)) }}">{!! $email->mail_aff !!}</a></h5>
                    </div>
                @endforeach
                    <div class="col-md-3">
                        <a href="{{ url('/formEmail') }}"><img src="/BHLprojet/resources/assets/images/+.png" alt="" class="card-img-top" width="100px" height="100px" /></a>
                        <h5 class="img-title"><a href="{{ url('/formEmail') }}">Ajouter</a></h5>
                    </div>
             </div>
         {!! Form::close() !!}
    </div>
</div>
@endsection