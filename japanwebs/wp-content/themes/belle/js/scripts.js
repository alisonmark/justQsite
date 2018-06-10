"use strict";

/*************************************************************
SCRIPTS INDEX

ISOTOPE: INIT
ISOTOPE: MASONRY GALLERY FILTER MENU
FLEXSLIDER INIT
FANCYBOX INIT
OWL CAROUSEL: MORE POSTS CAROUSEL
OWL CAROUSEL: FEATURE BLOCK CAROUSEL
OWL CAROUSEL: PREV/NEXT NAV
MINOR PLUGINS INIT
		// FITVIDS
 	  	// STELLAR PARALLAX
		// EMBED SCROLL PROTECT
		// MACTHHEIGHT
SIDR RESPONSIVE MENU
SLIDER NAVIGATION ON HOVER ONLY
TOGGLE
ACCORDION
ARCHIVE PAGINATION
		PREVNEXT AJAX
		LOADMORE AJAX
COUNTDOWN
CLICKABLE BACKGROUND
STICKY HEADER
	SCROLL TO ANCHOR
	SEARCH BUTTON
SEARCH AUTOCOMPLETE
@FONT-FACE FIX
MENU ANIMATION
RATINGS BAR
USER RATING
INFO BOX LIST CHECK
POST LIKE BUTTON
HOVERBOX VALIGN CONTENT
FEATURE BLOCK: POST GRID ANIMATION
SET NEGATIVE MARGIN FOR OVERLAY-HEADER CLASS + APPLY IS-OVERLAID-HEADER CLASS
SET NEGATIVE MARGIN FOR OVERLAY-CONTENT CLASS
BACK TO TOP
POLLS

*************************************************************/


  

/*************************************************************
ISOTOPE: INIT
*************************************************************/

	jQuery(document).ready(function($) {

		// ISOTOPE MASONRY LAYOUT
		if ($('.main-isotope-container.isotope-masonry-layout').size() > 0) {
			$('.main-isotope-container.isotope-masonry-layout').isotope({
				itemSelector: '.single-item',
				masonry: {
				  gutter: '.gutter-sizer',
				  columnWidth: '.grid-sizer',
				},
			});
		}

		// ISOTOPE EVEN LAYOUT
		if ($('.main-isotope-container.isotope-even-layout').size() > 0) {
			$('.main-isotope-container.isotope-even-layout').isotope({
				itemSelector: '.single-item',
				layoutMode: 'fitRows',
				fitRows: {
				  gutter: '.gutter-sizer',
				  columnWidth: '.grid-sizer',
				},
			});
		}

		// ISOTOPE CLASSIC LAYOUT
		if ($('.main-isotope-container.isotope-classic-layout').size() > 0) {
			$('.main-isotope-container.isotope-classic-layout').isotope({
				itemSelector: '.single-item',
				layoutMode: 'fitRows',
			});
		}

		// ISOTOPE GALLERY MASONRY LAYOUT
		if ($('.page-masonry-gallery').size() > 0) {
			$('.page-masonry-gallery').isotope({
				itemSelector: '.gallery-item',
				layoutMode: 'masonry',
			});
		}

	});

	jQuery(window).load(function($) {

		$=jQuery;

		// bouncer
		if ($('.main-isotope-container').size() == 0 && $('.page-masonry-gallery').size() == 0) { return; }

		// RELAYOUT AFTER WINDOWS LOAD
		$('.main-isotope-container').isotope('layout');
		$('.page-masonry-gallery').isotope('layout');

	});

	

/*************************************************************
ISOTOPE: MASONRY GALLERY FILTER MENU
*************************************************************/

	jQuery(document).ready(function($) {
		if ($('.gallery-filter li').size() > 0) {
			
			//apply selected class to first menu item (show all)
			$('.gallery-filter li:eq(0) a').addClass('selected');

			$('.gallery-filter li a').on('click', function (event) {
				event.preventDefault();
				var $this = $(this);
				var thisGallerySelector = $this.closest('.gallery-filter').attr('data-associated_gallery_selector');
				var $this_gallery = $(thisGallerySelector);

				//update selected filter item
				$('.gallery-filter li a').removeClass('selected');
				$this.addClass('selected');


				var filterVar = $this.closest('li').attr('class');
				if ( (typeof filterVar == 'undefined') || (filterVar.indexOf('cat-item-all') != -1) )  {
					filterVar = "*";
				} else {
					filterVar = filterVar.split(' ');
					filterVar = "." + filterVar[1];
				}
				$this_gallery.isotope({ filter: filterVar});

			});

		}
	});



/*************************************************************
FLEXSLIDER INIT
*************************************************************/

	jQuery(window).load(function($){
		$ = jQuery;

		if ($('.flexslider-standard').size() > 0) {

			var canonAnimImgSliderSlidershow = (extData.canonOptionsAppearance['anim_img_slider_slideshow'] == 'checked') ? true : false;

			$('.flexslider-standard').flexslider({
				slideshow: canonAnimImgSliderSlidershow,
				slideshowSpeed: parseInt(extData.canonOptionsAppearance['anim_img_slider_delay']),
				animationSpeed: parseInt(extData.canonOptionsAppearance['anim_img_slider_anim_duration']),
				animation: "fade",
				smoothHeight: true,
				touch: true,
				controlNav: true,
				directionNav: true,
				prevText: "",
				nextText: "",
				start: function(slider){
					$('body').removeClass('loading');
				}
			});

		}

		if ($('.flexslider-quote').size() > 0) {

			var canonAnimQuoteSliderSlidershow = (extData.canonOptionsAppearance['anim_quote_slider_slideshow'] == 'checked') ? true : false;

			$('.flexslider-quote').flexslider({
				slideshow: canonAnimQuoteSliderSlidershow,
				slideshowSpeed: parseInt(extData.canonOptionsAppearance['anim_quote_slider_delay']),
				animationSpeed: parseInt(extData.canonOptionsAppearance['anim_quote_slider_anim_duration']),
				animation: "fade",
				smoothHeight: true,
				touch: true,
				controlNav: true,
				directionNav: false,
				prevText: "",
				nextText: "",
				start: function(slider){
					$('body').removeClass('loading');
				}
			});	 

		}

	});


