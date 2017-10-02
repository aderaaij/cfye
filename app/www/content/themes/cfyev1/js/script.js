/*jslint browser: true, regexp: true, sloppy: true, vars: true, white: true */
/*global $, jQuery*/
//If element exists check
jQuery.fn.exists = function () {
    return this.length > 0;
};

// Declare variables
var activeMenu = true,
    myFuncCalls = 0,
    navTease = false,
    flipped = false;

//Global functions
(function ($) {

    /* Clicktoggle function */
    $.fn.clickToggle = function (func1, func2) {
        var funcs = [func1, func2];
        this.data('toggleclicked', 0);
        this.click(function () {
            var data = $(this).data();
            var tc = data.toggleclicked;
            $.proxy(funcs[tc], this)();
            data.toggleclicked = (tc + 1) % 2;
        });
        return this;
    };

    /* Close menu */
    $.fn.closeMenu = function () {
        activeMenu = false;
        $('body').removeClass('active-menu');
        $('.logo-flip-container').removeClass('hover');
        window.setTimeout(function () {
            $("body").removeClass("overflow");
        }, 400);

        if (!Modernizr.csstransitions) {
            $('.site-header').animate({
                'margin-left': '-300'
            }, 'swing');
            $('.big-wrap').animate({
                'margin-right': '0',
                'opacity': '1'
            }, 'swing');
            $('.page-images-wrap').animate({
                'left': '0'
            });
        }
    }; // end closeMenu();

    /* open menu */
    $.fn.openMenu = function () {
        activeMenu = true;
        $('body').addClass('active-menu');
        //$('.logo-flip-container').addClass('hover');
        $('.navtease').removeClass('active-tease');
        window.setTimeout(function () {
            $("body").addClass("overflow");
        }, 400);
        //myFuncCalls++;
        //console.log( "I have been called " + myFuncCalls + " times" );
        if (!Modernizr.csstransitions) {
            $('.site-header').animate({
                'margin-left': '0'
            }, 'swing');
            $('.big-wrap').animate({
                'margin-right': '-300',
                'opacity': '.5'
            }, 'swing');
            $('.page-images-wrap').animate({
                'left': '300px'
            });
        }
    }; // end openMenu();

    /* Main Nav toggle function */
    $.fn.mainNavToggle = function () {
        this.bind("click", function () {
            if (!activeMenu) {
                $(window).openMenu();
            } else {
                $(window).closeMenu();
            }
        });
    };

    /**
     * Stop empty searches
     *
     * @author Thomas Scholz http://toscho.de
     * @param  $ jQuery object
     * @return bool|object
     */
    $.fn.preventEmptySubmit = function (options) {
        var settings = {
            inputselector: "#s",
            msg: "Your search query is empty"
        };
        if (options) {
            $.extend(settings, options);
        }
        this.submit(function () {
            var s = $(this).find(settings.inputselector);
            if (!s.val()) {
                alert(settings.msg);
                s.focus();
                return false;
            }
            return true;
        });
        return this;
    };
    /* Social Modal / popup window */
    $.fn.socialModal = function (options) {
        if (options) {
            $.extend(options);
        }
        this.click(function () {
            var width = 575,
                height = 400,
                left = ($(window).width() - width) / 2,
                top = ($(window).height() - height) / 2,
                url = this.href,
                opts = 'status=1' +
                    ',width=' + width +
                    ',height=' + height +
                    ',top=' + top +
                    ',left=' + left;
            window.open(url, 'share', opts);
            return false;
        });
    };

    /* FAQ functions */
    qaList = function () {
        if ($('.qa-list').exists()) {
            $('.qa-list-item').clickToggle(
                function () {
                    $(this).addClass('qa-active');
                },
                function () {
                    $(this).removeClass('qa-active');
                }
            );
        }
    };
    /* Fixed paged links, uses scrolltofixed.js */
    fixedPageLinks = function () {
        if ($('.page-links').exists()) {
            $('.page-links').scrollToFixed({
                marginTop: 0,
                limit: function () {
                    var limit = $('footer.entry-meta').offset().top - $('.page-links').outerHeight(true);
                    return limit;
                },
                dontSetWidth: true
            });
        }
    };

    /* Article navigation */
    articleNavigation = function () {
        $(document).scroll(function () {
            $singleNavLinks = $('.single-prev-next');

            if ($singleNavLinks.exists()) {
                var topContentHeight = $('.top-wrap').outerHeight(),
                    y = $(this).scrollTop(),
                    $singleNavLinks = $('.single-prev-next');
                if (y > topContentHeight * 0.6) {
                    $('.single-nav-prev').removeClass('slideOutLeft');
                    $('.single-nav-next').removeClass('slideOutRight');
                } else {
                    $('.single-nav-prev').addClass('slideOutLeft');
                    $('.single-nav-next').addClass('slideOutRight');
                }
                if ($singleNavLinks.offset().top + $singleNavLinks.height() >= $('footer.entry-meta').offset().top - 10) {
                    $singleNavLinks.css({
                        'position': 'absolute',
                        'top': 'auto',
                        'bottom': '10px'
                    });

                }
                if ($(this).scrollTop() + window.innerHeight < $('footer.entry-meta').offset().top + ($(window).height() / 2) + -80) {
                    $singleNavLinks.css({
                        'position': 'fixed',
                        'bottom': 'auto',
                        'top': '50%'
                    });
                }
            }
        }); // end documetn scroll Functions
        // end if nav-links exist
    }; //topTreshold();

    /* Single slideshow - uses CarouFredsel */
    function singleSlideshow() {
        var $carousel = $('.single-carousel');
        $carousel.fadeIn();
        // Start the Carousel   
        $carousel.carouFredSel({
            width: '100%',
            height: '100%',
            //pagination:'#slide-pager',
            responsive: false,
            items: {
                visible: 1,
                width: '100%',
                height: '100%'
            },
            auto: false,
            scroll: {
                easing: "linear",
                duration: 300
            },
            next: {
                button: ".next-slide",
                key: "right",

                fx: "cover-fade"
            },
            prev: {
                button: ".prev-slide",
                key: "left",
                fx: "uncover-fade"
            }
        });
    }

    /* Call thumbimags */
    thumbImageCall = function () {
        if ($('.top-content-wrap').exists()) {
            $('.top-content').waitForImages(function () {
                $('.top-content').addClass('loaded');
                $('.img-preloader').fadeOut(100);
            });
        }
    };

    // Call the Slideshow after background-images are loaded
    slideShowCall = function () {
        if ($('.single-carousel').exists()) {
            $('.single-carousel').waitForImages(function () {
                singleSlideshow();
                $('.preloader').hide();
            });
        }
    };

    /* Prevent default big click */
    preBigClick = function () {
        $('.big-wrap').click(function () {
            if (activeMenu) {
                $(window).closeMenu();
                $('.big-wrap a').click(function () {
                    return false;
                });
            }
        });
    };

    //Toggle page list on paginated articls
    pageListToggle = function () {
        var pageLinksOpen = false;
        if ($('.page-links').exists()) {
            $('.pageLinksToggle').click(function () {
                if (!pageLinksOpen) {
                    $('.subpage-list').css({
                        'right': '0',
                        'opacity': '1'
                    });
                    $('.single-nav-next').css('right', '100px');
                    pageLinksOpen = true;
                } else {
                    $('.subpage-list').css({
                        'right': '-64px'
                    });
                    $('.single-nav-next').css('right', '15px');
                    pageLinksOpen = false;
                }
            });
        }
    };

    /* Lazy load images */
    function lazy_load_image(img) {
        var $img = jQuery(img),
            src = $img.attr('data-lazy-src');

        $img.unbind('scrollin') // remove event binding
        .hide()
            .removeAttr('data-lazy-src')
            .attr('data-lazy-loaded', 'true');

        img.src = src;
        $img.fadeIn();
    }
    /* If image is in viewport */
    function isImageInViewPort(elem) {
        var $elem = $(elem);
        // Get the scroll position of the page.
        var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') !== -1) ? 'body' : 'html');
        var viewportTop = $(scrollElem).scrollTop();
        var viewportBottom = viewportTop + $(window).height() + 300;
        // Get the position of the element on the page.
        var elemTop = Math.round($elem.offset().top);
        var elemBottom = elemTop + $elem.height();
        return ((elemTop < viewportBottom) && (elemBottom > viewportTop));
    }

    /* time to check image*/
    checkImage = function () {
        var $elem = $('img[data-lazy-src]');
        $elem.each(function () {
            var $singleElement = $(this);
            // If the animation has already been started
            if (isImageInViewPort($singleElement)) {
                // Start the animation
                lazy_load_image(this);
            }
        });
    };
    /* scrolled function*/
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
    };
}(jQuery));



