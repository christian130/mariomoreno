$(document).ready(function(){


	
	
		// owlCarousel Slider one
	$("#slider_one").owlCarousel({
		    navigation : true,
		    navigationText: true,
		    navigationText : ["<i class='inline left-iocn fa fa-caret-left'></i>","<i class='inline right-icon fa fa-caret-right'></i>"],
			items : 1,
			itemsDesktop : [1199,1],
			itemsDesktopSmall : [979,1],
			itemsDesktopSmall : [768,1],
			itemsDesktopSmall : [767,1],
			pagination : false,
	
		}); 
		
		// owlCarousel Slider two
	$("#slider_two").owlCarousel({
		    navigation : true,
		    navigationText: true,
		    navigationText : ["<i class='inline slider-two-left-iocn fa fa-angle-left'></i>","<i class='inline slider-tow-right-icon fa fa-angle-right'></i>"],
			items : 3,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,2],
			pagination : false,
	
		}); 
		
		
		
		$('.setting_dropdown_menu').hide();

		$('.setting_icon').mouseenter(function() {
			$('.setting_dropdown_menu').show();
		});
		$('.setting_dropdown_menu').mouseleave(function() {
			$('.setting_dropdown_menu').hide();
		});

		
		$('.impor').hide();

		$('.hover_show').mouseenter(function() {
			$('.impor').show();
		});
		$('.impor').mouseleave(function() {
			$('.impor').hide();
		}); 







})




























