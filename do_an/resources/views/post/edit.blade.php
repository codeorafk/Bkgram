@extends('app')

@section('content')
    <div>
        <div class="text-center">
            <h1>update Post</h1>
        </div>
    </div>

    <div>
        <form action ="/profile/{{ $posts->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="block">
                <input type="text" name="username" value="{{$posts->username}}">
                <input type="text" name="n_likes" value="{{$posts->n_likes}}">
                <input type="text" name="description" value="{{$posts->description}}">
                <button type="submit"> submit</button>
            </div>
        </form>
    </div>
@endsection('content')