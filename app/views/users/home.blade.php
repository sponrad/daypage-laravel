@extends('main')

@section('content')
  <div id="hDatepicker"></div>
  <div id="viewContainer">
    <div id="feedView">
      <button type="button" class="btn btn-primary" id="composeButton"><span class="glyphicon glyphicon-plus"></span>New Entry</button>
      <!-- <button id="filterButton">Filter</button> -->
      <div id="feed"></div>
    </div>

    <div id="editorView">
    </div>

    <div class="homeLoading">
    </div>
    
  </div>
@stop

@section('underheader')
  <link media="all" type="text/css" rel="stylesheet" href="/wysihtml5-stylesheet.css">
@stop


@section('underbody')
  <script src="/hDatepicker.js"></script>
  <script src="/wysihtml5-0.0advanced.js"></script>
  <script src="/wysihtml5-0.3.0.js"></script>
  <script src="/notify.min.js"></script>
  <script>

   dpFormat = function(date){
     fDate = "" + date.getFullYear() + ("0" + (date.getMonth() + 1)).slice(-2) + ("0" + date.getDate()).slice(-2);
     return fDate;
   }

   $(document).ready( function(){
     selectedDate = new Date();
     loading = $(".homeLoading")

     $("#editorView").hide();

     hDatepicker( $("#hDatepicker"), {
       onDateSelect: function(date){
         $("#feed").html("").append(loading);
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
       $("#editorView").html("").show();

       $("#editorView").append(loading);
       
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
             //load the entryid into the writing box
             $("#writingbox").attr("entryId", data.entryId);

             $.notify("Saved", "success");
           }
           else{
             console.log("unsuccessful save");
             $.notify("Error");
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

       $("#editorView").html("").append(loading);

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

     $("#feed").on("click", ".delete", function(e){
       e.preventDefault();
       if (confirm("Delete? Are you sure?")){
         var id = $(e.target).attr("entryId");
         var datatosend = {id: id};
         $.post("/json/deleteentry", datatosend, 
		function(data){
             if (data.response == "1"){
               console.log("successful delete");
               $(e.target).parents(".entryDiv").fadeOut(300, function(){
                 $(this).remove();
               });
             }
             else{
               console.log("unsuccessful delete");
             }
           }, 'json' );	 
       }
     });

     $("#feed").html("").append(loading);
     date = new Date();
     $("#feed").load("/ajax/getentries?date=" + dpFormat(date));

   });
  </script>
@stop
