<!doctype html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daypage</title>
    {{ HTML::style('packages/bootstrap-3.0.3/css/bootstrap.min.css') }}
    {{ HTML::style('main.css') }}
    @yield('underheader')
  </head>

  <body>

    <div id="wrap">
      <div class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Daypage</a>
          </div>
          <div class="navbar-collapse collapse">

            <ul class="nav navbar-nav">
<!--              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li> -->
	      @if(Session::has('message'))
		<li class="pagealert">{{ Session::get('message') }}</li>
	      @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
              @if(!Auth::check())
		<li>{{ HTML::link('users/register', 'Register') }}</li>   
		<li>{{ HTML::link('users/login', 'Login') }}</li>
	      @else
              <li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->firstname.' '.Auth::user()->lastname }} <b class="caret"></b></a>
		<ul class="dropdown-menu">
                  <li>{{ HTML::link('users/home', 'Home') }}</li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
		  <li>{{ HTML::link('users/logout', 'Logout') }}</li>
		</ul>
              </li>
	      @endif
            </ul>
          </div><!--/.nav-collapse -->
	</div>
      </div>

      <!-- CONTENT -->    

      <div class="container">

	{{ $content }}
      </div>
    </div>


      <!-- FOOTER -->
      <footer>
	<div class="container">
	  <p>&copy;<?php echo date("Y"); ?> Daypage &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
	</div>
      </footer>


    <script src="/jquery1.10.2.js"></script>
    <script src="/packages/bootstrap-3.0.3/js/bootstrap.min.js"></script>

    @yield('underbody')
        

    
  </body>

</html>
