@extends('layout')
@section('content')

  <div class="container-fluid">
  <div class="jumbotron">

    <h2 class="text-center">Items I'm selling</h2>
    <!--<p class="lead text-center">I have two items that I'm currently selling</p>-->

    @foreach($products as $product)
    <div class="panel itemtosell">
      <div class="panel-heading">
        <h3>{{ $product->name }}<span class="badge">&pound;{{ $product->price }}</span></h3>
      </div>
      <div class="panel-body">
      <div class="alert-danger poster">
        <p class="text-center"><small>Posted by <strong>Bashir</strong> on <strong>{{ \Carbon\Carbon::parse($product->created_at)->format('l jS F, Y') }}</strong></small></p>
      </div>
      <p class="text-center">{{ $product->intro }}</p>
      <div class="row">
        <div class="col-md-8">
        {!! $product->descr !!}
        </div>
        <div class="col-md-4">
        <div class="thumbnail">
        <a href="img/itemstosell/{{ $product->id }}/1.jpg" class="overlay">
        {{ Html::Image("img/itemstosell/{$product->id}/1.jpg",'',
        ['width'=>350,'class'=>'img-responsive','style'=>'margin:0 auto 20px auto']) }}
        </a>
        <p class="text-center"><small>{{ $product->productImages[0]->caption }}</small></p>
        </div>
        </div>
      </div>

      <ul class="product-image list-inline text-center">
        @foreach($product->productImages as $prodimage)
        @if($loop->first)
        <li>{{ Html::Image("img/itemstosell/{$product->id}/".$prodimage->num.".jpg",'',
        ['width'=>200,'class'=>'sel thumbnail img-responsive']) }}
        @else
        <li>{{ Html::Image("img/itemstosell/{$product->id}/".$prodimage->num.".jpg",'',
        ['width'=>200,'class'=>'thumbnail img-responsive']) }}
        @endif
        @endforeach
      </ul>

      <ul class="product-image-caption list-inline text-center">
        @foreach($product->productImages as $prodimage)
        <li><div>{{ $prodimage->caption }}</div>
        @endforeach
      </ul>

      <p class="actionbuttons text-center" title2="{{ $product->id }}">
        <button class="interested btn btn-success">Buy this for &pound;{{ $product->price }}</button>
        <!--<button class="not-interested btn btn-warning">I am not interested in buying this for &pound;{{ $product->price }}</button>-->
      </p>
      </div>
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
    <div class="panel tab-content">
      <div role="tabpanel" class="panel-body tab-pane active" id="home2">
        <ul>
        <li>Once you've decided you are interested in buying an item, contact me by
        calling me on <strong>{{ $pagecontent['mobile'] }}</strong> or by sending your name and contact email. You don't have to 
        supply your email address. If you don't, you will be given a link to communicate via this site.</p> 
        <li>We can meet and you can take a look at the item.</p>
        <li>If you agree, pay the amount and take the item.</p>
        <!--<p>You can ask for a discount (via the not interested button) and I will contact you if I can sell it at that price.</p>-->
        </ul>
      </div>
      <div role="tabpanel" class="panel-body tab-pane" id="payitem">
        <ul>
        <li>I accept only cash payments.</p>
        </ul>
      </div>
      <div role="tabpanel" class="panel-body tab-pane" id="messages">
        <ul>
        <li>I am based in Walthamstow and I would expect you come to me to see 
        the item you're interested in to make sure it is what you want.</p>
        </ul>
      </div>
      <div role="tabpanel" class="panel-body tab-pane" id="settings">
        <ul>
        <li>You can use the system on this web site if you have any further questions 
        about the items or anything else.</p>
        </ul>
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
//var numf=43;
// Scroll up icon.
$('<a href="#" class="scrollup"></a>').prependTo('body').hide().click(function(e){
  $("html, body").animate({ scrollTop: 0 }, 500);
  e.preventDefault();
});

$(window).scroll(function(){
  if($(this).scrollTop()>100){$('a.scrollup').fadeIn();}else{$('a.scrollup').fadeOut();}
});


$('.interested').click(function(){
  // Display contact form.
  var productId = $(this).parent().attr('title2');
  var contactForm = '<div class="interested_form">';
  contactForm+= '<p><strong>Great! You can contact me on {{ $pagecontent['mobile'] }} or by using the form below:</strong></p>';
  contactForm+= '<div class="form-group"><input class="form-control" type="text" placeholder="Your name (required)"></div>';
  contactForm+= '<div class="form-group"><input class="form-control" type="email" placeholder="Your email (optional)"></div>';
  contactForm+= '<div class="form-group"><input title2="'+productId+'" class="btn btn-primary" type="submit" value="Submit"> ';
  contactForm+= '<button class="btnReset btn btn-warning">Cancel</button></div>';
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
    nameInput.next('span').remove(); // Remove any error spans.
    $('<span class="error" style="color:#f00;">Please supply your name (not less than 3 characters)</span>')
    .insertAfter(nameInput);
    nameInput.focus();

  } else {
    // Name has been supplied. Check email field.
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
            emailInput.next('span').remove(); // Remove any error spans.
            $('<span class="error" style="color:#f00;">The email address you supplied does not look correct.</span>')
            .insertAfter(emailInput);
            emailInput.focus();

          } else { // Email address was valid.
            // Send email.
            $.ajax({
              "type":"POST",
              "url":"itemstosell/email/send",
              "data":"email=" + emailInput.val() 
              + '&name=' + nameInput.val()
              + '&item=' + productId,
              "success":function(data){

              }
            });

            $('<p class="alert-success">'+success_msg+'</p>')
            .insertAfter(nameInput.parent().parent());
            nameInput.parent().parent().remove(); // Remove form.
          }

        } // End ajax success function

      }); // End ajax.

    } else { // Form submitted without supplying an email address. Communicate via site.
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

$('img.sel').addClass('img-glow');

$('.product-image img').hover(function() {
  $(this).css({'cursor':'pointer'});
  $(this).parent().parent().prev().find('img').attr('src',$(this).attr('src'));
  $(this).parent().parent().prev().find('img').parent().next().html('test');
  $(this).parent().parent().find('img').removeClass('sel');
  $(this).addClass('sel');
  $('img.sel').addClass('img-glow');
}, function() {
  //$(this).css({'cursor':'pointer'});
  $('.product-image img').removeClass('img-glow');
  $('img.sel').addClass('img-glow');
});

</script>
@endsection