/*************************************************************
FANCYBOX INIT
*************************************************************/

	//attach fanybox class to all image links
	jQuery(document).ready(function($) {
		$("a[href$='.jpg'],a[href$='.png'],a[href$='.gif']").attr('rel','gallery').addClass('fancybox');
	});

	//init fancybox
	jQuery(document).ready(function($) {

		// default fancybox
		if ($(".fancybox").size() > 0) {
			var canonLightboxColor = extData.canonOptionsAppearance['lightbox_overlay_color'];
			var canonLightboxOpacity = extData.canonOptionsAppearance['lightbox_overlay_opacity'];;

			$(".fancybox").fancybox({

				openEffect	: 'fade',	//fade, elastic, none
				closeEffect	: 'fade',
				openSpeed	: 'normal',	//slow, normal, fast or ms
				closeSpeed	: 'fast',

				helpers : {
			        overlay : {
			            css : {
			                'background' : jQuery.GlobalFunctions.hexOpacityToRgbaString(canonLightboxColor, canonLightboxOpacity)
			            }
			        }
			    }
			});
		}


		// media fancybox - same as fancybox but lets you open media links in lightbox and set a max height of 500px
		if ($(".fancybox-media").size() > 0) {
			var canonLightboxColor = extData.canonOptionsAppearance['lightbox_overlay_color'];
			var canonLightboxOpacity = extData.canonOptionsAppearance['lightbox_overlay_opacity'];;

			$(".fancybox-media").fancybox({

				openEffect	: 'fade',	//fade, elastic, none
				closeEffect	: 'fade',
				openSpeed	: 'normal',	//slow, normal, fast or ms
				closeSpeed	: 'fast',

				helpers : {
			        overlay : {
			            css : {
			                'background' : jQuery.GlobalFunctions.hexOpacityToRgbaString(canonLightboxColor, canonLightboxOpacity)
			            },
			        },
					media : {},
			    },

			    maxHeight: '500',

			});
		}

	});


/*************************************************************
OWL CAROUSEL: MORE POSTS CAROUSEL
*************************************************************/

	jQuery(document).ready(function($) {

		// bouncer
		if ($('.more-posts-carousel').size() == 0) { return; }

		var $morePostsCarousels = $('.more-posts-carousel');

		$morePostsCarousels.each(function (index) {
			var $this = $(this);
			var numItems = $this.attr('data-items');

			// responsive num items
			var numPostsDesktop = 4;
			var numPostsDesktopSmall = 3;
			var numPostsTablet = 2;
			var numPostsMobile = 1;
			if (numItems < numPostsDesktop) { numPostsDesktop = numItems; }
			if (numItems < numPostsDesktopSmall) { numPostsDesktopSmall = numItems; }
			if (numItems < numPostsTablet) { numPostsTablet = numItems; }
			if (numItems < numPostsMobile) { numPostsMobile = numItems; }


			$this.owlCarousel({
				items: numItems,
				itemsDesktop: [1199,numPostsDesktop],
				itemsDesktopSmall: [979,numPostsDesktopSmall],
				itemsTablet: [768,numPostsTablet],
				itemsMobile: [479,numPostsMobile],
				pagination: false,
			});		
		});

	});


/*************************************************************
OWL CAROUSEL: FEATURE BLOCK CAROUSEL
*************************************************************/
	
	jQuery(document).ready(function($) {


		if ($('.block-carousel').size() == 0) { return; }

		// for each block-carousel read settings and init
		$('.block-carousel').each(function(index){
			var $this = $(this);
			var numItems = parseInt($this.attr('data-display_num_posts'));
			var autoPlay = ($this.attr('data-autoplay_speed') === "0") ? false : parseInt($this.attr('data-autoplay_speed'));
			var stopOnHover = ($this.attr('data-stop_on_hover') == 'checked') ? true : false;
			var pagination = ($this.attr('data-pagination') == 'checked') ? true : false;

			// responsive num items
			var numPostsDesktop = 4;
			var numPostsDesktopSmall = 3;
			var numPostsTablet = 2;
			var numPostsMobile = 1;
			if (numItems < numPostsDesktop) { numPostsDesktop = numItems; }
			if (numItems < numPostsDesktopSmall) { numPostsDesktopSmall = numItems; }
			if (numItems < numPostsTablet) { numPostsTablet = numItems; }
			if (numItems < numPostsMobile) { numPostsMobile = numItems; }

			$this.owlCarousel({
				items: numItems,
				itemsDesktop: [1199,numPostsDesktop],
				itemsDesktopSmall: [979,numPostsDesktopSmall],
				itemsTablet: [768,numPostsTablet],
				itemsMobile: [479,numPostsMobile],
				autoPlay: autoPlay,
				stopOnHover: stopOnHover,
				pagination: pagination,
			});

		});

	});

/*************************************************************
OWL CAROUSEL: PREV/NEXT NAV
*************************************************************/

	jQuery(document).ready(function($) {

		if ($('.owl-carousel-nav').size() == 0) { return; }

		$('.owl-carousel-nav .next-btn').on('click', function(event) {
			var $this = $(this);
			var $thisCarousel = $this.closest('.owl-carousel-nav').next('.owl-carousel');
			$thisCarousel.trigger('owl.next'); 
		});

		$('.owl-carousel-nav .prev-btn').on('click', function(event) { 
			var $this = $(this);
			var $thisCarousel = $this.closest('.owl-carousel-nav').next('.owl-carousel');
			$thisCarousel.trigger('owl.prev')	
		});

	});


/*************************************************************
MINOR PLUGINS INIT
*************************************************************/


	jQuery(document).ready(function($) {

		// FITVIDS
		$(".outter-wrapper").fitVids();

 	  	// STELLAR PARALLAX
		$(window).stellar({
	  		horizontalScrolling: false,
	  	});

		// EMBED SCROLL PROTECT
		$('.embed-scroll-protect').mbEmbedScrollProtect();


		// MACTHHEIGHT
		$('.isotope-even-layout .single-item .inner-wrapper').matchHeight(true);	
		$('.block-carousel .owl-item-boxed-content').matchHeight(false);


	});

/*************************************************************
SIDR RESPONSIVE MENU
*************************************************************/

	jQuery(document).ready(function($) {

		// SIDR
		$('.responsive-menu-button').sidr({
		    name: 'sidr-main',
		    source: '#sidr-navigation-container',
		    renaming: false,
		});
		$('#sidr-main .closebtn').click(function() {
		    $.sidr('close', 'sidr-main');
		});

	});

	jQuery(window).resize(function() {

		// SIDR CLOSE ON RESIZE
		jQuery.sidr('close', 'sidr-main');
		
	});



