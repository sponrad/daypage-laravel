<!-- {{ $date }} -->

@if (count( $entries ) == 0)
  <div style="text-align: center;">
    <br><br><br><br><br>
    <h3>Nothing here, click <button type="button" class="btn btn-primary" id="composeButton"><span class="glyphicon glyphicon-plus"></span><u>N</u>ew Entry</button> to add something</h3>
  </div>
@endif

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

   $("#feed").on("click", ".entry-save-button", function(e){
     e.stopPropagation();
     entry = $(this).prev().prev();

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
    
   });

 });
</script>

