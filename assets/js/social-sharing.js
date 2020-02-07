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
		'via':$('#buttons').data('twitterid'),
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
			'<a href="' + socialmediaurls[socialmedium] + '"></a>' + 
			'</li>' 
		);
	}

	$('#social-sharing ul').empty();
	$('#social-sharing ul').append(children.join(''));

	// Image classes for social media icons

	var twitterImage = '<i class="fab fa-twitter"></i>';
	var facebookImage = '<i class="fab fa-facebook-f"></i>';
	var emailImage = '<i class="fas fa-envelope"></i>';
	var linkedinImage = '<i class="fab fa-linkedin-in"></i>';
	var pinterestImage = '<i class="fab fa-pinterest-p"></i>';

	// Go thru social media list and use correct icons

	$('#buttons li').each(function () {

		if ( $(this).hasClass('twitter') ) {

	    	  $(this).children().append(twitterImage);

	        } else if ( $(this).hasClass('facebook') ) {
		
		  $(this).children().append(facebookImage);

		} else if ( $(this).hasClass('email') ) {

		  $(this).children().append(emailImage);

		} else if ( $(this).hasClass('linkedin') ) {

		  $(this).children().append(linkedinImage);

		} else {

		  $(this).children().append(pinterestImage);

		}
	});

	// Add settings page stylings

	const buttonStyles = $('#buttons').data();

	switch (buttonStyles.size) {

		case 1:
		$('#buttons li').each(function () {
			$(this).addClass('small');
		});
		break;	

		case 3: 
		$('#buttons li').each(function () {
			$(this).addClass('large');
		});
		break;

		default:
		break;

	}

	switch (buttonStyles.style) {

		case 2: 
		$('#buttons li').each(function () {
			$(this).addClass('square');
		});
		break;

		default:
		break;
	}

	if ( buttonStyles.background.length > 0 ) { 

		$('#buttons li a').each(function () {
			$(this).css('background', buttonStyles.background);
		});

	 }

	 if ( buttonStyles.hover.length > 0 ) {

		const currentBg = $('#buttons li a').css('background');

		$('#buttons li a').mouseover( function() {

			 $(this).css('background', buttonStyles.hover);

		}); 
		
		$('#buttons li a').mouseout( function() {
			
			$(this).css('background', currentBg);
		
		});

	}

});