/*************************************************************
SLIDER NAVIGATION ON HOVER ONLY
*************************************************************/


	jQuery(window).load(function($) {
		$=jQuery;
		
		if ($('.flexslider ul.flex-direction-nav').size() > 0) {

			var $slidesNavArrows = $('.flex-direction-nav');
			$slidesNavArrows.hide();

			// uncomment these to also hide nav bullets
			// var $slidesNavBullets = $('.flex-control-nav.flex-control-paging');	
			// $slidesNavBullets.hide();

			// on slider hover
			$('.flexslider').hover(function () {
				var $this = $(this);
				var $thisSlideNavArrows = $this.find('.flex-direction-nav');
				$thisSlideNavArrows.fadeIn();

				// var $thisSlideNavBullets = $this.find('.flex-control-nav.flex-control-paging');
				// $thisSlideNavBullets.fadeIn();
			}, function() {
				var $this = $(this);
				var $thisSlideNavArrows = $this.find('.flex-direction-nav');
				$thisSlideNavArrows.hide();

				// var $thisSlideNavBullets = $this.find('.flex-control-nav.flex-control-paging');
				// $thisSlideNavBullets.hide();
			});

			//on navigation button hover
			$slidesNavArrows.hover(function () {
				var $this = $(this);
				var $thisSlideNavArrows = $this.find('.flex-direction-nav');
				$thisSlideNavArrows.show();
				
				// var $thisSlideNavBullets = $this.find('.flex-control-nav.flex-control-paging');
				// $thisSlideNavBullets.show();
			});

		}


	});

/*************************************************************
TOGGLE
*************************************************************/

	jQuery(document).ready(function($){

		if ($('.toggle-btn').size() > 0) {

			// initial states
			$('.toggle-content:not(.active)').hide();

			// toggle	  
			$('.toggle-btn').click(function(e){
				e.preventDefault();
				$(this).closest('li').find('.toggle-content').not(':animated').slideToggle();
				$(this).toggleClass("active");
			});
			
		}


	});


  


/*************************************************************
ACCORDION
*************************************************************/

	jQuery(document).ready(function($){

		if ($('.accordion-btn').size() > 0) {
			
			// initial states
			$('.accordion-content:not(.active)').hide();

			// accordion	  
			$('.accordion-btn').click(function(e){
				e.preventDefault();
				var $this = $(this);
				var $thisAccordionContent = $this.closest('li').find('.accordion-content');
				var currentStatus = "";
				if ($this.attr('class').indexOf('active') != -1) {
					currentStatus = "active";
				}
				//first close all and remove active class
				$this.closest('.accordion').find('li').each(function(index) {
					var $thisLi = $(this);
					$thisLi.find('.accordion-btn').removeClass('active');
					$thisLi.find('.accordion-content').slideUp('400', function() {
						$(this).removeClass('active');
					});
				});
				if (currentStatus != "active") {
					$thisAccordionContent.not(':animated').slideDown();
					$this.addClass('active');
					$thisAccordionContent.addClass('active');
				}
			});

		}
		
	});

	
