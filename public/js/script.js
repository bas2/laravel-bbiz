$(document).ready(function(){

  if ($('p.error').length==0&&$('p.success').length==0) { 
    $('<p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <a href="#">Contact me</a></p>').insertBefore('#home .intro div.contactform').click(function(e){
      $('#home .intro div.contactform').show();
      $(this).hide();
      $('input[name=name]').focus();
      e.preventDefault();
    });
    $('#home .intro div.contactform').hide();
  } else {
    if ($('p.success').length>0) {
      $('#home .intro div.contactform form').hide();
      $('#home .intro div.contactform').delay(3000).fadeOut();
    }
  }


  $('.overlay').click(function(e){
    $('<div class="overlay_container"><div>Close</div><img src="'+$(this).find('img').attr('src')+'"></div>')
    .appendTo('body');
    $("body").css("overflow","hidden");
    e.preventDefault();
  });

  $(document).on('click','.overlay_container div',function(){
    $(this).parent().remove();
    $("body").css("overflow","auto");
  });


  $('div.recent a').hover(
    function() {
      var img = $(this).find('img');
        
      img.stop().fadeTo('slow', 0.5);
         
      $('<span style="position:absolute;color:#ccc;font-weight:bold;font-size:2em;" class="itxt">+</span>')
      .insertAfter(img).css({'left': img.position().left + (1/2*img.width() - 10),
                              'top': img.position().top + 0 })
      .animate({ 
        top: img.position().top + (1/2*img.height() - 50 ),
        opacity: .8,
      },500);
         
      $('<span style="position:absolute;color:#fff;font-weight:bold;font-size:1em;" class="itxt">ZOOM</span>')
      .insertAfter(img).css({'top': img.position().top + (1*img.height() - 30),
                            'left': img.position().left + (1/2*img.width()) - 25 })
      .animate({ 
        top: img.position().top + (1/2*img.height()) ,
      },500);
    },
    function() {
      $('.itxt').remove();
      var img = $(this).find('img');
      img.stop().fadeTo('slow', 1);
    }
  );

});