@extends('main')

@section('content')
  <div id="hDatepicker"></div>
  <div id="viewContainer">
    <div id="feedView">
      <button type="button" class="btn btn-primary" id="composeButton"><span class="glyphicon glyphicon-plus"></span><u>N</u>ew Entry</button>
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
  <script src="/keymaster.js"></script>
  <script>

   dpFormat = function(date){
     fDate = "" + date.getFullYear() + ("0" + (date.getMonth() + 1)).slice(-2) + ("0" + date.getDate()).slice(-2);
     return fDate;
   }

   editorKeys = function(editor){
     var $doc = $(editor.composer.doc);

     var out  = (function(){
       return function(msg){ console.log(msg)} ;
     })();
     
     if (writingMode == true){

       $doc.keydown(function(evt){
//	 out("Down "+ evt.which);
//	 if (evt.which == 75 && evt.ctrlKey == true){
	 if (evt.which == 27){
	   evt.preventDefault();
	   $("#cancelComposeButton").click();
/*
	   $("#feedView").show();
	   $("#editorView").hide();
	   writingMode = false;
	   $("#wrap").focus(); */
	 }
	 if (evt.which == 83 && evt.ctrlKey == true){
	   evt.preventDefault();
	   console.log("save");
	   $("#saveButton").click();
	 }
       });
     }
   }

   $(document).ready( function(){
     selectedDate = new Date();
     writingMode = false;
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
	 $("#wrap").focus();
       }
     });
     
     $("#viewContainer").on("click", "#composeButton",function(){
       $("#feedView").hide();
       $("#editorView").html("").show();
       writingMode = true;

       $("#editorView").append(loading);
       
       $("#editorView").load("/ajax/loadeditor", function(){
	 var editor = new wysihtml5.Editor("writingbox", {
	   toolbar:      "toolbar",
           stylesheets:  "/wysihtml5-stylesheet.css",
           parserRules:  wysihtml5ParserRules
         });

	 $("#writingbox").focus(); 

	 editor.on("load", function() {
	   editorKeys(editor);
	 });

       });

     });

     $("#viewContainer").on("click", "#filterButton, #cancelComposeButton",function(e){
       $("#feedView").show();
       $("#editorView").hide();
       writingMode = false;
       //TODO redraw entries?
       $("#editorView").html("");
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
       writingMode = true;

       $("#editorView").html("").append(loading);

       var id = $(e.target).attr("entryId");

       var datatosend = {id: id};
       
       $("#editorView").load("/ajax/loadeditor", datatosend, function(e){
         var editor = new wysihtml5.Editor("writingbox", {
           toolbar:      "toolbar",
           stylesheets:  "/wysihtml5-stylesheet.css",
           parserRules:  wysihtml5ParserRules
         });

	 $("#writingbox").focus();	 

	 editor.on("load", function() {
	   editorKeys(editor);
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

     key('n', function(e){
       e.preventDefault();
       $("#composeButton").click();	     
     });
     key('1', function(e){
       e.preventDefault();
       $("a.edit#1").click();
     });
     key('2', function(e){
       e.preventDefault();
       $("a.edit#2").click();
     });
     key('3', function(e){
       e.preventDefault();
       $("a.edit#3").click();
     });
     key('4', function(e){
       e.preventDefault();
       $("a.edit#4").click();
     });
     key('5', function(e){
       e.preventDefault();
       $("a.edit#5").click();
     });
     key('6', function(e){
       e.preventDefault();
       $("a.edit#6").click();
     });
     key('shift+right', function(e){
       e.preventDefault();
       console.log("next day");
       selected_div = $("#hDatepicker > button.dateButton.weekday.today.selected");
       if (selected_div.is(':last-child')){
	 //go to next month first day
	 $("#monthRow > button:nth-child(3)").click();
	 $("#hDatepicker > button:first-child").click();	 
       }
       else {
	 selected_div.next().click();
       }
     });
     key('shift+left', function(e){
       e.preventDefault();
       console.log("previous day");
       selected_div = $("#hDatepicker > button.dateButton.weekday.today.selected");
       if (selected_div.is(':first-child')){
	 //go to previous month last day
	 $("#monthRow > button:nth-child(2)").click();
	 $("#hDatepicker > button:last_child").click();
       }
       else {
	 selected_day.next().click();
       }
     });

   });
  </script>
@stop
