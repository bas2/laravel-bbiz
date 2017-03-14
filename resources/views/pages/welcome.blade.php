@extends('layout')
@section('content')
<div class="topdiv">
  <fieldset class="intro"><legend>About me</legend>
  {!! $pagecontent['aboutme'] !!}
    <div>@include('contactform')</div>
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
  @foreach($images as $image)<li><a href="img/{{ $image->filename }}" rel="lightbox"><img src="img/{{ $image->filename }}" alt="" width="200"></a></li>@endforeach
  </ul>
</fieldset>

@endsection