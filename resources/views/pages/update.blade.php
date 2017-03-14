@extends('layout')
@section('content')
{!! Form::open(['route'=>'updatecontent','method'=>'POST','files'=>'true']) !!}
<h1>About me</h1>
<div>
{!! Form::textarea('about',$content['about'],['required']) !!}
</div>

<h1>Recent work</h1>
<div>
{!! Form::textarea('recent',$content['recent'],['required']) !!}
</div>

{!! Form::file('image') !!}

<h1>Skills</h1>
@foreach ($content['skills'] as $skill)
<div>
{!! Form::text("skillname_".$skill->id,$skill->skill) !!}
{!! Form::text("skillcontent_".$skill->id,$skill->content) !!}
</div>
@endforeach
<div>
{!! Form::text("skillname",null,['placeholder'=>'Enter new skill name']) !!}
</div>

<div>
{!! Form::submit('Update >') !!}
</div>
{!! Form::close() !!}
@endsection