@extends('layout')
@section('content')
{!! Form::open(['route'=>'updatecontent','method'=>'POST','files'=>'true']) !!}

<div>

<ul class="list-inline">
  <li><a href="#travelodge">Travelodge</a>
  <li><a href="#intro">About me</a>
  <li><a href="#skills">Skills history</a>
  <li><a href="#recent">Recent work</a>
</ul>

@if($flash=session('message'))
<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session('message') }}</div>
@endif
<div class="container-fluid">
<div class="row">
<div>
{!! Form::submit('Update >',['class'=>'btn btn-lg btn-primary btn-block']) !!}
</div>
</div>
</div>

{{-- 
https://www.travelodge.co.uk/search/results?location=walthamstow&checkIn=28/03/17&checkOut=29/03/17&rooms%5B0%5D%5Badults%5D=1&rooms%5B0%5D%5Bchildren%5D=0 
https://www.travelodge.co.uk/search/results?location=tolworth&checkIn=28/03/17&checkOut=29/03/17&rooms%5B0%5D%5Badults%5D=1&rooms%5B0%5D%5Bchildren%5D=0 
https://www.travelodge.co.uk/search/results?location=walthamstow&checkIn=29/03/17&checkOut=30/03/17&rooms%5B0%5D%5Badults%5D=1&rooms%5B0%5D%5Bchildren%5D=0 
https://www.travelodge.co.uk/search/results?location=walthamstow&checkIn=01/04/17&checkOut=02/04/17&rooms%5B0%5D%5Badults%5D=1&rooms%5B0%5D%5Bchildren%5D=0 
--}}

<div class="container-fluid">
<div class="row">

  <div id="travelodge" class="col-md-12 travelodge-affiliate">
    <div class="panel">
      <h2 class="panel-heading">Book a room with travelodge</h2>
      <div class="container">

      <div class="row">
      {!! Form::textarea('travelodge',$travelodge['lead'],['class'=>'form-control','required']) !!}
      </div>

      <div class="row">
        <div class="col-md-4 trav-today">
          @include('includes.travday', ['text'=>'Today', 'date2'=>\Carbon\Carbon::now()])
        </div>
        <div class="col-md-4 trav-tomorrow">
          @include('includes.travday', ['text'=>'Tomorrow','date2'=>\Carbon\Carbon::now()->addDay(1)])
        </div>
        <div class="col-md-4 trav-dayaftertomorrow">
          @include('includes.travday', ['text'=>'Day after','date2'=>\Carbon\Carbon::now()->addDay(2)])
        </div>
      </div>


      <div class="row">
        <div class="col-md-6">
          @include('includes.travday', ['text'=>'Sat next','date2'=>\Carbon\Carbon::parse('next saturday')])
        </div>
        <div class="col-md-6">
          @include('includes.travday', ['text'=>'Sun next','date2'=>\Carbon\Carbon::parse('next sunday')])
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          @include('includes.travday', ['text'=>'Sat next1','date2'=>\Carbon\Carbon::parse('next saturday')->addWeek()])
        </div>
        <div class="col-md-6">
          @include('includes.travday', ['text'=>'Sun next1','date2'=>\Carbon\Carbon::parse('next sunday')->addWeek()])
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          @include('includes.travday', ['text'=>'Sat next2','date2'=>\Carbon\Carbon::parse('next saturday')->addWeek(2)])
        </div>
        <div class="col-md-6">
          @include('includes.travday', ['text'=>'Sun next2','date2'=>\Carbon\Carbon::parse('next sunday')->addWeek(2)])
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          @include('includes.travday', ['text'=>'Sat next3','date2'=>\Carbon\Carbon::parse('next saturday')->addWeek(3)])
        </div>
        <div class="col-md-6">
          @include('includes.travday', ['text'=>'Sun next3','date2'=>\Carbon\Carbon::parse('next sunday')->addWeek(3)])
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          @include('includes.travday', ['text'=>'Sat next4','date2'=>\Carbon\Carbon::parse('next saturday')->addWeek(4)])
        </div>
        <div class="col-md-6">
          @include('includes.travday', ['text'=>'Sun next4','date2'=>\Carbon\Carbon::parse('next sunday')->addWeek(4)])
        </div>
      </div>


      </div>
    </div>
  </div>

