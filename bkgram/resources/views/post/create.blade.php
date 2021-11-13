@extends('app')

@section('content')
    <div>
        <div class="text-center">
            <h1>create Post</h1>
        </div>
    </div>

    <div>
        <form action ="/profile" method="POST">
            @csrf
            <div class="block">
                <input type="text" name="username" placeholder="username">
                <input type="text" name="n_likes" placeholder="n_likes">
                <input type="text" name="description" placeholder="description">
                <button type="submit"> submit</button>
            </div>
        </form>
    </div>
@endsection('content')
