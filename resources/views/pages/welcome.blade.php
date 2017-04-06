@extends('layout')
@section('content')
<div class="container">
<div class="row equal">

<div class="pagenav panel">
<div class="nav nav-inverse">
<nav>
  <ul class="list-inline nav-justified">
  <li><a href="#trtodtom">{{ date('j M') }}</a>
  <li><a href="#trwe1">{{ \Carbon\Carbon::parse('next saturday')->format('j M') }}</a>
  @for($i=1;$i<6;$i++)
  <li><a href="#trwe{{ $i+1 }}">{{ \Carbon\Carbon::parse('next saturday')->addWeek($i)->format('j M') }}</a>
  @endfor
  <li><a href="#aboutme">About me</a>
  <li><a href="#skills">Skills</a>
  <li><a href="#recent">Recent work</a>
  </ul>
</nav>
</div>
</div>

<div class="col-md-12 travelodge-affiliate">
  <div class="panel">
    <h3 class="panel-heading text-center main-heading">Book a room for one night with Travelodge</h3>
    <div class="panel-body">
    {!! $travelodge['lead'] !!}


    <div class="col-md-6 page-heading" id="trtodtom">
      <h4>Today's lowest prices - {{ date('l, j F') }} check-in</h4>
      <p>Online booking available until <strong>midnight on {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay())->format('l') }}</strong>, <strong>check-in is after 3pm</strong> and <strong>check-out is at midday on {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay())->format('l') }}</strong>.</p>
      @include('includes.hotel-list', ['hotels'=>$travelodge['today']])
    </div>

    <div class="col-md-6">
      <h4>Tomorrow's lowest prices - {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay())->format('l, j F') }} check-in</h4>
      <p>Online booking available until <strong>midnight on {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay(2))->format('l') }}</strong>, <strong>check-in is after 3pm</strong> and <strong>check-out is at midday on {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay(2))->format('l') }}</strong>.</p>
      @include('includes.hotel-list', ['hotels'=>$travelodge['tomorrow']])
    </div>

    <div class="col-md-12 page-heading" id="trwe1">

      <h4 class="text-center">Lowest prices at the weekend - {{ \Carbon\Carbon::parse('next saturday')->format('l j F') }} and {{ \Carbon\Carbon::parse('next saturday')->addDay()->format('l j F') }}</h4>
      <p class="text-center">Online booking available until <strong>midnight of the following day</strong> and <strong>check-in is after 3pm on the day</strong>.</p>
      
      <div class="col-md-6">
        @include('includes.hotel-list', ['hotels'=>$travelodge['satnext']])
      </div>

      <div class="col-md-6">
        @include('includes.hotel-list', ['hotels'=>$travelodge['sunnext']])
      </div>

    </div>

    @for($i=1;$i<6;$i++)
    <div class="col-md-12 page-heading" id="trwe{{ $i+1 }}">

      <h4 class="text-center">Lowest prices at the weekend - {{ \Carbon\Carbon::parse('next saturday')->addWeek($i)->format('l j F') }} and {{ \Carbon\Carbon::parse('next saturday')->addDay()->addWeek($i)->format('l j F') }}</h4>
      <p class="text-center">Online booking available until <strong>midnight of the following day</strong> and <strong>check-in is after 3pm on the day</strong>.</p>
      
      <div class="col-md-6">
        @include('includes.hotel-list', ['hotels'=>$travelodge["satnext{$i}"]])
      </div>

      <div class="col-md-6">
        @include('includes.hotel-list', ['hotels'=>$travelodge["sunnext{$i}"]])
      </div>

    </div>
    @endfor


    </div>
  </div>
</div>


  <div class="col-md-4 intro page-heading" id="aboutme">
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

  <div class="col-md-8 skills page-heading" id="skills">
    <div class="panel hunp">
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


<div class="col-md-12 recent page-heading" id="recent">
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
<script>
$(window).scroll(function(){
  if( Math.floor($('.main-heading').offset().top) > $(window).scrollTop() )
  {$('.pagenav').removeAttr('style');}
  else {$('.pagenav').css({'position':'fixed','top':0,'left':0});}
  //{$('.pagenav').fadeOut();}else {$('.pagenav').fadeIn();}
  $('.page-heading').each(function(){
    if( Math.floor($(this).offset().top) > $(window).scrollTop() ) {
      $('a[href$='+$(this).attr('id')+']').removeClass('selected').addClass('unselected');
    } else {
      $('a[href]').removeClass('selected').addClass('unselected');
      $('a[href$='+$(this).attr('id')+']').removeClass('unselected').addClass('selected');
    }
  });
});
</script>
@endsection
