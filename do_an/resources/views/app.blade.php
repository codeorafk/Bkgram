<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title>Instagram</title>
    <link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}"> 

    <script src="{{ asset('js/app.js') }}" defer>
    </script>
  </head>
  <body>
    <div class="navigation">
      @include('layouts.nav')
    </div>
    <div class="container">
      @yield('content')  
    </div>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  </body>
</html>