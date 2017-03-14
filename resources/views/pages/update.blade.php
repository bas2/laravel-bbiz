@extends('layout')
@section('content')
{!! Form::open(['route'=>'updatecontent']) !!}
<h1>About me</h1>
<div>
{!! Form::textarea('about',$content['about'],['required']) !!}
</div>

<h1>Recent work</h1>
<div>
{!! Form::textarea('recent',$content['recent'],['required']) !!}
</div>



<div>
{!! Form::submit('Update >') !!}
</div>
{!! Form::close() !!}
@endsection