/*************************************************************
ARCHIVE PAGINATION
*************************************************************/


	jQuery(document).ready(function($){

		/*************************************************************
		LINKS AJAX
		*************************************************************/

		if ($('.archive-pagination-links-ajax').size() > 0) { 

			// LINK CLICK
			$('body').on('click', '.archive-pagination-links-ajax a', function(e) {
				e.preventDefault();
				var $this = $(this);
				ajaxArchivePaginationFadeOut($this);
			});

		}


		/*************************************************************
		PREVNEXT AJAX
		*************************************************************/

		if ($('.archive-pagination-prevnext-ajax').size() > 0) { 

			// PREVNEXT CLICK
			$('body').on('click', '.archive-pagination-prevnext-ajax a', function(e) {
				e.preventDefault();
				var $this = $(this);
				ajaxArchivePaginationFadeOut($this);
			});

			// // DETECT ARROW KEYPRESS
			// document.onkeydown = mb_checkKey;


			// // DETECT ARROW KEYPRESS FUNCTION
			// function mb_checkKey(e) {
			//     e = e || window.event;
			// 	// console.log(e.keyCode);		// remember to put focus on window not on console.

			//     if (e.keyCode == '39') {
			//         $('.archive-pagination-prevnext-ajax .next a').click();
			//     }
			//     else if (e.keyCode == '37') {
			//         $('.archive-pagination-prevnext-ajax .prev a').click();
			//     }
			// }


		}


		function ajaxArchivePaginationFadeOut($this) {
			var fadeOutStyle = "all";

			if (fadeOutStyle == "all") {
				// settings
				var fadeOutSpeed = 800;
				var $target = $('.main-isotope-container');	// if you target multiple elements then the end of animation callback will also get called multiple times.

				$target.animate({
					opacity: 0,
				}, fadeOutSpeed, function() {
					ajaxArchivePaginationLoadLink($this);
				});

			}

			// FADEOUT NAV
			var navFadeSpeed = 800;
			$('.main-column .pagination').animate({
				opacity: 0,
			}, navFadeSpeed);

				
		}

		function ajaxArchivePaginationFadeIn() {

			var fadeInStyle = "all";

			if (fadeInStyle == "all") {
				// settings
				var fadeInSpeed = 1800;
				var $target = $('.main-isotope-container .single-item');

				$target.animate({
					opacity: 1,
				}, fadeInSpeed);

			}

			// FADEIN NAV
			var navFadeSpeed = 800;
			$('.main-column .pagination').animate({
				opacity: 1,
			}, navFadeSpeed);
				
		}
		

		// AJAX ARCHIVE PAGINATION LOAD LINK
		function ajaxArchivePaginationLoadLink($this) {
			var link = $this.attr('href');
			var link = link + " .main-column > *";
			var $contentContainer = $('.main-column');
			$contentContainer.height($contentContainer.height()); 	// temporarily fix height to avoid page jumping back to top.

			$contentContainer.load(link, function () {
				var $this = $(this);
				var $mainIsotopeContainer = $this.find('.main-isotope-container');
				
				// "hide" posts and nav
				$mainIsotopeContainer.find('.single-item').css('opacity',0);
				$('.main-column .pagination').css('opacity', 0);

				// FIT VIDS
				$mainIsotopeContainer.fitVids();

				// REINIT INSTAGRAM EMBED.JS
				instgrm.Embeds.process();

				// MATCH HEIGHT
				$('.isotope-even-layout .single-item .inner-wrapper').matchHeight(false);	
				
				// ISOTOPE MASONRY LAYOUT
				if ($('.main-isotope-container.isotope-masonry-layout').size() > 0) {
					$('.main-isotope-container.isotope-masonry-layout').isotope({
						itemSelector: '.single-item',
						masonry: {
							gutter: '.gutter-sizer',
							columnWidth: '.grid-sizer',
						},
					});
				}

				// ISOTOPE GRID LAYOUT
				if ($('.main-isotope-container.isotope-even-layout').size() > 0) {
					$('.main-isotope-container.isotope-even-layout').isotope({
						itemSelector: '.single-item',
						layoutMode: 'fitRows',
						fitRows: {
						  gutter: '.gutter-sizer',
						  columnWidth: '.grid-sizer',
						},
					});
				}

				// ISOTOPE CLASSIC LAYOUT
				if ($('.main-isotope-container.isotope-classic-layout').size() > 0) {
					$('.main-isotope-container.isotope-classic-layout').isotope({
						itemSelector: '.single-item',
						layoutMode: 'fitRows',
					});
				}

				
				// AFTER IMAGESLOADED
				imagesLoaded($contentContainer, function(instance) {

					// RELAYOUT ISOTOPE
					$mainIsotopeContainer.isotope('layout');
					
					// ANIMATE TO NEW CONTAINERHEIGHT
					$contentContainer.mbAnimateToNewContainerHeight(1200);

					// FADEIN CONTENT
					ajaxArchivePaginationFadeIn();		

				});

			});

		}

		/*************************************************************
		LOADMORE AJAX
		*************************************************************/

		if ($('.archive-pagination-loadmore-ajax').size() > 0) { 

			// LOADMORE CLICK
			$('body').on('click', '.archive-pagination-loadmore-ajax a', function(e) {
				e.preventDefault();
				$('.archive-pagination-loadmore-ajax li').html('<img src="' + extData.templateURI +'/img/ajax-loader.gif">'); 	// replace link with loader gif. For effect but mostly to prevent double-clicks
				var $this = $(this);
				ajaxArchivePaginationLoadMore($this);
			});
		}

		// AJAX ARCHIVE PAGINATION LOAD MORE
		function ajaxArchivePaginationLoadMore($this) {

			var link = $this.attr('href');
			var $contentContainer = $('.main-column');
			$contentContainer.height($contentContainer.height()); 	// temporarily fix height to avoid page jumping back to top.
			var $mainIsotopeContainer = $('.main-isotope-container');

			$.get(link, function (data) {
				var $this = $(this);

				// update loadmore link
				if ($('.main-column .pagination') == $(data).find('.main-column .pagination')) { return; }
				$('.main-column .pagination').replaceWith($(data).find('.main-column .pagination'));

				// get new items, append them to main-isotope-container and update isotope instance
				var $newItems = $(data).find('.main-isotope-container .single-item');
				$mainIsotopeContainer.append($newItems).isotope('appended', $newItems);
				$newItems.css('opacity', 0);

				// FIT VIDS
				$mainIsotopeContainer.fitVids();

				// REINIT INSTAGRAM EMBED.JS
				instgrm.Embeds.process();

				// MATCH HEIGHT
				if ($('.isotope-even-layout').size() > 0 ) { $newItems.find('.inner-wrapper').matchHeight(false); }

				// AFTER IMAGESLOADED
				imagesLoaded($contentContainer, function(instance) {

					// RELAYOUT ISOTOPE
					$mainIsotopeContainer.isotope('layout');

					// ANIMATE TO NEW CONTAINERHEIGHT
					$contentContainer.mbAnimateToNewContainerHeight(1500);

					// FADEIN CONTENT
					var initialDelay = 800;
					var fadeInSpeed = 800;

					$newItems.delay(initialDelay).animate({
						opacity: 1.0
					}, fadeInSpeed);
							
				});

			});

		}

	});



/*************************************************************
COUNTDOWN
*************************************************************/

	jQuery(document).ready(function($){

		//bouncer
		if ($('.countdown').size() == 0) { return; }

		$('.countdown').each(function(index, element) {
			var $this = $(this);

			//get vars
			var labelYears = $this.data('label_years');
			var labelMonths = $this.data('label_months');
			var labelWeeks = $this.data('label_weeks');
			var labelDays = $this.data('label_days');
			var labelHours = $this.data('label_hours');
			var labelMinutes = $this.data('label_minutes');
			var labelSeconds = $this.data('label_seconds');

			var labelYear = $this.data('label_year');
			var labelMonth = $this.data('label_month');
			var labelWeek = $this.data('label_week');
			var labelDay = $this.data('label_day');
			var labelHour = $this.data('label_hour');
			var labelMinute = $this.data('label_minute');
			var labelSecond = $this.data('label_second');

			var labelY = $this.data('label_y');
			var labelM = $this.data('label_m');
			var labelW = $this.data('label_w');
			var labelD = $this.data('label_d');

			var datetimeString = $this.data('datetime_string');
			var gmtOffset = $this.data('gmt_offset');
			var format = $this.data('format');
			var useCompact = $this.data('use_compact');
			var description = $this.data('description');
			var layout = $this.data('layout');


			//handle vars
			if (useCompact == "checked") { var useCompactBool = true; } else { var useCompactBool = false; }
			if (datetimeString == "") { datetimeString = "" }
			layout = (typeof layout != "undefined") ? layout : null;

			// set labels
			var defaultArgs = {
				labels: [labelYears, labelMonths, labelWeeks, labelDays, labelHours, labelMinutes, labelSeconds],
				labels1: [labelYear, labelMonth, labelWeek, labelDay, labelHour, labelMinute, labelSecond],
				compactLabels: [labelY, labelM, labelW, labelD],
				windowhichLabels: null,
				digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
				timeSeparator: ':', isRTL: false};
			$.countdown.setDefaults(defaultArgs);

			// set date
			var countdownDatetime = new Date(); 
			// countdownDatetime = new Date(2013, 11, 31, 23, 59, 59, 100);
			countdownDatetime = new Date(datetimeString);

			$this.countdown({
				compactLabels: ['y', 'm', 'w', 'd'],
				until: countdownDatetime,
				timezone: parseInt(gmtOffset),
				format: format,
				compact: useCompactBool,					
				description: description,
				layout: layout,
			}); 
			 
		});

	});



