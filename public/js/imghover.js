$('document').ready(function(){
  $('fieldset.recent a').hover(
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