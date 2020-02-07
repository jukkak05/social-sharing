<?php
/**
 * Plugin Name:       Social Sharing
 * Description:       Social media sharing buttons.
 * Version:           1.0.0
 * Author:            Jukka Kalenius
 * Author URI:        https://github.com/jukkak05
 * License:           BSD 3-Clause License
 * License URI:       https://opensource.org/licenses/BSD-3-Clause
 * Text Domain:       social-sharing
 * Domain Path:       /languages
 **/

// If this file is called directly, abort. 
if ( ! defined( 'WPINC') ) {

    die;

}

 
// Define plugin paths
define ( 'SOCIAL_SHARING_URL', plugin_dir_url( __FILE__ ) );
define ( 'SOCIAL_SHARING_DIR', plugin_dir_path( __FILE__ ) );


// Include scripts and stylesheets
function social_sharing_assets() {

        
        // Stylesheet
       wp_enqueue_style( 'social-sharing', SOCIAL_SHARING_URL . 'assets/css/social-sharing.css');

       // Javascript
       wp_enqueue_script( 'social-share-media', SOCIAL_SHARING_URL . 'assets/js/social-share-media.js', ['jquery'], '1.0.0' );
       wp_enqueue_script( 'social-sharing', SOCIAL_SHARING_URL . 'assets/js/social-sharing.js', ['jquery'], '1.0.0' );

       // Font Awesome
       wp_enqueue_style( 'font-awesome-icons', SOCIAL_SHARING_URL . 'assets/css/all.min.css');

}
add_action( 'wp_enqueue_scripts', 'social_sharing_assets', 10);


// Create shortcodes
function social_sharing_shortcodes ( $atts = '' ) {

    // Create array for different social media sites
    $site = shortcode_atts( array(
        'facebook' => 0,
        'twitter' => 0,
        'pinterest' => 0,
        'email' => 0,
        'linkedin' => 0,
        'twitterid' => ''
    ), $atts );

    // Button containers with social media site attributes
    $output = '<div id="social-sharing">'; 
    $output .= '<ul id="buttons"' . 'data-facebook="' . $site['facebook'] .'"';
    $output .= 'data-twitter="' . $site['twitter'] . '"' . 'data-twitterid="' . $site['twitterid'] . '"';
    $output .= 'data-pinterest="' . $site['pinterest'] . '"' . 'data-email="' . $site['email'] . '"';
    $output .= 'data-linkedin="' . $site['linkedin'] . '"';
    $output .= '></ul></div>';

    return $output;

}
add_shortcode( 'social-sharing', 'social_sharing_shortcodes');