/*************************************************************
CLICKABLE BACKGROUND
*************************************************************/

	jQuery(document).ready(function($){

		if (extData.canonOptions['use_boxed_design'] == "checked") {

			var bgLink = extData.canonOptionsAppearance['bg_link'];

			if (typeof bgLink != "undefined") {
				if (bgLink != "") {
						
					$(document).on('click','body', function(event) {
						if (event.target.nodeName == "BODY") {
							window.open(bgLink, "_blank");
						}
					});
					
				}
			}

		}
	});

/*************************************************************
STICKY HEADER
*************************************************************/

	jQuery(document).ready(function($){

		if ($('.canon_sticky').size() > 0) {

			// add stickyness to these elements
			var stickySelectorClass = ".canon_sticky";
			var $stickyElements = $(stickySelectorClass);
			$stickyElements.each(function(index) {
				$(this).wrap('<div class="sticky_placeholder"></div>');	
			});

			// add canon_sticky_shadow class
			if (extData.canonOptionsFrame['use_sticky_shadow'] == "checked") { $('.sticky-header-wrapper .canon_sticky').last().addClass('canon_sticky_shadow'); }
			
			// init vars
			var adjustedOffset = 0;
         	var windowPosition = 0;
         	var placeholderOffset = 0;
	        var $win = $(window);

			updateStickyPlaceholderHeights();				// set height of this subject's placeholder
			$win.on('scroll', stickyScrollEvent);

			// UPDATE PLACEHOLDER HEIGHTS ON WINDOW LOAD (TO PROTECT AGAINST LATE ARRIVAL CONTENT)
			$(window).load(function() {
				updateStickyPlaceholderHeights();
			});

         	// ON RESIZE
			$(window).resize(function () {

				// turn off old scroll event to allow for new
				$(window).off('scroll', stickyScrollEvent);

				updateStickyPlaceholderHeights();
				$win.on('scroll', stickyScrollEvent);	

			}); 


		}

		function updateStickyPlaceholderHeights () {

 			$('.canon_sticky').each(function (index) {
				var $stickySubject = $(this);
				var $stickyPlaceholder = $stickySubject.closest('.sticky_placeholder');
				var stickySubjectHeight = $stickySubject.height();

				//maintain height of placeholder
				$stickyPlaceholder.css({
					"display": "block",
					"height": stickySubjectHeight,
				});
			});


		}

		function stickyScrollEvent () {

 			$('.canon_sticky').each(function (index) {
				var $stickySubject = $(this);
		        var $stickyPlaceholder = $stickySubject.closest('.sticky_placeholder');

	        	var originalOffset = getWPAdminBarOffset();

				var placeholderOffset = $stickyPlaceholder.offset().top;
				var adjustedOffset = getAdjustedOffset($stickySubject);
				var startingZIndex = 999;
				var thisZIndex = startingZIndex - index;
				// console.log(thisZIndex);

	     		windowPosition = $win.scrollTop();

	     		// console.log("windowposition+adjustedoffset: " + (windowPosition+adjustedOffset));
	     		// console.log("placeholderOffset: " + placeholderOffset);

	     		// apply stickyness when scrolling past
	     		if (windowPosition+adjustedOffset > placeholderOffset) {
	     			// console.log("STICKY ON");
					$stickySubject.css({
					    "position": "fixed",
					    "top": adjustedOffset,
					    "z-index": thisZIndex,
					});
					$stickySubject.addClass('canon_stuck');
	     		}

	     		// remove stickyness when scrolling back over
	     		if (windowPosition+adjustedOffset <= placeholderOffset) {
	     			// console.log("STICKY OFF");
					$stickySubject.css({
					    "position": "relative",
					    "top": "auto",
					    "z-index": thisZIndex,
					});
					$stickySubject.removeClass('canon_stuck');
	     		}

	     		// if turn off in responsive then remove stickyness from all
				var windowWidth = $(window).width();
				var turnOffWidth = extData.canonOptionsFrame['sticky_turn_off_width'];
				// console.log("window width: " + windowWidth);
				// console.log("turn off width: " + turnOffWidth);
	     		if (windowWidth < turnOffWidth) {
	     			// console.log("STICKY OFF");
					$stickySubject.css({
					    "position": "relative",
					    "top": "auto",
					    "z-index": thisZIndex,
					});
					$stickySubject.removeClass('canon_stuck');
	     		}

 			});
		}
		
		function getAdjustedOffset ($stickySubject) {
			var index = $('.sticky_placeholder').index($stickySubject.closest('.sticky_placeholder'));
         	var originalOffset = getWPAdminBarOffset();

			var adjustedOffset = originalOffset;
			var $placeholdersAbove = $('.sticky_placeholder').slice(0, index);
			$placeholdersAbove.each(function (index) {
				var $thisPlaceholder = $(this);
				adjustedOffset = adjustedOffset + $thisPlaceholder.height();	
			});
			return adjustedOffset;
		}

		function getWPAdminBarOffset () {

			var offset = 0;
         	var $wpAdminBar = $('#wpadminbar');
         	if ($wpAdminBar.size() > 0) {
	         	var wpAdminBarPosition = $wpAdminBar.css('position');
	         	var wpAdminBarHeight = $wpAdminBar.height();
	         	offset = (wpAdminBarPosition == "fixed") ? wpAdminBarHeight : 0;
         	}
         	return offset;

		}

	/*************************************************************************
	SCROLL TO ANCHOR

	USE: link #example will scroll to the first element with class "example"
	Can also be linked to other internal pages. So link "http://www.mypage.com/#example" will first load http://www.mypage.com/example and then after a short delay scroll to first element with class "example".
	*************************************************************************/

			jQuery(window).load(function($) {
				$=jQuery;

				var scrollToSelector = '#';
				var onLoadScrollToDelay = 1500;

				// on window load grab the url and scan for # then initiate scroll if this is found
				var href = isolateScrollToHref(document.URL, scrollToSelector);
				if (href !="") { setTimeout(function() { canonScrollToAnchor(href) }, onLoadScrollToDelay); }

				// on click a tag
				$('body').on('click', 'a', function (event) {

					if (typeof $(this).attr('href') == "undefined") { return; } // failsafe against a tags with no href
					var href = isolateScrollToHref($(this).attr('href'), scrollToSelector)
					if (href != "") { canonScrollToAnchor(href); }
						
				});

			});

			function isolateScrollToHref (source, scrollToSelector) {
				if (source.indexOf('#') != -1) {
					var splitArray = source.split(scrollToSelector);
					return splitArray[1];
				} else {
					return "";	
				}
			}

			function canonScrollToAnchor(href){
				var target = $("."+href);

				if (target.size() > 0) {
					var originalOffset = getWPAdminBarOffset();
					var adjustedOffset = originalOffset;

					// first adjust for header stickies
					var $headerStickies = $('.sticky-header-wrapper .canon_sticky');
					$headerStickies.each(function(index) {
						var $thisSticky = $(this);
						adjustedOffset = adjustedOffset + $thisSticky.height();	
					});

					// next adjust for block stickies
					if (target.hasClass('pb_block')) {
						var $blockClosest = target;	
					} else {
						var $blockClosest = target.closest('.pb_block');	
					}
					var $prevStickyBlocks = $blockClosest.prevAll('.sticky_placeholder');
					$prevStickyBlocks.each(function(index) {
						var $thisSticky = $(this);
						adjustedOffset = adjustedOffset + $thisSticky.height();	
					});

					var scrollToOffset = target.offset().top - adjustedOffset;

					$('html,body').animate({scrollTop: scrollToOffset},'slow');
					
				}
			}


	/*************************************************************
	SEARCH BUTTON
	*************************************************************/

			if ($('.toolbar-search-btn').size() > 0) {

				// SEARCH BUTTON CLICK
				$('body').on('click','.toolbar-search-btn', function (event) {
					event.preventDefault();
					var $searchHeaderContainer = $('.search-header-container');
					var status = $searchHeaderContainer.attr('data-status');

					//update status
					if (status == "closed") {
						$searchHeaderContainer.fadeIn();
						$searchHeaderContainer.attr('data-status', 'open');
					} 

					//calculate offset
					var originalOffset = getWPAdminBarOffset();
					var adjustedOffset = originalOffset;

					var $headerStickies = $('.sticky-header-wrapper .canon_sticky');
					$headerStickies.each(function(index) {
						var $thisSticky = $(this);
						adjustedOffset = adjustedOffset + $thisSticky.height();	
					});

					var scrollToOffset = $searchHeaderContainer.offset().top - adjustedOffset;

					//scroll
					$('html,body').animate({
						scrollTop: scrollToOffset
					},'slow',function () {
						$searchHeaderContainer.find('#s').focus();
					});

					// reinit fitText to fix fitText not appearing issue
					if ($('.search-header-container .fittext').size() > 0) {
						if (typeof fitText == "function") {
							$('.fittext').each(function(index, el) {
								var $this = $(this);
								var ratio = $this.attr('data-ratio');
								fitText($this, ratio);
							});
						}
					}

				});

				// SEARCH CONTROL SEARCH
				$('body').on('click','.search_control_search', function (event) {
					$('.search-header-container #searchform-header').submit();
				});

				// SEARCH CONTROL CLOSE
				$('body').on('click','.search_control_close', function (event) {
					var $searchHeaderContainer = $('.search-header-container');
					$searchHeaderContainer.fadeOut();
					$searchHeaderContainer.attr('data-status', 'closed');
					// $('html,body').animate({scrollTop: 0},'slow');
				});


			}

	});