// document ready
jQuery(document).ready(function ($) {

    // Set menu variable   
    var
    $menuToggle = $('.toggle-wrap'),
        searchInput = $('#s'),
        searchDefault = 'Search...',
        searchSubmit = $('#searchsubmit'),
        searchForm = $('#searchform');

    // call menu function
    $menuToggle.mainNavToggle();

    // Close menu after .8s on first load
    window.setTimeout(function () {
        $(window).closeMenu();
    }, 800);

    //Do stuff on Keydown
    $(document).on('keydown', function (e) {
        if (!$('.carousel-wrap').exists()) {
            if (!activeMenu) {
                if (e.keyCode === 37) { // left arrow       
                    $('.single-nav-prev a').click();
                }
                if (e.keyCode === 39) { // right-arrow          
                    $('.single-nav-next a').click();
                }
            }
        }
        if (e.keyCode === 27 && activeMenu) { // ESC
            $(window).closeMenu();
        }
    });

    //add animated class to frontpage post
    $('.frontpage-post').addClass('animate');

    // Let IE users hide the chromeframe/warning
    $('.hidethis').click(function () {
        $('.chromeframe').hide();
    });

    // Initialize article navigaiton function
    articleNavigation();

    //initialize social modals on facebook/twitter shares
    $('.facebook-share a').socialModal();
    $('.twitter-share a').socialModal();

    //Initialize FAQ list
    qaList();

    // Prevent default click action on big-wrap
    preBigClick();

    // set global navtease variable

    // Show navtease stuff only on desktop / non-touchscreen
    if (!Modernizr.touch) {
        //Show navigation teaser
        $menuToggle.mouseenter(function () {
            if (!activeMenu) {
                $('.navtease').addClass('active-tease');
                navTease = true;
            }
        });
        // Hide nav tease only when leaving through left or right
        $menuToggle.mouseleave(function (e) {
            if (e.offsetX < 0 || e.offsetX > $(this).width()) {
                $('.navtease').removeClass('active-tease');
                navTease = false;
            }
        });

        // Prepend navigation to navtease container to show a teaser
        $('.nav').clone().prependTo(".navtease");

        // Show entire navigation when hovering from menu-toggle icon to nav-tease
        $('.navtease .nav').mouseover(function () {
            $(window).openMenu();
            $('.logo-flip-container').addClass('hover');
            $('.navtease').removeClass('active-tease');
        });

        // Hide the nav tease on hovering the main-content
        $('.big-wrap').mouseenter(function () {
            if (navTease) {
                $('.navtease').removeClass('active-tease');
                navTease = false;
            }
        });
    }

    //Fixed pagination on paginated articles
    fixedPageLinks();
    // Toggle fixed pagination list
    pageListToggle();

    //Search input replace function
    searchInput.val(searchDefault);

    searchInput.click(function () {
        if ($(this).val() === searchDefault) {
            $(this).val('');
        }
    });
    searchSubmit.click(function () {
        if (searchInput.val() === searchDefault) {
            searchInput.val('');
        }
    });
    searchInput.blur(function () {
        if ($(this).val() === '') {
            $(this).val(searchDefault);
        }
    });
    searchForm.preventEmptySubmit();

    // Check if element is onscreen - https://github.com/silvestreh/onScreen
    checkIfOnScreen_cfye = function () {
        $('.artist-thumb-wrap').onScreen({
            container: window,
            direction: 'vertical',
            doIn: function () {
                // Do something to the matched elements as they come in
                flipTease();
            },
            doOut: function () {
                // Do something to the matched elements as they get off screen
                $('.flip-container').removeClass('hover');
            },
            tolerance: 250,
            toggleClass: true,
            lazyAttr: null,
            lazyPlaceholder: 'someImage.jpg',
            debug: false
        });
        $('.related-article').onScreen({
            container: window,
            direction: 'vertical',
            doIn: function () {
                // Do something to the matched elements as they come in
                $(this).addClass('in-focus');
            },
            doOut: function () {
                // Do something to the matched elements as they get off screen
                $(this).removeClass('in-focus');
            },
            tolerance: 250,
            toggleClass: true,
            lazyAttr: null,
            lazyPlaceholder: 'someImage.jpg',
            debug: false
        });
        // Load blockquotes on scroll
        $('.article-entry-content blockquote p').onScreen({
            container: window,
            direction: 'vertical',
            doIn: function () {
                // Do something to the matched elements as they come in
                $(this).addClass('blockloaded');
            },
            doOut: function () {
                // Do something to the matched elements as they get off screen
                $(this).removeClass('blockloaded');
            },
            tolerance: 250,
            toggleClass: true,
            lazyAttr: null,
            debug: false
        });
           /*  var $elem = $('.article-wrap img[data-lazy-src]');
          $elem.onScreen({
            container: window,
            direction: 'vertical',
            doIn: function () {      
            $(this).addClass('loaded');         
            },
            doOut: function () {                
            },
            tolerance: 0,
            toggleClass: true,
            lazyAttr: 'data-lazy-src',
            debug: false
        });*/
    };


    // Artist flip thumbnail    
    flipTease = function () {
        if (!flipped) {
            setTimeout(function () {
                flipped = true;
                $('.flip-container').addClass('hover');
                $('.social-icon').addClass("active");
            }, 300);
        }
        setTimeout(function () {
            $('.flip-container').removeClass('hover');
            $('.social-icon').removeClass("active");
            flipped = false;
        }, 1500);

    };

    // flip artist profile picture on hover
    $('.artist-thumb-wrap').hover(function () {
        if (!flipped) {
            $(this).children('.flip-container').addClass('hover');
            $(this).find('li').addClass('active');
            flipped = true;
        }
    }, function () {
        if (flipped) {
            $(this).children('.flip-container').removeClass('hover');
            $(this).find('li').removeClass('active');
            flipped = false;
        }
    });
    checkIfOnScreen_cfye();

    // Capture scroll events
    $(window).scrolled(10, function () {
        checkImage();
        //checkAnimation();
    });

    //fitvids
    $(".top-content").fitVids();
    $('.article-wrap').fitVids();
    //$('.single-video-wrap').fitVids();    
    if ($('.dotdot').exists()) {
        $(".dotdot").dotdotdot({
            //  configuration goes here
            ellipsis: '... ',
            wrap: 'word',
            watch: true
        });
    }


    // get the amount of page likes for the nav-menu counter
    function getPageLikes() {
        jQuery('.fb-pagecounter').each(function () {
            var currentdiv = jQuery(this);
            var url = currentdiv.attr('rel');
            jQuery.getJSON('http://graph.facebook.com/' + url, function (data) {
                currentdiv.text((data.likes || 0));
            });
        });
    }
    getPageLikes();

}); //end document ready 

