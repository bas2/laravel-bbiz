@extends('layout')
@section('content')



<div class="container-fluid">
<div class="row equal">

  <div class="col-md-4 col-sm-12 intro page-heading" id="about">
    <div class="panel hunp">
      <h2 class="panel-heading">About me</h2>
      <div class="panel-body text-center">
        {!! $pagecontent['aboutme'] !!}
        @if(!empty($pagecontent['email']))
        <div class="contactform">@include('contactform')</div>
        @endif
      </div>
    </div>
  </div>

  <div class="col-md-8 col-sm-12 skills page-heading" id="skills">
    <div class="panel hunp">
      <h2 class="panel-heading">Skills summary</h2>
      <div class="panel-body">
        <ul>
        @foreach($pagecontent['skills'] as $skill)
        @if(!empty($skill->skill))
        <li><i>{!! $skill->skill !!}</i> &rarr; {!! $skill->content !!}</li>
        @endif
        @endforeach
        </ul>
      </div>
    </div>
  </div>

</div>
</div>


<div class="container-fluid">
<div class="row">

  <div class="col-md-12 recent page-heading" id="recent">
    <div class="panel">
      <h2 class="panel-heading">Recent work</h2>
      <div class="panel-body">
        <p class="lead text-center">{!! $pagecontent['recent'] !!}</p>
        <ul class="list-inline">
        @foreach($images as $image)<li>{{ link_to("img/uploaded/{$image->filename}",Html::image("img/uploaded/{$image->filename}",'',['width'=>200,'class'=>'thumbnail']), ['class'=>'overlay'], null, false) }}</li>@endforeach
        </ul>
      </div>
    </div>
  </div>

</div>
</div>

<script>
  var numf=43;
// Scroll up icon.
$('<a href="#" class="scrollup"></a>').prependTo('body').hide().click(function(e){
  $("html, body").animate({ scrollTop: 0 }, 500);
  e.preventDefault();
});

$(window).scroll(function(){
  if($(this).scrollTop()>100){$('a.scrollup').fadeIn();}else{$('a.scrollup').fadeOut();}
});


$('.interested').click(function(){
  var resetBtn = '<p class="btnReset"><button class="btn btn-warning">Cancel</button></p>';

  var contactForm = '<div class="interested_form">';
  contactForm+= '<div class="form-group"><input class="form-control" type="text" placeholder="Your name (required)"></div>';
  contactForm+= '<div class="form-group"><input class="form-control" type="email" placeholder="Your email (optional)"></div>';
  contactForm+= '<div class="form-group"><input class="btn btn-primary" type="submit" value="Submit"></div></div>';
  $(
    '<p><strong>Great! You can contact me on 077 599 702 09 or by using the form below:</strong></p>'
    + contactForm
    + resetBtn
  )
  .insertAfter($(this));
  $('.not-interested').hide();
  $(this).hide();
  $('.interested_form div').first().find('input').focus();
})

// Send message:
$('body').on('click','.interested_form input[type=submit]',function(){
  var nameInput = $(this).parent().prev().prev().find('input');

  if(nameInput.val().length<4) {
    nameInput.next('span').remove();
    $('<span class="error" style="color:#f00;">Please supply your name</span>').insertAfter(nameInput);
    nameInput.focus();

  } else {
    var emailInput = $(this).parent().prev().find('input').val();
    var success_msg = 'Thank you for your interest!';
    if(emailInput.length>0) {
      success_msg+=' I will contact you asap at ' + emailInput + '.';
    } else {
      success_msg+=' You did not supply an email address.';
    }

    $('<p class="alert-success">'+success_msg+'</p>')
    .insertAfter(nameInput.parent().parent());

    nameInput.parent().parent().remove();

    $('.btnReset').hide();
  }
});
</script>
@endsection
