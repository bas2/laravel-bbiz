@extends('layout')
@section('content')
{!! Form::open(['route'=>'updatecontent','method'=>'POST','files'=>'true']) !!}

<div>

<ul class="list-inline">
<li><a href="#about">About me</a>
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
      <li>{{ Html::image("img/$image->filename",'',['width'=>200]) }}
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
@endsection