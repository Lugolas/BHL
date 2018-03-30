@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        @yield('nomUtilisation')
    </div>
     <div class="row">
        @yield('option')
    </div>
     <div class="row">
        @yield('listeAvatars')
    </div>
</div>
@endsection
