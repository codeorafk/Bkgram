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
      <div class="app row">  
        <div class="col-md-8">
          @include('layouts.post')
        </div>
        <div class="col-md-4">
          @include('layouts.listFollow')
        </div>
      </div>
    </section>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/app.js') }}" type="text/javascript"></script>
  </body>
</html>