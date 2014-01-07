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

  <div id="{{ $entry->id }}">
    <p>
      <img src="{{ $grav_url }}" />
      @if( $entry->user_id == Auth::user()->id )
	<a href="" class="owner" id="{{ $entry->id }}" }}>{{ $entry->user->firstname }} {{ $entry->user->lastname }}</a>
      @else
	{{ $entry->user->firstname }} {{ $entry->user->lastname }}
      @endif
    </p>
    <p>{{ $entry->content }}</p>
  </div>

@endforeach
