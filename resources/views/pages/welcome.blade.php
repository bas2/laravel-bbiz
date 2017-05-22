@extends('layout')
@section('content')

  <div class="container-fluid">
  <div class="jumbotron">

    <h2 class="text-center">Items I'm selling</h2>
    <p class="lead text-center">I have two items that I'm currently selling</p>


    @foreach($products as $product)
    <div class="itemtosell">
      <h3>{{ $product->name }}<span class="badge">&pound;{{ $product->price }}</span></h3>
      <p>{{ $product->intro }}</p> 
      <div class="row">
        <div class="col-md-8">
        {!! $product->descr !!}
        </div>
        <div class="col-md-4 text-center">
        {{ Html::Image("img/itemstosell/{$product->id}/1.jpg",'',['width'=>300,'class'=>'thumbnail']) }}
        </div>
      </div>
      <p class="actionbuttons" title2="{{ $product->id }}">
        <button class="interested btn btn-success">I am interested in buying this for &pound;{{ $product->price }}</button>
        <!--<button class="not-interested btn btn-warning">I am not interested in buying this for &pound;{{ $product->price }}</button>-->
      </p>
    </div>
    @endforeach

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#home2" aria-controls="home2" role="tab" data-toggle="tab">How this works</a></li>
      <li role="presentation"><a href="#payitem" aria-controls="payitem" role="tab" data-toggle="tab">Paying for the item</a></li>
      <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Where I am</a></li>
      <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Need to know more?</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="home2">
        <p>Once you've decided you are interested in buying an item, contact me by
        calling me on {{ $pagecontent['mobile'] }} or by sending your name and contact email. You don't have to 
        supply your email address. If you don't, you will be given a link to communicate via this site.</p> 
        <p>We can meet and you can take a look at the item.</p>
        <p>If you agree, pay the amount and take the item.</p>
        <p>You can ask for a discount (via the not interested button) and I will contact you if I can sell it at that price.</p>
      </div>
      <div role="tabpanel" class="tab-pane" id="payitem">
        <p>I accept only cash payments.</p>
      </div>
      <div role="tabpanel" class="tab-pane" id="messages">
        <p>I am based in Walthamstow and I would expect you come to me to see 
        the item you're interested in to make sure it is what you want.</p>
      </div>
      <div role="tabpanel" class="tab-pane" id="settings">
        <p>You can use the system on this web site if you have any further questions 
        about the items or anything else.</p>
      </div>
    </div>

  

  </div>
  </div>




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
  var productId = $(this).parent().attr('title2');
  var contactForm = '<div class="interested_form">';
  contactForm+= '<p><strong>Great! You can contact me on {{ $pagecontent['mobile'] }} or by using the form below:</strong></p>';
  contactForm+= '<div class="form-group"><input class="form-control" type="text" placeholder="Your name (required)"></div>';
  contactForm+= '<div class="form-group"><input class="form-control" type="email" placeholder="Your email (optional)"></div>';
  contactForm+= '<div class="form-group"><input title2="'+productId+'" class="btn btn-primary" type="submit" value="Submit"></div>';
  contactForm+= '<div class="form-group"><button class="btnReset btn btn-warning">Cancel</button></div>';
  contactForm+= '</div>';
  $( contactForm ).insertAfter($(this));

  $(this).next().next().hide(); // Hide the second button.
  $(this).hide();              // Hide button that was clicked.
  $('.interested_form div').first().find('input').focus();
})

// Send message:
$('body').on('click','.interested_form input[type=submit]',function(){
  var productId = $(this).attr('title2');
  var nameInput = $(this).parent().prev().prev().find('input');

  if(nameInput.val().length<3) {
    nameInput.next('span').remove();
    $('<span class="error" style="color:#f00;">Please supply your name (not less than 3 characters)</span>').insertAfter(nameInput);
    nameInput.focus();

  } else {
    var emailInput  = $(this).parent().prev().find('input');
    var success_msg = 'Thank you for your interest!';
    if(emailInput.val().length>0) {
      success_msg+=' I will contact you asap at ' + emailInput.val() + '.';
      $.ajax({
        "type":"POST",
        "url":"itemstosell/email/",
        "data":"message=12345&email=" + emailInput.val(),
        "success":function(data){
          if (data=='email_not_valid') {
            emailInput.next('span').remove();
            $('<span class="error" style="color:#f00;">The email address you supplied does not look correct.</span>')
            .insertAfter(emailInput);
            emailInput.focus();

          } else { // Email address was valid.
            // Send email.
            $.ajax({
              "type":"POST",
              "url":"itemstosell/email/send",
              "data":"message=12345&email=" + emailInput.val(),
              "success":function(data){

              }
            });

            $('<p class="alert-success">'+success_msg+'</p>')
            .insertAfter(nameInput.parent().parent());
            nameInput.parent().parent().remove(); // Remove form.
          }

        } // End ajax success function

      }); // End ajax.

    } else { // Form submitted without supplying an email address.
      success_msg+= ' You did not supply an email address so can';
      success_msg+= ' send receive message via the following URL:';
      // Generate code to allow contact via web site.
      $.ajax({
        "type":"POST",
        "url":"itemstosell/getcode",
        "data":'name=' + nameInput.val() + '&productid=' + productId ,
        "success":function(code){
          success_msg+=' <a href="viewmessages/'+code+'">Here</a>' ;
          //alert(success_msg);
          $('<p class="alert-success">'+success_msg+'</p>')
          .insertAfter(nameInput.parent().parent());
          nameInput.parent().parent().remove(); // Remove form.
        } // End ajax success function
      }); // End ajax.


    }


  }
});

$('body').on('click','button.btnReset', function(){
  $(this).parent().parent().parent().find('.interested').show();
  $(this).parent().parent().parent().find('.not-interested').show();
  $(this).parent().parent().remove(); // Remove form.
});
</script>
@endsection
