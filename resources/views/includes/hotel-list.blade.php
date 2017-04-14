<h5 class="text-center">{{ \Carbon\Carbon::parse($day)->format('l, j F') }} check-in</h5>

<p class="text-center">Online booking available until <strong>midnight on {{ \Carbon\Carbon::parse($day)->addDay()->format('l') }}</strong>, <strong>check-in is after 3pm</strong> and <strong>check-out is at midday on {{ \Carbon\Carbon::parse($day)->addDay()->format('l') }}</strong>.</p>

@if(!count($hotels))
<p class="alert alert-info text-center">No cheap hotels on {{ \Carbon\Carbon::parse($day)->format('l') }}</p>
@else
<ul class="list-group">
  @foreach($hotels as $hoteldate)
  <li class="list-group-item">{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }} <span class="badge">{{ $hoteldate->price }}</span></li>
  @endforeach
</ul>
@endif