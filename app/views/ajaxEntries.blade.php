@if (count( $entries ) == 0)
  <div>
    No entries on this day
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
	<a href="" class="edit" entryId="{{ $entry->id }}" }}>Edit</a>
	<a href="" class="delete" entryId"{{ $entry->id }}" }}>Delete</a>
      @endif
    </p>
    <p>{{ $entry->content }}</p>
  </div>

@endforeach
