@extends('layout')
@section('content')

{!! Form::open() !!}
<div>
<div>
{!! Form::text('username',null,['class'=>'form-control','placeholder'=>'Your username...']) !!}
</div>

<div>
{!! Form::password('password',['class'=>'form-control','placeholder'=>'Your password...']) !!}
</div>

<div>
{!! Form::submit('Login >',['class'=>'btn btn-lg btn-primary btn-block']) !!}
</div>
</div>
{!! Form::close() !!}

@endsection