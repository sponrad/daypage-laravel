<br>
@foreach ($entries as $key => $entry)

  <?php

  $email = $entry->user->email;
  $default = "http://www.somewhere.com/homestar.jpg";
  $size = 40;

  $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

  ?>

  <div id="{{ $entry->id }}" class="entryDiv">
    <div>
      @if( $entry->user_id == Auth::user()->id )
        <a href="" class="edit" entryId="{{ $entry->id }}" }}><span class="glyphicon glyphicon-pencil" entryId="{{ $entry->id }}" }}></span></a>
	<a href="" class="delete" entryId="{{ $entry->id }}" }}><span class="glyphicon glyphicon-trash"></span></a>
      @endif
    </div>

    <div class="entry-content" contenteditable=true id="{{ $entry->id }}" spellcheck=false>{{ $entry->content }}</div>
  </div>
@endforeach

<div class="entryDiv">
  <div class="entry-content" contenteditable=true id="new-entry" spellcheck=false data-ph="+"></div>
  <style>
   [contentEditable=true]:empty:not(:focus):before{
     content:attr(data-ph)
   }
  </style>
</div>


  </div>

@foreach ($groupEntries as $entry)
  {{ $entry->user->firstname }} {{ $entry->user->lastname }} -  {{ $entry->group->name }} <br>
  {{ $entry->content }}
@endforeach


<script>
 $(document).ready( function(){

   key('ctrl+s', function(e){
     e.preventDefault();
     var focused = $(':focus');
     if (focused.hasClass("entry-content")){
       console.log("save fired");
       console.log(focused);
       entry = focused;

       if (entry.attr("id") != "new-entry"){
	 var id = entry.attr("id");
	 var content = $(entry).html();
	 var date = dpFormat(selectedDate);
	 var datatosend = {id: id, content: content, date: date};

	 $.post("/json/saveentry", datatosend, 
		function(data){
             if (data.response == "1"){
	       entry.next().remove();
	       entry.next().remove();
	       entry.removeClass("editing");
             }
             else{
               console.log("unsuccessful save");
               $.notify("Error");
             }
	   }, 'json' );

       }
       else{

	 var content = $(entry).html();
	 var date = dpFormat(selectedDate);
	 var datatosend = {id: id, content: content, date: date};

	 $.post("/json/saveentry", datatosend, 
		function(data){
             if (data.response == "1"){
	       entry.next().remove();
	       entry.next().remove();
	       entry.removeClass("editing");
	       entry.attr("id", data.entryId);
             }
             else{
               console.log("unsuccessful save");
               $.notify("Error");
             }
	   }, 'json' );
       }
       
       focused.blur();
     }
   });

   $("#feed").on("click", ".entry-content", function(e){
     if ( $(e.target).attr('id') != undefined ){
       entry = $(e.target);
     }
     else{
       entry = $(e.target).parents("div.entry-content");
     }

     if ( !entry.hasClass("editing") ){
       entry.after("<button class='entry-cancel-button'>Cancel</button><button class='entry-save-button'>Save</button>");
       entry.data("original-content", entry.html());
       entry.addClass("editing");
     }
     else {
       //continuing to edit
     }
   });

   $("#feed").on("click", ".entry-cancel-button", function(e){
     entry = $(this).prev();
     entry.removeClass("editing");
     entry.html( entry.data("original-content"));
     entry.next().remove();
     entry.next().remove();
   });

   $("#feed").off(".entry-save-button").on("click", ".entry-save-button", function(e){
     e.stopImmediatePropagation();
     entry = $(this).prev().prev();

     var datatosend = [];

     if (entry.attr("id") != "new-entry"){
       var id = entry.attr("id");
       var content = $(entry).html();
       var date = dpFormat(selectedDate);
       var datatosend = {id: id, content: content, date: date};

       $.post("/json/saveentry", datatosend, 
              function(data){
           if (data.response == "1"){
	     entry.next().remove();
	     entry.next().remove();
	     entry.removeClass("editing");
           }
           else{
             console.log("unsuccessful save");
             $.notify("Error");
           }
	 }, 'json' );

     }
     else{

       var content = $(entry).html();
       var date = dpFormat(selectedDate);
       var datatosend = {id: id, content: content, date: date};

       $.post("/json/saveentry", datatosend, 
              function(data){
           if (data.response == "1"){
	     entry.next().remove();
	     entry.next().remove();
	     entry.removeClass("editing");
	     entry.attr("id", data.entryId);
           }
           else{
             console.log("unsuccessful save");
             $.notify("Error");
           }
	 }, 'json' );
     }

    
   });

 });
</script>

