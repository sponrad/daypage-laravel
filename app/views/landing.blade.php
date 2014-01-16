@extends('main')

@section('underheader')
  <style>

   /* CUSTOMIZE THE CAROUSEL
   -------------------------------------------------- */

   /* Carousel base class */
   .carousel {
     height: 500px;
     margin-bottom: 60px;
   }
   /* Since positioning the image, we need to help out the caption */
   .carousel-caption {
     z-index: 10;
   }

   /* Declare heights because of positioning of img element */
   .carousel .item {
     height: 500px;
     background-color: #777;
   }
   .carousel-inner > .item > img {
     position: absolute;
     top: 0;
     left: 0;
     min-width: 100%;
     height: 500px;
   }

   /* MARKETING CONTENT
   -------------------------------------------------- */

   /* Pad the edges of the mobile views a bit */
   .marketing {
     padding-left: 15px;
     padding-right: 15px;
   }

   /* Center align the text within the three columns below the carousel */
   .marketing .col-lg-4 {
     text-align: center;
     margin-bottom: 20px;
   }
   .marketing h2 {
     font-weight: normal;
   }
   .marketing .col-lg-4 p {
     margin-left: 10px;
     margin-right: 10px;
   }


   /* Featurettes
   ------------------------- */

   .featurette-divider {
     margin: 80px 0; /* Space out the Bootstrap <hr> more */
   }

   /* Thin out the marketing headings */
   .featurette-heading {
     font-weight: 300;
     line-height: 1;
     letter-spacing: -1px;
   }



   /* RESPONSIVE CSS
   -------------------------------------------------- */

   @media (min-width: 768px) {

     /* Remove the edge padding needed for mobile */
     .marketing {
       padding-left: 0;
       padding-right: 0;
     }

     /* Navbar positioning foo */
     .navbar-wrapper {
       margin-top: 20px;
     }
     .navbar-wrapper .container {
       padding-left:  15px;
       padding-right: 15px;
     }
     .navbar-wrapper .navbar {
       padding-left:  0;
       padding-right: 0;
     }

     /* The navbar becomes detached from the top, so we round the corners */
     .navbar-wrapper .navbar {
       border-radius: 4px;
     }

     /* Bump up size of carousel content */
     .carousel-caption p {
       margin-bottom: 20px;
       font-size: 21px;
       line-height: 1.4;
     }

     .featurette-heading {
       font-size: 50px;
     }

   }

   @media (min-width: 992px) {
     .featurette-heading {
       margin-top: 120px;
     }
   } 
  </style>
@stop

@section('content')

  <!-- Carousel
  ================================================== -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="item active">
        <img src="/img/sunrise.jpg" alt="First slide">
        <div class="container">
          <div class="carousel-caption">
            <h1>Simple Daily Notes</h1>
	    <p>Daypage is the simplest way to keep track daily. It is a super pumped-up modern day journal.</p>
            <p><a class="btn btn-lg btn-primary" href="/users/register" role="button">Sign up now</a></p>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="/img/Nightpage.jpg" alt="Second slide">
        <div class="container">
          <div class="carousel-caption">
            <h1>Great Personal and for Groups</h1>
            <p>Make daily notes personal and private or start a group and keep track together. Daypage has you covered.</p>
            <p><a class="btn btn-lg btn-primary" href="/features" role="button">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="/img/Daypage1.jpg" alt="Third slide">
        <div class="container">
          <div class="carousel-caption">
            <h1>Simple, and Still Tons of Features</h1>
            <p>Daypage keeps things extremely simple, but still manages to offer tons of great features.</p>
            <p><a class="btn btn-lg btn-primary" href="/features" role="button">See Features</a></p>
          </div>
        </div>
      </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
  </div><!-- /.carousel -->

 <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <img class="img-circle" data-src="holder.js/140x140" alt="Generic placeholder image">
          <h2>Write</h2>
          <p>Writing on Daypage helps you stay more organized and stress-free. Click a day to bring up a clean blank page and let it all out.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="" alt="Generic placeholder image">
          <h2>Remember</h2>
          <p>Can you remember what you did two Tuesdays ago? Start remembering what you have accomplished every day. Daypage makes it easy to look back at that Tuesday and remember what was going on.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" data-src="holder.js/140x140" alt="Generic placeholder image">
          <h2>Private</h2>
          <p>Daypage keeps your daily notes and musings exactly that, yours. User privacy is paramount. We use government grade security to protect what you have written. Of course if you want to share your stuff that is allowed too.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="/img/usedaypage.jpg" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="/img/harmonica.jpg" alt="Generic placeholder image">
        </div>
        <div class="col-md-7">
          <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="/img/houseplant.jpg" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

@stop
