@extends('layouts.masterProfile')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('route' => 'avatars.store', 'files' => true, 'method' => 'post')) !!}
        {!! Form::label('mail', 'Votre adresse mail') !!}
        {!! Form::email('mail', '') !!}<br />
        {!! Form::label('image', 'Votre avatar') !!}
        {!! Form::file('image') !!}
        {!! Form::submit('Envoyer !') !!}
    {!! Form::close() !!}
@endsection