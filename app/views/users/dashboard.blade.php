<div id="hDatepicker"></div>

<div id="viewContainer">

  <div id="feedView">
    <button id="composeButton">New Entry</button>
    <button id="filterButton">Filter</button>
    <div id="feed"></div>
  </div>

  <div id="editorView">
  </div>

</div>


@section('underheader')
  <link media="all" type="text/css" rel="stylesheet" href="/wysihtml5-stylesheet.css"
@stop


@section('underbody')
  <script src="/hDatepicker.js"></script>
  <script src="/wysihtml5-0.0advanced.js"></script>
  <script src="/wysihtml5-0.3.0.js"></script>
  <script>

   dpFormat = function(date){
     fDate = "" + date.getFullYear() + ("0" + (date.getMonth() + 1)).slice(-2) + ("0" + date.getDate()).slice(-2);
     return fDate;
   }

   $(document).ready( function(){
     $("#editorView").hide();

     hDatepicker( $("#hDatepicker"), {
       onDateSelect: function(date){
	 $("#feed").html("loading");
	 fDate = dpFormat(date);
	 $("#feed").load("/ajax/getentries?date=" + fDate);
       }
     }
		 );
     
     $("#viewContainer").on("click", "#composeButton",function(){
       $("#feedView").hide();
       $("#editorView").show();

       $("#hDatepicker").bind("click", function(e){
	 e.preventDefault();
       });

       $("editorView").load("/ajax/loadeditor");

       var editor = new wysihtml5.Editor("writingbox", {
	 toolbar:      "toolbar",
	 stylesheets:  "wysihtml5-stylesheet.css",
	 parserRules:  wysihtml5ParserRules
       });

       $("#writingbox").focus();

     });

     $("#viewContainer").on("click", "#filterButton, #cancelComposeButton",function(){
       $("#feedView").show();
       $("#editorView").hide();

     });

     function saveEntry( target ){
       var id = $(target).attr("id");
       var content = $(target).val();
       var date = new Date();
       var datatosend = {id: id, content: content, date: date};
       $.post("/json/saveentry", datatosend, 
	      function(data){
           if (data.response == "1"){
	     console.log("successful save");
           }
	   else{
	     console.log("unsuccessful save");
	   }
         }, 'json' );
     }


     $("#viewContainer").on("click", "#saveButton",function(e){
       saveEntry( $("#writingbox") );
     });

     $("#feed").html("loading");
     date = new Date();
     $("#feed").load("/ajax/getentries?date=" + dpFormat(date));

   });
  </script>
@stop
