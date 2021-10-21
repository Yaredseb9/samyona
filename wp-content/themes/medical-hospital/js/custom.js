// NAVIGATION CALLBACK
jQuery(function($){
 	"use strict";
   	jQuery('.main-menu-navigation > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast'
   	});
});

jQuery(function($){
	$( '.toggle-menu button' ).click( function(e){
        $( 'body' ).toggleClass( 'show-main-menu' );
        var element = $( '.respside-nav' );
        medical_hospital_trapFocus( element );
    });

    $( '.closebtn' ).click( function(e){
        $( '.toggle-menu button' ).click();
        $( '.toggle-menu button' ).focus();
    });
    $( document ).on( 'keyup',function(evt) {
        if ( $( 'body' ).hasClass( 'show-main-menu' ) && evt.keyCode == 27 ) {
            $( '.toggle-menu button' ).click();
            $( '.toggle-menu button' ).focus();
        }
    });
    
	$(window).scroll(function(){
	    if ($(window).scrollTop() >= 100) {
	        $('.toggle-menu').addClass('sticky');
	    }
	    else {
	        $('.toggle-menu').removeClass('sticky');
	    }
	});
	$(window).scroll(function(){
		var sticky = $('.sticky-header'),
		scroll = $(window).scrollTop();

		if (scroll >= 100) sticky.addClass('fixed-header');
		else sticky.removeClass('fixed-header');
	});
	$(window).load(function() {
		$(".tg-loader").delay(2000).fadeOut("slow");
	    $("#overlayer").delay(2000).fadeOut("slow");
	});
	$(window).load(function() {
		$(".preloader").delay(2000).fadeOut("slow");
	    $(".preloader .preloader-container").delay(2000).fadeOut("slow");
	});

	// back to top.
	$( window ).scroll( function() {
		if ( $( this ).scrollTop() > 200 ) {
			$( '.back-to-top' ).addClass( 'show-back-to-top' );
		} else {
			$( '.back-to-top' ).removeClass( 'show-back-to-top' );
		}
	});
	$( '.back-to-top' ).click( function() {
		$( 'html, body' ).animate( { scrollTop : 0 }, 200 );
		return false;
	});
});

function medical_hospital_trapFocus( element, namespace ) {
    var medical_hospital_focusableEls = element.find( 'a, button' );
    var medical_hospital_firstFocusableEl = medical_hospital_focusableEls[0];
    var medical_hospital_lastFocusableEl = medical_hospital_focusableEls[medical_hospital_focusableEls.length - 1];
    var KEYCODE_TAB = 9;

    medical_hospital_firstFocusableEl.focus();

    element.keydown( function(e) {
        var isTabPressed = ( e.key === 'Tab' || e.keyCode === KEYCODE_TAB );

        if ( !isTabPressed ) { 
            return;
        }

        if ( e.shiftKey ) /* shift + tab */ {
            if ( document.activeElement === medical_hospital_firstFocusableEl ) {
                medical_hospital_lastFocusableEl.focus();
                e.preventDefault();
            }
        } else /* tab */ {
            if ( document.activeElement === medical_hospital_lastFocusableEl ) {
                medical_hospital_firstFocusableEl.focus();
                e.preventDefault();
            }
        }

    });
}