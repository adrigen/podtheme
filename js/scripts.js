(function($) {

$.fn.vAlign = function() {
return this.each(function(i){
var ah = $(this).height();
var ph = $(this).parent().height();
var mh = Math.ceil((ph-ah) / 2);
$(this).css('padding-top', mh);
});
};


$(document).ready(function() {
$('a.text-over-image').vAlign();
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

 $("li.product-category").each(function() {
	 $imgh = ($(this).find('img').height());
	 $h3 = $(this).find('h3');
	 $h3h = $h3.height();
	 $h3.css('top', (($imgh/2)-($h3h/2)));
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
