@extends('layout')
@section('content')
<div class="container">
<div class="row equal">

<div class="col-md-12 travelodge-affiliate">
  <div class="panel">
    <h3 class="panel-heading text-center">Book a room with travelodge</h2>
    <div class="panel-body">
{!! $pagecontent['travelodge'] !!}

    <h4>Today's lowest prices - Monday, 27 March 2017</h4>
    <p><small>Online booking available until midnight and check-in is after 3pm on Tuesday.</small></p>
    <ul>
    <li>Both Kingston hotels, Surrey £49</li>
    <li>Teddington, Surrey £49</li>    
    <li>Twickenham, Surrey £49 (located next to Twickenham station)</li>
    <li>London Hounslow, £49</li>
    <li>London Crystal Palace, £49</li>
    <li>Whetstone, £52</li>
    <li>Cheshunt, £60</li>
    </ul>
    <p></p>

    <h4>Tomorrow's lowest prices - Tuesday, 27 March 2017</h4>
    <p><small>Online booking available until midnight on the day and check-in is after 3pm on the day.</small></p>
    <p></p>

    <h4>Lowest prices at the weekend - Saturday, 1 April 2017 and Sunday 2 April 2017</h4>
    <p><small>Online booking available until midnight on the day and check-in is after 3pm on the day.</small></p>
    <p></p>
    

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