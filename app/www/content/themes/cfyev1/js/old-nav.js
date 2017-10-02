	
// Navigation 	
	$('.site-header').scrollToFixed({
		dontSetWidth: true
	});

	//Menu actions on sroll and hover
	//declare variables
	var $fixednav = $('.site-header');
	var $nav = $('.main-navigation');
	var $navtoggle = $('.nav-opener')
	var $submenu = $('.dropdown-menu');
	
	function headerHide() {
		$fixednav.css({
			'opacity': '0.5',
			'background-color': 'transparent'
		}),
		$nav.css( {
			'margin-left': '-100%'
		}),
		$('.top-level').removeClass('open'),
		$navtoggle.css('margin-left','0');
	}

	function headerShow() {
		$fixednav.css({
			'opacity': '1',
			'background-color': '#ec008c'
		}, 200),
		  
		$nav.css({
			'margin-left': '0'
		}),
		$navtoggle.css('margin-left','-100%');
		if ($('body').hasClass('single')) {

		}
	}

	if ($('body').hasClass('single')) {
		headerHide();
	}
	
	//start scroll function	
	var $submenuHeight = $submenu.outerHeight();
	$submenu.css({
		'top':-$submenuHeight+'px'
	});

	$(window).scroll(function () {		
		var scrollTop = $(window).scrollTop();
		if (scrollTop != 0) {
			headerHide();
		}
		else {
			if (! $('body').hasClass('single')) {
				headerShow();
			}
		}
	});
	
	//start click function
	$('.nav-opener').click(	function (e) {		
		$fixednav.stop().css({
			'opacity': '1',
			'background-color': '#ec008c'
		}),			
		$nav.css({
			 'margin-left': '0'
		}),
	    $navtoggle.css('margin-left','-100%');		
	});	
	$('.nav-opener').hover(function (e) {		
		$fixednav.css({
			'opacity': '1'
		});		
	});
	
	
	// Infinite scroll

	if ($('.pagination').exists()) {
		var base2url = document.URL,  
		shortUrl=base2url.substring(base2url.lastIndexOf("/"),0);
		console.log(shortUrl);
		
		var currentPage = $('.next a').attr("href");
		currentPurl = currentPage.substring(currentPage.lastIndexOf("/"),0);
		console.log(currentPurl);

		var curNumber = currentPage.substring(currentPage.lastIndexOf("/") + 1);
		console.log(curNumber,'next selector');
		
		var curUrl = document.URL,
		curUrl = curUrl.substring(curUrl.lastIndexOf('/') + 1);
		
		console.log(curUrl,'cururl');
		// Infinite Scroll
		$('.big-wrap').infinitescroll({
			navSelector: ".pagination",
			// selector for the paged navigation (it will be hidden)
			nextSelector: ".next a",
			// selector for the NEXT link (to page 2)
			itemSelector: "article",
			// selector for all items you'll retrieve
			columnWidth:function (containerWidth) {
				return containerWidth / 5;
			},
			animate: false,
			debug: true,
			state: {
				currPage: curNumber - 1
			},
			pathParse: function() {
					return [currentPurl+'/', '']
				},
			loading: {
				finishedMsg: "<em>You seem to have reached the end!</em>",
				img: '/wp-content/themes/cfyev1/img/285.gif',
			},			
   
		},
		function (newElements, data, url) {
			var newTitle = "A new title!";
			if (window.history) {				
				history.pushState('', '',url);
			}
			loadFacebook();
			loadTwitter();	
			socialModal();
			getLikes();
			$('.frontpage-post').delay(1200).addClass('animate');
		}	

	);
}