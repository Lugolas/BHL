@extends('layouts.master')
@section('extraCss')
    <link rel="stylesheet" href="../css/css.css">
@endsection
@section('content')
    <div id="container">
        <div id="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Modifier votre avatar</div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::open(array('route' => array('avatars.update', $email), 'files' => true, 'method' => 'put')) !!}
                            {{ Form::hidden('mail', $email, array('id' => 'mail')) }}
                            {!! Form::label('image', 'Votre avatar') !!}
                            {!! Form::file('image', ['class' => 'form-control-file']) !!}
                            {!! Form::submit('Modifier !', ['id' => 'send', 'class' => 'btn btn-primary mb-2']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection