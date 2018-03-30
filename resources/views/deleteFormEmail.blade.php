@extends('layouts.masterProfile')

@section('content')
    {!! Form::open(array('route' => 'deleteAvatar', 'method' => 'delete')) !!}
        {!! Form::label('mail', 'Votre adresse mail') !!}
        {!! Form::email('mail', '') !!}<br />
        {!! Form::submit('Envoyer !') !!}
    {!! Form::close() !!}
@endsection