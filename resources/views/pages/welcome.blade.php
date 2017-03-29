@extends('layout')
@section('content')
<div class="container">
<div class="row equal">

<div class="col-md-12 travelodge-affiliate">
  <div class="panel">
    <h3 class="panel-heading text-center">Book a room for one night with Travelodge</h3>
    <div class="panel-body">
    {!! $travelodge['lead'] !!}

    <div class="col-md-6">
    <h4>Today's lowest prices - {{ date('l, j F') }} check-in</h4>
    <p>Online booking available until <strong>midnight</strong>, <strong>check-in is after 3pm</strong> and <strong>check-out is at midday on {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay())->format('l') }}</strong>.</p>
    <ul>
      @foreach($travelodge['today'] as $hoteldate)
      <li>{{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
      @endforeach
    </ul>
    </div>

    <div class="col-md-6">
    <h4>Tomorrow's lowest prices - {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay())->format('l, j F') }} check-in</h4>
    <p>Online booking available until <strong>midnight on {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay(2))->format('l') }}</strong>, <strong>check-in is after 3pm</strong> and <strong>check-out is at midday on {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay(2))->format('l') }}</strong>.</p>
    <ul>
      @foreach($travelodge['tomorrow'] as $hoteldate)
      <li>{{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
      @endforeach
    </ul>
    </div>

    <div class="col-md-12">

      <h4 class="text-center">Lowest prices at the weekend - {{ \Carbon\Carbon::parse('next saturday')->format('l j F') }} and {{ \Carbon\Carbon::parse('next sunday')->format('l j F') }}</h4>
      <p class="text-center">Online booking available until <strong>midnight of the following day</strong> and <strong>check-in is after 3pm on the day</strong>.</p>
      
      <div class="col-md-6">
      <ul>
        @foreach($travelodge['sat'] as $hoteldate)
        <li>{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
        @endforeach
      </ul>
      </div>

      <div class="col-md-6">
      <ul>
        @foreach($travelodge['sun'] as $hoteldate)
        <li>{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
        @endforeach
      </ul>
      </div>

    </div>

    <div class="col-md-12">

      <h4 class="text-center">Lowest prices at the weekend - {{ \Carbon\Carbon::parse('next saturday')->addWeek()->format('l j F') }} and {{ \Carbon\Carbon::parse('next sunday')->addWeek()->format('l j F') }}</h4>
      <p class="text-center">Online booking available until <strong>midnight of the following day</strong> and <strong>check-in is after 3pm on the day</strong>.</p>
      
      <div class="col-md-6">
      <ul>
        @foreach($travelodge['sat1'] as $hoteldate)
        <li>{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
        @endforeach
      </ul>
      </div>

      <div class="col-md-6">
      <ul>
        @foreach($travelodge['sun1'] as $hoteldate)
        <li>{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
        @endforeach
      </ul>
      </div>

    </div>



    <div class="col-md-12">

      <h4 class="text-center">Lowest prices at the weekend - {{ \Carbon\Carbon::parse('next saturday')->addWeek(2)->format('l j F') }} and {{ \Carbon\Carbon::parse('next sunday')->addWeek(2)->format('l j F') }}</h4>
      <p class="text-center">Online booking available until <strong>midnight of the following day</strong> and <strong>check-in is after 3pm on the day</strong>.</p>
      
      <div class="col-md-6">
      <ul>
        @foreach($travelodge['sat2'] as $hoteldate)
        <li>{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
        @endforeach
      </ul>
      </div>

      <div class="col-md-6">
      <ul>
        @foreach($travelodge['sun2'] as $hoteldate)
        <li>{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
        @endforeach
      </ul>
      </div>

    </div>


    <div class="col-md-12">

      <h4 class="text-center">Lowest prices at the weekend - {{ \Carbon\Carbon::parse('next saturday')->addWeek(3)->format('l j F') }} and {{ \Carbon\Carbon::parse('next sunday')->addWeek(3)->format('l j F') }}</h4>
      <p class="text-center">Online booking available until <strong>midnight of the following day</strong> and <strong>check-in is after 3pm on the day</strong>.</p>
      
      <div class="col-md-6">
      <ul>
        @foreach($travelodge['sat3'] as $hoteldate)
        <li>{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
        @endforeach
      </ul>
      </div>

      <div class="col-md-6">
      <ul>
        @foreach($travelodge['sun3'] as $hoteldate)
        <li>{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
        @endforeach
      </ul>
      </div>

    </div>


    <div class="col-md-12">

      <h4 class="text-center">Lowest prices at the weekend - {{ \Carbon\Carbon::parse('next saturday')->addWeek(4)->format('l j F') }} and {{ \Carbon\Carbon::parse('next sunday')->addWeek(4)->format('l j F') }}</h4>
      <p class="text-center">Online booking available until <strong>midnight of the following day</strong> and <strong>check-in is after 3pm on the day</strong>.</p>
      
      <div class="col-md-6">
      <ul>
        @foreach($travelodge['sat4'] as $hoteldate)
        <li>{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
        @endforeach
      </ul>
      </div>

      <div class="col-md-6">
      <ul>
        @foreach($travelodge['sun4'] as $hoteldate)
        <li>{{ \Carbon\Carbon::parse($hoteldate->date)->format('l') }} {{ $hoteldate->hotels[0]->name }}, <strong>{{ $hoteldate->price }}</strong></li>
        @endforeach
      </ul>
      </div>

    </div>









    </div>
  </div>
</div>

  <div class="col-md-4 intro">
    <div class="panel hunp">
      <h2 class="panel-heading">About me</h2>
      <div class="panel-body text-center">
        {!! $pagecontent['aboutme'] !!}
        @if(!empty($pagecontent['email']))
        <div class="contactform">@include('contactform')</div>
        @endif
      </div>
    </div>
  </div>

  <div class="col-md-8 skills">
    <div class="panel">
      <h2 class="panel-heading">Skills summary</h2>
      <div class="panel-body">
        <ul>
        @foreach($pagecontent['skills'] as $skill)
        @if(!empty($skill->skill))
        <li><i>{!! $skill->skill !!}</i> &rarr; {!! $skill->content !!}</li>
        @endif
        @endforeach
        </ul>
      </div>
    </div>
  </div>

</div>
</div>


<div class="container">
<div class="row">


<div class="col-md-12 recent">
  <div class="panel hunp">
    <h2 class="panel-heading">Recent work</h2>
    <div class="panel-body">
    <p>{!! $pagecontent['recent'] !!}</p>
    <ul class="list-inline">
    @foreach($images as $image)<li>{{ link_to("img/uploaded/{$image->filename}",Html::image("img/uploaded/{$image->filename}",'',['width'=>200]), ['class'=>'overlay'], null, false) }}</li>@endforeach
    </ul>
    </div>
  </div>
</div>


</div>
</div>

@endsection