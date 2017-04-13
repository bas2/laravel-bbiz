@extends('layout')
@section('content')

<nav class="pagenav">
  <div class="container-fluid">
    <div class="panel">
      <ul class="list-inline nav-justified">
        <li><a href="#trtodtom">{{ date('j M') }}</a>
        <li><a href="#trwe1">{{ \Carbon\Carbon::parse('next friday')->format('j M') }}</a>
        @for($i=1;$i<6;$i++)
        <li class="showmore2"><a href="#trwe{{ $i+1 }}">{{ \Carbon\Carbon::parse('next friday')->addWeek($i)->format('j M') }}</a>
        @endfor
        <li><a href="#aboutme">About me</a>
        <li><a href="#skills">Skills</a>
        <li><a href="#recent">Recent work</a>
      </ul>
    </div>
  </div>
</nav>


<div class="container-fluid">
<div class="row">

  <div class="col-md-12 travelodge-affiliate">
    <div class="panel">
      <h3 class="panel-heading text-center main-heading">Book a room for one night with Travelodge</h3>
      <div class="panel-body">
        {!! $travelodge['lead'] !!}

        <div class="row">
          <div class="col-md-6 page-heading" id="trtodtom">
            <h4 class="text-center">Today's prices - {{ date('l, j F') }} check-in</h4>
            <p class="text-center">Online booking available until <strong>midnight on {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay())->format('l') }}</strong>, <strong>check-in is after 3pm</strong> and <strong>check-out is at midday on {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay())->format('l') }}</strong>.</p>
            @include('includes.hotel-list', ['hotels'=>$travelodge['today'],'day'=>date('l')])
          </div>

          <div class="col-md-6">
            <h4 class="text-center">Tomorrow's prices - {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay())->format('l, j F') }} check-in</h4>
            <p class="text-center">Online booking available until <strong>midnight on {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay(2))->format('l') }}</strong>, <strong>check-in is after 3pm</strong> and <strong>check-out is at midday on {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay(2))->format('l') }}</strong>.</p>
            @include('includes.hotel-list', ['hotels'=>$travelodge['tomorrow'],'day'=>\Carbon\Carbon::parse(\Carbon\Carbon::now()->addDay())->format('l')])
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 page-heading" id="trwe1">

            <h4 class="text-center">
            Prices at the weekend - {{ \Carbon\Carbon::parse('next friday')->format('l j F') }}, {{ \Carbon\Carbon::parse('next friday')->addDay()->format('l j F') }} and {{ \Carbon\Carbon::parse('next friday')->addDay(2)->format('l j F') }}
            </h4>
            <p class="text-center">Online booking available until <strong>midnight of the following day</strong> and <strong>check-in is after 3pm on the day</strong>.</p>
            
            <div class="col-md-4">
              @include('includes.hotel-list', ['hotels'=>$travelodge['frinext'],'day'=>\Carbon\Carbon::parse('next friday')->format('l')])
            </div>

            <div class="col-md-4">
              @include('includes.hotel-list', ['hotels'=>$travelodge['satnext'],'day'=>\Carbon\Carbon::parse('next friday')->addDay()->format('l')])
            </div>

            <div class="col-md-4">
              @include('includes.hotel-list', ['hotels'=>$travelodge['sunnext'],'day'=>\Carbon\Carbon::parse('next friday')->addDay(2)->format('l')])
            </div>

          </div>
        </div>

        <div class="showmore ">

          @for($i=1;$i<6;$i++)
          <div class="row">
            <div class="col-md-12 page-heading" id="trwe{{ $i+1 }}">

              <h4 class="text-center">Prices at the weekend - {{ \Carbon\Carbon::parse('next friday')->addWeek($i)->format('l j F') }}, {{ \Carbon\Carbon::parse('next friday')->addDay()->addWeek($i)->format('l j F') }} and {{ \Carbon\Carbon::parse('next friday')->addDay(2)->addWeek($i)->format('l j F') }}</h4>
              <p class="text-center">Online booking available until <strong>midnight of the following day</strong> and <strong>check-in is after 3pm on the day</strong>.</p>
              
              <div class="col-md-4">
                @include('includes.hotel-list', ['hotels'=>$travelodge["frinext{$i}"],'day'=>\Carbon\Carbon::parse('next friday')->addWeek($i)->format('l j F')])
              </div>

              <div class="col-md-4">
                @include('includes.hotel-list', ['hotels'=>$travelodge["satnext{$i}"],'day'=>\Carbon\Carbon::parse('next friday')->addDay()->addWeek($i)->format('l j F')])
              </div>

              <div class="col-md-4">
                @include('includes.hotel-list', ['hotels'=>$travelodge["sunnext{$i}"],'day'=>\Carbon\Carbon::parse('next friday')->addDay(2)->addWeek($i)->format('l j F')])
              </div>

            </div>
          </div>
          @endfor

        </div>

      </div>
    </div>
  </div>

