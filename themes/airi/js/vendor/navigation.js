/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();




(function ($) {

	var aThemesIconBoxCarouselrun = function ($scope, $) {

		$('.athemes-iconbox-carousel').not('.slick-initialized').slick({
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: true
		});    		
	};

	var aThemesTestimonialsCarouselrun = function ($scope, $) {

		$('.testimonials-section.style1 .athemes-testimonials-carousel, .testimonials-section.style3 .athemes-testimonials-carousel').not('.slick-initialized').slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			prevArrow: $('.testimonials-arrows .prev'),
			nextArrow: $('.testimonials-arrows .next')
		});    	

		$('.testimonials-section.style2 .athemes-testimonials-carousel').not('.slick-initialized').slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
		});

		$('.athemes-testimonials-carousel-nav').not('.slick-initialized').slick({
			infinite: true,
			slidesToShow: 5,
			slidesToScroll: 1,
			arrows: true,
			focusOnSelect: true,
			asNavFor: '.testimonials-section.style2 .athemes-testimonials-carousel',
			centerMode: true
		});

	};    

    var aThemesPortfoliorun = function ($scope, $) {
	   if ( $('.athemes-project-wrap').length ) {

	      $('.athemes-project-wrap').each(function() {

	        var self       = $(this);
	        var filterNav  = self.find('.project-filter').find('a');

	        var projectIsotope = function($selector) {
		        $selector.isotope({
		            filter: '*',
		            itemSelector: '.project-item',
		            percentPosition: true,
		            animationOptions: {
		                duration: 750,
		                easing: 'liniar',
		                queue: false,
		            }
		        });
	        }

	        self.children().find('.isotope-container').imagesLoaded( function() {
				projectIsotope( self.children().find('.isotope-container').parent().removeClass('loading') );	        	
				projectIsotope( self.children().find('.isotope-container') );
	        });

	        $( document ).ready(function() {
				projectIsotope( self.children().find('.isotope-container').parent().removeClass('loading') );	        	
				projectIsotope( self.children().find('.isotope-container') );
	        });

	        filterNav.click(function(){
	            var selector = $(this).attr('data-filter');
	            filterNav.removeClass('active');
	            $(this).addClass('active');

	            self.find('.isotope-container').isotope({
	                filter: selector,
	                animationOptions: {
	                    duration: 750,
	                    easing: 'liniar',
	                    queue: false,
	                }
	            });

	            return false;

	        });

	      });

	    }
    };

	var aThemesShopGridrun = function ($scope, $) {     
    
		// Categories
		var $categoryWrap = $( '.shop-cats-grid' ),
			$categoryIsotope = function() {
				$categoryWrap.isotope( {
					itemSelector: '.cats-grid-item',
					percentPosition: true,
					masonry: {
						columnWidth: '.cats-grid-item'
					}
				} );
			};

		if ( $.fn.imagesLoaded ) {
			$categoryWrap.imagesLoaded( $categoryIsotope );
		} else {
			$categoryIsotope.apply( this );
		}

    };

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/athemes-iconbox-carousel.default', aThemesIconBoxCarouselrun);
		elementorFrontend.hooks.addAction('frontend/element_ready/athemes-testimonials-carousel.default', aThemesTestimonialsCarouselrun);
		elementorFrontend.hooks.addAction('frontend/element_ready/athemes-portfolio.default', aThemesPortfoliorun);
		//elementorFrontend.hooks.addAction('frontend/element_ready/athemes-categories-grid.default', aThemesShopGridrun);		
	});

})(jQuery);