/*************************************************************
SEARCH AUTOCOMPLETE
*************************************************************/

	jQuery(document).ready(function($){

		if (typeof extDataAutocomplete != "undefined") {

			var autocompleteArray = extDataAutocomplete.autocompleteArray;
			$( ".search-header-container #s" ).autocomplete({ source: autocompleteArray });
			
		}

	});

/*************************************************************
@FONT-FACE FIX
*************************************************************/

	jQuery(window).load(function($){

		if (extData.canonOptions['fontface_fix'] == 'checked') {

			$ = jQuery;
	 		$('body').hide().show();
				
		}
 		
	});


/*************************************************************
MENU ANIMATION
*************************************************************/

	jQuery(document).ready(function($){

		if (extData.canonOptionsAppearance['anim_menus'] != 'anim_menus_off') {

			$(extData.canonOptionsAppearance['anim_menus']).each(function(index) {
				var $this_menu = $(this);
				$($this_menu.children('li').get().reverse()).each(function(index) {
					var $this_li = $(this);
					$this_li.delay(index*parseInt(extData.canonOptionsAppearance['anim_menus_delay'])).animate({
						'opacity': '1',
						'top': '0px',
						'right': '0px',
						'bottom': '0px',
						'left': '0px',
					}, parseInt(extData.canonOptionsAppearance['anim_menus_duration']));
					
				});
			});

		}

	});

/*************************************************************
RATINGS BAR
*************************************************************/


	jQuery(document).ready(function($){

		if ($('.ratings-bar').size() === 0) { return; }

		var $ratingBars = $('.ratings-bar');

		$ratingBars.each(function(index) {
			var $this = $(this);
			var percentage = parseFloat($this.attr('data-ratio')) * 100;
			$this.css('width', percentage + "%");
			// $this.animate({
			// 	width: percentage + "%",
			// }, 2000);
		});

	});



/*************************************************************
USER RATING
*************************************************************/


	jQuery(document).ready(function($){

		// bouncer
		if ($('.star-rating').size() === 0) { return; }


		// set colours
		var ratedColor = extData.canonOptionsAppearance['color_feat_text_1'];
		var hoverColor = 'orange';

		// initial state
		var $starRatingContainers = $('.star-rating');
		$starRatingContainers.each(function(index) {
			var $this = $(this);
			if ($this.attr('class').indexOf('unrated') == -1) {
				var starRating = $this.attr('data-my_rating');
				var $incStars = $this.find('li i').slice(0, starRating);
				$incStars.removeClass('fa-star-o').addClass('fa-star').css('color', ratedColor);
			}
				
		});

		// bounce from here if already rated
		if ($('.star-rating.unrated').size() === 0) { return; }

		var $stars = $('.star-rating.unrated li i');


		// hover effect
		$stars.hover(function (event) {
			var $this = $(this);
			var starRating = $stars.index($this)+1;
			var $incStars = $stars.slice(0, starRating);
			$incStars.removeClass('fa-star-o').addClass('fa-star').css('color', hoverColor);

		}, function (event) {
			$stars.removeClass('fa-star').addClass('fa-star-o').css('color', '#ddd');
		});


		$stars.on('click', function (event) {
			var $this = $(this);
			var $thisStarRatingContainer = $this.closest('.star-rating');
			var starRating = $stars.index($this)+1;
			var $incStars = $stars.slice(0, starRating);
			var postID = $thisStarRatingContainer.attr('data-post_id');
			var nonce = $thisStarRatingContainer.attr('data-nonce');

			$.ajax({
				type: 'post',
				url: extData.ajaxUrl,
				data: {
					action: 'user_rating',
					star_rating: starRating,
					post_id: postID,
					nonce: nonce
				},
				success: function(response) {
					if (response != "") {

						// change class to rated
						$thisStarRatingContainer.removeClass('unrated').addClass('rated');

						// unbind hover event
						$stars.unbind();

						// color stars to user rating
						$incStars.removeClass('fa-star-o').addClass('fa-star').css('color', '#ff6666');

						// recalculate new rating results
						var resultsArray = response.split(',');
						var sum = 0;
						$.each(resultsArray, function (index, value) {
							sum = sum + parseInt(value);	
						});
						var average = Math.round(sum/resultsArray.length * 10) / 10;
						var resultString = average + " (" + resultsArray.length + " votes)";
						$('.star-rating-result').text(resultString);

					}
				}
			}); //end ajax
		});

	});


