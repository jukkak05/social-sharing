jQuery( document ).ready(function( $ ){

	// Get additional info for sharing 

	var pageTitle = $('h1').text();
	var twitterTitle = pageTitle.trim().split(" ").join("").toLowerCase();
	var siteHashTag = window.location.href.match(/(\w+)\.\w{2,}(\/|\?|$)/)[1];

	const socialmedia = GetSocialMediaSites_WithShareLinks_OrderedByPopularity();
	const socialmediaurls = GetSocialMediaSiteLinks_WithShareLinks({
		'url':window.location.href,
		'title':pageTitle,
		'desc':$('meta[name="description"]').attr('content'),
		'text':$('meta[name="description"]').attr('content'),
		'via':$('#social-sharing-buttons').data('twitterHandle'),
		'email_address':'share@to',
		'provider':window.location.hostname,
		'hash_tags':siteHashTag + ' #' + twitterTitle
	});
	
	var children = [];

	for(var i = 0; i < socialmedia.length; i++) {
		const socialmedium = socialmedia[i];

		// Attach links to page

		children.push(
			'<li class="' + socialmedium + '">' +
			'<a href="' + socialmediaurls[socialmedium] + '" target="_blank">' + '<span>' + socialmedium + '</span>' + '</a>' + 
			'</li>' 
		);
	}

	//$('#social-sharing ul').empty();
	$('#social-sharing ul').append(children.join(''));

	// Button styles from settings page

	if ( $('#social-sharing-buttons').length > 0 ) { 

		var buttonStyles = $('#social-sharing-buttons').data();

		if ( buttonStyles.background ) { 
			
			buttonBackground(buttonStyles.background);

		}

		if ( buttonStyles.hover ) {

			buttonHover(buttonStyles.hover);

		}

		if (buttonStyles.iconColor) {
			
			buttonIcon(buttonStyles.iconColor);

		}

		if (buttonStyles.iconHoverColor) {

			buttonIconHover(buttonStyles.iconHoverColor);

		}

		if ( buttonStyles.size ) {
			
			buttonSize(buttonStyles.size);

		}

		if ( buttonStyles.style ) {
			
			buttonStyle(buttonStyles.style);

		}

		

	}

	function buttonBackground(background) {

		$('#social-sharing-buttons li a').each(function () {
			$(this).css('background', background);
		});

	}

	function buttonStyle(style) {

		switch (style) {

			case 2: 
			$('#social-sharing-buttons li').each(function () {
				$(this).addClass('square');
			});
			break;

			default:
			break;
		}

	}

	function buttonIcon(color) {

		$('#social-sharing-buttons li a').each(function () {

			$(this).css('color', color);

		});

	}

	function buttonIconHover(iconHover) {

		var currentIconColor = $('#social-sharing-buttons li a').css('color');

		$('#social-sharing-buttons li a').mouseover( function() {

			$(this).css('color', iconHover);

	   }); 
	   
	   $('#social-sharing-buttons li a').mouseout( function() {
		   
		   $(this).css('color', currentIconColor);
	   
	   });

	}

	function buttonSize(size) {

		switch (size) {

			case 1:
			$('#social-sharing-buttons li').each(function () {
				$(this).addClass('small');
			});
			break;	

			case 3: 
			$('#social-sharing-buttons li').each(function () {
				$(this).addClass('large');
			});
			break;

			default:
			break;

		}

	}

	function buttonHover(hover) {

		var currentBg = $('#social-sharing-buttons li a').css('background');

		$('#social-sharing-buttons li a').mouseover( function() {

			 $(this).css('background', hover);

		}); 
		
		$('#social-sharing-buttons li a').mouseout( function() {
			
			$(this).css('background', currentBg);
		
		});

	}

});
