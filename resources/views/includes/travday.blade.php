<fieldset>
  <legend>{{ $text }} {{ \Carbon\Carbon::parse($date2)->format('l, j F') }}</legend>
  
  @foreach($travelodge[strtolower(str_replace(' ','',$text))] as $hoteldate)
  @if( !isset($order) # Initial.
  || ( $order == 'WALTOL' ) # All.
  || ( in_array($order, [strtoupper(substr($hoteldate->descr, 0,3))]) ) # 
  || ( 'WALTOL' == strtoupper($hoteldate->descr) ) # 
  )
  <div class="form-group">
  {!! Form::select("price_{$hoteldate->date_id}",range(0,70),$hoteldate->price) !!}
  {{ Form::label($hoteldate->hotels[0]->name) }} <span class="zero">x</span> <span class="hoteldescr">{{ substr($hoteldate->descr, 0,3) }}</span>
  </div>
  @endif
  @endforeach

  <div class="form-group">
  {!! Form::select("price_",range(0,70),(isset($price)?$price:39)) !!}
  {!! Form::select("hotel",$travelodge['hotels'],'',['class'=>'addhotel']) !!}
  </div>

  {{ Form::button('Update >',['class'=>'updatetoday btn btn-primary','title2'=>\Carbon\Carbon::parse($date2)->format('Y-m-d'),'title3'=>((isset($order)?$order:'TW'))]) }}
</fieldset>
