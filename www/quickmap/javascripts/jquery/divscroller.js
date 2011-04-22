<!--
$(document).ready(function() {
 
	//create scroller for each element with "horizontal_scroller" class...
	$('.horizontal_scroller').SetScroller({	velocity: 	 60,
											direction: 	 'horizontal',
											startfrom: 	 'right',
											loop:		     'infinite',
											movetype: 	 'linear',
											onmouseover: 'pause',
											onmouseout:  'play',
											onstartup: 	 'play',
											cursor: 	   'pointer'
										});
	/*
		All possible values for options...
		
		velocity: 		from 1 to 99 								[default is 50]						
		direction: 		'horizontal' or 'vertical' 					[default is 'horizontal']
		startfrom: 		'left' or 'right' for horizontal direction 	[default is 'right']
						'top' or 'bottom' for vertical direction	[default is 'bottom']
		loop:			from 1 to n+, or set 'infinite'				[default is 'infinite']
		movetype:		'linear' or 'pingpong'						[default is 'linear']
		onmouseover:	'play' or 'pause'							[default is 'pause']
		onmouseout:		'play' or 'pause'							[default is 'play']
		onstartup: 		'play' or 'pause'							[default is 'play']
		cursor: 		'pointer' or any other CSS style			[default is 'pointer']
	*/
 
	//how to overwrite options after setup and without deleting the other settings...
	$('#no_mouse_events').ResetScroller({	onmouseover: 'play', onmouseout: 'play'   });
	$('#scrollercontrol').ResetScroller({	velocity: 60, startfrom: 'left'   });
 
	//if you need to remove the scrolling animation, uncomment the following line...
	//$('#scrollercontrol').RemoveScroller();
 
	//how to play or stop scrolling animation outside the scroller... 
	$('#play_scrollercontrol').mouseover(function(){   $('#scrollercontrol').PlayScroller();   });
	$('#stop_scrollercontrol').mouseover(function(){   $('#scrollercontrol').PauseScroller();  });		
 
	//create a vertical scroller...	
	$('.vertical_scroller').SetScroller({	velocity: 80, direction: 'vertical'  });		
	
	//"$('#soccer_ball_container')" inherits scrolling options from "$('.horizontal_scroller')",
	// then I reset new options; besides, "$('#soccer_ball_container')" will wraps and scrolls the bouncing animation...
	$('#soccer_ball_container').ResetScroller({	 velocity: 85, movetype: 'pingpong', onmouseover: 'play', onmouseout: 'play'  });
 
	//create soccer ball bouncing animation...
	$('#soccer_ball').bind('bouncer', function(){
			$(this).animate({top:42}, 500, 'linear').animate({top:5}, 500, 'linear', function(){$('#soccer_ball').trigger('bouncer');});			
	}).trigger('bouncer');
 
});
//-->
