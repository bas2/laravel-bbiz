@extends('layout')
@section('content')
{!! Form::open(['route'=>'updatecontent','method'=>'POST','files'=>'true']) !!}

<fieldset class="intro">
<legend>About me</legend>
<div>
{!! Form::textarea('about',$content['about'],['required']) !!}
</div>
<div>
{!! Form::email('email',$content['email']) !!}
</div>
</fieldset>


<fieldset class="skills">
<legend>Skills</legend>
@foreach ($content['skills'] as $skill)
<div>
{!! Form::text("skillname_".$skill->id,$skill->skill) !!}
{!! Form::textarea("skillcontent_".$skill->id,$skill->content) !!}
</div>
@endforeach
<div>
{!! Form::text("skillname",null,['placeholder'=>'Enter new skill name']) !!}
</div>


</fieldset>

<fieldset class="recent">
<legend>Recent work</legend>
<div>
{!! Form::textarea('recent',$content['recent'],['required']) !!}
</div>

{!! Form::file('image') !!}

<fieldset>
<legend>Current images</legend>
<ul>
@foreach ($images as $image)
<li>{{ Html::image("img/$image->filename",'',['width'=>200]) }}
@endforeach
</ul>
</fieldset>

</fieldset>

<div>
{!! Form::submit('Update >') !!}
</div>

{!! Form::close() !!}
@endsection