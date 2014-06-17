(function($) {
$(document).ready(function() {
//top banner
  $('.flexslider').flexslider();

//ticker
$(function() {
	 $('#ticker') 
  .cycle({ 
   fx:     'scrollDown', 
   speed:   900, 
   timeout: 200
  });
});

  var menu = $('ul.menu');
  var menuToggle = $('#js-mobile-menu');
  var signUp = $('.sign-up');

  $(menuToggle).on('click', function(e) {
    e.preventDefault();
    menu.slideToggle(function(){
      if(menu.is(':hidden')) {
       // menu.removeAttr('style');
       menu.prop('display', 'block');
      } else {
       menu.prop('display', 'none');
      }
    });
  });



  // underline under the active nav item
  $(".nav .nav-link").click(function() {
    $(".nav .nav-link").each(function() {
      $(this).removeClass("active-nav-item");
    });
    $(this).addClass("active-nav-item");
    $(".nav .more").removeClass("active-nav-item");
  });
});
  
})(jQuery);
