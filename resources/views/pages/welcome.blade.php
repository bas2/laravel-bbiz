@extends('layout')
@section('content')
<div class="container">
<div class="row equal">

  <div class="col-md-5 intro">
    <div class="panel hunp">
      <h2 class="panel-heading">About me</h2>
      <div class="panel-body">
        {!! $pagecontent['aboutme'] !!}
        @if(!empty($pagecontent['email']))
        <div class="contactform">@include('contactform')</div>
        @endif
      </div>
    </div>
  </div>

  <div class="col-md-7 skills">
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