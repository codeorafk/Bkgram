<html lang = "en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title>Bkgram</title>
    <link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>
      .post{
        margin: 20px 0px;
      }
    </style>
  </head>
  <body>
    <div class="navigation">
      @include('layouts.nav')
    </div>
    <section>
      <div class="col-md-8 col-sm-12">
        <div class="post">
          @include('layouts.post')
        </div>
        <div class="post">
          @include('layouts.post')
        </div>
      </div>
      <div class="col-md-4">
        @include('layouts.listFollow')
      </div>
    </section>
    <script src="{{asset('js/script.js')}}"></script> 
  </body>
</html>