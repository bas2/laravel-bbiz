$(document).ready(function(){
  if ($('p.error').length==0&&$('p.success').length==0) { 
    $('<p><a href="#">Contact me</a></p>').insertBefore('.intro div').click(function(){
      $('.intro div').show();
      $(this).hide();
      $('input[name=message]').focus();
    });
    $('.intro div').hide();
  } else {
    if ($('p.success').length>0) {
      $('.intro div form').hide();
      $('.intro div').delay(3000).fadeOut();
    }
  }
});