@if(!count($hotels))
<p class="alert alert-info text-center">No cheap hotels on {{ $day }}</p>
@else
<ul class="list-group">
  @foreach($hotels as $hoteldate)
  <li class="list-group-item">{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }} <span class="badge">{{ $hoteldate->price }}</span></li>
  @endforeach
</ul>
@endif