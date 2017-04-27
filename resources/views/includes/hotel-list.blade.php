<h5 class="text-center">{{ \Carbon\Carbon::parse($day)->format('l, j F') }} check-in</h5>

<p class="text-center">Online booking available until <strong>midnight on {{ \Carbon\Carbon::parse($day)->addDay()->format('l') }}</strong>, <strong>check-in is after 3pm</strong> and <strong>check-out is at midday on {{ \Carbon\Carbon::parse($day)->addDay()->format('l') }}</strong>.</p>

@if(!count($hotels))
<p class="alert alert-info text-center">No cheap hotels on {{ \Carbon\Carbon::parse($day)->format('l') }}</p>
@else
<ul class="list-group">
  @foreach($hotels as $hoteldate)
  @if(!empty($hoteldate->notes))
  <li class="list-group-item">{{ 
    $hoteldate->name
  }} <span title2="{{ $hoteldate->hotel_id }}">i</span> 
  {{ FixData($hoteldate->updated_at->diffForHumans(\Carbon\Carbon::now())) }} 
  <span class="badge">&pound;{!! $hoteldate->price 
    . ' '
  . (
    (($hoteldate->price-$hoteldate->previous_price)>0) 
    ? (
        (
        ( ($hoteldate->price-$hoteldate->previous_price)!= $hoteldate->price)
        ? '<span class="error">+'.($hoteldate->price-$hoteldate->previous_price).'</span>'
        : ''
        )
      )
    : '<span class="success">'.($hoteldate->price-$hoteldate->previous_price).'</span>'
    )
  !!}
  </span>
  </li>
  @else
  <li class="list-group-item">{!! 
  $hoteldate->name . ' '  . FixData($hoteldate->updated_at->diffForHumans(\Carbon\Carbon::now()))
  !!} 
  <span class="badge">&pound;{!! $hoteldate->price
  . ' '
  . (
    (($hoteldate->price-$hoteldate->previous_price)>0) 
    ? (
        (
        ( ($hoteldate->price-$hoteldate->previous_price)!= $hoteldate->price)
        ? '<span class="error">+'.($hoteldate->price-$hoteldate->previous_price).'</span>'
        : ''
        )
      )
    : '<span class="success">'.($hoteldate->price-$hoteldate->previous_price).'</span>'
    )
  !!}
  </span>
  </li>
  @endif
  @endforeach
</ul>
@endif