</div>
</div>


<div class="container-fluid">
<div class="row equal">

  <div class="col-md-4 col-sm-12 intro page-heading" id="aboutme">
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

  <div class="col-md-8 col-sm-12 skills page-heading" id="skills">
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


<div class="container-fluid">
<div class="row">

  <div class="col-md-12 recent page-heading" id="recent">
    <div class="panel">
      <h2 class="panel-heading">Recent work</h2>
      <div class="panel-body">
      <p class="lead text-center">{!! $pagecontent['recent'] !!}</p>
      <ul class="list-inline">
      @foreach($images as $image)<li>{{ link_to("img/uploaded/{$image->filename}",Html::image("img/uploaded/{$image->filename}",'',['width'=>200,'class'=>'thumbnail']), ['class'=>'overlay'], null, false) }}</li>@endforeach
      </ul>
      </div>
    </div>
  </div>

</div>
</div>
<script>
$('<a href="#" class="scrollup"></a>').prependTo('body').hide().click(function(e){
  $("html, body").animate({ scrollTop: 0 }, 500);
  e.preventDefault();
});

$(window).scroll(function(){
  if($(this).scrollTop()>100){$('a.scrollup').fadeIn();}else{$('a.scrollup').fadeOut();}
});

$('<div class="row text-center"><button class="btn btn-primary">Show more &rarr;</button></div>')
.insertAfter($('.showmore')).click(function(e){
  $('.showmore').toggle(); // Headings.
  $('.showmore2').toggle();; // Menu items.
  if ($('.showmore').is(':visible')) {
    $(this).find('button').html('Show less &larr;');
    $('html, body').animate({scrollTop: $('#trwe2').offset().top-42}, 1000);
  } else {
    $(this).find('button').html('Show more &rarr;');
    $('html, body').animate({scrollTop: $('#trwe1').offset().top-42}, 1000);
  }
  e.preventDefault();
});
$('.showmore').hide();
$('.showmore2').hide();

$('nav.pagenav a').click(function(e){
  var offset=($('.pagenav').css('position')=='fixed') ? 42 : 64;
  $('html, body').animate({scrollTop: $(''+$(this).attr('href')).offset().top-offset}, 500);
  e.preventDefault();
});

$(window).scroll(function(){
  if( Math.floor($('.main-heading').offset().top) > $(window).scrollTop() )
  {$('.pagenav').css('position','static');}
  else {$('.pagenav').css({'position':'fixed','top':0,'left':0});}

  $('.page-heading').each(function(){
    if($(this).is(':visible')) { // Avoid interating through hidden weekend headings.
      if( Math.floor($(this).offset().top)-42 > $(window).scrollTop() ) {
        $('.pagenav a[href$='+$(this).attr('id')+']').removeClass('selected').addClass('unselected');
      } else {
        //console.log($(this).attr('id'));
        $('.pagenav a[href]').removeAttr('class').addClass('unselected');
        $('.pagenav a[href$='+$(this).attr('id')+']').removeClass('unselected').addClass('selected');
      }
    }
  });
});
</script>
@endsection
