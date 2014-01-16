<!-- {{ $date }} -->

@if (count( $entries ) == 0)
  <div style="text-align: center;">
    <br><br><br><br><br>
    <h3>Nothing here, click <button type="button" class="btn btn-primary" id="composeButton"><span class="glyphicon glyphicon-plus"></span>New Entry</button> to add something</h3>
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
	<a href="" class="edit" entryId="{{ $entry->id }}" }}><span class="glyphicon glyphicon-pencil"></span>Edit</a>
	<a href="" class="delete" entryId="{{ $entry->id }}" }}><span class="glyphicon glyphicon-trash"></span>Delete</a>
      @endif
    </p>
    <p>{{ $entry->content }}</p>
  </div>

@endforeach

@foreach ($groupEntries as $entry)
  {{ $entry->user->firstname }} {{ $entry->user->lastname }} -  {{ $entry->group->name }} <br>
  {{ $entry->content }}
@endforeach
