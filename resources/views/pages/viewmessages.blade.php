@extends('layout')
@section('content')

<div class="container-fluid">
<div class="jumbotron">

<ul>
@foreach($messages as $message)
@if($loop->first)
<li>{{ $message->message }} posted by <strong>Bashir</strong> on <strong>{{ $message->created_at }}</strong></li>
@else
<li>{{ $message->message }} posted by <strong>{{ $message->name }}</strong> on <strong>{{ $message->created_at }}</strong></li>
@endif
@endforeach
</ul>

{{ Form::open() }}

<div class="form-group">
{{ Form::textarea('message',null,['class'=>'form-control','placeholder'=>'Your message...']) }}
</div>
@foreach($errors->all() as $error)
<p class="alert alert-warning">{{ $error }}</p>
@endforeach
@if($flash=session('failuremessage'))
<p class="alert alert-danger">{{ $flash }}</p>
@endif
<div class="form-group">
{!! Form::submit('Reply',['class'=>'btn btn-primary']) !!}
</div>

{{ Form::close() }}

</div>
</div>
@endsection
