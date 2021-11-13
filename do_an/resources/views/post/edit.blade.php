@extends('app')

@section('content')
<div class="row">
    <div class="col-5 sidebar">
    <div class="img">
        <img class="card-img-top" src="{{asset('images/'.$posts->image_path)}}" alt="Card image" style="width:100%">
    </div>
    </div>
    <div class="col-7" style="padding-left: 50px">
        <form action ="{{route('post.update',$posts->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <label class="form-text"> Image</label>
                <input type="file" class="form-input" name="image">
                </div>
                <div class="row">
                <lable class="form-text"> description</lable>
                <textarea class="form-input" type="text" name="description" placeholder="{{$posts->description}}"></textarea>
                </div>
                <div class="submit">
                <button type="submit"> submit</button>  
            </div>
        </form>
    </div>
</div>
@endsection('content')