</div>
{!! Html::script('js/pikaday.js') !!}
{!! Html::script('js/pikaday_jquery.js') !!}
<script>
    var $datepicker = $('#datepicker').pikaday({
        firstDay: 1,
        minDate: new Date(2000, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [2000,2020],
    });
    // chain a few methods for the first datepicker, jQuery style!
    //$datepicker.pikaday('show').pikaday('nextMonth');
</script>
</div>


<div class="container-fluid">
<div class="row">

  <div id="intro" class="col-md-12 intro">
    <div class="panel hunp">
      <h2 class="panel-heading">About me</h2>
      <div class="container">
      <div>
      {!! Form::textarea('about',$content['about'],['class'=>'form-control','required']) !!}
      </div>
      <div>
      {!! Form::email('email',$content['email'],['class'=>'form-control','placeholder'=>'Email for contact form']) !!}
      </div>
      </div>
    </div>
  </div>


  <div id="skills" class="col-md-12 skills">
    <div class="panel hunp">
      <h2 class="panel-heading">Skills</h2>
      <div class="container">
      @foreach ($content['skills'] as $skill)
      <div>
      {!! Form::text("skillname_".$skill->id,$skill->skill,['class'=>'form-control']) !!}
      {!! Form::textarea("skillcontent_".$skill->id,$skill->content,['class'=>'form-control']) !!}
      </div>
      @endforeach
      <div>
      {!! Form::text("skillname",null,['class'=>'form-control','placeholder'=>'Enter new skill name']) !!}
      </div>
      </div>
    </div>
  </div>


</div>
</div>


<div class="container-fluid">
<div class="row">

  <div id="recent" class="col-md-12 recent">
    <div class="panel hunp">
      <h2 class="panel-heading">Recent work</h2>
      <div class="container">
        <div>
        {!! Form::textarea('recent',$content['recent'],['class'=>'form-control','required']) !!}
        </div>

        {!! Form::file('image') !!}

        <h3>Current images</h3>
        <ul class="list-inline">
        @foreach ($images as $image)
        <li>{{ Form::checkbox('del[]',$image->id,null,['id'=>'img'.$image->id,'style'=>'display:none;']) }}
        {{ Form::label('img'.$image->id,Html::image("img/uploaded/$image->filename",'',['width'=>200]),[],false) }}
        @endforeach
        </ul>
      </div>
    </div>
  </div>

</div>
</div>


<div class="container-fluid">
<div class="row">
<div>
{!! Form::submit('Update >',['class'=>'btn btn-lg btn-primary btn-block']) !!}
</div>
</div>
</div>

</div>

{!! Form::close() !!}
<script>
$(document).ready(function(){
  $('#recent label').click(function(){$(this).find('img').toggleClass('halfopacity');});
  
  $('<a href="#" class="scrollup"></a>').prependTo('body').hide().click(function(e){
    $("html, body").animate({ scrollTop: 0 }, 500);
    e.preventDefault();
  });

  $(window).scroll(function(){
    if($(this).scrollTop()>100){$('a.scrollup').fadeIn();}else{$('a.scrollup').fadeOut();}
  });

  $(document).on('click', 'button.updatetoday', function(e){
    var updatestr='update=1';
    var fields=$(this).parent().find('select[name^=price_]');
    $(fields).each(function(){
      var id = $(this);
      updatestr += '&hotel_' + $(this).attr('name') + '=' + $(this).val();
    });
    updatestr += '&newdaterow=' + $(this).prev().find('select.addhotel').val();
    updatestr += '&newpricerow=' + $(this).prev().find('select[name=price_]').val();
    updatestr += '&date=' + $(this).attr('title2');
    var $this=$(this);
    $.ajax({
      "type":"POST",
      "url":"/travelodge/update/today/",
      "data": updatestr,
      "success":function(data){
        $this.parent().parent().html(data);
      }
    });
    e.preventDefault();
  });

  $(document).on('click', 'span.zero', function(){
    $(this).parent().find('select[name^=price]').val(0);
  });


});
</script>
@endsection