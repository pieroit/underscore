$ = jQuery;
$(document).ready( function(){
	
	// If there are many articles on the page, make them images
	if( $('.hentry').size() > 1 ){
		
		// Change <article> css by adding a class
		// the class makes them shrink and in a grid
		$('.hentry').addClass('thumb-hentry');
	}
});
