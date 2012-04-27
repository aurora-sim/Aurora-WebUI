$(document).ready(function($){
	$('#mega-menu-1').dcMegaMenu({
		rowItems: megaMenuConfig['#mega-menu-1'].rowItems,
		speed: megaMenuConfig['#mega-menu-1'].speed,
		effect: megaMenuConfig['#mega-menu-1'].effect,
		event: megaMenuConfig['#mega-menu-1'].event
	});
	$('#mega-menu-2').dcMegaMenu({
		rowItems: megaMenuConfig['#mega-menu-2'].rowItems,
		speed: megaMenuConfig['#mega-menu-2'].speed,
		effect: megaMenuConfig['#mega-menu-2'].effect,
		event: megaMenuConfig['#mega-menu-2'].event
	});
	$('#mega-menu-3').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'fade',
		event: 'hover'
	});
	$('#mega-menu-4').dcMegaMenu({
		rowItems: '4',
		speed: 'fast',
		effect: 'fade',
		event: 'hover'
	});
	$('#mega-menu-5').dcMegaMenu({
		rowItems: '1',
		speed: 'fast',
		effect: 'fade',
		event: 'hover'
	});
	$('#mega-menu-6').dcMegaMenu({
		rowItems: '1',
		speed: 'slow',
		effect: 'slide',
		event: 'hover'
	});
	$('#mega-menu-7').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'slide',
		event: 'hover'
	});
	$('#mega-menu-8').dcMegaMenu({
		rowItems: '4',
		speed: 'fast',
		effect: 'fade',
		event: 'hover'
	});
	$('#mega-menu-9').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'fade',
		event: 'hover'
	});
});
