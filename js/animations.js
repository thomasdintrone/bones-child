$(function(){
	/************************************************************
	SET UP THE BASICS:
	************************************************************/
	// Load PrettyPhoto (Lightbox)
	//$("a[rel^='prettyPhoto']").prettyPhoto();
	
	// For ie10 Selection => reflected in css/browsers.css
	var b = document.documentElement;
	b.setAttribute('data-useragent',  navigator.userAgent);
	b.setAttribute('data-platform', navigator.platform );
	
	/************************************************************
	CUSTOM CODING:
	************************************************************/
	// SCROLL TO BUTTON(S)
	$('a#down').on({
		click: function(){
			goToByScroll('slide2');
			return false;
		}
	});
	
	/* Mobile Menu */
	$('a#openMenu').on({
		click: function(){
			
			$('body,html').addClass('noScroll');
			
			$('div.mobileMenuWrap').fadeIn('fast');
			
			return false;
		}
	});
	$('a#closeMenu').on({
		click: function(){
			
			$('body,html').removeClass('noScroll');
			
			$('div.mobileMenuWrap').fadeOut('fast');
			
			return false;
		}
	});
	
	// IE8 Bug Fix for fontawesome menu icon
	if($('html').hasClass('lt-ie9')) {
			var head = document.getElementsByTagName('head')[0],
			style = document.createElement('style');
		style.type = 'text/css';
		style.styleSheet.cssText = ':before,:after{content:none !important';
		head.appendChild(style);
		setTimeout(function(){
			head.removeChild(style);
		}, 0);
	}
	
	/************************************************************
	WINDOW RESIZE (if needed)
	************************************************************/
	$(window).resize(function(){
	
		if($(window).width() >= '768') { // ipad
			
			$('div.mobileMenuWrap').show();
			
		} else {
			$('div.mobileMenuWrap').hide(); 
		}
		
		// IE8 Bug Fix for fontawesome menu icon
		if($('html').hasClass('lt-ie9')) {
				var head = document.getElementsByTagName('head')[0],
				style = document.createElement('style');
			style.type = 'text/css';
			style.styleSheet.cssText = ':before,:after{content:none !important';
			head.appendChild(style);
			setTimeout(function(){
				head.removeChild(style);
			}, 0);
		}
	
	});
	
	
	/************************************************************
	REPSONSIVE (if needed)
	************************************************************/
	if($(window).width() == '768') { // ipad
			
	} else {
							 
	}
	
	// OR? - haven't tested this yet...
	var isiPad = navigator.userAgent.match(/iPad/i) != null;
	function isiPhone(){
		return (
			//Detect iPhone
			(navigator.platform.indexOf("iPhone") != -1) ||
			//Detect iPod
			(navigator.platform.indexOf("iPod") != -1)
		);
	}
});

$(window).load(function(){
	// Home Content
	
	var windowHeight = $(window).height();
	var windowWidth = $(window).width();
	
	if(windowHeight < 750 && windowWidth > 320) {
		contentHeight = '750px';
	}  else {
		contentHeight = windowHeight;
	}
	
	$('section.homeContent').css({ 'min-height':contentHeight});
	
	// Center the banner
	var bannerheight 		= $('.bannerWrap').height();
	var homeContentHeight 	= $('.homeContent').height();
	
	// Calculate the height
	var tPos = (homeContentHeight - bannerheight)/2;
	$('.bannerWrap').css({ 'visibility':'visible', opacity:0, top:tPos }).animate({ opacity:1 });
	
	// center logo shadow
	var logoWidth = $('.logo img').width();
	var logoShadow = $('.logoShadow').width();
	var lPos = ((logoShadow - logoWidth)/2) - 17;
	$('.logoShadow').css({ left:-lPos });
});