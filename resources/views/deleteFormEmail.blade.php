@extends('layouts.masterProfile')

@section('content')
    {!! Form::open(array('route' => 'suppAvatar', 'method' => 'delete')) !!}
        {!! Form::label('mail', 'Votre adresse mail') !!}
        {!! Form::email('mail', '') !!}<br />
        {!! Form::submit('Envoyer !') !!}
    {!! Form::close() !!}
@endsection