
//Parallax
jQuery(function($) {
	$(".site-header").parallax("50%", 0.3);
});

//Fit Vids
jQuery(function($) {
    $("body").fitVids();  
});

//Open social links in a new tab
jQuery(function($) {
     $( '.social-navigation li a' ).attr( 'target','_blank' );
});

//Toggle sidebar
// edit by KH

jQuery(function($) {
	$('.sidebar-toggle').click(function() {
		console.log("toggle");
		sidebar_toggle();
	});
	$('.sidebar-toggle-inside').click(function() {
		console.log("toggle_inside");
		sidebar_toggle_inside();
	});	
});

function sidebar_toggle() {
	jQuery('.widget-area').toggleClass('widget-area-visible');
	jQuery('.sidebar-toggle').toggleClass('sidebar-toggled');
	jQuery('.sidebar-toggle').find('i').toggleClass('fa-bars fa-times');
}

function sidebar_toggle_inside() {
	jQuery('.widget-area').toggleClass('widget-area-visible');
	jQuery('.sidebar-toggle').toggleClass('sidebar-toggled');
	jQuery('.sidebar-toggle').find('i').toggleClass('fa-bars fa-times');
}

// Toggle sidebar backup
/*
jQuery(function($) {
	$('.sidebar-toggle').click(function() {
		$('.widget-area').toggleClass('widget-area-visible');
		$('.sidebar-toggle').toggleClass('sidebar-toggled');
		$('.sidebar-toggle').find('i').toggleClass('fa-bars fa-times');
	});
	$('.sidebar-toggle-inside').click(function() {
		$('.widget-area').toggleClass('widget-area-visible');
	});	
});
*/


// added by KH
// Check First Item on payment_method
/*
jQuery(function($) {
	$("input[name=payment_method][disabled=false]:first").attr('checked', true);
});
*/


//Menu
jQuery(function($) {
	$('.main-navigation .menu').slicknav({
		label: '',
		duration: 500,
		prependTo:'.sidebar-nav',
		closedSymbol: '&#43;',
		openedSymbol: '&#45;',
		allowParentLinks: true	
	});
});
