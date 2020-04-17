<?php
/**
 * Plugin Name:       Social Sharing
 * Description:       Social media sharing buttons.
 * Version:           1.3
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

// Include plugin files
include ( SOCIAL_SHARING_DIR . 'inc/social-sharing-shortcodes.php');
include ( SOCIAL_SHARING_DIR . 'inc/social-sharing-settings.php');

// Include scripts and stylesheets
function social_sharing_assets() {

    $options = get_option( 'social_sharing_settings');
  
        // Stylesheet. Load only if user accepts in settings.
        if ( isset($options['stylesheet']) ) {
            wp_enqueue_style( 'social-sharing', SOCIAL_SHARING_URL . 'assets/css/social-sharing.css', array(), '1.2');
        }

       // Javascript
       wp_enqueue_script( 'social-share-media', SOCIAL_SHARING_URL . 'assets/js/social-share-media.js', ['jquery'], '1.2' );
       wp_enqueue_script( 'social-sharing', SOCIAL_SHARING_URL . 'assets/js/social-sharing.js', ['jquery'], '1.2' );

       // Font Awesome. Load only if user accepts in settings.    
       if ( isset($options['font_awesome']) ) {
            wp_enqueue_style( 'font-awesome-icons', SOCIAL_SHARING_URL . 'assets/css/all.min.css');
       }
   
}
add_action( 'wp_enqueue_scripts', 'social_sharing_assets', 10);


