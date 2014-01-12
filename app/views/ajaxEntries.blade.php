{{ $date }}

@if (count( $entries ) == 0)
  <div style="text-align: center;">
    <h3>No entries for this day, you should add something you did</h3>
  </div>
@endif

@foreach ($entries as $entry)

  <?php

  $email = $entry->user->email;
  $default = "http://www.somewhere.com/homestar.jpg";
  $size = 40;

  $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

  ?>

  <div id="{{ $entry->id }}" class="entryDiv">
    <p>
      <img src="{{ $grav_url }}" height=40 width=40 />
      {{ $entry->user->firstname }} {{ $entry->user->lastname }}
      @if( $entry->user_id == Auth::user()->id )
	<a href="" class="edit" entryId="{{ $entry->id }}" }}><span class="glyphicon glyphicon-pencil"></span> Edit</a>
	<a href="" class="delete" entryId="{{ $entry->id }}" }}><span class="glyphicon glyphicon-trash"></span> Delete</a>
      @endif
    </p>
    <p>{{ $entry->content }}</p>
  </div>

@endforeach
