<!doctype html>
<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daypage</title>
    {{ HTML::style('packages/bootstrap-3.0.3/css/bootstrap.min.css') }}
    {{ HTML::style('main.css') }}
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <ul class="nav">  
	    @if(!Auth::check())
              <li>{{ HTML::link('users/register', 'Register') }}</li>   
              <li>{{ HTML::link('users/login', 'Login') }}</li>
	    @else
	      <li>{{ HTML::link('users/logout', 'Logout') }}</li>
	    @endif
          </ul>
        </div>
      </div>
    </div> 
    
    <div class="container">
      @if(Session::has('message'))
	<p class="alert">{{ Session::get('message') }}</p>
      @endif

      {{ $content }}
    </div>


    <script src="/jquery1.10.2.js"></script>
    <script src="/packages/bootstrap-3.0.3/js/bootstrap.min.js"></script>
    
  </body>

</html>
