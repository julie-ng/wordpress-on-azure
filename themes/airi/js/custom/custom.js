/* Sticky menu */
(function($) {

	function stickyHeader() {
		if ( matchMedia( 'only screen and (min-width: 1024px)' ).matches ) {

			$('.menuStyle1.sticky-header:not(.admin-bar) .site-header, .menuStyle2.sticky-header:not(.admin-bar) .site-header').sticky({
				topSpacing: 0,
				responsiveWidth: true
			});

			$('.menuStyle1.sticky-header.admin-bar .site-header, .menuStyle2.sticky-header.admin-bar .site-header').sticky({
				topSpacing: 32,
				responsiveWidth: true
			});

			$('.menuStyle4.sticky-header .main-navigation').sticky({
				topSpacing: 15,
				responsiveWidth: true
			});			

			$('.menuStyle3.sticky-header.admin-bar .bottom-bar').sticky({
				topSpacing: 32,
				responsiveWidth: true
			});		
			$('.menuStyle3.sticky-header:not(.admin-bar) .bottom-bar').sticky({
				topSpacing: 0,
				responsiveWidth: true
			});

			$('.menuStyle5.sticky-header.admin-bar .site-header').sticky({
				topSpacing: 32,
				responsiveWidth: true
			});
			$('.menuStyle5.sticky-header:not(.admin-bar) .site-header').sticky({
				topSpacing: 0,
				responsiveWidth: true
			});

			var menuHeight = $( '.main-navigation' ).outerHeight();
			$( '.menuStyle4 #site-navigation-sticky-wrapper, .menuStyle4 .main-navigation' ).css( 'margin-bottom', -(menuHeight/2 + 30) );

			var headerHeight = $('.site-header').outerHeight();
			$('#masthead-sticky-wrapper').css('min-height', headerHeight);

			//Help Edge with handling the menu background color
			$window = $(window);
			$window.scroll(function() {
				if ( $window.scrollTop() <= 0 ) {
					$('.menuStyle1 .sticky-wrapper').removeClass('is-sticky');
				} else {
					$('.menuStyle1 .sticky-wrapper').addClass('is-sticky');
				}
			});

		} else {
			$('.sticky-header .site-header, .sticky-header .main-navigation, .sticky-header .bottom-bar').unstick();
		}
	}
	stickyHeader();
	$(window).on('resize', stickyHeader );

})( jQuery );



/* Mobile menu */
(function($) {

	// Mobile menu navigation toggle
	// Add .mobile-menu-active class to body when mobile menu is toggled
	// With that class hide/show mobile menu overlay
	$( '.site-header' ).on( 'click', '.mobile-menu-toggle', function( e ) {
		e.preventDefault();
		$( 'body' ).toggleClass( 'mobile-menu-active' );
	} );


	$( '.main-navigation' ).on( 'click', 'li a', function( e ) {
		if ( $( 'body' ).hasClass( 'mobile-menu-active' ) ) {
			$( 'body' ).removeClass( 'mobile-menu-active' );
		}
	} );

	// Add dropdown arrow to <li> elements that contain sub-menus
	var hasChildMenu = $( '.main-navigation' ).find('li:has(ul)');
	hasChildMenu.children('a').after('<span class="subnav-toggle"></span>');

	// Mobile sub-menus toggle action
	$( '.main-navigation' ).on( 'click', '.subnav-toggle', function( e ) {
		e.preventDefault();
		$( this ).toggleClass( 'open' ).next( '.sub-menu, .children' ).slideToggle();
	} );

})( jQuery );

/* Mobile menu */
(function($) {
	
	function mobileMenu() {
		if ( $('.site-header').length ) {
			var headerHeight = $( '.site-header' ).outerHeight();
			
			if ( matchMedia( '(max-width: 1199px)' ).matches ) {

				// Check if WordPress Admin bar is present and accomodate the extra spacing by pushing the mobile menu futher bellow
				if ( $('#wpadminbar').length ) {
					var wpadminbarHeight = $( '#wpadminbar' ).outerHeight();
					$( '.main-navigation' ).css( 'top', headerHeight + wpadminbarHeight - 1 );
				} else {
					$( '.main-navigation' ).css( 'top', headerHeight - 1 );
				}

			} else {
				$( '.main-navigation' ).css( 'top', 'auto' );
			}
		}
	}

	$(window).on('load resize', mobileMenu );

})( jQuery );


/* Header search toggle */
(function($) {

	var toggleButton = $( '.header-search-toggle' );

	if ( toggleButton.length ) {

		toggleButton.on("click", function(){
			$( '.header-search-form' ).slideToggle();
		});
	}

})( jQuery );