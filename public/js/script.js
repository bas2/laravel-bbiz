$(document).ready(function(){
  if ($('p.error').length==0&&$('p.success').length==0) { 
    $('<p><a href="#">Contact me</a></p>').insertBefore('#home .intro div.contactform').click(function(e){
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
});