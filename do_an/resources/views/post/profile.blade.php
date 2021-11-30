@extends('app')
@section('content')
    <div class="header"> 
        @include('layouts.headerProfile') 
    </div>
    @include('layouts.postProfile')
@endsection('content')