/*************************************************************
INFO BOX LIST CHECK
*************************************************************/
  
	jQuery(document).ready(function($){

		// bouncer
		if ($('.tc-info-box-ul li').size() === 0) { return; }

		$( ".tc-info-box-ul li" ).click(function() {
			$( this ).toggleClass( "checked" );
		});

	});



/*************************************************************
POST LIKE BUTTON
*************************************************************/

	jQuery(document).ready(function($) {

		$('body').on('click', '.heart', function (e) {
			e.preventDefault();
			var $this = $(this);
			var $this_post = $this.closest('.post');
			var liked = ($this.attr('class').indexOf("liked") != -1) ? true : false;
			var postID = $this_post.attr('data-post_ID');
			var nonce = $this_post.attr('data-nonce');

			$.ajax({
				type: 'post',
				url: extData.ajaxUrl,
				data: {
					action: 'like_post',
					post_ID: postID,
					nonce: nonce
				},
				success: function(response) {
					if (response != "") {
						var $these = $('.post[data-post_ID = "'+ postID +'"]').find('.heart');
						// var heartIconClass = (liked === false) ? "fa-heart" : "fa-heart-o";
						$these.html('<em class="fa fa-heart"></em>' + response);
						if (liked === false) { $these.addClass('liked'); } else { $these.removeClass('liked'); }
					}
				}
			}); //end ajax
		});
	});
	

/*************************************************************
HOVERBOX VALIGN CONTENT
*************************************************************/

	jQuery(document).ready(function($) {

		// bouncer
		if ($('.tc-hover-container').size() == 0) { return; }

		// init on imagesloaded
		imagesLoaded( $('.tc-hover-container'), function( instance ) {
			canonValignChildInParent();
		});

		// on window resize
		$(window).resize(function () {
			canonValignChildInParent();
		});

		function canonValignChildInParent() {

			var selector = ".tc-hover-content";

			var $valignSubjects = $(selector);

			$valignSubjects.each(function(index, e) {
				var $this = $(this);
				var $parent = $this.parent();

				var childHeight = $this.height();
				var parentHeight = $parent.height();

				
				var topMargin = (parentHeight/2) - (childHeight/2);
				if (topMargin < 0 ) { topMargin = 0; }

				$this.css({
					'margin-top': topMargin,
				});

			});

		}

	});


/*************************************************************
FEATURE BLOCK: POST GRID ANIMATION
*************************************************************/

	jQuery(document).ready(function($) {

		// bouncer
		if ($('.element-block-post-grid').size() == 0) { return; }

		// grab grid posts
		var $gridPosts = $('.element-block-post-grid .tc-hover-container');
		var delay = parseInt(extData.canonOptionsFrame.block_post_grid_anim_delay);
		var fadeSpeed = parseInt(extData.canonOptionsFrame.block_post_grid_anim_speed);

		// defaults
		if (typeof delay == "undefined") { delay = 400; }
		if (typeof fadeSpeed == "undefined") { fadeSpeed = 2200; }

		// ANIMATION OFF
		if (extData.canonOptionsFrame.block_post_grid_animation == "off") {

			imagesLoaded( $('.element-block-post-grid'), function( instance ) {
				$gridPosts.css('opacity', 1);
			});
			
		}

		// SIMPLE FADEIN
		if (extData.canonOptionsFrame.block_post_grid_animation == "simple") {

			$gridPosts.each(function (index, element) {
				var $this = $(this);  

				$this.animate({
					opacity: 1.0
				}, fadeSpeed);
					
			});
			
		}


		// SEQUENTIAL ANIMATION
		if (extData.canonOptionsFrame.block_post_grid_animation == "sequential") {

			$gridPosts.each(function (index, element) {
				var $this = $(this);  

				$this.delay(delay*index).animate({
					opacity: 1.0
				}, fadeSpeed);
					
			});
			
		}

		// RANDOM ANIMATION
		if (extData.canonOptionsFrame.block_post_grid_animation == "random") {

			var delayArray = [];

			for (var i = 0; i < $gridPosts.size(); i++) { delayArray.push(i*delay); }

			delayArray = mbShuffleArray(delayArray);

			$gridPosts.each(function (index, element) {
				var $this = $(this);  

				$this.delay(delayArray[index]).animate({
					opacity: 1.0
				}, fadeSpeed);
					
			});
			
		}




	});


/*************************************************************
SET NEGATIVE MARGIN FOR OVERLAY-HEADER CLASS + APPLY IS-OVERLAID-HEADER CLASS
*************************************************************/

	jQuery(document).ready(function($){

		// bouncer
		if ($('.overlay-header').size() == 0) { return; }

		// set vars
		var $stickyHeaderWrapper = $('.sticky-header-wrapper');
		var $topOverlayHeaderObject = $('.overlay-header').not('.main-footer-container .overlay-header');
		var headerHeight = 0;

		// init
		updateOverlayHeaderMargin();

		// on window resize
		$(window).resize(function () { updateOverlayHeaderMargin(); }); 

		function updateOverlayHeaderMargin () {
			var windowWidth = $(window).width();
			var turnOffWidth = extData.canonOptions['overlay_header_turn_off_width'];

	     	if (windowWidth < turnOffWidth) {
				$topOverlayHeaderObject.css('margin-top', 0);
				 $stickyHeaderWrapper.removeClass('is-overlaid-header');
			} else {
				headerHeight = $stickyHeaderWrapper.height() * -1;
				$topOverlayHeaderObject.css('margin-top', headerHeight);
				if ($topOverlayHeaderObject.size() === 1) { $stickyHeaderWrapper.addClass('is-overlaid-header'); }
			}
		}

	});



