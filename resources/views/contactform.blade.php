{!! Form::open(['route'=>'sendcontacemeil']) !!}
<div>
{!! Form::text('name',null,['placeholder'=>'Your name...']) !!}
</div>
<div>
{!! Form::email('email',null,['placeholder'=>'Your email...']) !!}
</div>
<div>
{!! Form::textarea('message',null,['class'=>'form-control','placeholder'=>'Your message...','required']) !!}
</div>
<div>
{!! Form::submit('Send >',['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

@foreach($errors->all() as $error)
<p class="error">{{ $error }}</p>
@endforeach

@if($flash=session('message'))
<p class="success">{{ $flash }}</p>
@endif

