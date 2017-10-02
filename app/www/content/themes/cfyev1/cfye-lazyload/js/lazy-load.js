/*(function($) {
	//lazy_load_init();
	//$( 'body' ).bind( 'post-load', lazy_load_init ); // Work with WP.com infinite scroll
	
	$(window).on('statechangecomplete', function () {
		
	});
	
	/*function lazy_load_init() {
		$( 'img[data-lazy-src]' ).bind( 'scrollin',{ distance: 	0 }, function() {
			lazy_load_image( this );			
		});
		// We need to force load gallery images in Jetpack Carousel and give up lazy-loading otherwise images don't show up correctly
		$( '[data-carousel-extra]' ).each( function() {
			$( this ).find( 'img[data-lazy-src]' ).each( function() {
				lazy_load_image( this );
			} );		
		} );
	}

	function lazy_load_image( img ) {
		var $img = jQuery( img ),
			src = $img.attr( 'data-lazy-src' );

		$img.unbind( 'scrollin' ) // remove event binding
			.hide()
			.removeAttr( 'data-lazy-src' )
			.attr( 'data-lazy-loaded', 'true' );

		img.src = src;
		$img.fadeIn();
	};

	function isImageInViewPort(elem) {
		var $elem = $(elem);
		// Get the scroll position of the page.
		var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html');
		var viewportTop = $(scrollElem).scrollTop();
		var viewportBottom = viewportTop + $(window).height() + 300;
		// Get the position of the element on the page.
		var elemTop = Math.round($elem.offset().top);
		var elemBottom = elemTop + $elem.height();
		return ((elemTop < viewportBottom) && (elemBottom > viewportTop));
	};

	// Check if it's time to load the image
	checkImage = function() {
		var $elem = $('img[data-lazy-src]');
		$elem.each(function () {
			var $singleElement = $(this);
			// If the animation has already been started
			if (isImageInViewPort($singleElement)) {
				// Start the animation
				lazy_load_image( this );
			}
		});
	};



	$.fn.scrolled = function (waitTime, fn) {
    	var tag = "scrollTimer";
	    this.scroll(function () {
	        var self = $(this);
	        var timer = self.data(tag);
	        if (timer) {
	            clearTimeout(timer);
	        }
	        timer = setTimeout(function () {
	            self.data(tag, null);
	            fn();
	        }, waitTime);
	        self.data(tag, timer);
	    });
	}



	
})(jQuery);

jQuery(document).ready(function ($) {
	$(window).scrolled(50, function() {				
		checkImage();
	});		
	
});*/