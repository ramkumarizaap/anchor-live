	
// Global Function Start
	// Get OS
	var os = [ 
		'iphone', 
		'ipad', 
		'windows', 
		'mac', 
		'linux'];

	var match = navigator.appVersion.toLowerCase().match(
		new RegExp(os.join('|'))
	);

	var classes = match[0]+' '+$.browser.name+' Version-'+$.browser.version;
	if (match) { 
		$('body').addClass(classes); 
	};


	// File Upload
	function showImagee(src,target) {
	  var fr=new FileReader();
	  // when image is loaded, set the src of the image where you want to display it
	  fr.onload = function(e) { target.src = this.result; };
	  
	  src.addEventListener("change",function() {
	    // fill fr with image data    
	    fr.readAsDataURL(src.files[0]);
	  });
	}

	
// Global Function End


	/* Ready Function */
$(function(){
	
	// SVG Replace
	console.log("HRM");

	if( $("#src").length && $("#target").length )
	{
		var src = document.getElementById("src");
		var target = document.getElementById("target");
		showImagee(src, target);
	};
	$('img.svg').each(function(){
        var $img = $(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');
    
        $.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = $(data).find('svg');
    
            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }
    
            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');
            
            // Check if the viewport is set, else we gonna set it if we can.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }
    
            // Replace image with new SVG
            $img.replaceWith($svg);
    
        }, 'xml');
    
    }); // SVG Replace


/* Functions */
	window.onbeforeunload = function(){ window.scrollTo(0,0); }

	/* Body Fadein */
	$('body').animate({opacity:1},1000);
	/* Scroll Animation */ 
	$('*[data-animated]').addClass('animated');

	$('.leftCol > .sidebar').matchHeight();

	/* Animate */	
	function animated_contents() {
		$(".animated:appeared").each(function (i) {
			var $this    = $(this),
				animated = $(this).data('animated'),
				delay = $(this).data('delay');
			setTimeout(function () {
				$this.addClass(animated);
				$this.addClass('delay'+delay);
			}, 70 * i);
		});
	}

	$(window).scroll(function() {
		animated_contents();
	});

	/* Parallex Move */
	/*$('.circleTrust').parallax("50%", 0.1);*/
	//$('.intro').parallax("50%", 0.85);

	/* Background Image */
	$('[data-bg]').each(function(){
		var curBg = $(this).data('bg');
		$(this).css('background-image','url('+curBg+')');
	});  

	/* Tab */
	$('.tabTitle a').click(function(e){

	if(!$(this).hasClass('active')){
		$('.tabTitle a').removeClass('active');
		$(this).addClass('active');
		var tabIdentity = $(this).data('tab');
		$('.tabFeature').hide();
		$('#'+tabIdentity).fadeIn(800);
	}

		return false;

	});


	// table dynamic data content
	$('table tr td').each(function(index, element) {
		var th = $('table thead th').eq($(this).index()).text();
        $(this).attr('data-title', th);
    });

 	// /*jquery ui selectbox*/
	// $.widget('app.selectmenu', $.ui.selectmenu, {
	// 	_drawButton: function() {
	// 		this._super();
			
	// 		var selected = this.element
	// 				.find( '[selected]' )
	// 				.length,
	// 			placeholder = this.options.placeholder;
			
	// 		if ( !selected && placeholder ) {
	// 			this.buttonText.text( placeholder );    
	// 		}
	// 	}
	// });

	/* Generic Slide */
	$('.genericSlide').slick({
		dots: false,
		arrows: true,
    	infinite: false,
		prevArrow: '<div class="triangleArrow slick-prev"><img src="assets/img/svg/arrow-left.svg" class="svg"/></div>',
		nextArrow: '<div class="triangleArrow slick-next"><img src="assets/img/svg/arrow-right.svg" class="svg" /></div>',
  		slidesToShow: 1,
  		slidesToScroll: 1,
	});


	// jQueryUI Toogle
	$('.accordion').accordion({
		heightStyle: "content",
		collapsible: true,
    	active: false
	
	}); // accordion

	// jQueryUI Tabs
    $('#tabs').tabs();

    // jQueryUI Check box + Radio Boxes
   	// $('checkbox').checkboxradio({ icon: false });
   	// $('radio').checkboxradio({ icon: false });
    	$("#forGot").checkboxradio({ icon: false });
    	$(".radio").checkboxradio({ icon: false });
    	$(".checkbox").checkboxradio({ icon: false });

   	// custom dropdown 
   	$(".dropbtn").on("click",function(){
    	var id = $(this).nextAll(".dropdown-content").attr("id");
    	document.getElementById(id).classList.toggle("show");
  	});


   

  // $( function() {
  //   $( "input" ).checkboxradio();
  //   $( "fieldset" ).controlgroup();
  // } );


 // $("checkbox").checkboxradio();
    
	

	// Anchor Target _Blank
	$('a[href$=".pdf"]').attr('target', '_blank');
	$('a[href$=".ppt"]').attr('target', '_blank');
	$('a[href$=".doc"]').attr('target', '_blank');
	$('a[href$=".pptx"]').attr('target', '_blank');
	$('a[href$=".docx"]').attr('target', '_blank');


	/* Scroll to next */
	$('a.scrollToNext').on('click', function(){
		var $thisHref = $(this).attr('href');
		$('html, body').animate({
			scrollTop: $($thisHref).offset().top
		}, 1000);
		return false;
	});


	

	// Filter Active State

	$('.filter').on('click', 'li', function(){
    	$('.filter li').removeClass('active');
    	$(this).addClass('active');
	});

	/**********************************************\
	 *	Code Example:
	 *	<nav class="filter">
	 *		<li class="active"><a href="javascript:void(0);">Value</a></li>
	 *		<li><a href="javascript:void(0);">Value</a></li>
	 *		<li><a href="javascript:void(0);">Value</a></li>
	 *	</nav>
	/**********************************************/




/* side bar Menu Start*/
$.sidebarMenu = function(menu) {
  var animationSpeed = 300,
    subMenuSelector = 'ul';

  $(menu).on('click', 'li a', function(e) {
    var $this = $(this);
    var checkElement = $this.next();

    if (checkElement.is(subMenuSelector) && checkElement.is(':visible')) {
      checkElement.slideUp(animationSpeed, function() {
        checkElement.removeClass('menu-open');
      });
      checkElement.parent("li").removeClass("active");
    }

    //If the menu is not visible
    else if ((checkElement.is(subMenuSelector)) && (!checkElement.is(':visible'))) {
      //Get the parent menu
      var parent = $this.parents('ul').first();
      //Close all open menus within the parent
      var ul = parent.find('ul:visible').slideUp(animationSpeed);
      //Remove the menu-open class from the parent
      ul.removeClass('menu-open');
      //Get the parent li
      var parent_li = $this.parent("li");

      //Open the target menu and add the menu-open class
      checkElement.slideDown(animationSpeed, function() {
        //Add the class active to the parent li
        checkElement.addClass('menu-open');
        parent.find('li.active').removeClass('active');
        parent_li.addClass('active');
      });
    }
    //if this isn't a link, prevent the page from being redirected
    if (checkElement.is(subMenuSelector)) {
      e.preventDefault();
    }
  });
}

$.sidebarMenu($('.sidebar-menu'));
/* side bar Menu End*/






/* Resize Function */
if(!Modernizr.touch) { 
	$(window).resize(function(){
		
	}); // resize
} // Modernizr.touch

/* Orientation Function */
$(window).on("orientationchange",function(){ 

}); // orientationchange

}); // function


