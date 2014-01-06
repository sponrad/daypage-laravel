<div id="hDatepicker"></div>

<div id="viewContainer">

  <div id="feedView">
    <button id="composeButton">Compose</button>
    <button id="filterButton">Filter</button>
    <div id="feed"></div>
  </div>

  <div id="composeView">
    <button id="cancelComposeButton">Cancel</button>
    <button id="saveButton">Save</button>

    <div id="toolbarWrapper">
      <div id="toolbar" style="display: none;">
	
	<a data-wysihtml5-command="bold" title="CTRL+B">bold</a> |
	<a data-wysihtml5-command="italic" title="CTRL+I">italic</a> |
	<a data-wysihtml5-command="createLink">insert link</a> |
	<a data-wysihtml5-command="insertImage">insert image</a> |
	<a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1">h1</a> |
	<a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2">h2</a> |
	<a data-wysihtml5-command="insertUnorderedList">insertUnorderedList</a> |
	<a data-wysihtml5-command="insertOrderedList">insertOrderedList</a> |
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red">red</a> |
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green">green</a> |
	<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue">blue</a> |
	<a data-wysihtml5-command="insertSpeech">speech</a>
	<a data-wysihtml5-action="change_view">switch to html view</a>
	
	<div data-wysihtml5-dialog="createLink" style="display: none;">
	  <label>
	    Link:
	    <input data-wysihtml5-dialog-field="href" value="http://">
	  </label>
	  <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
	</div>
	
	<div data-wysihtml5-dialog="insertImage" style="display: none;">
	  <label>
	    Image:
	    <input data-wysihtml5-dialog-field="src" value="http://">
	  </label>
	  <label>
	    Align:
	    <select data-wysihtml5-dialog-field="className">
              <option value="">default</option>
              <option value="wysiwyg-float-left">left</option>
              <option value="wysiwyg-float-right">right</option>
	    </select>
	  </label>
	  <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
	</div>
	
      </div> <!-- toolbar -->
    </div> <!-- toolbarWrapper -->
    <div id="writingboxWrapper">
      <textarea id="writingbox" name="writingbox" class="writingbox" placeholder="Start writing" spellcheck="false"></textarea>
    </div>
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
     $("#composeView").hide();

     hDatepicker( $("#hDatepicker"), {
       onDateSelect: function(date){
	 $("#feed").html("loading");
	 fDate = dpFormat(date);
	 $("#feed").load("/ajax/getentries?date=" + fDate);
       }
     }
     );
     
     $.getJSON( "/json/getentries", function( data ) {
       var items = [];
       $.each( data, function( key, val){
	 items.push( "<li id='" + key + "'>" + val + "</li>" );
       });
     });

     $("#viewContainer").on("click", "#composeButton",function(){
       $("#feedView").hide();
       $("#composeView").show();

       $("#hDatepicker").bind("click", function(e){
	 e.preventDefault();
       });

       var editor = new wysihtml5.Editor("writingbox", {
	 toolbar:      "toolbar",
	 stylesheets:  "wysihtml5-stylesheet.css",
	 parserRules:  wysihtml5ParserRules
       });

       $("#writingbox").focus();

     });

     $("#viewContainer").on("click", "#filterButton, #cancelComposeButton",function(){
       $("#feedView").show();
       $("#composeView").hide();

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
     $("#feed").load("/ajax/getentries?date=20140106");

   });
  </script>
@stop
