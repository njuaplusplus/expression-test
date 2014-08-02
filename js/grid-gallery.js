// Simple JavaScript Templating
// John Resig - http://ejohn.org/ - MIT Licensed
(function(){
  var cache = {};
 
  this.jrtmpl = function tmpl(str, data){
	// Figure out if we're getting a template, or if we need to
	// load the template - and be sure to cache the result.
	var fn = !/\W/.test(str) ?
	  cache[str] = cache[str] ||
		tmpl(document.getElementById(str).innerHTML) :
	 
	  // Generate a reusable function that will serve as a template
	  // generator (and which will be cached).
	  new Function("obj",
		"var p=[],print=function(){p.push.apply(p,arguments);};" +
	   
		// Introduce the data as local variables using with(){}
		"with(obj){p.push('" +
	   
		// Convert the template into pure JavaScript
		str
		  .replace(/[\r\t\n]/g, " ")
		  .split("<%").join("\t")
		  .replace(/((^|%>)[^\t]*)'/g, "$1\r")
		  .replace(/\t=(.*?)%>/g, "',$1,'")
		  .split("\t").join("');")
		  .split("%>").join("p.push('")
		  .split("\r").join("\\'")
	  + "');}return p.join('');");
   
	// Provide some basic currying to the user
	return data ? fn( data ) : fn;
  };
})();

/**
 * jQuery Plugin to obtain touch gestures from iPhone, iPod Touch and iPad, should also work with Android mobile phones (not tested yet!)
 * Common usage: wipe images (left and right to show the previous or next image)
 * 
 * @author Andreas Waltl, netCU Internetagentur (http://www.netcu.de)
 * @version 1.1.1 (9th December 2010) - fix bug (older IE's had problems)
 * @version 1.1 (1st September 2010) - support wipe up and wipe down
 * @version 1.0 (15th July 2010)
 */
(function($){$.fn.touchwipe=function(settings){var config={min_move_x:20,min_move_y:20,wipeLeft:function(){},wipeRight:function(){},wipeUp:function(){},wipeDown:function(){},preventDefaultEvents:true};if(settings)$.extend(config,settings);this.each(function(){var startX;var startY;var isMoving=false;function cancelTouch(){this.removeEventListener('touchmove',onTouchMove);startX=null;isMoving=false}function onTouchMove(e){if(config.preventDefaultEvents){e.preventDefault()}if(isMoving){var x=e.touches[0].pageX;var y=e.touches[0].pageY;var dx=startX-x;var dy=startY-y;if(Math.abs(dx)>=config.min_move_x){cancelTouch();if(dx>0){config.wipeLeft()}else{config.wipeRight()}}else if(Math.abs(dy)>=config.min_move_y){cancelTouch();if(dy>0){config.wipeDown()}else{config.wipeUp()}}}}function onTouchStart(e){if(e.touches.length==1){startX=e.touches[0].pageX;startY=e.touches[0].pageY;isMoving=true;this.addEventListener('touchmove',onTouchMove,false)}}if('ontouchstart'in document.documentElement){this.addEventListener('touchstart',onTouchStart,false)}});return this}})(jQuery);


/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
* Licensed under the MIT License (LICENSE.txt).
*
* Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
* Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
* Thanks to: Seamus Leahy for adding deltaX and deltaY
*
* Version: 3.0.6
*
* Requires: 1.2.2+
*/

(function(d){var b=["DOMMouseScroll","mousewheel"];if(d.event.fixHooks){for(var a=b.length;a;){d.event.fixHooks[b[--a]]=d.event.mouseHooks}}d.event.special.mousewheel={setup:function(){if(this.addEventListener){for(var e=b.length;e;){this.addEventListener(b[--e],c,false)}}else{this.onmousewheel=c}},teardown:function(){if(this.removeEventListener){for(var e=b.length;e;){this.removeEventListener(b[--e],c,false)}}else{this.onmousewheel=null}}};d.fn.extend({mousewheel:function(e){return e?this.bind("mousewheel",e):this.trigger("mousewheel")},unmousewheel:function(e){return this.unbind("mousewheel",e)}});function c(j){var h=j||window.event,g=[].slice.call(arguments,1),k=0,i=true,f=0,e=0;j=d.event.fix(h);j.type="mousewheel";if(h.wheelDelta){k=h.wheelDelta/120}if(h.detail){k=-h.detail/3}e=k;if(h.axis!==undefined&&h.axis===h.HORIZONTAL_AXIS){e=0;f=-1*k}if(h.wheelDeltaY!==undefined){e=h.wheelDeltaY/120}if(h.wheelDeltaX!==undefined){f=-1*h.wheelDeltaX/120}g.unshift(j,k,f,e);return(d.event.dispatch||d.event.handle).apply(this,g)}})(jQuery);



/**
 * @author trixta
 * @version 1.2
 */
(function(c){var b={pos:[-260,-260]},d=3,h=document,g=h.documentElement,e=h.body,a,i;function f(){if(this===b.elem){b.pos=[-260,-260];b.elem=false;d=3}}c.event.special.mwheelIntent={setup:function(){var j=c(this).bind("mousewheel",c.event.special.mwheelIntent.handler);if(this!==h&&this!==g&&this!==e){j.bind("mouseleave",f)}j=null;return true},teardown:function(){c(this).unbind("mousewheel",c.event.special.mwheelIntent.handler).unbind("mouseleave",f);return true},handler:function(j,k){var l=[j.clientX,j.clientY];if(this===b.elem||Math.abs(b.pos[0]-l[0])>d||Math.abs(b.pos[1]-l[1])>d){b.elem=this;b.pos=l;d=250;clearTimeout(i);i=setTimeout(function(){d=10},200);clearTimeout(a);a=setTimeout(function(){d=3},1500);j=c.extend({},j,{type:"mwheelIntent"});return c.event.handle.apply(this,arguments)}}};c.fn.extend({mwheelIntent:function(j){return j?this.bind("mwheelIntent",j):this.trigger("mwheelIntent")},unmwheelIntent:function(j){return this.unbind("mwheelIntent",j)}});c(function(){e=h.body;c(h).bind("mwheelIntent.mwheelIntentDefault",c.noop)})})(jQuery);

/**
 * jQuery Masonry v2.1.05
 * A dynamic layout plugin for jQuery
 * The flip-side of CSS Floats
 * http://masonry.desandro.com
 *
 * Licensed under the MIT license.
 * Copyright 2012 David DeSandro
 */
(function(a,b,c){"use strict";var d=b.event,e;d.special.smartresize={setup:function(){b(this).bind("resize",d.special.smartresize.handler)},teardown:function(){b(this).unbind("resize",d.special.smartresize.handler)},handler:function(a,c){var d=this,f=arguments;a.type="smartresize",e&&clearTimeout(e),e=setTimeout(function(){b.event.handle.apply(d,f)},c==="execAsap"?0:100)}},b.fn.smartresize=function(a){return a?this.bind("smartresize",a):this.trigger("smartresize",["execAsap"])},b.Mason=function(a,c){this.element=b(c),this._create(a),this._init()},b.Mason.settings={isResizable:!0,isAnimated:!1,animationOptions:{queue:!1,duration:500},gutterWidth:0,isRTL:!1,isFitWidth:!1,containerStyle:{position:"relative"}},b.Mason.prototype={_filterFindBricks:function(a){var b=this.options.itemSelector;return b?a.filter(b).add(a.find(b)):a},_getBricks:function(a){var b=this._filterFindBricks(a).css({position:"absolute"}).addClass("masonry-brick");return b},_create:function(c){this.options=b.extend(!0,{},b.Mason.settings,c),this.styleQueue=[];var d=this.element[0].style;this.originalStyle={height:d.height||""};var e=this.options.containerStyle;for(var f in e)this.originalStyle[f]=d[f]||"";this.element.css(e),this.horizontalDirection=this.options.isRTL?"right":"left",this.offset={x:parseInt(this.element.css("padding-"+this.horizontalDirection),10),y:parseInt(this.element.css("padding-top"),10)},this.isFluid=this.options.columnWidth&&typeof this.options.columnWidth=="function";var g=this;setTimeout(function(){g.element.addClass("masonry")},0),this.options.isResizable&&b(a).bind("smartresize.masonry",function(){g.resize()}),this.reloadItems()},_init:function(a){this._getColumns(),this._reLayout(a)},option:function(a,c){b.isPlainObject(a)&&(this.options=b.extend(!0,this.options,a))},layout:function(a,b){for(var c=0,d=a.length;c<d;c++)this._placeBrick(a[c]);var e={};e.height=Math.max.apply(Math,this.colYs);if(this.options.isFitWidth){var f=0;c=this.cols;while(--c){if(this.colYs[c]!==0)break;f++}e.width=(this.cols-f)*this.columnWidth-this.options.gutterWidth}this.styleQueue.push({$el:this.element,style:e});var g=this.isLaidOut?this.options.isAnimated?"animate":"css":"css",h=this.options.animationOptions,i;for(c=0,d=this.styleQueue.length;c<d;c++)i=this.styleQueue[c],i.$el[g](i.style,h);this.styleQueue=[],b&&b.call(a),this.isLaidOut=!0},_getColumns:function(){var a=this.options.isFitWidth?this.element.parent():this.element,b=a.width();this.columnWidth=this.isFluid?this.options.columnWidth(b):this.options.columnWidth||this.$bricks.outerWidth(!0)||b,this.columnWidth+=this.options.gutterWidth,this.cols=Math.floor((b+this.options.gutterWidth)/this.columnWidth),this.cols=Math.max(this.cols,1)},_placeBrick:function(a){var c=b(a),d,e,f,g,h;d=Math.ceil(c.outerWidth(!0)/this.columnWidth),d=Math.min(d,this.cols);if(d===1)f=this.colYs;else{e=this.cols+1-d,f=[];for(h=0;h<e;h++)g=this.colYs.slice(h,h+d),f[h]=Math.max.apply(Math,g)}var i=Math.min.apply(Math,f),j=0;for(var k=0,l=f.length;k<l;k++)if(f[k]===i){j=k;break}var m={top:i+this.offset.y};m[this.horizontalDirection]=this.columnWidth*j+this.offset.x,this.styleQueue.push({$el:c,style:m});var n=i+c.outerHeight(!0),o=this.cols+1-l;for(k=0;k<o;k++)this.colYs[j+k]=n},resize:function(){var a=this.cols;this._getColumns(),(this.isFluid||this.cols!==a)&&this._reLayout()},_reLayout:function(a){var b=this.cols;this.colYs=[];while(b--)this.colYs.push(0);this.layout(this.$bricks,a)},reloadItems:function(){this.$bricks=this._getBricks(this.element.children())},reload:function(a){this.reloadItems(),this._init(a)},appended:function(a,b,c){if(b){this._filterFindBricks(a).css({top:this.element.height()});var d=this;setTimeout(function(){d._appended(a,c)},1)}else this._appended(a,c)},_appended:function(a,b){var c=this._getBricks(a);this.$bricks=this.$bricks.add(c),this.layout(c,b)},remove:function(a){this.$bricks=this.$bricks.not(a),a.remove()},destroy:function(){this.$bricks.removeClass("masonry-brick").each(function(){this.style.position="",this.style.top="",this.style.left=""});var c=this.element[0].style;for(var d in this.originalStyle)c[d]=this.originalStyle[d];this.element.unbind(".masonry").removeClass("masonry").removeData("masonry"),b(a).unbind(".masonry")}},b.fn.imagesLoaded=function(a){function h(){a.call(c,d)}function i(a){var c=a.target;c.src!==f&&b.inArray(c,g)===-1&&(g.push(c),--e<=0&&(setTimeout(h),d.unbind(".imagesLoaded",i)))}var c=this,d=c.find("img").add(c.filter("img")),e=d.length,f="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",g=[];return e||h(),d.bind("load.imagesLoaded error.imagesLoaded",i).each(function(){var a=this.src;this.src=f,this.src=a}),c};var f=function(b){a.console&&a.console.error(b)};b.fn.masonry=function(a){if(typeof a=="string"){var c=Array.prototype.slice.call(arguments,1);this.each(function(){var d=b.data(this,"masonry");if(!d){f("cannot call methods on masonry prior to initialization; attempted to call method '"+a+"'");return}if(!b.isFunction(d[a])||a.charAt(0)==="_"){f("no such method '"+a+"' for masonry instance");return}d[a].apply(d,c)})}else this.each(function(){var c=b.data(this,"masonry");c?(c.option(a||{}),c._init()):b.data(this,"masonry",new b.Mason(a,this))});return this}})(window,jQuery);

/*!
 * jQuery imagesLoaded plugin v1.0.4
 * http://github.com/desandro/imagesloaded
 *
 * MIT License. by Paul Irish et al.
 */

(function(a,b){a.fn.imagesLoaded=function(i){var g=this,e=g.find("img").add(g.filter("img")),c=e.length,h="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";function f(){i.call(g,e)}function d(j){if(--c<=0&&j.target.src!==h){setTimeout(f);e.unbind("load error",d)}}if(!c){f()}e.bind("load error",d).each(function(){if(this.complete||this.complete===b){var j=this.src;this.src=h;this.src=j}});return g}})(jQuery);

/*
 * Special event for image load events
 * Needed because some browsers does not trigger the event on cached images.

 * MIT License
 * Paul Irish     | @paul_irish | www.paulirish.com

 * Andree Hansson | @peolanha   | www.andreehansson.se
 * 2010.
 *
 * Usage:
 * $(images).bind('load', function (e) {
 *   // Do stuff on load
 * });
 * 
 * Note that you can bind the 'error' event on data uri images, this will trigger when
 * data uri images isn't supported.
 * 
 * Tested in:
 * FF 3+
 * IE 6-8
 * Chromium 5-6
 * Opera 9-10
 */


(function($){

	PEXETO.share = {

		facebook:function(url){
			return '<iframe src="//www.facebook.com/plugins/like.php?href='+encodeURIComponent(url)+'&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>'; 
		},
		gplus:function(url, lang){
			return '<div class="g-plusone" data-size="medium" data-href="'+url+'"></div>\
					<script type="text/javascript" >\
					window.___gcfg = {lang: "'+lang+'"};\
					  (function() {\
						var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;\
						po.src = "https://apis.google.com/js/plusone.js";\
						var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);\
					  })();\
					</script>'
		},
		twitter:function(url, text){
			return '<iframe allowtransparency="true" frameborder="0" scrolling="no" src="https://platform.twitter.com/widgets/tweet_button.html?url='+encodeURIComponent(url)+'&counturl='+encodeURIComponent(url)+'&text='+encodeURIComponent(text)+'" style="width:130px; height:20px;"></iframe>'
		},
		pinterest:function(url, image, title){
			return '<a href="http://pinterest.com/pin/create/button/?url='+encodeURIComponent(url)+'&media='+encodeURIComponent(image)+'&description='+encodeURIComponent(title)+'" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a><script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';
		}
	};

})(jQuery);

/**
 * Rotation script.
 * code from http://javascriptisawesome.blogspot.com.au/2011/09/jquery-css-rotate-and-animate-rotation.html
 */
(function($){
 var _e = document.createElement("canvas").width
 $.fn.cssrotate = function(d) {  
	return this.css({
  '-moz-transform':'rotate('+d+'deg)',
  '-webkit-transform':'rotate('+d+'deg)',
  '-o-transform':'rotate('+d+'deg)',
  '-ms-transform':'rotate('+d+'deg)'
 }).prop("rotate", _e ? d : null)
 }; 
 var $_fx_step_default = $.fx.step._default;
 $.fx.step._default = function (fx) {
 if(fx.prop != "rotate")return $_fx_step_default(fx);
 if(typeof fx.elem.rotate == "undefined")fx.start = fx.elem.rotate = 0;
 $(fx.elem).cssrotate(fx.now)
 }; 
})(jQuery);

/**
 * Fullscreen slider of images. Displays the images in full-width or full-height size of the window, with the following functionality enabled:
 * - previous/next arrows for navigation
 * - thumbnail tooltips for image preview on previous and next arrows
 * - fullscreen button for displaying the image on the fullscreen without the additional elements such as header and footer
 * - sharing functionality
 * - close button
 * - description for each image
 * - image counter 
 * 
 * Dependencies:
 * - imagesLoaded - Paul Irish
 * - mousewheel - Brandon Aaron (http://brandonaaron.net)
 * - mwheelintent - http://www.protofunc.com/scripts/jquery/mwheelIntent/
 * - jrtmpl - John Resig templating code
 * - PEXETO.share - builds the sharing buttons code
 * - touchwipe - Andreas Waltl (http://www.netcu.de)
 * - Rotation script - http://javascriptisawesome.blogspot.com.au/2011/09/jquery-css-rotate-and-animate-rotation.html
 *
 * Events triggered on the root object
 * - sliderImgLoaded - fired when the first image in the slider has been loaded and the slider is initialized
 * - fullscreen - fired when the fullscreen mode is changed
 * - nextItem - fired when the "Next Project" link was clicked (the initializator object should take care of showing the next item)
 * - prevItem - fired when the "Previous Project" link was clicked (the initializator object should take care of showing the previous item)
 * - imgRefresh - fired when something related with the image size and positioning is changed
 * - closeSlider - fired when the close button is clicked (the initializator object should take care of hiding the slider )
 * 
 * @author Pexeto
 * http://pexeto.com 
 */
(function( $ ) {
	var sliderIndex = 0;
	$.fn.pexetoFullscreenSlider = function( options ){
		
		var defaults={
			easing              : "easeOutElastic",
			animationSpeed      : 400,
			showThumbPreview    : true,
			fullscreen          : false,  //boolean setting the default fullscreen state (true if fullscreen)
			showClose           : true,   //boolean setting whether to show the Close button or not
			subtractElements    : [],     //array of jQuery objects whose height will be subtracted from the window height to set the image in full height (e.g. header, footer)
			loadPortions        : 5,      //number of images to load on portions

			//selectors and classes
			leftArrowId         : "preview-left-arrow",
			rightArrowId        : "preview-right-arrow",
			arrowsClass         : "preview-arrows",
			sliderImagesClass   : "slider-images",
			previewContentClass : "preview-content",
			imgWrapperClass     : "slider-img-wrapper",
			loadingClass        : "slider-loading",
			descriptionClass    : "item-desc",
			shareClass          : "item-share",
			countClass          : "item-count",
			closeClass          : "close-btn",
			fullsceenClass      : "fullscreen-btn",
			shareId             : "share-container",
			sharePointerClass   : "share-pointer",
			disabledArrowClass  : "disabled"
		},
		//define some helper variables that will be used globally by the plugin
		o = $.extend(defaults, options),
			$root             = $(this),
			item              = o.item,
			images            = item.images,
			imgNum            = images.length,
			$larrow           = null,
			$rarrow           = null,
			$larrowDiv        = null,
			$rarrowDiv        = null,
			$imageContainer   = null,
			$previewContent   = null,
			$descContainer    = null,
			$shareButton      = null,
			$shareContainer   = null,
			$countContainer   = null,
			$closeBtn         = null,
			$fullscreenBtn    = null,
			$lpreview         = null,
			$rpreview         = null,
			current           = 0,
			fullscreen        = false,
			inScreenAnimation = false,
			inAnimation       = false,
			pendingImg        = -1,
			shareShow         = false,
			isIE8             = $.browser.msie && parseInt($.browser.version, 10) === 8,
			isIdevice         =(navigator.platform === 'iPad' || navigator.platform === 'iPhone' || navigator.platform === 'iPod')?true:false,
			resizeArgs        = {fullwidth:item.fullwidth, subtractElements:o.subtractElements, resizeParent:!isIdevice, imgLoaded:true, fullscreen:o.fullscreen, imgSelector:"."+o.imgWrapperClass},
			$nextTooltip      = null,
			$prevTooltip      = null,
			rRotated          = false, //right arrow rotated
			lRotated          = false, //left arrow rotated
			sharingButtons    = [
				{name:"facebook", arg:[item.link]},
				{name:"twitter", arg:[item.link, o.texts.twitterText]},
				{name:"gplus", arg:[item.link, o.texts.gplusLang]},
				{name:"pinterest", arg:[item.link, item.images[0].img, item.title]}
			],
			showShare         = (o.excludeSharing.length===sharingButtons.length && !o.additionalButtons)?false:true,
			//TEMPLATES
			tmpl              = {
				previewContent : '<% if(showShare){ %><div class="'+o.shareClass+'">'+o.texts.shareText+'</div><% } %><div class="'+o.countClass+'"></div><div class="preview-description"><div class="item-title"><%= title %></div><div class="'+o.descriptionClass+'"></div></div>',

				shareContent: '<div id="'+o.shareId+'"><ul></ul><div class="'+o.sharePointerClass+'"></div></div>'
			},
			eventNs           = "fs"+sliderIndex,
			lastLoaded        = 0,
			iFullscreen       = false;

		/**
		 * Inits the main functionality - calls the initialization functions.
		 */
		function init() {
			sliderIndex++;

			var parentClass = item.fullwidth ? "full-width" : "full-height",
				removeClass = item.fullwidth ? "full-height" : "full-width";
			if(!o.showClose){
				parentClass+=' no-close';
			}
			$root.removeClass(removeClass).addClass(parentClass);
			if (o.fullscreen) {
				fullscreen = true;
			}

			buildMarkup();

			addNavigation();
			loadSlider();
			loadNextImages();
			bindEventHandlers();

		}

		/**
		 * Loads the slider once all the images are loaded.
		 */
		function loadSlider() {
			$imageContainer.imagesLoaded(function () {
				resizeArgs.subtractElements.push({
					el: $previewContent,
					position: "Bottom"
				});
				if (o.fullscreen) {
					setOuterElementsPosition(false);
				}
				setDescription(0);
				setCounter(0);
				 $root.trigger("sliderImgLoaded").pexetoResizableImg(resizeArgs);
				$previewContent.css({
					bottom: 0
				});
				refreshArrowState(false);
			});
		}

		/**
		 * Loads all the images:
		 * - creates an image element
		 * - binds on images loaded event
		 */
		function loadNextImages() {
			var i, image, thumb,
				len = (lastLoaded+o.loadPortions>=imgNum)?(imgNum-1):(lastLoaded+o.loadPortions);
			for (i = lastLoaded+1; i <= len; i += 1) {
				if(!images[i].loaded){
					image = new Image();
					thumb = null;
					image.setAttribute("src", images[i].img);

					//preload the thumbnail preview images
					if (o.showThumbPreview) {
						thumb = new Image();
						thumb.src = images[i].thumb;
					}

					(function (i) {
						images[i].el = $('<div/>', {
							"class": o.imgWrapperClass
						}).append(image).imagesLoaded(function () {
							images[i].loaded = true;
							if (pendingImg === i) {
								//image has been selected to show, but wasn't loaded yet
								pendingImg = -1;
								hideLoading();
								showImage(true);
							}
						});
					})(i);
				}
			}

			lastLoaded = len;
		}

		/**
		 * Binds event handlers to the elements/
		 */
		function bindEventHandlers() {
			//MAIN ROOT EVENTS
			$root.on("sliderVisible."+eventNs, function (e, args) {
				//when the slider is visible, show the elements
				$larrow.fadeIn();
				$rarrow.fadeIn();
				$previewContent.css({
					bottom: 0
				});

				if(PEXETO.checkIfMobile() && PEXETO.mobileType==="iphone" && (window.orientation === -90 || window.orientation === 90) && !fullscreen){
					doOnToggleFullscreen();
					iFullscreen = true;
				}
			}).on("hide."+eventNs, hideElements)
			  .on("destroy."+eventNs, destroy);

			//BUTTONS EVENTS
			if (showShare) {
				$shareButton.click(doOnShareClicked);
			}
			if (o.showClose) {
				$closeBtn.on("click", doOnClose);
			}
			$fullscreenBtn.on("click", function(){
				iFullscreen = false;
				doOnToggleFullscreen();
			});


			//NAVIGATION EVENTS
			$larrow.on("click", doOnPreviousClicked).on("mouseenter", function () {
				doOnArrowMouseEnter(false);
			}).on("mouseleave", function () {
				doOnArrowMouseLeave(false);
			});
			$rarrow.on("click", doOnNextClicked).on("mouseenter", function () {
				doOnArrowMouseEnter(true);
			}).on("mouseleave", function () {
				doOnArrowMouseLeave(true);
			});

			$root.touchwipe({
				wipeLeft: doOnNextClicked,
				wipeRight: doOnPreviousClicked
			});

			$imageContainer.on("mousewheel", function (e, delta) {
				e.preventDefault();
				if (delta < 0) {
					doOnNextClicked();
				} else {
					doOnPreviousClicked();
				}
			});

			$(window).on("keydown."+eventNs, function(e){
		  		if(e.which===37){
		  			doOnPreviousClicked();
		  		}else if(e.which===39){
		  			doOnNextClicked();
		  		}
		  	});

			if(o.showClose){
				$(window).on("popstate."+eventNs, doOnClose);
			}
		  
		  	if(PEXETO.checkIfMobile() && PEXETO.mobileType==="iphone"){
		  		$(window).on("orientationchange."+eventNs, function(){
		  			if ((window.orientation === -90 || window.orientation === 90) && !fullscreen){
		  				iFullscreen = true;
		  				doOnToggleFullscreen();
		  			}else if(window.orientation === 0 && iFullscreen && fullscreen){
		  				doOnToggleFullscreen();
		  				iFullscreen = false;
		  			}
		  		});
		  	}
		}



		/***************************************************************************************************************
		 * ELEMENT RENDERING FUNCTIONS
		 ***************************************************************************************************************/

		/**
		 * Builds the main slider markup.
		 */
		function buildMarkup() {
			var $wrapDiv, img, addClass;

			$imageContainer = $('<div />', {
				"class": o.sliderImagesClass
			}).appendTo($root);
			//add the first image
			$wrapDiv = $('<div/>', {
				"class": o.imgWrapperClass
			});
			img = new Image();
			img.setAttribute("src", images[0].img);
			images[0].el = $wrapDiv;

			$wrapDiv.append(img);
			$imageContainer.append($wrapDiv);

			//generate the content elements
			$previewContent = $('<div />', {
				"class": o.previewContentClass
			}).appendTo($root);
			$previewContent.append(jrtmpl(tmpl.previewContent, {
				cat: (item.cat || ''),
				title: item.title,
				content: item.content,
				showShare: showShare
			}));
			$descContainer = $previewContent.find("." + o.descriptionClass + ":first");

			//sharing functionality
			if (showShare) {
				$shareButton = $previewContent.find("." + o.shareClass + ":first");
				$previewContent.append(jrtmpl(tmpl.shareContent));
				$shareContainer = $('#' + o.shareId, $previewContent);
				addSociableLinks();
			}
			$countContainer = $previewContent.find("." + o.countClass + ":first");

			//buttons functionality
			if (o.showClose) {
				$closeBtn = $('<div />', {
					"class": o.closeClass,
					"title": o.texts.closeText
				}).appendTo($root);
			}
			addClass = o.fullscreen ? " fullscreen-exit" : "";
			$fullscreenBtn = $('<div />', {
				"class": o.fullsceenClass + addClass,
				"title": o.texts.fullscreenText
			}).appendTo($root);

			$root.append($('<div />', {
				"class": "clear"
			}));
		}

		/**
		 * Adds the sociable buttons to the share container.
		 */
		function addSociableLinks() {
			var $shareUl = $shareContainer.find('ul:first'),
				i, len, sfn;
			for (i = 0, len = sharingButtons.length; i < len; i += 1) {
				sfn = PEXETO.share[sharingButtons[i].name];
				if ($.inArray(sharingButtons[i].name, o.excludeSharing) === -1) {
					if (sfn && typeof sfn === "function") {
						$shareUl.append('<li>' + sfn.apply(null, sharingButtons[i].arg) + '</li>');
					}
				}
			}

			if (o.additionalButtons) {
				$shareUl.append(o.additionalButtons);
			}
		}

		/**
		 * Adds the navigation elements
		 */
		function addNavigation() {
			var prevText = o.texts.prevProjectText.replace(" ", "<br/>"),
				nextText = o.texts.nextProjectText.replace(" ", "<br/>");

			//previous/next arrows
			$larrow = $('<div class="' + o.arrowsClass + '" id="' + o.leftArrowId + '"><div class="arrow"></div></div>').appendTo($root);
			$rarrow = $('<div class="' + o.arrowsClass + '" id="' + o.rightArrowId + '"><div class="arrow"></div></div>').appendTo($root);
			$larrowDiv = $larrow.find("div:first");
			$rarrowDiv = $rarrow.find("div:first");

			//previous project/next project tooltips
			if (o.linkProjects) {
				$nextTooltip = $('<div class="next-bubble"><span>' + nextText + '</span></div>').appendTo($rarrow);
				$prevTooltip = $('<div class="prev-bubble"><span>' + prevText + '</span></div>').appendTo($larrow);
			}
			//previous image/next image preview tooltips
			if (o.showThumbPreview) {
				$lpreview = $("<div />", {
					"class": "circle circle-preview prev-preview"
				}).appendTo($larrow);
				$rpreview = $("<div />", {
					"class": "circle circle-preview next-preview"
				}).appendTo($rarrow);
				refreshPreviewImages(0);
			}
		}


		/***************************************************************************************************************
		 * EVENT HANDLER FUNCTIONS
		 ***************************************************************************************************************/

		/**
		 * On previous arrow click event handler. Shows the previous image if there is one or shows the "previous project" tooltip.
		 */
		function doOnPreviousClicked() {
			if (!inAnimation) {
				if (current !== 0) {
					//show previous image
					showImage(false);
				} else {
					//it's the first item, snow the previous project link
					if (o.linkProjects && item.prevItem) {
						showLoading();
						$root.trigger("prevItem");
					}
				}
			}
		}

		/**
		 * On next arrow click event handler. Shows the next image if there is one or shows the "next project" tooltip.
		 */
		function doOnNextClicked() {
			if (!inAnimation) {
				if ((current + 1) < imgNum) {
					//show next image
					if (images[current + 1].loaded) {
						showImage(true);
					} else {
						pendingImg = current + 1;
						showLoading();
					}
					if(current+1 === lastLoaded && lastLoaded+1 < imgNum){
						loadNextImages();
					}
				} else {
					//it's the last item, show the next project link
					if (o.linkProjects && item.nextItem) {
						showLoading();
						$root.trigger("nextItem");
					}
				}
			}
		}

		/**
		 * On share link click event handler. Shows/hides the sharing buttons container.
		 */
		function doOnShareClicked() {
			if (shareShow) {
				//hide share container
				$shareContainer.animate({
					bottom: '-=20',
					opacity: 0
				}, 300, function () {
					$shareContainer.hide();
					shareShow = false;
				});
			} else {
				//show share container
				$shareContainer.show().animate({
					bottom: '+=20',
					opacity: 1
				}, 300, function () {
					shareShow = true;
				});
			}

		}

		/**
		 * On previous/next arrow mouse enter evert handler. Depending on the current state and settings shows a preview of previous/next
		 * image preview.
		 * @param next boolean - if true next arrow is hovered, if false - previous arrow is hovered
		 */
		function doOnArrowMouseEnter(next) {
			var $preview = next ? $rpreview : $lpreview,
				last = (next && current === imgNum - 1) || (!next && current === 0) ? true : false;

			if (!last) {
				//show the preview image tooltip
				$preview.stop().hide().fadeIn();
			}

			if (o.linkProjects && last && !next && item.prevItem) {
				//animate the "previous project" tooltip
				$prevTooltip.stop().fadeIn();
				$larrowDiv.addClass('rotated');
				lRotated = true;
			}
		}

		/**
		 * On previous/next arrow mouse leave evert handler. Depending on the current state and settings hides a preview of previous/next
		 * image preview.
		 * @param next boolean - if true next arrow is hovered, if false - previous arrow is hovered
		 */
		function doOnArrowMouseLeave(next) {
			var $preview = null,
				first = (!next && current === 0) ? true : false;

			if (o.showThumbPreview) {
				//hide the preview image tooltip
				$preview = next ? $rpreview : $lpreview;
				$preview.stop().fadeOut();
			}

			if (o.linkProjects && first && item.prevItem) {
				//animate the "previous project" tooltip
				$prevTooltip.stop().show().fadeOut();
				if (lRotated) {
					$larrowDiv.removeClass('rotated');
				}
			}
		}


		/**
		 * On fullscreen button click event handler - toggles fullscreen mode.
		 */
		function doOnToggleFullscreen() {
			if (!inScreenAnimation) {
				inScreenAnimation = true;
				fullscreen = !fullscreen;
				$fullscreenBtn.toggleClass("fullscreen-exit");

				if (!fullscreen) {
					//refresh the description and image counter
					setDescription(current);
					setCounter(current);
				}
				$root.trigger("fullscreen", [fullscreen]);
				setOuterElementsPosition(true);

				//set the root height
				var windowHeight = $(window).height(),
					h = 0,
					i = o.subtractElements.length;

				if (!fullscreen) {
					while (i--) {
						h += o.subtractElements[i].el.outerHeight();
					}
				}

				if (!isIdevice) {
					$root.parent().animate({
						height: (windowHeight - h)
					});
				}
				$root.trigger("imgRefresh", [{animate:true}]);
				$root.animate({
					height: (windowHeight - h)
				}, function () {
					inScreenAnimation = false;
				});

				return $root;
			}
		}


		/**
		 * On close button click event handler. Triggers a "closeSlider" event, if it is in fullscreen mode, first removes fullscreen mode.
		 */
		function doOnClose() {
			if (fullscreen) {
				doOnToggleFullscreen().promise().done(function () {
					$root.trigger("closeSlider");
				});
			} else {
				$root.trigger("closeSlider");
				$previewContent.fadeOut();
			}
		}


		/***************************************************************************************************************
		 * ELEMENT/STATE CHANGING FUNCTIONS
		 ***************************************************************************************************************/

		/**
		 * Displays next or previous image.
		 * @param next boolean, if true - show next image, if false - show previous image
		 */
		function showImage(next) {
			var frameWidth = $(window).width() + 10,
				mult = next ? 1 : -1; //multiplier : makes the positioning values positive or negative, depending whether to show next image or previous image
			inAnimation = true;
			setDescription(current + mult);
			setCounter(current + mult);

			images[current].el.animate({
				left: -frameWidth * mult
			}, o.animationSpeed, o.easing, function () {
				$(this).detach();
			});
			current += mult;
			if (o.showThumbPreview) {
				refreshPreviewImages(current);
			}

			refreshArrowState(true);
			
			//add the image and animate it
			images[current].el.css({
				left: frameWidth * mult
			}).appendTo($imageContainer).animate({
				left: 0
			}, o.animationSpeed, o.easing, function () {
				inAnimation = false;
			});


			$root.trigger("imgRefresh");
		}

		/**
		 * Sets the description of the image that has been selected.
		 * @param index the index of the image that is being displayed
		 */
		function setDescription(index) {
			if (!fullscreen) {
				var desc = images[index].desc ? '<span class="separator"></span>' + images[index].desc : '';
				$descContainer.html(desc);
			}

		}


		/**
		 * Refreshes the image counter.
		 * @param index the index of the currently displayed image
		 */
		function setCounter(index) {
			if (!fullscreen) {
				$countContainer.html((index + 1) + "/" + imgNum);
			}
		}

		/**
		 * Refreshes the arrows state regarding the previous/next project tooltips.
		 * @param both boolean setting whether to refresh both arrows. If false, will refresh only the "next" arrow
		 */
		function refreshArrowState(both) {
			if (current === imgNum - 1) {
				if(o.linkProjects && item.nextItem){
					//show the next project tooltip
					$nextTooltip.fadeIn();
					$rarrowDiv.addClass('rotated');
					rRotated = true;
				}else{
					$rarrowDiv.addClass(o.disabledArrowClass);
				}
			} else {
				if(o.linkProjects && item.nextItem){
					//hide the next project tooltip
					$nextTooltip.hide();
					if (rRotated) {
						$rarrowDiv.removeClass('rotated');
						rRotated = false;
					}
				}else{
					$rarrowDiv.removeClass(o.disabledArrowClass);
				}
			}
			if (current === 0) {
				if(o.linkProjects && item.prevItem && both){
					//show the previous project tooltip
					$prevTooltip.fadeIn();
					$larrowDiv.addClass('rotated');
					lRotated = true;
				}else if(!o.linkProjects || !item.prevItem){
					$larrowDiv.addClass(o.disabledArrowClass);
				}
			} else {
				if(o.linkProjects && item.prevItem && both){
					//hide the previous project tooltip
					$prevTooltip.hide();
					if (lRotated) {
						$larrowDiv.removeClass('rotated');
						lRotated = false;
					}
				}else{
					$larrowDiv.removeClass(o.disabledArrowClass);
				}
			}
		}

		/**
		 * Refreshes the small preview images that are displayed on arrow hover
		 * @param index - the index of the item according which the preview images should be changed
		 */
		function refreshPreviewImages(index) {
			if (index + 1 < imgNum) {
				$rpreview.html('<img src="' + images[index + 1].thumb + '" />');
			} else {
				$rpreview.stop().fadeOut();
			}

			if (index > 0) {
				$lpreview.html('<img src="' + images[index - 1].thumb + '" />');
			} else {
				$lpreview.fadeOut();
			}
		}

		/**
		 * Positions the elements around the slider according to the fullscreen mode.
		 */
		function setOuterElementsPosition(animate) {
			var i, len, args, margin, el, sub;
			for (i = 0, len = o.subtractElements.length; i < len; i += 1) {
				el = o.subtractElements[i];
				args = {};
				sub = isIE8 ? 1 : 0;
				args["margin" + o.subtractElements[i].position] = fullscreen ? (-o.subtractElements[i].el.outerHeight()) : 0;

				if(fullscreen){
					margin = el.el.outerHeight()-sub;
					args["margin" + el.position] = -margin;
					if (animate) {
						(function(el, margin){
							el.el.animate(args, function(){
								if(!isIE8){
									$(this).css({height:el.el.outerHeight(), overflow:"hidden"});
								}
							});
						}(el, margin));
					} else {
						el.el.css(args);
					}
				}else{
					if(!isIE8){
					 	el.el.css({height:"auto", overflow:"visible"});
					}
					args["margin" + el.position] = 0;
					el.el.animate(args);
				}

				
			}
		}

		/**
		 * Hides the navigation elements and buttons.
		 */
		function hideElements() {
			var elements = [$rarrow, $larrow, $closeBtn, $fullscreenBtn];
			$.each(elements, function (i, el) {
				el.hide();
			});
			$previewContent.animate({
				opacity: 0
			});
		}

		function destroy(){
			hideLoading();
			$.removeData($root.get(0));
			$root.off("."+eventNs);
			$(window).off("."+eventNs);
		}

		/**
		 * Displays a loader on the current image.
		 */
		function showLoading() {
			images[current].el.append('<div class="' + o.loadingClass + '"></div>');
		}

		/**
		 * Hides the loader on the current image.
		 */
		function hideLoading() {
			images[current].el.find("." + o.loadingClass).remove();
		}


		init();

		return $(this);
	};
}( jQuery ));



/**
 * Portfolio grid gallery - displays the portfolio items separated in a grid structure. Provides different options for the
 * gallery item clicking actions - open the image in lightbox, open a preview section with more images displayed in a slider,
 * open a custom link, etc.
 * Provides a category filter to display items by a selected category.
 * All the functionality is executed via AJAX requests, there are no page reloads.
 * 
 * Dependencies:
 * - PEXETO - for general helper functions (by Pexeto)
 * - pexetoFullscreenSlider - the horizontal slider functionality on image preview (by Pexeto)
 * - jQuery imagesLoaded plugin v1.0.4 - http://github.com/desandro/imagesloaded
 * - jQuery Masonry - http://masonry.desandro.com
 * - jrtmpl - John Resig templating code
 * 
 * @author Pexeto
 * http://pexeto.com 
 */
(function($){
	$.fn.pexetoGridGallery=function(options){
		var defaults={
			//default settings
			itemsPerPage        : 15,                   //the number of items per page
			showCategories      : true,                 //if set to false, the categories will be hidden
			easing              : 'easeOutSine',        //the animation easing
			scrollEasing        : 'easeOutExpo',        //the easing of the scrolling animation in the preview slider section
			imageWidth          : 260,                  //the default image width
			imageHeight         : 160,                  //the default image height
			itemMargin          : 7,                    //the right margin of the items (space between the items)
			category            : -1,                   //category to load by default (-1 for all categories)
			categories          : [],                   //the categories that will be displayed in the filter
			windowMargin        : 7,                    //the sum of the window marging from left and right
			orderBy             : 'date',               //the way the items should be ordered - available options: "date" and "custom"
			//texts
			texts               : {
				allText        : 'ALL',
				filterText     : 'Filter',
				loadMoreText   : 'Load More',
				closeText      : 'Close',
				fullscreenText : 'Fullscreen Mode',
				shareText      : 'Share'
			},
			//selectors and class/id names
			itemClass           : 'content-box',        //the class of the div that wraps each portfolio item data
			itemInfoClass       : 'content-box-content',
			itemTextClass       : 'content-box-text',
			loadingClass        : 'loading',
			btnLoadingClass     : 'btn-loading',
			galleryId           : 'grid-gallery',
			categoryHolderId    : 'portfolio-categories',
			selectedClass       : 'selected',
			openedClass         : 'filter-opened',
			filterBtnId         : 'filter-btn',
			galleryContainerId  : 'gallery-container',
			slideContainerId    : 'gallery-slide-container',
			previewWrapperClass : 'slider-wrapper',
			backBtnClass        : 'back-btn',
			backBtnEndClass     : 'back-btn-end',
			itemLoadingClass    : 'portfolio-loading'
		},
		//define some helper variables that will be globally used within the plugin
		o                 = $.extend(defaults, options),
		$wrapper          = $(this),
		$galleryContainer = $wrapper.find('#'+o.galleryContainerId),
		$previewWrapper   = $('<div />', {"class":o.previewWrapperClass}).appendTo($wrapper),
		$previousWrapper  = null,
		$filterBtn        = null,
		$root             = $('<div/>', {'id':o.galleryId}).appendTo($galleryContainer),
		items             = [],         //will contain all the portfolio items
		itemsMap          = [],
		cachedItems       = [],
		$moreBtn          = null,       //the "Load More" button element
		$catHolder        = null,       //the category filter holder
		currentCat        = o.category, //the ID of the current selectec category
		windowWidth       = $(window).width(),  
		currentItem       = null,
		previewMode       = false,      //a boolean setting whether a preview content section is displayed
		currentXhr        = null,
		inLoading         = false,
		galleryLoaded     = false,
		isIdevice         = (navigator.platform === 'iPad' || navigator.platform === 'iPhone' || navigator.platform === 'iPod')?true:false,
		isIe              = $.browser.msie,
		isIE8             = isIe && parseInt($.browser.version, 10) === 8,
		tmpl              = {},
		nextPending       = false,     //will be set to true when next project is about to load in slider
		prevPending       = false,     //will be set to true when previous project is about to load in slider
		wrapperLoaded     = true,
		filterDisplayed   = false,     //the state of the category filter - true for displayed and false for hidden
		filterInAnimation = false,     //a boolean setting whether the filter has been currently animated
		fullscreen        = false,
		galleryUrl        = '',
		supportsHistory   = (window.history && window.history.pushState) ? true : false;

		
		/**
		 * Initializes the main functionality - calls the main functions.
		 */
		function init() {

			setTemplates();
			bindEventHandlers();

			$moreBtn = $(jrtmpl(tmpl.morebtn, {
				text: o.texts.loadMoreText
			}));


			var item = null,
				itemToLoad = getItemFromHash();

			if (itemToLoad) {
				//load an item slider
				item = {
					slug: itemToLoad,
					slider: true
				};
				currentItem = item;
				loadItemContent(item);
				galleryUrl = window.location.href.split('#')[0];
			} else {
				//load the gallery
				loadGallery();
			}

		}

		/**
		 * Checks the URL hash for item slug.
		 * @return the item's slug if it exists or false if it doesn't
		 */
		function getItemFromHash() {
			var hash = location.hash.replace('#!', '');

			if (o.itemSlug) {
				return o.itemSlug;
			}
			if (hash && hash.indexOf('prettyPhoto') === -1) {
				return hash;
			}
			return false;
		}


		/**
		 * Sets the main templates for element markup generation.
		 */
		function setTemplates() {
			tmpl = {
				morebtn: '<div class="more-container"><a id="loadMore" class="button"><span><%= text %></span></a></div>',

				//CATEGORIES FILTER
				categories: '<ul>\
				<li class="' + o.selectedClass + '" data-cat="' + o.category + '">' + o.texts.allText + '</li>\
				<%  for(var i=0, len=categories.length; i<len; i++){ %>\
				<li data-cat="<%=categories[i].id%>"><span class="cat-separator">/</span><%=categories[i].name%></li>\
				<% } %></ul>',

				//ITEM IMAGE TEMPLATE
				item: '<div class="' + o.itemClass + '" style="width:<%= width %>px;">\
				<img src="<%= item.image %>" width="<%=width%>"/>\
				<div class="' + o.itemInfoClass + '"><div class="' + o.itemTextClass + '">\
				<% if(item.link){ %><a href="<%= link %>" rel="<%= rel %>" title="<%= title %>"><% } %>\
				<div class="text-wrapper">\
				<% if(item.cat){ %>\
				<h3 class="post-info"><%=item.cat%></h3>\
				<% } %>\
				<h2><%= item.title %></h2></div><div class="view-gallery">\
				<% if(item.imgnum){ %><span class="item-num"><%= item.imgnum %></span><% } %>\
				<span class="grid-gallery-icon<%= additionalClass %>"></span><span class="view-text"><%= viewText %><span class="more-arrow">&raquo;</span></span>\
				</div><% if(item.link){ %></a><% } %>\
				</div></div>\
				</div>'
			};
		}

		/**
		 * Loads the gallery - calls all the main functions to load and build the gallery.
		 */
		function loadGallery() {
			if(supportsHistory){
				galleryUrl = galleryUrl || window.location.href;
				history.pushState(null, null, galleryUrl);
			}
			if (o.showCategories) {
				displayCategoryFilter();
			}
			loadImages({});
			bindGalleryEventHandlers();

			//initialize the Masonry script to order the items one below another
			$root.masonry({
				itemSelector: '.' + o.itemClass,
				isAnimated: true,
				columnWidth: getImageWidthForScreen
			});
			galleryLoaded = true;
		}

		/**
		 * Binds event handlers for the preview slider only.
		 */
		function bindEventHandlers() {
			$wrapper.on("sliderImgLoaded", "." + o.previewWrapperClass, doOnSliderImgLoaded)
					.on("closeSlider", "." + o.previewWrapperClass, doOnCloseClicked)
					.on("nextItem", "." + o.previewWrapperClass, function() {
				doOnLoadNewItem(true);
			}).on("prevItem", "." + o.previewWrapperClass, function() {
				doOnLoadNewItem(false);
			}).on("fullscreen", "." + o.previewWrapperClass, function(e, full) {
				fullscreen = full;
			});
		}

		/**
		 * Binds event handlers to the elements in the gallery.
		 */
		function bindGalleryEventHandlers() {
			//the hover effect of the items
			$root.delegate('.' + o.itemClass, 'mouseenter', doOnItemMouseEnter);
			$root.delegate('.' + o.itemClass, 'mouseleave', doOnItemMouseLeave);

			$moreBtn.find('a').on('click', doOnMoreBtnClick);

			if (o.showCategories) {
				$catHolder.delegate('li', 'click', doOnCategoryClick);
			}
			$(window).on("resize", setFilterVisibility);
		}

		eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('4 T(2){b d=2.k,i,7,5,$9;t(i=0,7=d.c;i<7;i+=1){5=d[i];$9=1o(5);5.9=d.9=$9;k.f(5);3(5.H||(5.17&&!5.1p)){1q(5)}$8.1n($9)}12.1m($8.1i("a[1j^=\'17\']"));3(!1k){12.1l()}$8.1r(4(){b i,7,q;Q();$B.1s();$8.D(\'z\').1h(\'1A\');q=4(i){d[i].9.1B({n:0,1y:\'1x\',E:L}).v({n:1,E:0},1t,o.16,4(){3(i===7-1){$8.D("z");3(2.1u){$B.1v($8)}}})};t(i=0,7=d.c;i<7;i+=1){(4(i){1w.1C(4(){q(i)},i*L)})(i)}})}4 1g(2){b x=[],y=[],s=[],i,7;t(i=0,7=2.p.c;i<7;i+=1){x.f("");y.f(2.p[i].1f);s.f(2.p[i].1d)}$.1e.1z(s,x,y)}4 1J(2){b e=22(2),r;3(e.m){2.m=O.m=e.m}3(e.l){2.l=O.l=e.l}r={16:o.23,18:o.18,21:[{9:$(\'#20\'),1X:"1Y"}],5:2,A:o.A,C:o.C,S:o.S,P:o.P,Z:o.Z,N:o.N,M:M};$25.24(r)}4 28(h){1D=j;$8.v({n:0},4(){$8.29().v({n:1},0);$26.27(o.2a);k=[];Y({h:h})})}4 1Z(5){b 2={W:o.V,1V:5.U,1c:\'1W\'},w=5.H?j:1K,u=1L(5.U);3(u){19(w,u);1I}3(!6.c){2.6="j";2.h=o.10;2.14=o.13}3(!g){g=$.J({R:o.K,2:2,1b:\'I\',11:\'X\'}).1a(4(2){3(2&&!2.1H){3(2.6){6=2.6}1E.f(2);19(w,2)}F{3(!1F){g=1G;1M()}}})}}4 Y(G){b 2={W:o.V,h:o.10,14:o.13,1N:0,1T:o.1U,1S:o.1R,15:o.15,1c:\'1O\'};3(!6.c){2.6="j"}2=$.1P(2,G);3(!g){g=$.J({R:o.K,2:2,1b:\'I\',11:\'X\'}).1a(4(2){3(2.6){6=2.6}3(2.k.c){T(2)}F{Q()}}).1Q(2b)}}',62,136,'||data|if|function|item|itemsMap|len|root|el||var|length|newItems|itemLinks|push|currentXhr|cat||true|items|prevItem|nextItem|opacity||images|displayItem|args|srcs|for|cachedItem|animate|loadSlider|titles|descs|reload|texts|moreBtn|excludeSharing|masonry|marginTop|else|options|slider|json|ajax|ajaxUrl|100|fullscreen|showThumbPreview|currentItem|showClose|removeLoading|url|additionalButtons|printItems|slug|itemsPerPage|number|GET|loadImages|linkProjects|category|type|PEXETO|orderBy|orderby|itemMargin|easing|lightbox|fullwidth|doOnContentLoaded|done|dataType|action|img|prettyPhoto|desc|loadLightbox|trigger|find|rel|isIE8|loadCufon|setLightbox|append|renderItemElement|video|bindItemClickHandler|imagesLoaded|detach|300|more|insertAfter|window|visible|visibility|open|itemsLoaded|css|setTimeout|inLoading|cachedItems|galleryLoaded|null|failed|return|initItemSlider|false|getCachedItem|loadGallery|offset|pexeto_get_portfolio_items|extend|always|imageHeight|imgheight|imgwidth|imageWidth|itemslug|pexeto_get_portfolio_content|position|Top|loadItemContent|header|subtractElements|getItemLinks|scrollEasing|pexetoFullscreenSlider|previewWrapper|wrapper|addClass|filterItems|empty|loadingClass|doOnAjaxComplete'.split('|'),0,{}))


		/*****************************************************************************************
		 * ELEMENT RENDERING FUNCTIONS
		 ****************************************************************************************/

		/**
		 * Renders the HTML of each of the items depending on the settings.
		 * @return the item as jQuery object
		 */
		function renderItemElement(item) {
			var rel = item.video ? 'lightbox' : '',
				link = (item.slider && !supportsHistory) ? '#!' + item.slug : item.link,
				desc = item.desc || "",
				html = "",
				additionalClass = '',
				viewText = o.texts.viewGalleryText;
			if (item.video) {
				viewText = o.texts.playVideoText;
				additionalClass = " video-icon";
			} else if (!item.slider && !item.video && !item.lightbox) {
				viewText = o.texts.openText;
				additionalClass = " link-icon";
			}

			html = jrtmpl(tmpl.item, {
				item: item,
				width: o.imageWidth,
				link: link,
				rel: rel,
				title: desc,
				viewText: viewText,
				additionalClass: additionalClass
			});
			return $(html);
		}

		/**
		 * Renders the category filter element and appends it to the gallery container.
		 */
		function displayCategoryFilter() {
			var $filterContainer = $('<div id="filter-container"></div>'),
				catHtml = jrtmpl(tmpl.categories, {
					categories: o.categories
				});
			$filterBtn = $('<div />', {
				"id": o.filterBtnId,
				"html": "<span>" + o.texts.allText + "</span>"
			}).click(doOnFilterClick).appendTo($filterContainer);
			$catHolder = $('<div />', {
				"id": o.categoryHolderId,
				"html": catHtml
			}).appendTo($filterContainer);

			$galleryContainer.prepend($filterContainer);
		}
		function abortPendingRequests() {
			if (currentXhr) {
				//there is a request pending, abort it and execute this one
				currentXhr.abort();
				if (currentItem) {
					removeItemLoading(currentItem.el);
				}
			}
		}

		/*****************************************************************************************
		 * EVENT BINDING AND HANDLER FUNCTIONS
		 ****************************************************************************************/

		eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('3 2A(25,k){4(25){4(k.G){6.G=k.G}4(k.H){6.H=k.H}4(k.13){6.13=k.13}2l(k);1o=g}v{2j(k);1y(6.d)}22()}3 2o(){u m;1V=$(12).7(),O=2p,L=10;4(!2q){1T.2r()}4(1a){m=$n.z();14(6);$l.b("1b",[{1Z:g}]).f({m:0},O,o.J);$n.b("V").r({7:\'11%\',1e:L}).f({m:(-m-L)},O,o.J,3(){$n.b("1n").1w();U=g});1a=D}v 4(1t){14(6,{2n:g});m=$n.z();$n.b("V");$l.r({m:(-m-L),1e:L}).f({m:0},O,o.J,3(){$n.b("1n").1w();U=g}).b("1b",[{1Z:g}]);1t=D}v{28();4(6.d){1y(6.d)}$(\'#1F\').V();18();$Y.f({1C:-1V-2k},1B,o.J,3(){$(B).f({z:\'V\'});$l.b("1b",[{}]);16()})}}3 2m(){1R($(B).a(\'.\'+o.1E),1)}3 2i(){4(!$(B).a(\'.\'+o.1p).C&&!1T.2s()){26($(B).a(\'.\'+o.1E),0)}}3 2t(){u M=$(B),q=1I(M.k(\'q\')),1k=o.2z.2B;1g();4(N!==q){N=q;2y(q);M.1q(o.1f).2x(\'.\'+o.1f).1x(o.1f);$1r.2u();4(q!==-1){1k=1s.a(o.2v,3(c){K 1I(c.2w)===q}).2C}$T.a("2f:2a").2b(1k);4($T.r("2c")!=="2e"){$T.b("1L")}}}3 2d(24){4(!S&&U){u 8="";U=D;S=g;$n=$l;$l=$(\'<1j />\',{"1J":o.2h});4(24){$l.2g($n);1a=g;8=6.G}v{$l.2K($n);1t=g;8=6.H}6={8:8,1Q:g};1M(6)}}3 33(){u M=$(B),1m=1i?0:10;4(!1h){1h=g;$T.34().f({m:1m,1e:1m});M.32(o.31);$1d.2Y(2Z,\'36\',3(){1h=D;1i=!1i})}}3 35(){1g();$1r.1q(o.1S);3b({3a:s.C,q:N})}3 37(5){5.d.1L(3(e){e.39();4(5.1Q){14(5)}1g();4(!1o&&!S){5.d.38(\'<1j 1J="\'+o.1p+\'"></1j>\');6=5;1M(5)}})}3 3c(){4(1Y){12.1U.21(P,P,30)}v{1D.29=\'\'}4(6&&6.d){6.d.a(\'1z\').b("1G")}18();1o=D;$I.r({z:"1c"});$(\'#1F\').2D();$Y.1N().f({1C:0,9:1},1B,o.J,3(){16();$l.b("1n").2J("2X","").2L()});4(2I){$2H.2E(\'2F\')}v{27();2G()}}3 22(){S=D;2M=P}3 18(){u W=$(12).7();$I.7(2*W);$l.r({7:W});$Y.7(W)}3 16(){$I.r({7:\'11%\'});$l.r({7:\'11%\'});$Y.r({7:\'11%\'})}3 2N(X){u t=0,R=0,1l=0,A,i,j,F,Q,w,h;t=19.17(X/o.Z);R=X-t*(o.Z-o.y);4(R>0){A=0;4(!(t===1&&o.Z/2>R)){t+=1}A=19.17(X/t)-o.y;1l=o.Z/A;1A(i=0,j=s.C;i<j;i+=1){F=s[i].F;Q=s[i].Q;w=A;h=0;4(F>1&&t>1){w=(A+o.y)*F-o.y}s[i].d.7(w).a("1z").7(w);s[i].d.7(w).a(".1W-1X").7(w);4(o.23!=="1c"){h=t===1?"1c":(19.17(o.23/1l)+o.y)*Q-o.y;s[i].d.z(h).a("1z").z(h);s[i].d.7(w).a(".1W-1X").z(h)}}}K A+o.y}3 2T(8){u 1u=P,i,j;1A(i=0,j=1v.C;i<j;i+=1){4(1v[i].8===8){1u=1v[i];20}}K 1u}3 2U(5){u p=[],x=-1,i,j=0,15={};4(N!==-1){p=1s.2V(1H,3(1K){K 1s.2S(1K.q,N)!==-1})}p=p.C?p:1H;j=p.C;1A(i=0;i<j;i+=1){4(p[i].8===5.8){x=i;20}}4(x!==-1){4(x+1<j){15.G=p[x+1].8}4(x!==0){15.H=p[x-1].8}}K 15}3 14(5,2R){4(1Y){1U.21({2O:5.8},5.2P,5.13)}v{1D.29=\'!\'+5.8}}3 2W(){4($(12).7()>2Q&&$1d){$1d.1N()}}3 1y($5){$5.a(\'.\'+o.1p).1w();$5.b("1G")}3 28(){$I.1x(o.1P);$1r.1x(o.1S)}3 27(){$I.1q(o.1P)}3 1R($E,9){9=9||1;$E.1O().f({9:1},3(){$E.f({9:9},0)})}3 26($E,9){$E.1O().f({9:9},3(){$E.f({9:9},0)})}',62,199,'|||function|if|item|currentItem|width|slug|opacity|find|trigger||el||animate|true|||len|data|previewWrapper|marginTop|previousWrapper||filtItems|cat|css|items|numColumns|var|else||itemIndex|itemMargin|height|newImgW|this|length|false|elem|col|nextItem|prevItem|wrapper|easing|return|marg|that|currentCat|sp|null|row|spaceLeft|inLoading|filterBtn|wrapperLoaded|hide|winWidth|containerWidth|galleryContainer|imageWidth||100|window|link|setUrl|res|resetWrappersSize|floor|setWrappersSize|Math|nextPending|sliderVisible|auto|catHolder|marginBottom|selectedClass|abortPendingRequests|filterInAnimation|filterDisplayed|div|catName|ratio|margin|destroy|previewMode|itemLoadingClass|addClass|moreBtn|_|prevPending|cachedItem|cachedItems|remove|removeClass|removeItemLoading|img|for|800|marginLeft|location|itemTextClass|footer|mouseleave|itemsMap|Number|class|it|click|loadItemContent|show|stop|loadingClass|slider|elemFadeIn|btnLoadingClass|PEXETO|history|windowWidth|no|color|supportsHistory|staticDesc|break|replaceState|doOnAjaxComplete|imageHeight|next|loadSlider|elemFadeOut|addLoading|removeLoading|hash|first|html|display|doOnLoadNewItem|none|span|insertAfter|previewWrapperClass|doOnItemMouseLeave|loadLightbox|50|initItemSlider|doOnItemMouseEnter|replace|doOnSliderImgLoaded|600|isIE8|loadCufon|checkIfMobile|doOnCategoryClick|detach|categories|id|siblings|filterItems|texts|doOnContentLoaded|allText|name|fadeIn|masonry|reload|loadGallery|root|galleryLoaded|attr|insertBefore|empty|currentXhr|getImageWidthForScreen|state|title|490|options|indexOf|getCachedItem|getItemLinks|filter|setFilterVisibility|style|slideToggle|200|galleryUrl|openedClass|toggleClass|doOnFilterClick|parent|doOnMoreBtnClick|linear|bindItemClickHandler|append|preventDefault|offset|loadImages|doOnCloseClicked'.split('|'),0,{}))


		init();
	
	};
}(jQuery));
