@foreach ($entries as $entry)

  <?php

  $email = $entry->user->email;
  $default = "http://www.somewhere.com/homestar.jpg";
  $size = 40;

  $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

  ?>

  <div>
    <p><img src="{{ $grav_url }}" /> {{ $entry->user->firstname }} {{ $entry->user->lastname }}</p>
    <p>{{ $entry->content }}</p>
  </div>

@endforeach