/*************************************************************
SET NEGATIVE MARGIN FOR OVERLAY-CONTENT CLASS
*************************************************************/

	jQuery(document).ready(function($){

		// bouncer
		if ($('.overlay-content').not('.main-footer-container .overlay-content').size() == 0) { return; }

		var $pageContent = $('.page-content');

		// init
		updateOverlayContentMargin();

		// on window resize
		$(window).resize(function () { updateOverlayContentMargin(); }); 

		function updateOverlayContentMargin () {
			var windowWidth = $(window).width();
			var turnOffWidth = extData.canonOptions['overlay_content_turn_off_width'];

	     	if (windowWidth < turnOffWidth) {
				$pageContent.css('margin-top', 0);
			} else {
				$pageContent.css('margin-top', parseInt(extData.canonOptions['overlay_content_negative_margin']));
			}
		}

	});



/*************************************************************
BACK TO TOP
*************************************************************/

	jQuery(document).ready(function($) {

		// TO TOP
		var toTopSelector = '.to-top';
		$('body').on('click', toTopSelector, function(event) {
			event.preventDefault();
			$('body,html').animate({scrollTop:0},800);
		});	

	});	


	jQuery(document).ready(function($) {

	  	// SCROLLUP
	  	if (extData.canonOptions['back_to_top_button'] == "floating") {
		  	$.scrollUp({
		  	    scrollName: 'scrollUp', 	// Element ID
		        scrollDistance: 300,         // Distance from top/bottom before showing element (px)
		        scrollFrom: 'top',           // 'top' or 'bottom'
		        scrollSpeed: 800,            // Speed back to top (ms)
		        easingType: 'linear',        // Scroll to top easing (see http://easings.net/)
		        animation: 'fade',           // Fade, slide, none
		        animationSpeed: 200,         // Animation speed (ms)
		  	    scrollText: '',			 // Text for element, can contain HTML
		        // scrollTrigger: false,        // Set a custom triggering element. Can be an HTML string or jQuery object
		        // scrollTarget: false,         // Set a custom target element for scrolling to. Can be element or number
		        // scrollTitle: false,          // Set a custom <a> title if required.
		        // scrollImg: false,            // Set true to use image
		        // activeOverlay: false,        // Set CSS color to display scrollUp active point, e.g '#00FFFF'
		        // zIndex: 2147483647           // Z-Index for the overlay
			});
	  	}

	});	


/*************************************************************
POLLS
*************************************************************/

	jQuery(document).ready(function($){

		// bouncer
		if ($('.poll').size() == 0) { return; }

		// init
		updatePollResultBars();

		// POLL-GO-RESULT-BTN
		$('body').on('click', '.poll-go-result-btn', function(event) {
			event.preventDefault();
			var $this = $(this);
			var $thisPollVoteContainer = $this.closest('.poll').find('.poll-vote-container');
			var $thisPollResultContainer = $this.closest('.poll').find('.poll-result-container');
			$thisPollVoteContainer.hide();
			$thisPollResultContainer.show();
		})

		// POLL-GO-VOTE-BTN
		$('body').on('click', '.poll-go-vote-btn', function(event) {
			event.preventDefault();
			var $this = $(this);
			var $thisPollVoteContainer = $this.closest('.poll').find('.poll-vote-container');
			var $thisPollResultContainer = $this.closest('.poll').find('.poll-result-container');
			$thisPollVoteContainer.show();
			$thisPollResultContainer.hide();
		})

		// VOTE BTN
		$('body').on('click', '.poll-vote-btn', function(event) {
			event.preventDefault();
			var $this = $(this);
			var $thisPoll = $this.closest('.poll');
			var $thisPollVoteContainer = $thisPoll.find('.poll-vote-container');
			var $thisPollResultContainer = $thisPoll.find('.poll-result-container');
			var $thisRadioButtons = $thisPoll.find('.poll-answers input');
			var selectedRadioButtonIndex = "-1";

			// get radio button value
			$thisRadioButtons.each(function(index) {
				var $thisRadioButton = $(this);
				if ($thisRadioButton.is(':checked')) { selectedRadioButtonIndex = $thisRadioButton.attr('value'); }	
			});

			// bounce if no radio button is selected
			if (selectedRadioButtonIndex == "-1") { return;	}

			// get vars
			var id = $thisPoll.attr('data-id');
			var numVotes = $thisPoll.find('.poll-num-votes span').text();
			var nonce = $thisPoll.attr('data-nonce');

			$.ajax({
				type: 'post',
				url: extData.ajaxUrl,
				data: {
					action: 'vote_poll',
					id: id,
					selected_radio_button_index: selectedRadioButtonIndex,
					num_votes: numVotes,
					nonce: nonce
				},
				success: function(response) {
					if (response == "success") {

						// update total num votes
						numVotes++;
						var numVotesText = (numVotes === 1) ? "vote" : "votes";
						$thisPoll.find('.poll-num-votes').html("<span>" + numVotes + "</span> " + numVotesText);

						// update answer vote
						var $resultBars = $thisPoll.find('.result-bar-container .result-bar');
						var $votedForAnswer = $resultBars.eq(selectedRadioButtonIndex);
						var answerNumVotes = $votedForAnswer.attr('data-votes');
						answerNumVotes++;
						$votedForAnswer.attr('data-votes', answerNumVotes);


						// recalculate percentages and update
						$resultBars.each(function(index) {
							var $thisResultBar = $(this);
							var thisResultBarNumVotes = parseInt($thisResultBar.attr('data-votes'));
							if (numVotes > 0) {
								var thisResultBarPercent = Math.round((thisResultBarNumVotes/numVotes)*100);
								$thisResultBar.attr('data-percent', thisResultBarPercent);
								$thisResultBar.closest('li').find('.poll-result-text span').text(thisResultBarPercent + "%");
							}
						});

						// update bars
						updatePollResultBars();

						// hide  go to vote link
						$thisPoll.find('.poll-result-container .poll-result-footer .poll-go-vote-btn').hide();

						// change not-voted class to voted
						$thisPoll.removeClass('not-voted').addClass('voted');

						// show result hide vote
						$thisPollVoteContainer.hide();
						$thisPollResultContainer.show();

					}
				}
			}); //end ajax

		})


		function updatePollResultBars() {

			var $resultBars = $('.poll .result-bar-container .result-bar');
			$resultBars.each(function(index) {
				var $this = $(this);
				var percent = $this.attr('data-percent');
				$this.css('width', percent + "%");
			});

		}


	});


