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
            <a class="navbar-brand" href="/">Daypage</a>
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
                <li><a href="/users/home"><span class="glyphicon glyphicon-home"></span>{{ Auth::user()->firstname.' '.Auth::user()->lastname }}</a></li>
                <li title="Settings"><a href="/users/settings"><span class="glyphicon glyphicon-cog"></span></a></li>
		<li title="Logout"><a href="/users/logout"><span class="glyphicon glyphicon-off"></span></a></li>
	      @endif
            </ul>
          </div><!--/.nav-collapse -->
	</div>
      </div>

      <!-- CONTENT -->    

      <div class="container">
	@yield('content')
      </div>
    </div>


    <!-- FOOTER -->
    <footer>
      <div class="container">
	<p>
	  &copy;<?php echo date("Y"); ?> Daypage &middot; 
	  <a href="/privacy">Privacy</a> &middot; 
	  <a href="/terms">Terms</a> &middot; 
	  <a href="/features">Features</a> &middot; 
	  <a href="/about">About</a>
	</p>
      </div>
    </footer>


    <script src="/jquery1.10.2.js"></script>
    <script src="/packages/bootstrap-3.0.3/js/bootstrap.min.js"></script>

    @yield('underbody')

    <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
       (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

     ga('create', 'UA-38960400-1', 'daypager.com');
     ga('send', 'pageview');
    </script>
  </body>

</html>
