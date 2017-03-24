{!! Form::open(['route'=>'sendcontacemeil']) !!}
<div>
{!! Form::text('name',null,['placeholder'=>'Your name...']) !!}
</div>
<div>
{!! Form::email('email',null,['placeholder'=>'Your email...','required']) !!}
</div>
<div>
{!! Form::textarea('message',null,['class'=>'form-control','placeholder'=>'Your message...','required']) !!}
</div>
<div>
{!! Form::submit('Send >',['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

@foreach($errors->all() as $error)
<p class="alert alert-warning">{{ $error }}</p>
@endforeach

@if($flash=session('successmessage'))
<p class="alert alert-success">{{ $flash }}</p>
@endif

@if($flash=session('failuremessage'))
<p class="alert alert-danger">{{ $flash }}</p>
@endif
