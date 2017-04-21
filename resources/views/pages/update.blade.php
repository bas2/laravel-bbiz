@extends('layout')
@section('content')
{!! Form::open(['route'=>'updatecontent','method'=>'POST','files'=>'true']) !!}

<div class="container-fluid">
<div class="row">

  <ul class="list-inline">
    <li><a href="#travelodge">Travelodge</a>
    <li><a href="#intro">About me</a>
    <li><a href="#skills">Skills history</a>
    <li><a href="#recent">Recent work</a>
  </ul>

  @if($flash=session('message'))
  <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session('message') }}</div>
  @endif

    <div id="travelodge" class="travelodge-affiliate">
      <div class="panel">
        <h2 class="panel-heading">Book a room with Travelodge</h2>
        <div class="panel-body"> 
        {!! Form::textarea('travelodge',$travelodge['lead'],['class'=>'form-control','required']) !!}

        <div class="row">
          <div class="col-md-4 trav-today hotels">              
            @include('includes.travday', 
            ['text'=>'Today', 'date2'=>\Carbon\Carbon::now()])
          </div>
          <div class="col-md-4 trav-tomorrow hotels">
            @include('includes.travday', 
            ['text'=>'Tomorrow','date2'=>\Carbon\Carbon::now()->addDay(1)])
          </div>
          <div class="col-md-4 trav-dayaftertomorrow hotels">
            @include('includes.travday', 
            ['text'=>'Day after','date2'=>\Carbon\Carbon::now()->addDay(2)])
          </div>
        </div>
          
        <div class="row">
          <div class="col-md-4 hotels">
            @include('includes.travday',
            ['text'=>'Fri next',
            'date2'=>\Carbon\Carbon::parse('next fri')])
          </div>
          <div class="col-md-4 hotels">
            @include('includes.travday',
            ['text'=>'Sat next',
            'date2'=>\Carbon\Carbon::parse('next fri')->addDay()])
          </div>
          <div class="col-md-4 hotels">
            @include('includes.travday',
            ['text'=>'Sun next',
            'date2'=>\Carbon\Carbon::parse('next fri')->addDay(2)])
          </div>
        </div>

        @for($i=1;$i<13;$i++)
        <div class="row">
          <div class="col-md-4 hotels">
            @include('includes.travday',
            ['text'=>"Fri next{$i}",
            'date2'=>\Carbon\Carbon::parse('next fri')->addWeek($i)])
          </div>
          <div class="col-md-4 hotels">
            @include('includes.travday', 
            ['text'=>"Sat next{$i}",
            'date2'=>\Carbon\Carbon::parse('next fri')->addDay()->addWeek($i)])
          </div>
          <div class="col-md-4 hotels">
            @include('includes.travday', 
            ['text'=>"Sun next{$i}",
            'date2'=>\Carbon\Carbon::parse('next fri')->addDay(2)->addWeek($i)])
          </div>
        </div>
        @endfor
        </div>
      </div>
    </div>

</div>
</div>



<div class="container-fluid">
  <div class="row">

    <div id="intro" class="intro">
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


    <div id="skills" class="skills">
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

    <div id="recent" class="recent">
      <div class="panel">
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

<div class="form-group">
  {!! Form::submit('Update >',['class'=>'btn btn-lg btn-primary btn-block']) !!}
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
      // /laravel/bbiz/public
      "url":"/travelodge/update/today/",
      "data": updatestr + "&orderby=" + $this.attr('title3'),
      "success":function(data){
        $this.parent().parent().html(data);
        colorSelects();
      }
    });
    e.preventDefault();
  });

  $(document).on('click', 'span.zero', function(){
    $(this).parent().find('select[name^=price]').val(0);
  });


  $('.hotels ul li a').css('cursor','pointer').click(function(){
    var $this=$(this);
    var ul=$this.parent().parent();
    $.ajax({
      "type":"GET",
      // /laravel/bbiz/public
      "url":"/travelodge/getday/" + ul.attr('title2'),
      "data":"orderby=" + $this.text() + "&text=" + ul.attr('title3'),
      "success":function(data){
        ul.next().html(data);
        colorSelects();
      } // End ajax success function

    }); // End ajax.
  });

  function colorSelects() { 
    var price=0;
    $('.hotels select[name^=price]').each(function(){
      if ($(this).val()!=price&&!$(this).parent().hasClass('new-price')) {$(this).css('color','blue');price=0;}
      else {$(this).css('color','black');}
      if(!$(this).parent().hasClass('new-price')) {price=$(this).val();}
      else {$(this).css({'background':'#000','color':'#fff'});price=0;}
    });
  }
  colorSelects();

});
</script>
@endsection
