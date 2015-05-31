/**
 * jQuery Animations
 *
 */

jQuery(function ($) {
    /**
    * Expand Header
    */ 
    $('#menu-toggle a').click(function(){
    	if ( $('#site-header').hasClass('open') ) {
            $('#site-header').removeClass('open');
            $('#social-icons').removeClass('open');
            $('#menu-toggle a').removeClass('open');
            $('#main-navigation').hide(); 
        } else {
           $('#site-header').addClass('open');
            $('#social-icons').addClass('open');
            $('#menu-toggle a').addClass('open');
            $('#main-navigation').show();             
        }
    });
      
});