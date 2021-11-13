@extends('app')
@section('content')
    <div class="header"> 
        @include('layouts.headerProfile') 
    </div>
    <div class="posts_profile row">
        @include('layouts.postProfile')
    </div>
@endsection('content')