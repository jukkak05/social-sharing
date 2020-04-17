=== Social Sharing ===

Contributors: jukkak, mikkopaltamaa, bradvin
Tags: social, social media, sharing, facebook, twitter, linkedin, pinterest
License: BSD 3-Clause License
License URI: https://opensource.org/licenses/BSD-3-Clause

Social media sharing buttons

== Description ==

This plugin is based on Social Share URLs javascript code from github user bradvin. 

The initial code has been further developed with some additional features. User can now easily insert social media buttons using a shortcode. 

== Installation ==

1. Upload to the "/wp-content/plugins" directory. 
2. Activate the plugin.
3. Change settings from Settings > Social Sharing. 
4. Insert shortcode where you want the social buttons to appear. 

== Usage ==

All sites are deactivated by default. 

You can change sites and styling on the settings page. 

There are two ways to use the plugin: 

Insert shortcode [social-sharing] without attributes. Plugin will use settings page options. 

OR 

Insert shortcode [social-sharing] with site attributes to override settings:

facebook=1
twitter=1
email=1
linkedin=1
pinterest=1
twitterhandle=handle

Example: [social-sharing email=1 linkedin=1 twitter=1 twitterhandle=konseptofi]

Sharing links will have correct information if you have seo meta tags on page. 

Plugin uses font awesome icons. You can easily change colors and icons with css, see social-sharing.css. 

== Changelog ==

= 1.3 =

Improved localization and accessibility. 

Updated twitter and linkedin sharing links. 

= 1.2 =

New settings and sanitization. 

Switched shortcode attribute twitterid to twitterhandle. 

= 1.1 =

Settings page with site and styling options. 

All links now open in new window. 

= 1.0 =

Initial release. 

Simple shortcode with attributes usage. 
