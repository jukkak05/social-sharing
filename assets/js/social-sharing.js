jQuery( document ).ready(function( $ ) {

	function GetSocialMediaSites_WithShareLinks_OrderedByPopularity() {

		// Get data attributes for correct sites output
		var facebookData =  $('#social-sharing-buttons').data('facebook');
		var twitterData = $('#social-sharing-buttons').data('twitter');
		var linkedinData = $('#social-sharing-buttons').data('linkedin');
		var pinterestData = $('#social-sharing-buttons').data('pinterest');
		var whatsappData = $('#social-sharing-buttons').data('whatsapp');
		var emailData = $('#social-sharing-buttons').data('email');

		var sites = [];

		if ( facebookData == "1" ) {
			sites.push('facebook');
		} 
		
		if ( twitterData == "1" ) {
			sites.push('twitter');
		} 
		
		if ( linkedinData == "1" ) {
			sites.push('linkedin');
		} 
		
		if ( pinterestData == "1" ) {
			sites.push('pinterest');
		} 
		
		if ( whatsappData == "1" ) {
			sites.push('whatsapp');
		} 

		if ( emailData == "1" ) {
			sites.push('email');
		} 

		return sites;

	}

	// Social Media Site Links With Share Links
	function GetSocialMediaSiteLinks_WithShareLinks(args) {
		const validargs = [
			'url',
			'title',
			'desc',
			'via',
			'hash_tags',
			'email_address'
		];
		
		for(var i = 0; i < validargs.length; i++) {
			const validarg = validargs[i];
			if(!args[validarg]) {
				args[validarg] = '';
			}
		}
		
		const url = fixedEncodeURIComponent(args.url);
		const title = fixedEncodeURIComponent(args.title);
		const desc = fixedEncodeURIComponent(args.desc);
		const via = fixedEncodeURIComponent(args.via);
		const hash_tags = fixedEncodeURIComponent(args.hash_tags);
		const email_address = fixedEncodeURIComponent(args.email_address);
		
		return {
			'email' : 'mailto:' + email_address + '?subject=' + title + '&body=' + url + escape("\n\n") + desc,
			'facebook' : 'http://www.facebook.com/sharer.php?u=' + url,
			'linkedin' : 'https://www.linkedin.com/sharing/share-offsite/?url=' + url,
			'pinterest' : 'http://pinterest.com/pin/create/button/?url=' + url,
			'twitter' : 'https://twitter.com/intent/tweet?url=' + url + '&text=' + title + '&via=' + via + '&hashtags=' + hash_tags,
			'whatsapp' : 'https://api.whatsapp.com/send?text=' + title + '%20' + url
		};
	}

	function fixedEncodeURIComponent(str) {
		return encodeURIComponent(str).replace(/[!'()*]/g, function(c) {
			return '%' + c.charCodeAt(0).toString(16);
		});
	}

	// Get additional info for sharing
	const pageTitle = $('h1').text();
	const twitterTitle = pageTitle.trim().split(" ").join("").toLowerCase();
	const siteHashTag = window.location.href.match(/(\w+)\.\w{2,}(\/|\?|$)/)[1];

	const socialmedia = GetSocialMediaSites_WithShareLinks_OrderedByPopularity();
	const socialmediaurls = GetSocialMediaSiteLinks_WithShareLinks({
		'url':window.location.href,
		'title':pageTitle,
		'desc':$('meta[name="description"]').attr('content'),
		'text':$('meta[name="description"]').attr('content'),
		'via':$('#social-sharing-buttons').data('twitterHandle'),
		'email_address':'',
		'hash_tags':siteHashTag + ' #' + twitterTitle
	});
	
	var children = [];

	for(var i = 0; i < socialmedia.length; i++) {

		let socialmedium = socialmedia[i];
		const siteLang = $('html').attr('lang');

		// Attach links to page
		if (siteLang == 'fi') {
			if (socialmedium == 'email') {
				children.push(
					'<li class="' + socialmedium + '">' +
					'<a href="' + socialmediaurls[socialmedium] + '" target="_blank"><span>Jaa sähköpostitse</span>' + 
					'</a></li>' 
				);
			} else if (socialmedium == 'facebook' || socialmedium == 'whatsapp') {
				children.push(
					'<li class="' + socialmedium + '">' +
					'<a href="' + socialmediaurls[socialmedium] + '" target="_blank"><span>Jaa ' + capitalizeFirstLetter(socialmedium) + 'issa</span>' + 
					'</a></li>' 
				);
			} else if (socialmedium  == 'twitter') {
				children.push(
					'<li class="x">' +
					'<a href="' + socialmediaurls[socialmedium] + '" target="_blank"><span>Jaa X:ssä</span>' + 
					'</a></li>' 
				);
			} else {
				children.push(
					'<li class="' + socialmedium + '">' +
					'<a href="' + socialmediaurls[socialmedium] + '" target="_blank"><span>Jaa ' + capitalizeFirstLetter(socialmedium) + 'issä</span>' + 
					'</a></li>' 
				);
			}
		} else if (siteLang == 'sv' && socialmedium == 'twitter') {
			children.push(
				'<li class="x">' +
				'<a href="' + socialmediaurls[socialmedium] + '" target="_blank"><span>Dela på X</span>' + 
				'</a></li>' 
			); 
		} else if (siteLang == 'sv') {
			children.push(
				'<li class="' + socialmedium + '">' +
				'<a href="' + socialmediaurls[socialmedium] + '" target="_blank"><span>Dela på ' + capitalizeFirstLetter(socialmedium) + '</span>' + 
				'</a></li>' 
			);
		} else if (socialmedium == 'twitter') {
			children.push(
				'<li class="x">' +
				'<a href="' + socialmediaurls[socialmedium] + '" target="_blank"><span>Share on X</span>' + 
				'</a></li>' 
			);
		} else {
			children.push(
				'<li class="' + socialmedium + '">' +
				'<a href="' + socialmediaurls[socialmedium] + '" target="_blank"><span>Share on ' + capitalizeFirstLetter(socialmedium) + '</span>' + 
				'</a></li>' 
			);
		}
	}

	$('#social-sharing ul').append(children.join(''));

	// Button styles from settings page
	// Used when shortcode is without attributes
	const buttonStyles = $('#social-sharing-buttons').data();

	if (buttonStyles && buttonStyles.settingsPage) { 

		if (buttonStyles.iconColor) {			
			buttonIcon(buttonStyles.iconColor);
		}

		if (buttonStyles.background) { 			
			buttonBackground(buttonStyles.background);
		}

		if (buttonStyles.size) {			
			buttonSize(buttonStyles.size);
		}

		if (buttonStyles.style) {			
			buttonStyle(buttonStyles.style);
		}

		if (buttonStyles.hover) {
			buttonHover(buttonStyles.hover);
		}

		if (!buttonStyles.hover) {
			buttonHoverNoSetting();
		}

		if (buttonStyles.iconHoverColor) {
			buttonIconHover(buttonStyles.iconHoverColor);
		}

		if (!buttonStyles.iconHoverColor) {
			buttonIconHoverNoSetting();
		}

	}

	function buttonBackground(background) {

		$('#social-sharing-buttons li a').css('background', background);

	}

	function buttonStyle(style) {

		switch (style) {
			case 2: 
			$('#social-sharing-buttons li').addClass('square');	
			break;

			default:
			break;
		}
	}

	function buttonIcon(color) {

		$('#social-sharing-buttons li a').css('color', color); 

	}

	function buttonIconHover(iconHover) {

		const currentIconColor = $('#social-sharing-buttons li a').css('color');

		$('#social-sharing-buttons li a').mouseover( function() {

			$(this).css('color', iconHover);

	   }); 
	   
	   $('#social-sharing-buttons li a').mouseout( function() {
		   
		   $(this).css('color', currentIconColor);
	   
	   });

	}

	function buttonIconHoverNoSetting() {

		const currentIconColor = $('#social-sharing-buttons li a').css('color');

		$('#social-sharing-buttons li a').mouseover( function() {

			$(this).css('color', currentIconColor);

	   }); 

	}

	function buttonSize(size) {
		
		switch (size) {
			case 1:
			$('#social-sharing-buttons li').addClass('small');
			break;	

			case 3: 
			$('#social-sharing-buttons li').addClass('large');
			break;

			default:
			break;
		}

	}

	function buttonHover(hover) {

		const currentBg = $('#social-sharing-buttons li a').css('background-color');

		$('#social-sharing-buttons li a').mouseover( function() {

			 $(this).css('background', hover);

		}); 
		
		$('#social-sharing-buttons li a').mouseout( function() {
			
			$(this).css('background', currentBg);
		
		});

	}

	function buttonHoverNoSetting() {

		const currentBg = $('#social-sharing-buttons li a').css('background-color');

		$('#social-sharing-buttons li a').mouseover(function () {
			$(this).css('background-color', currentBg);
		});

	}

	function capitalizeFirstLetter(string) {
    	return string.charAt(0).toUpperCase() + string.slice(1);
	}

});
