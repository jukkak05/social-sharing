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

		// Button size
		buttonStyles.size ? buttonSize(buttonStyles.size) : buttonSize('2');

		// Button background
		buttonStyles.background ? buttonBackground(buttonStyles.background) : buttonBackground('transparent');

		// Button hover background
		buttonStyles.hover ? buttonHover(buttonStyles.hover) : buttonHover('transparent');
	
		// Button style
		buttonStyles.style ? buttonStyle(buttonStyles.style) : buttonStyle('round');

		// Icon color
		buttonStyles.iconColor ? buttonIcon(buttonStyles.iconColor) : buttonIcon('#000000');

		// Icon hover color
		buttonStyles.iconHoverColor ? buttonIconHover(buttonStyles.iconHoverColor) : buttonIconHover('#000000');

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

	function buttonIcon(iconColor) {

		$('#social-sharing-buttons li').each(function () {

			// jQuery object of link element
			const $linkElement = $(this).find('a');

			// Content attribute of link element
			let content = window.getComputedStyle($linkElement[0], '::before').getPropertyValue('content');

			// Remove wrapping quotes if present
			if (content.startsWith('"') || content.startsWith("'")) {
				content = content.slice(1, -1);
			}

			// Extract SVG data from url("data:image/svg+xml,...")
			const match = content.match(/^url\("data:image\/svg\+xml,(.*)"\)$/);
			if (!match) return;

			// Decode svg string
			let svg = decodeURIComponent(match[1]);

			// Set icon size
			const size = $('#social-sharing-buttons').data('size');
			let iconWidth, iconHeight;
			switch (size) {
				case 1: iconWidth = '18'; iconHeight = '12'; break;
				case 2: iconWidth = '26'; iconHeight = '16'; break;
				case 3: iconWidth = '30'; iconHeight = '20'; break;
				default: iconWidth = '26'; iconHeight = '15'; break;
			}

			svg = svg.replace('<svg', `<svg width="${iconWidth}" height="${iconHeight}"`);

			// Replace fill attribute from svg string
			svg = svg.replace(/fill=(['"])(#[0-9A-Fa-f]{3,6}|[a-zA-Z]+)\1/, 'fill="' + iconColor + '"');

			// Re-encode svg string and set as CSS variable
			const encoded = encodeURIComponent(svg).replace(/'/g, "%27").replace(/"/g, "%22");
			svgUri = 'url("data:image/svg+xml,' + encoded + '")';
			$linkElement.css('--svg-uri', svgUri);
	
		});

	}

	function buttonIconHover(iconHoverColor) {

		$('#social-sharing-buttons li a').on('mouseenter', function() {

			// jQuery object of link element
			const $linkElement = $(this);

			// Variable to store svgUri
			let svgUri; 

			// Check if hover svg uri is set as data attribute
			if ($linkElement.data('hover-svg-uri')) {

				svgUri = $linkElement.data('hover-svg-uri');
				$linkElement.css('--svg-hover-uri', svgUri);

			// Proceed to create the hover svg uri
			} else {

				// Content attribute of link element
				let content = window.getComputedStyle($linkElement[0], '::before').getPropertyValue('content');
				if (!content) return;

				// Remove wrapping quotes if present
				if (content.startsWith('"') || content.startsWith("'")) {
					content = content.slice(1, -1);
				}

				// Extract SVG data from url("data:image/svg+xml,...")
				const match = content.match(/^url\("data:image\/svg\+xml,(.*)"\)$/);
				if (!match) return;

				// Decode svg string
				let svg = decodeURIComponent(match[1]);

				// Set icon size
				const size = $('#social-sharing-buttons').data('size');
				let iconWidth, iconHeight;
				switch (size) {
					case 1: iconWidth = '18'; iconHeight = '12'; break;
					case 2: iconWidth = '26'; iconHeight = '16'; break;
					case 3: iconWidth = '30'; iconHeight = '20'; break;
					default: iconWidth = '26'; iconHeight = '15'; break;
				}

				svg = svg.replace('<svg', `<svg width="${iconWidth}" height="${iconHeight}"`);

				// Replace fill attribute from svg string
				svg = svg.replace(/fill=(['"])(#[0-9A-Fa-f]{3,6}|[a-zA-Z]+)\1/, 'fill="' + iconHoverColor + '"');

				// Re-encode svg string and set as CSS variable
				const encoded = encodeURIComponent(svg).replace(/'/g, "%27").replace(/"/g, "%22");
				svgUri = 'url("data:image/svg+xml,' + encoded + '")';
				$linkElement.css('--svg-hover-uri', svgUri);

				// Store the link element hover svg uri as data attribute
				$linkElement.data('hover-svg-uri', svgUri);

			}

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

		const backgroundColor = $('#social-sharing-buttons').data('background');

		$('#social-sharing-buttons li a').on('mouseenter', function() {
			 $(this).css('background', hover);
		}); 
		
		$('#social-sharing-buttons li a').on('mouseleave', function() {
			$(this).css('background', backgroundColor);
		});

	}

	function capitalizeFirstLetter(string) {
    	return string.charAt(0).toUpperCase() + string.slice(1);
	}

});
