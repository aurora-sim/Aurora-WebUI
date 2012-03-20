jQuery.fn.extend({
  resize: function(params){
    var jQ = jQuery;
    return this.each(function(){
			var clicked = false; //set to off
			var start_x; //starting point of mouse
			var start_y; 
			if(params && params['target']){ var resize = params['target'];}	//if target passed then use that
			else{ var resize = this; }
			if(params && typeof(params['y']) != "undefined"){ var y = params['y'];} //if y passed then fix the max height
			else{ var y = 1;}
			if(params && typeof(params['x']) != "undefined"){ var x = params['x'];} //if x then fix width
			else{ var x = 1;}
			if(params && typeof(params['min_width']) != "undefined"){ var min_w = params['min_width'];}
			else{ var min_w = 1;}
			if(params && typeof(params['min_height']) != "undefined"){ var min_h = params['min_height'];}
			else{ var min_h = 1;}
			
			$(this).hover(
					function(){$(this).css('cursor', 'move');},
					function(){$(this).css('cursor','default');clicked=false;}
					);			
			$(this).mousedown(function(e){
				clicked = true;
				start_x = Math.round(e.pageX - $(this).eq(0).offset().left);
				start_y = Math.round(e.pageY - $(this).eq(0).offset().top);
			});
			$(this).mouseup(function(e){clicked = false;});
			$(this).mousemove(function(e){
				if(clicked){
					var mouse_x = Math.round(e.pageX - $(this).eq(0).offset().left) - start_x;
					var mouse_y = Math.round(e.pageY - $(this).eq(0).offset().top) - start_y;
					var div_w = $(resize).width();
					var div_h = $(resize).height();
					var new_w = parseInt(div_w)+mouse_x;
					var new_h = parseInt(div_h)+mouse_y;	
					if(x==1 || (typeof(x) == "number" && new_w < x && new_w > min_w) ){ $(resize).css('width', new_w+"px"); }
					if(y==1 || (typeof(y) == "number" && new_h < y && new_h > min_h) ){ $(resize).css('height',new_h+"px"); }
					start_x = Math.round(e.pageX - $(this).eq(0).offset().left);
					start_y = Math.round(e.pageY - $(this).eq(0).offset().top);
				}
			});					
    });
  }
});