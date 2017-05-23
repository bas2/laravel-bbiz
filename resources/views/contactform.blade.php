{!! Form::open(['route'=>'sendcontacemeil']) !!}
<div class="form-group">
{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Your name...']) !!}
</div>
<div class="form-group">
{!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Your email...','required']) !!}
</div>
<div class="form-group">
{!! Form::textarea('message',null,['class'=>'form-control','placeholder'=>'Your message...','required']) !!}
</div>
<div class="form-group">
{!! Form::submit('Send >',['class'=>'btn btn-primary btn-lg btn-block']) !!}
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
