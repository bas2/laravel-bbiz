{!! Form::open() !!}
{{ csrf_field() }}

{!! Form::text('text',null,['placeholder'=>'Your message...']) !!}
{!! Form::submit('Send') !!}

{!! Form::close() !!}

@if (isset($errors))
{{ print_r($errors) }}
@endif
