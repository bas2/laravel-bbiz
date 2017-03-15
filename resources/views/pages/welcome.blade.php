@extends('layout')
@section('content')
<div class="topdiv">
  <fieldset class="intro"><legend>About me</legend>
  {!! $pagecontent['aboutme'] !!}
    <div class="contactform">@include('contactform')</div>
  </fieldset>

  <div class="sep"></div>

  <fieldset class="skills">
    <legend>Skills</legend>
    <ul>
      @foreach($pagecontent['skills'] as $skill)
      <li><i>{!! $skill->skill !!}</i> &rarr; {!! $skill->content !!}</li>
      @endforeach
    </ul>
  </fieldset>
</div>

<fieldset class="recent">
  <legend>Recent work</legend>
  <p>{!! $pagecontent['recent'] !!}</p>
  <ul>
  @foreach($images as $image)<li>{{ link_to("img/{$image->filename}",Html::image("img/{$image->filename}",'',['width'=>200]), ['rel'=>'lightbox'], null, false) }}</li>@endforeach
  </ul>
</fieldset>

@endsection