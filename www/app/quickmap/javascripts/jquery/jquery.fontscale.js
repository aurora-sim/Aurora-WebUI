/**
 * jQuery fontscale - A plugin to alter the font size of DOM elements 
 * Copyright (c) 2010 Ben Byrne - ben(at)fireflypartners(dot)com | http://www.fireflypartners.com
 * Dual licensed under MIT and GPL.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 * Date: 07/21/2010
 * @author Ben Byrne
 * @version 0.2
 *
 */

/**
 * For complete documentation, visit http://byrnecreative.com/blog/fontscale
 * @example $("#fontgrow").fontscale("p","+");
 * @desc Bind scaling up the font size of all P elements to the element #fontgrow with default settings.
 * @example $("#fontshrink").fontscale("p","-",{unit:"percent",increment:25,useCookie:false,adjustLeading:true});
 * @desc Bind scaling down the font size of all P elements to the element #fontshrink with custom settings.
 * @example $("#reset").fontscale("p","reset");
 * @desc Eliminate all fontscale resizing 
 */
 
(function($) {
  $.fn.fontscale = function(selectors, adjustment, parameters) {

    var settings = $.extend( $.fn.fontscale.defaults, parameters);
    
    //only use cookies if we can
		if ( ! $.isFunction( $.cookie )  ) settings.useCookie = false;
		
    // if the cookie exists, we're supposed to use it, and we haven't before, then load it 
	  if (!settings.cookieLoaded && $.cookie(settings.cookieName)  && settings.useCookie) {
      cookieSettings = $.fn.fontscale.readcookie( settings.cookieName );
	    //only actually apply the data from the cookie if its unit settings match!
			if (cookieSettings.unit == settings.unit && !settings.cookieLoaded) $.fn.fontscale.scale( selectors, cookieSettings.delta, settings, true );
	  }
		
    this.each( function() {

		  // bind to elements
		  $(this).bind(settings.event, function() {
        $.fn.fontscale.scale( selectors, adjustment, settings, false);
        if ($.isFunction(settings.onAfter)) settings.onAfter(selectors, adjustment, settings); //is this okay?				
		  });
		});
		
		return this;
		
  };

  $.fn.fontscale.reset = function( object, settings ) {
    
    //remove any scaling done inline (assumed to be from this plugin)
    $(object).each(function(i) {
      $(this).css('font-size','');
      if (settings.adjustLeading) $(this).css('line-height','');
    });
    
    //if we're using a cookie, reset it too
    if ( settings.useCookie ) {
      $.fn.fontscale.savecookie("delete", settings );
    }
  }

	$.fn.fontscale.scale = function( object, adj, settings, fromcookie) {
	
    //make delta an int that changes nothing to start
    var delta = 0;
	
    if (adj == "+" || adj == "up") {
      //set the delta as an increase
      delta = settings.increment;
    } else if (adj == "-" || adj == "down") {
      //set the delta as a decrease
      delta = settings.increment * -1;
    } else if (adj == "reset") {
      //remove applied changes and do nothing else
      return $.fn.fontscale.reset( object, settings );
    } else if (fromcookie) {
      //get a pre-calibrated delta from the cookie if 
      delta = parseFloat(adj);
      settings.cookieLoaded = true;
	  }
	 	 
    //change the value into a percent if we have to
    if (settings.unit == "percent" && !fromcookie) {
      delta = 1 + (delta / 100);
    }
    	 
    $(object).each(function(i) {

      var currentSize = parseInt($(this).css("font-size"));
      var currentLeading = parseInt($(this).css("line-height"));
      
      if (settings.unit == "percent") {
        $(this).css("font-size", Math.round( currentSize * delta));
        if (settings.adjustLeading) $(this).css("line-height", Math.round( currentLeading * delta));
      } else {
        $(this).css("font-size", currentSize + delta);
        if (settings.adjustLeading) $(this).css("line-height", currentLeading + delta);
      }
  
	 });

  if (settings.useCookie && !fromcookie)  $.fn.fontscale.savecookie( delta, settings );
 
  return;
  
  };
  
  $.fn.fontscale.savecookie = function( delta, settings ) {

    //delete the cookie if we're performing a reset, do nothing else
    if (delta == "delete") {
      $.cookie( settings.cookieName, null, settings.cookieParams );
      return true;
    }
        
    if ($.cookie( settings.cookieName )) {
      properties = $.fn.fontscale.readcookie( settings.cookieName );
    } else {
      properties = {"delta":0}
    }
        
    //if we have a cookie that matches, just change the delta
    if (settings.unit == properties.unit) {  

      if (settings.unit == "percent") {
        properties.delta = (delta) ? properties.delta * delta : 1 ;
      } else {
        properties.delta = parseInt(properties.delta) + delta;
      }
    
      return $.cookie( settings.cookieName, "delta="+properties.delta+"&unit="+properties.unit, settings.cookieParams);
    
    //no cookie that matches, create a new     
    } else {
      $.cookie( settings.cookieName, "delta="+delta+"&unit="+settings.unit, settings.cookieParams);
      return true;
    }
      
  };
  
  $.fn.fontscale.readcookie = function( the_cookie ) {
  
    val_string = $.cookie( the_cookie );
                
    var objResult = {};
    $.each(val_string.split("&"), function() { 
      var prm=this.split("=");
      objResult[prm[0]] = prm[1]; 
    });
    return objResult;
  };

})(jQuery);

$.fn.fontscale.defaults = {
  useCookie:true,
  cookieName:'fontscale',
  cookieParams:{
    expires:30,
    path:"/"},
  increment:2,
  unit:"px",
  adjustLeading:false,
  event:"click",
  cookieLoaded:false
};
	
