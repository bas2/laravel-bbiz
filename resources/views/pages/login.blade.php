@extends('layout')
@section('content')
{!! Form::open() !!}

<div>
{!! Form::text('username',null,['placeholder'=>'Your username...']) !!}
</div>

<div>
{!! Form::password('password',null,['placeholder'=>'Your password...']) !!}
</div>

<div>
{!! Form::submit('Login >') !!}
</div>

{!! Form::close() !!}
@endsection