//Execute on load
(function ($) {
    function resizePostImg() {
        var postImage = $('pre img');
        postImage.each(function () {
            var imageHeight = $(this).height();
            var imageWidth = $(this).width();

            if (imageHeight > imageWidth) {
                $(this).addClass('portrait');
            }
        });
    }
    $(window).load(function () {
        //load slideshow function when all images are loaded
        $('.entry-content').waitForImages(function () {
            resizePostImg();
        });
    });
}(jQuery));


(function ($) {
    //get all content images and put in collection
    function wrapImages() {
        var collection = [];
        $('.wp-caption').each(function () {
            var nextBox = $(this).next().hasClass('alignright');
            collection.push($(this));
            if (!nextBox) {
                var container = $('<div class="collection"></div>');
                container.insertBefore(collection[0]);
                for (i = 0; i < collection.length; i++) {
                    collection[i].appendTo(container);
                }
                collection = [];
            }
            $('.wp-caption').css('width', '');
        });
        $('.collection').equalize('innerHeight');
        $('.collection').each(function () {
            if ($(this).next().hasClass('collection')) {
                $(this).addClass('content-grid');
            }
            if ($(this).prev('.collection').hasClass('content-grid')) {
                $(this).addClass('content-grid-last');
            }
        });
    }

    $('.single-video-wrap').append('<div class="preloader"></div>');
    $('.carousel-wrap').append('<div class="preloader"></div>');
    $('.top-content-wrap').append('<div class="img-preloader"></div>');
    //declare slideshow function

    function getTweets() {
        jQuery('.tw-counter').each(function () {
            var currentdiv = jQuery(this);
            var url = currentdiv.attr('rel');
            jQuery.getJSON('https://cdn.api.twitter.com/1/urls/count.json?url=' + url + '&callback=?', function (data) {
                currentdiv.text((data.count || 0));
            });
        });
    }
    getTweets();

    function getLikes() {
        jQuery('.fb-counter').each(function () {
            var currentdiv = jQuery(this);
            var url = currentdiv.attr('rel');
            jQuery.getJSON('http://graph.facebook.com/' + url, function (data) {
                currentdiv.text((data.shares || 0));
            });
        });
    }
    getLikes();

    // Functions to load when Window is completely loaded
    $(window).load(function () {
        slideShowCall();
        $('.big-wrap').waitForImages(function () {
            wrapImages();
        });
        thumbImageCall();
    }); // end load function    

    // Functions to call on statechange complete
    $(window).on('statechangecomplete', function () {
        //Loaders 
        $('.carousel-wrap').append('<div class="preloader"></div>');
        $('.top-content-wrap').append('<div class="img-preloader"></div>');
        $('.big-wrap').waitForImages(function () {
            wrapImages();
        });
        $('.single-video-wrap').append('<div class="preloader"></div>');
        // Change width of wp-caption
        $('.wp-caption').css('width', '');

        $('.artist-thumb-wrap').hover(function () {
            $(this).children('.flip-container').toggleClass('hover');
            $(this).find('li').toggleClass('active');
        });
        // Youtube style loading bar - http://www.ynh.io/2013/05/24/rebuild-youtubes-progress-bar.html# //End loading animation
        $(document).ajaxComplete(function () {
            //End loading animation
            $("#progress").width("101%").delay(200).fadeOut(400, function () {
                $(this).remove();
            });
        });
        $('.facebook-share a').socialModal();
        $('.twitter-share a').socialModal();
        // fitvids
        $(".top-content").fitVids();
        $('.article-wrap').fitVids();
        // callback global functions
        thumbImageCall();
        preBigClick();
        if (activeMenu) {
            $(window).closeMenu();
        }
        slideShowCall();
        getTweets();
        getLikes();
        articleNavigation();
        fixedPageLinks();
        pageListToggle();
        qaList();
        checkIfOnScreen_cfye();
        
    }); // end statechangecomplete

}(jQuery));