/**
 * jQuery Animations
 *
 */


jQuery(function ($) {
	var allPanes=$(".dashboard-panes .pane");
	var general=$(".dashboard-nav #general");
	var generalPane=$(".dashboard-panes #general-pane");
	var support=$(".dashboard-nav #support");
	var supportPane=$(".dashboard-panes #support-pane");
	
	supportPane.hide();
	general.click(function(){
		allPanes.hide();
      	generalPane.fadeIn();
		$( ".active").removeClass("active");
		$( this ).parent("li").addClass( "active" );
    });
	support.click(function(){
		allPanes.hide();
      	supportPane.fadeIn();
		$( ".active" ).removeClass("active");
		$( this ).parent("li").addClass( "active" );
    });


    $(".dashboard-panes .form-table").wrap("<div class='temp-wrapper'></div>");
    $(".dashboard-panes h3").append("<i class='fa fa-plus'></i>");
    $(".temp-wrapper").hide();

    $(".dashboard-panes h3").toggle(function(){
    	$(".temp-wrapper").slideUp("slow");
    	$(".dashboard-panes h3").children(".fa-minus").addClass("fa-plus").removeClass("fa-minus");
    	$( this ).next(".temp-wrapper").slideDown("slow");
    	$( this ).children(".fa-plus").addClass("fa-minus").removeClass("fa-plus");
    }, function() {
    	$( this ).next(".temp-wrapper").slideUp("slow");
    	$( this ).children(".fa-minus").addClass("fa-plus").removeClass("fa-minus");
    });


    $(".dashboard-panes dd").hide();
    $(".dashboard-panes dt").toggle(function(){
    	$( this ).next("dd").slideDown();
    	$( this ).children(".fa-plus").addClass("fa-minus").removeClass("fa-plus");
    }, function() {
    	$( this ).next("dd").slideUp();
    	$( this ).children(".fa-minus").addClass("fa-plus").removeClass("fa-minus");
    });

});
