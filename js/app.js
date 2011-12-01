/* Foundation v2.1.1 http://foundation.zurb.com */
$(document).ready(function() {

	/* Use this js doc for all application specific JS */

	/* TABS --------------------------------- */
	/* Remove if you don't need :) */
	
	var tabs = $('dl.tabs');
		tabsContent = $('ul.tabs-content')
	
	tabs.each(function(i) {
		//Get all tabs
		var tab = $(this).children('dd').children('a');
		tab.click(function(e) {
			
			//Get Location of tab's content
			var contentLocation = $(this).attr("href")
			contentLocation = contentLocation + "Tab";
			
			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {
			
				e.preventDefault();
			
				//Make Tab Active
				tab.removeClass('active');
				$(this).addClass('active');
				
				//Show Tab Content
				$(contentLocation).parent('.tabs-content').children('li').css({"display":"none"});
				$(contentLocation).css({"display":"block"});
				
			} 
		});
	});
	
	
	/* PLACEHOLDER FOR FORMS ------------- */
	/* Remove this and jquery.placeholder.min.js if you don't need :) */
	
	$('input, textarea').placeholder();
	
	
	/* DISABLED BUTTONS ------------- */
	/* Gives elements with a class of 'disabled' a return: false; */
	
	/* Konami code --------------------------------- */
	/* The lolz */
	var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
	$(document).keydown(function(e) {
		kkeys.push( e.keyCode );
		if ( kkeys.toString().indexOf( konami ) >= 0 ){
			$(document).unbind('keydown',arguments.callee);
			$.getScript('http://www.cornify.com/js/cornify.js',function(){
				cornify_add();
				$(document).keydown(cornify_add);
			});
		}
	});
		
	/* Create a <select> for phones --------------------------------- */
	$('ul#selectnav').each(function(){
		var list=$(this),
			select=$(document.createElement('select')).insertBefore($(this).hide()).change(function(){
				window.location.href=$(this).val();
			});
		$(document.createElement('option')).appendTo(select); // Insert empty option at the beginning of list
		$('>li a', this).each(function(){
			var option=$(document.createElement('option'))
				.appendTo(select)
				.val(this.href)
				.html($(this).html());
			if($(this).parent().hasClass('current-menu-item')){
				option.attr('selected','selected');
		  	}
		});
		list.remove();
	});

});