@if(!count($hotels))
<p class="alert alert-info text-center">No data found</p>
@else
<ul>
  @foreach($hotels as $hoteldate)
  <li>{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
  @endforeach
</ul>
@endif