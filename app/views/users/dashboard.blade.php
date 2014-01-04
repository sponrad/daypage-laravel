<h1>Dashboard</h1>

<p>forced Message that you are welcome here.</p>

<div class="cj-datenav"></div>



@section('underheader')
  <link href="/jquery-ui.css" rel="stylesheet" type="text/css"/>
@stop


@section('underbody')
  <script src="/cj-date-picker-bar/js/jquery.cj-date-picker-bar.js"></script>
  <script src="/jquery-ui.min.js"></script>
  <script>
   (function($) {
     "use strict";
     $('.cj-datenav').cjDatePickerBar({
       showDays: true,
       tinyInc: 1,
       showInc: false,
       onClick: function(dateObj) {
	 console.log(dateObj);
	 $('.cj-button-month,.cj-button-day').removeClass('ui-state-disabled').removeAttr('disabled');
       }
     });
   }(jQuery));

   $(document).ready( function(){
     $('.cj-button-month').hide();
     $('.cj-button-day').removeClass('ui-state-disabled').removeAttr('disabled');
     });
  </script>
@stop
