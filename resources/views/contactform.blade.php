{!! Form::open() !!}

{!! Form::text('message',null,['placeholder'=>'Your message...']) !!}
{!! Form::submit('Send') !!}

{!! Form::close() !!}

@foreach($errors->all() as $error)
<p class="error">{{ $error }}</p>
@endforeach

@if($flash=session('message'))
<p class="success">{{ $flash }}</p>
@endif

