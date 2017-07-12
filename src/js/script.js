jQuery(function($) {
    "use strict";

/* Touchscreen will follow button link on one click */

$(".navbar-nav li a").on("touchend", function(event) {
  window.location.href = $(this).attr("href");
});

/* Move Navbar outside Header container at 768px window size */
$( document ).ready(function() {

if($(window).width() < 768){
		$("nav").detach().appendTo(".nav-relocate");
	}
	else{
		$("nav").insertAfter(".site-title");
	}
});

$(window).resize(function(){

	if($(window).width() < 768){
		$("nav").detach().appendTo(".nav-relocate");
	}
	else{
		$("nav").insertAfter(".site-title");
	}
});

/* Adding Slick Slider on Home Page */

	$('.autoplay').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 4000,
		dots: true,
	});



/* Accordion */

//initially hides all the content
	$('.collapse-wrapper').hide();

	//when the header is clicked...
	$('.collapse-toggle').on('click', function(){
		event.preventDefault();

	    //the corresponding content collapses or expands...
		var click = $(this).parent().parent().next();
	    click.slideToggle();

	    //while all other content collapses
	    var otherContent = $('.collapse-toggle').not(event.target).parent().parent().next();
	    otherContent.slideUp();

	});


})(jQuery);