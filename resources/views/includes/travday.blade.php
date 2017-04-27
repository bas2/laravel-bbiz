@if(!isset($dontshowtabs))
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" title2="{{ \Carbon\Carbon::parse($date2)->format('Y-m-d') }}" title3="{{ $text }}">
  <li role="presentation"><a href="#wal" aria-controls="wal" role="tab" data-toggle="tab">WAL</a></li>
  <li role="presentation"><a href="#tol" aria-controls="tol" role="tab" data-toggle="tab">TOL</a></li>
  <li role="presentation" class="active"><a href="#waltol" aria-controls="waltol" role="tab" data-toggle="tab">WALTOL</a></li>
</ul>
@endif

<div>
  <fieldset>
    <legend>{{ $text }} {{ \Carbon\Carbon::parse($date2)->format('l, j F') }}</legend>

    @foreach($travelodge[strtolower(str_replace(' ','',$text))] as $hoteldate)
      @if( !isset($order) # Initial.
      || ( $order == 'WALTOL' ) # All.
      || ( in_array($order, [strtoupper(substr($hoteldate->descr, 0,3))]) ) # 
      || ( 'WALTOL' == strtoupper($hoteldate->descr) ) # 
      )
      <div class="form-group">
      {!! Form::select("pprice_{$hoteldate->date_id}",range(0,50),$hoteldate->previous_price) !!}
      {!! Form::select("price_{$hoteldate->date_id}",range(0,50),$hoteldate->price) !!}
      {{ Form::label($hoteldate->name) }} <span class="zero">x</span> <span class="hoteldescr">{{ substr($hoteldate->descr, 0,3) }}</span>
      </div>
      @endif
    @endforeach

    <div class="form-group new-price">
    {!! Form::select("price_",range(0,50),(isset($price)?$price:39)) !!}
    {!! Form::select("hotel",$travelodge['hotels'],'',['class'=>'addhotel']) !!}
    </div>

    {{ Form::button('Update >',['class'=>'updatetoday btn btn-primary','title2'=>\Carbon\Carbon::parse($date2)->format('Y-m-d'),'title3'=>((isset($order)?$order:'TW'))]) }}
  </fieldset>
</div>

