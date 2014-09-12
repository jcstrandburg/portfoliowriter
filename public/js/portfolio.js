$(document).ready(function(){
	$(".js-moreButton").click(function(){
		id = $(this).data('projectid');
		$("#proj-"+id).removeClass('lessDetails');
		$("#proj-"+id).addClass('moreDetails');
	});

	$(".js-lessButton").click(function(){
		id = $(this).data('projectid');
		$("#proj-"+id).addClass('lessDetails');
		$("#proj-"+id).removeClass('moreDetails');
	});
	
	$(".mainimg").click(function(){
		$(".zoomContainer").show();
		$(".zoomedImage").attr('src', $(this).attr('src'));
	});
	
	$(".thumb").click(function(){
		src = $(this).data('src');
		id = "#mainimg-"+$(this).data('projectid');
		if ( $(id).is(':visible')) {
			$(id).attr('src', src);
		}
		else {
			$(".zoomContainer").show();
			$(".zoomedImage").attr('src', $(this).attr('src'));		
		}
		return false;
	});
	
	$(".zoomContainer").click(function(){
		$(this).hide();
	});
	
	$('.menuButton').click(function(event){
		$('.menu').toggleClass('expanded');
	});
	
	$('.menu li:has(ul)').click(function(event){
		$(this).toggleClass('expand');
	});
	
	/*$('.menu li:not(:has(ul))').click(function(event){
		$('.menu li').removeClass('expand');
		$('.menu').removeClass('expanded');		
	});*/
	
	$(document).click(function(event){
		if (!$(event.target).closest('.menu').length) {
			$('.menu').removeClass('expanded');
			$('.menu li').removeClass('expand');
		}
	});

	$('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
			|| location.hostname == this.hostname) {

			hash = this.hash;
			if (hash.indexOf('details') == -1) {
				delay = 0;
			}
			else {
				delay = 0;
				return false;
			}
			setTimeout( function(){
				var target = $(hash);
				target = target.length ? target : $('[name=' + hash.slice(1) +']');
				   if (target.length) {
					 $('html,body').animate({
						 scrollTop: target.offset().top
					}, 800);
				}
			}, delay);
			return false;
		}
	});	
});
