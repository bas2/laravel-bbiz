@extends('layout')
@section('content')

{!! Form::open() !!}
<div>
<div class="form-group">
{!! Form::text('username',null,['class'=>'form-control','placeholder'=>'Your username...']) !!}
</div>

<div class="form-group">
{!! Form::password('password',['class'=>'form-control','placeholder'=>'Your password...']) !!}
</div>

<div class="form-group">
{!! Form::submit('Login >',['class'=>'btn btn-lg btn-primary btn-block']) !!}
</div>
</div>
{!! Form::close() !!}

@endsection