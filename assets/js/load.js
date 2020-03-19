(function() {
    'use strict';

    var d = document,

        // Remove 300ms click delay on mobile devices by using touchstart event
        // Usage: $(selector).on(pointer, (function() { });
        pointer = (('ontouchstart' in window) || window.DocumentTouch && d instanceof window.DocumentTouch) ? 'touchstart' : 'click',

        // Check if CSS property supported http://lea.verou.me/2009/02/check-if-a-css-property-is-supported/
        isSupported = function(property) {
            return property in document.body.style;
        },

        init  = true,
        state = window.history.pushState !== undefined,

        $nav     = $('#main-nav'),
        $content = $('#main-content'),
        $status  = $('.js-status'),

        // Google Universal Analytics tracking
        tracker = function() {
            if (typeof ga !== 'undefined') {
                return ga && ga('send', 'pageview', {
                    page: decodeURI(window.location.pathname)
                });
            }
        },
        $this, request, fadeTimer,
        stateLink = function(e, className) {
            $nav.each(function() {
                $this = $(this);

                if ($this.attr('href') === decodeURI($.address.state() + e.path).replace(/\/\//, '/')) {
                    $this.addClass(className).focus();
                } else {
                    $this.removeClass(className);
                }
                if ($status.hasClass('show')) $status.removeClass('show show-header show-footer');
            });
        },
        handler = function(data) { // Response
            if ($status.hasClass('start')) $status.addClass('done');

            d.title = data.pagetitle;
            $content.html(data.content);
            tracker();
        };

    // Avoid console.log error on legacy browsers
    if (!window.console) {
        window.console = {
            log: function() {}
        };
    }

    $(d).on('webkitTransitionEnd transitionend', '.js-status.done .progress', function() {
        $status.removeClass('start done');
    });

    function toggle(event, remove, add) {
        event.stopPropagation();
        $status.removeClass(remove).toggleClass(add);
        if ($status.hasClass('show-header') || $status.hasClass('show-footer')) {
            $status.addClass('show');
        } else {
            $status.removeClass('show');
        }
    }

    $('.js-header').on(pointer, function(e){
        toggle(e, 'show-footer', 'show-header');
    });
    $('.js-footer').on(pointer, function(e){
        toggle(e, 'show-header', 'show-footer');
    });

    if (window.matchMedia) {
        // https://developer.mozilla.org/en-US/docs/Web/Guide/CSS/Testing_media_queries
        var matchMedia = window.matchMedia('(max-width: 532px)'),
            cleanStatus = function() {
                if (matchMedia.matches) {
                    $(d).on(pointer, function(){
                        if ($status.hasClass('show')) $status.removeClass('show show-header show-footer');
                    });
                } else {
                    $(d).off(pointer);
                    $status.removeClass('show show-header show-footer');
                }
            };

        cleanStatus();
        matchMedia.addListener(cleanStatus);
    }

    $.address.state('/namtri/site/').init(function() {
        // Initialize jQuery Address
        $nav.address();
    }).change(function(e) {
	
        if (state && init) {
			
            init = false;
        } else {
		
            // Halt previously created request
            if (request && request.readyState !== 4) request.abort();

            stateLink(e, 'selected');

            // Load API content
            request = $.ajax({
                url: '/seo2/api' + (e.path.length !== 1 ? '/' + encodeURI(e.path.substr(1)) : ''),
                //dataType: 'jsonp',
                //jsonpCallback: 'foo',
                //cache: true,
                beforeSend: function() {
						
                    if (isSupported('transition')) $status.removeClass('start done');

                    fadeTimer = setTimeout(function() {
                        if (isSupported('transition')) $status.addClass('start');
                    }, 100); // Avoid fadeTimer() if content already in cache
                },
                success: function(data) {
                    if (fadeTimer) clearTimeout(fadeTimer);

                    $nav.removeClass('selected');
                    stateLink(e, 'active');
                    handler(data);
                },
                error: function(jqXHR, textStatus) {
                    if (fadeTimer) {
                        clearTimeout(fadeTimer);
                        if (isSupported('transition')) $status.removeClass('start done');
                        $nav.removeClass('active selected').blur();
                    }
                    if (textStatus !== 'abort') {
                        console.log(textStatus);

                        if (textStatus === 'timeout') $content.html('Loading seems to be taking a while...');
                        $nav.removeClass('selected');
                        d.title = 'Page not found';
                        $content.html('<h1>404 Not Found</h1><p>Sorry, this page cannot be found.</p>');
                        tracker();
                    }
                }
            });
        }
    });

    // Bind whatever event to Ajax loaded content
    //$(d).on('click', '.js-as', function(e) {
    //    console.log(e.target);
    //});
})();