// Modernizr.load loading the right scripts only if you need them
Modernizr.load([
 {
	// jqtrans-form
	load : ['http://atrabile.org/wp-content/themes/atrabile/library/js/jquery.jqtransform.js'],
	complete : function() {
	    $("form.jqtransform").jqTransform();
   }
}, {
	// Let's see if we need to load selectivizr
	test : Modernizr.borderradius,
	// Modernizr.load loads selectivizr and Respond.js for IE6-8
	nope : ['http://atrabile.org/wp-content/themes/atrabile/library/js/libs/selectivizr-min.js']
}, {
	// load label input
	load : ['http://atrabile.org/wp-content/themes/atrabile/library/js/jquery.infieldlabel.min.js'],
	complete : function() {
		// label into input (newsletter subscribe)
		$("label").inFieldLabels();
	}
}, {
	// load isotope - filter books
	load : ['http://atrabile.org/wp-content/themes/atrabile/library/js/jquery.isotope.min.js'],
	complete : function() {
		// cache container
		var $container = $('#catalogue-content');
		// initialize isotope
		$container.isotope({
			animationEngine: 'jquery',
		  	animationOptions: {
			    duration: 350,
			    easing: 'linear',
			    queue: false
		   },
		   layoutMode : 'fitRows'
		});
		
		// filter items when filter link is clicked
		$('#filters a').click(function(){
		  var selector = $(this).attr('data-filter');
		  $container.isotope({ filter: selector });
		  return false;
		});
	}
}
// , {
	// // load tooltip
	// load : ['http://atrabile.org/wp-content/themes/atrabile/library/js/jquery.tools.min.js'],
	// complete : function() {
		// // trigger tooltip
		// $('.image_catalogue').tooltip({
        // position: 'top right',
        // // tweak the position
        // offset: [-100, -40],
        // opacity: 1,
        // effect: 'toggle',
        // onBeforeShow: function(event, position){
            // this.getTip().appendTo('body');
            // this.getTip().css({
                // 'z-index': '100'
            // });
            // return true;
        // }
    // })//.dynamic({
        // // right: {
            // // direction: 'left'
        // // }
    // // });
	// }
// }
]);

/* imgsizer (flexible images for fluid sites) */
var imgSizer = {
	Config : {
		imgCache : [],
		spacer : "/path/to/your/spacer.gif"
	},
	collate : function(aScope) {
		var isOldIE = (document.all && !window.opera && !window.XDomainRequest) ? 1 : 0;
		if(isOldIE && document.getElementsByTagName) {
			var c = imgSizer;
			var imgCache = c.Config.imgCache;
			var images = (aScope && aScope.length) ? aScope : document.getElementsByTagName("img");
			for(var i = 0; i < images.length; i++) {
				images[i].origWidth = images[i].offsetWidth;
				images[i].origHeight = images[i].offsetHeight;
				imgCache.push(images[i]);
				c.ieAlpha(images[i]);
				images[i].style.width = "100%";
			}
			if(imgCache.length) {
				c.resize(function() {
					for(var i = 0; i < imgCache.length; i++) {
						var ratio = (imgCache[i].offsetWidth / imgCache[i].origWidth);
						imgCache[i].style.height = (imgCache[i].origHeight * ratio) + "px";
					}
				});
			}
		}
	},
	ieAlpha : function(img) {
		var c = imgSizer;
		if(img.oldSrc) {
			img.src = img.oldSrc;
		}
		var src = img.src;
		img.style.width = img.offsetWidth + "px";
		img.style.height = img.offsetHeight + "px";
		img.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "', sizingMethod='scale')"
		img.oldSrc = src;
		img.src = c.Config.spacer;
	},
	resize : function(func) {
		var oldonresize = window.onresize;
		if( typeof window.onresize != 'function') {
			window.onresize = func;
		} else {
			window.onresize = function() {
				if(oldonresize) {
					oldonresize();
				}
				func();
			}
		}
	}
}

// as the page loads
$(document).ready(function() {

	// nav auto-hide
	$('nav.menu').delay(5000).fadeOut();
	// show on hover header & stop auto fadeOut
	$('#inner-header').mouseenter(function() {
		$('nav.menu').stop(true, true).show()
	});
	$('#inner-header').mouseleave(function() {
		$('nav.menu').delay(2000).fadeOut()
	});
	// label into input (newsletter subscribe)
	// $("label").inFieldLabels();
	
	//slide livre desc.
	$('.cat-desc').click(function(){
		$(this).next('.collapsed').stop(true, true).slideToggle()
	});

});
/* end of as page load scripts */