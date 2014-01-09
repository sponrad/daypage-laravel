<div id="hDatepicker"></div>

<div id="viewContainer">

  <div id="feedView">
    <button id="composeButton">New Entry</button>
    <button id="filterButton">Filter</button>
    <div id="feed"></div>
  </div>

  <div id="editorView">
    Default Value
  </div>

</div>


@section('underheader')
  <link media="all" type="text/css" rel="stylesheet" href="/wysihtml5-stylesheet.css">
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
     selectedDate = new Date();

     $("#editorView").hide();

     hDatepicker( $("#hDatepicker"), {
       onDateSelect: function(date){
	 $("#feed").html("loading");
	 fDate = dpFormat(date);
	 $("#feed").load("/ajax/getentries?date=" + fDate);
	 selectedDate = date;
	 $("#editor").html("");
	 $("#editorView").hide();
	 $("#feedView").show();
       }
     }
		 );
     
     $("#viewContainer").on("click", "#composeButton",function(){
       $("#feedView").hide();
       $("#editorView").show();

       $("#editorView").html("loading");
       
       $("#editorView").load("/ajax/loadeditor", function(){
	 var editor = new wysihtml5.Editor("writingbox", {
	   toolbar:      "toolbar",
	   stylesheets:  "/wysihtml5-stylesheet.css",
	   parserRules:  wysihtml5ParserRules
	 });

	 $("#writingbox").focus();	 
       });

     });

     $("#viewContainer").on("click", "#filterButton, #cancelComposeButton",function(){
       $("#feedView").show();
       $("#editorView").hide();

     });

     function saveEntry( target ){
       //provide id to save existing
       var id = $('#writingbox').attr("entryId");
       var content = $(target).val();
       var date = dpFormat(selectedDate);
       var datatosend = {id: id, content: content, date: date};
       $.post("/json/saveentry", datatosend, 
	      function(data){
	   if (data.response == "1"){
	     console.log("successful save");
	     //load the entryid into the writing box
	     $("#writingbox").attr("entryId", data.entryId);
	   }
	   else{
	     console.log("unsuccessful save");
	   }
	 }, 'json' );
     }


     $("#viewContainer").on("click", "#saveButton",function(e){
       saveEntry( $("#writingbox") );
     });

     $("#feed").on("click", ".edit", function(e){
       e.preventDefault();
       $("#feedView").hide();
       $("#editorView").show();

       $("#editorView").html("loading");

       var id = $(e.target).attr("entryId");

       var datatosend = {id: id};
       
       $("#editorView").load("/ajax/loadeditor", datatosend, function(e){
	 var editor = new wysihtml5.Editor("writingbox", {
	   toolbar:      "toolbar",
	   stylesheets:  "/wysihtml5-stylesheet.css",
	   parserRules:  wysihtml5ParserRules
	 });
       });       
     });

     $"#feed").on("click", ".delete", function(e){
       //send it off to postJsonDelete
       //if deleted (response = 1) then remove that entry div
     });

     $("#feed").html("loading");
     date = new Date();
     $("#feed").load("/ajax/getentries?date=" + dpFormat(date));

   });
  </script>
@stop
