/**
 *
 * @package   theme_mb2nl
 * @copyright 2017 Mariusz Boloz (http://marbol2.com)
 * @license   Commercial https://themeforest.net/licenses
 *
 */


jQuery(document).ready(function($){
	
	
	
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	OAuth2 buttons
	/*-----------------------------------------------------------*/
	
	if ($('body').hasClass('pagelayout-login'))
	{
		$('#login').append($('.potentialidps'));
	}
	
	
	$('.potentialidp a').each(function(){
		
		var linkTitle = $(this).attr('title');
		
		//toLowerCase()
		$(this).attr('class', '');
		$(this).addClass('btn btn-' + linkTitle.toLowerCase());
		
		
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Open bootstrap accordion by url hash
	/*-----------------------------------------------------------*/
	var hash = document.location.hash;
	
    if (hash) 
	{			
        $('a[href="' + hash + '_acc"]').click();
    }
	
	
	
	/*-----------------------------------------------------------*/
	/*	Nivo lightbox
	/*-----------------------------------------------------------*/	
	$('.theme-lightbox').each(function(){
				
		var lLink = $(this);		
		lLink.nivoLightbox();	
		
	});
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Shortcode carousel
	/*-----------------------------------------------------------*/	
	$('.theme-slider').each(function(){
		
		slider = $(this);		
		theme_slider(slider);	
		
	});	
		
	// Course slider
	$(document).on('click', '.moreinfo',function(e) {
		
		var el = $(this);
		setTimeout(function(){
			var parentDiv = el.parent().parent();
			var courseSlider = parentDiv.find('.course-slider');
			
			if (courseSlider.length > 0)
			{
				theme_slider(courseSlider);	
			}
			
		}, 700);
		
	});
	
	
	function theme_slider (slider)
	{
		
		// Slider options
		isItems = slider.data('items');
		isMargin = slider.data('margin');
		isLoop = slider.data('loop') == 0 ? false : true;
		isNav = slider.data('nav') == 0 ? false : true;
		isDots = slider.data('dots') == 0 ? false : true;
		isAutoplay = slider.data('autoplay') == 0 ? false : true;
		isPauseTime = slider.data('pausetime');
		isAnimTime = slider.data('animtime');
		
				
		var is2res = isItems > 2 ? 2 : isItems;
		var is3res = isItems > 3 ? 3 : isItems;
		var is4res = isItems > 5 ? 5 : isItems;		
		isRes =  {0:{items:1},600: {items:is2res},780: {items:is3res},1000:{items:is4res}};
		
		slider.owlCarousel({
			
			items: isItems,
			margin: isMargin,
			loop: isLoop,
			nav: isNav,
			dots: isDots,
			autoplay: isAutoplay,
			responsive: isRes,
			autoplayHoverPause: true,
			autoplayTimeout: isPauseTime,
			smartSpeed: isAnimTime,
			navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
				
		});	
		
	}
	
	
	
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Scroll to top
	/*-----------------------------------------------------------*/	
	var scrollLink = $('.theme-scrolltt');
	var scrollSpeed = scrollLink.data('scrollspeed');
	
	$(window).on('scroll', function(){
				
		if ($(this).scrollTop() > 500) 
		{
			scrollLink.addClass('active');
		}
		else
		{
			scrollLink.removeClass('active');
		}		
		
	});
	
	
	scrollLink.click(function(e){
		
		e.preventDefault();
		$('html, body').stop().animate({scrollTop : 0}, scrollSpeed);
		
	});
	
	
	
	
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Theme settings accordion
	/*-----------------------------------------------------------*/	
	
	if ($('body').hasClass('path-admin-setting'))
	{

		$('.mb2tmpl-acc-title').each(function(){
			
			var heading = $(this);
				
			heading.click(function(e){
				
				$(this).toggleClass('active');		
				$(this).parent().find('> div').slideToggle(150);
				
			});	
			
		});
	
	}
	
	
	
	/*-----------------------------------------------------------*/
	/*	Remove cols and row attributes from textarea form field
	/*-----------------------------------------------------------*/
	//$('.form-textarea textarea').removeAttr('rows');
	//$('.form-textarea textarea').removeAttr('cols');
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Remove cols and row attributes from textarea form field
	/*-----------------------------------------------------------*/
	$('table').wrap('<div class="theme-table-wrap"></div>');
	$('.generaltable, .forumheaderlist, table.userenrolment').addClass('table table-striped');
	//$('.forumheaderlist').addClass('table table-striped');
	$('table.collection').addClass('table table-bordered');
	$('table.preference-table').addClass('table table-bordered');
	$('table.rolecap').addClass('table table-bordered');
	$('#categoryquestions').addClass('table table-striped');
	
	
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Play video by click
	/*-----------------------------------------------------------*/
	
	$('.embed-video-bg').each(function(){
		
		var imageEl = $(this);
		var clickEl = imageEl.parent().find('>i');
		
		
		clickEl.on('click', function(e){		
		
			var video = imageEl.parent().find('iframe');
			video.attr('src',imageEl.data('videourl'));			
			$(this).fadeOut(350);
			imageEl.fadeOut(350);		
			e.preventDefault();
			
		});
		
	});
	
	
	
	/*-----------------------------------------------------------*/
	/*	Add bootstrap class to form butons
	/*-----------------------------------------------------------*/
	//$('input[type="submit"]').addClass('btn');
	//$('input[type="submit"].form-submit').addClass('btn-primary');
	
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Add 'danger' class for bootstrap error alert
	/*-----------------------------------------------------------*/
	$('.alert-error').addClass('alert-danger');
	$('.box.notifyproblem').addClass('alert');
	$('.box.notifyproblem').addClass('alert-danger');
	$('.box.notifyproblem').removeClass('notifyproblem');
	
	
	
		
	
	/*-----------------------------------------------------------*/
	/*	Add active class for tob item
	/*-----------------------------------------------------------*/
	$('.nav-tabs .nav-link').each(function(){
		
		if ($(this).hasClass('active'))
		{
			$(this).parent().addClass('active');	
		}
	});
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Show region name
	/*-----------------------------------------------------------*/	
	$('.block-region').each(function(){		
		
		var regionName = '<span class="region-name">' + $(this).data('blockregion') + '</span>';		
		
		if ($('body').hasClass('editing'))
		{			
			$(this).append(regionName);				
		}		
		
	});
	
	
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Main menu
	/*-----------------------------------------------------------*/
	$('.theme-ddmenu').each(function(){
		
			
		var menuList = $(this);
		var animType = menuList.data('animtype');
		var animSpeed = menuList.data('animspeed');
		var mobileArr = menuList.find('.mobile-arrow');
		
		
		menuList.superfish({				
			popUpSelector: 'ul',    
			hoverClass: 'mb2ctm-hover',
			animation: animType == 2 ? {height:'show'} : {opacity:'show'},
			speed: animSpeed,  
			speedOut: 'fast',
			cssArrows: false	
		});
			
		
		// Disable sf menu on small screens
		menuOnHover(menuList);
		$(window).on('resize',function(){
			menuOnHover(menuList);		
		});
		
		
		
		
		// Open menu in mobile
		mobileArr.click(function(e){
			
			e.preventDefault();
			
			$(this).parent().siblings('ul').slideToggle(250);
			$(this).toggleClass('active');
			
		});
		
		
		
			
		function menuOnHover (list) {	
			
			var w = (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth);
			
			if (w<=768)
			{					
				list.removeClass('sf-js-enabled');
				list.removeClass('desk-menu');
				list.addClass('mobile-menu');									
			}
			else
			{
				list.addClass('sf-js-enabled');	
				list.removeClass('mobile-menu');
				list.addClass('desk-menu');	
				list.find('.mobile-arrow').removeClass('active');
				list.find('.mobile-arrow').parent().siblings('ul').hide();
			}
						
		}
		
		
		
	});
	
	
	
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Main menu - mobile menu
	/*-----------------------------------------------------------*/
	$(document).on('click', '.show-menu', function(e){
		
		e.preventDefault();
		var menuList = $(this).parent().parent().find('.theme-ddmenu');
		
		menuList.slideToggle(250);
		
	});
	
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Get username in slideing panel
	/*-----------------------------------------------------------*/
	
	var clonedUserName = $('.theme-loginform').find('.usertext');
	var userAvatar =  $('.theme-loginform').find('.welcome_userpicture')
	var userLink =  userAvatar.parent();
	
	userLink.append(clonedUserName);
	
	userLink.click(function(e){
		e.preventDefault();		
	});
	
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Make fixed navigation
	/*-----------------------------------------------------------*/
	
	// Make fixed navigation 
	setTimeout(function(){
		makeFixedNavigation();
	},10);	
		
	$(window).scroll(function(){		
		makeFixedNavigation();		
	});	
		
		
	function makeFixedNavigation()
	{
			
		// Define basic variables
		var win = $(window);
		var offsetEl = $('.sticky-nav-element-offset');
					
			
		// Fixed navigation element
		// Check if body has 'fixed-nav' class
		if (offsetEl.length !=0 && $('body').hasClass('sticky-nav'))			
		{			
				
			var fixedEl = $('#main-navigation');
			var fixedElWrap = fixedEl.parent();			
			var elOffset = offsetEl.offset().top;
			var fixElHeight = fixedEl.outerHeight(true);
			
			
			// Find fixed element			
			// If window scrollTp is the same as fixed element offset top
			// add fixed class to the fixed element
			if (win.scrollTop() > elOffset)
			{				
				fixedEl.addClass('sticky-nav-element');
				offsetEl.css({'height':fixElHeight});					
			}
			else
			{
				fixedEl.removeClass('sticky-nav-element');
				offsetEl.css({'height':0});	
			}
							
		}
	}
	
	
	
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Init colorpicker
	/*-----------------------------------------------------------*/	
	$('input.mb2color').each(function(){
	
		$(this).spectrum({
			showInput: true,
			showButtons: false,
			preferredFormat: 'rgb',
			allowEmpty: true,
			color: '',
			showAlpha: true
		});
	
	});	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Icon navigation
	/*-----------------------------------------------------------*/
	var iconNavHeight = $('#theme-iconnav').height();	
	$('#theme-iconnav').css({'margin-top':Math.ceil((iconNavHeight/2)*-1)});
	
	$('#theme-iconnav li').each(function(){		
		
		var linkEl = $(this).find('a');
		var textEl = $(this).find('span.iconnavtext');
		var isRtl = $('body').hasClass('dir-rtl');
			
		linkEl.hover(			
			function(){				
				
				if (isRtl)
				{
					textEl.stop().animate({'left':'100%'},300);
				}
				else
				{
					textEl.stop().animate({'right':'100%'},300);
				}
							
			},		
			
			function(){
				
				if (isRtl)
				{
					textEl.stop().animate({'left':-500},150);							
				}
				else
				{
					textEl.stop().animate({'right':-500},150);	
				}
				
			}		
		);	
		
	});
	
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Page outer min height
	/*-----------------------------------------------------------*/	
	
	setOuterHeight();
	
	
	$(window).on('resize',function(){
		
		setOuterHeight();
		
	});
	
	
	function setOuterHeight()
	{
		$('#page-outer').css({'min-height':$(window).height()});
	}
	
	
	
	
	
	
});






(function($){$(window).on('load', function(){	

	
	
	
	/*-----------------------------------------------------------*/
	/*	Sliding panel
	/*-----------------------------------------------------------*/
	
	$('.theme-loginform').show();
	$('.theme-searchform').show();
	$('.theme-links').show();
	
	$('.header-tools a').click(function(e){
		
		e.preventDefault();
		
		
		
		if ($(this).hasClass('toll-links'))
		{
			$('.theme-loginform').hide();
			$('.theme-searchform').hide();
			$('.theme-links').show();
			
			$('.toll-search').removeClass('active');
			$('.toll-login').removeClass('active');
		}
		else if ($(this).hasClass('toll-login'))
		{
			$('.theme-loginform').show();
			$('.theme-searchform').hide();
			$('.theme-links').hide();
			
			$('.toll-links').removeClass('active');
			$('.toll-search').removeClass('active');	
		}
		else
		{
			$('.theme-loginform').hide();
			$('.theme-searchform').show();
			$('.theme-links').hide();
			
			$('.toll-links').removeClass('active');
			$('.toll-login').removeClass('active');
		}
		
		panelOpen();
		
		
		
		
		var panel = $('.sliding-panel');	
		
		if (panel.hasClass('open') && $(this).hasClass('active'))
		{
			panelClose();	
		}
		
		
		if (panel.hasClass('open'))
		{
		
		$(this).addClass('active');
		}
					
		
	});	
	
	
	
	panelMarginTop();
	$(window).on('resize', function(){
		panelClose();
		panelMarginTop();
	});	
	
	
	function panelMarginTop()
	{
		
		var panel = $('.sliding-panel');
		var buttons = panel.find('btn');		
		panel.css({'margin-top':Math.ceil((panel.height()+1)*-1)});		
		
	}	
	
	
	
	function panelOpen ()
	{
		
		var panel = $('.sliding-panel');
		
		
		if (panel.hasClass('closed'))
		{
			panelMarginTop();
			
			panel.stop().animate({'margin-top':0}, 350);
			panel.removeClass('closed');
			panel.addClass('open');
		}		
	}	
	
	
	function panelClose ()
	{
		
		var panel = $('.sliding-panel');
		
		
		if (panel.hasClass('open'))
		{
		
			panel.stop().animate({'margin-top':Math.ceil(($('.sliding-panel').height()+1)*-1)}, 350);
			panel.removeClass('open');
			panel.addClass('closed');
			$('.header-tools a').removeClass('active');
		
		}
		
	}
	
	
	
	
	
	/*-----------------------------------------------------------*/
	/*	Loading screen
	/*-----------------------------------------------------------*/	
	var loadingDiv = $('.loading-scr');
		
	setTimeout(function(){
		loadingDiv.fadeOut(150);	
	}, loadingDiv.data('hideafter'));
	
	
	
		
	
})})(jQuery);


