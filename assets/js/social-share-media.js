
	// All Social Media Sites
		// -------------------------------------------------

	// All Social Media Sites ~ Nice Names
	// -------------------------------------------------

function GetSocialMediaSites_NiceNames() {
	return {
		'twitter':'Twitter',
		'pinterest':'Pinterest',
		'email':'EMail',
		'facebook':'FaceBook',
		'linkedin':'LinkedIn',
		};
}

		// Social Media Sites With Share Links
		// -------------------------------------------------

function GetSocialMediaSites_WithShareLinks_OrderedByPopularity() {

	// Check shortcode output for social media site attributes

	var facebookData =  jQuery('#social-sharing-buttons').data('facebook');
	var twitterData = jQuery('#social-sharing-buttons').data('twitter');
	var emailData = jQuery('#social-sharing-buttons').data('email');
	var linkedinData = jQuery('#social-sharing-buttons').data('linkedin');
	var pinterestData = jQuery('#social-sharing-buttons').data('pinterest');

	var sites = [];

	if ( facebookData == "1" ) {
		sites.push('facebook');
	} 
	
	if ( twitterData == "1" ) {
		sites.push('twitter');
	} 
	
	if ( emailData == "1" ) {
		sites.push('email');
	} 
	
	if ( linkedinData == "1" ) {
		sites.push('linkedin');
	} 
	
	if ( pinterestData == "1" ) {
		sites.push('pinterest');
	} 

	return sites;


		/*** These sites can also be added:
		'google.bookmarks',
		'reddit',
		'tumblr',
		'blogger',
		'livejournal',
		'evernote',
		'add.this',
		'getpocket',
		'hacker.news',
		'digg',
		'buffer',
		'flipboard',
		'instapaper',
		'surfingbird.ru',
		'flattr',
		'diaspora',
		'qzone',
		'vk',
		'weibo',
		'ok.ru',
		'douban',
		'xing',
		'renren',
		'threema',
		'sms',
		'line.me',
		'skype',
		'telegram.me',
		'gmail',
		'yahoo',
		***/

}

/*function GetSocialMediaSites_WithShareLinks_OrderedByAlphabet() {
	const nice_names = GetSocialMediaSites_NiceNames();
	
	return Object.keys(nice_names);
}*/

		// Social Media Site Links With Share Links
		// -------------------------------------------------

function GetSocialMediaSiteLinks_WithShareLinks(args) {
	const validargs = [
		'url',
		'title',
		'desc',
		'via',
		'hash_tags',
		'provider',
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
	const provider = fixedEncodeURIComponent(args.provider);
	const email_address = fixedEncodeURIComponent(args.email_address);
	
	var text = title;
	
	if(desc) {
		text += '%20%3A%20';	// This is just this, " : "
		text += desc;
	}
	
	return {
		'email':'mailto:' + email_address + '?subject=' + title + '&body=' + desc,
		'facebook':'http://www.facebook.com/sharer.php?u=' + url,
		'linkedin':'https://www.linkedin.com/shareArticle?mini=true&url=' + url + '&title=' + title + '&summary=' + text + '&source=' + provider,
		'pinterest':'http://pinterest.com/pin/create/button/?url=' + url ,
		'twitter':'https://twitter.com/intent/tweet?url=' + url + '&text=' + title + '&via=' + via + '&hashtags=' + hash_tags
	};
}

function fixedEncodeURIComponent(str) {
	return encodeURIComponent(str).replace(/[!'()*]/g, function(c) {
		return '%' + c.charCodeAt(0).toString(16);
	});
}

