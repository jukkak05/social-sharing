<?php
/**
 * Plugin Name:       Social Sharing
 * Description:       Social media sharing buttons.
 * Version:           1.4
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

        // Javascript
        wp_enqueue_script( 'social-sharing', SOCIAL_SHARING_URL . 'assets/js/social-sharing.js', ['jquery'], '1.4' );
  
        // Plugin stylesheet. Loaded only if user accepts in settings.
        if ( isset($options['stylesheet']) ) {
            wp_enqueue_style( 'social-sharing', SOCIAL_SHARING_URL . 'assets/css/social-sharing.css', array(), '1.4');
        }

       // Font Awesome stylesheets. Loaded only if user accepts in settings.    
       if ( isset($options['font_awesome']) ) {
            wp_enqueue_style( 'font-awesome-icons-brands', SOCIAL_SHARING_URL . 'assets/css/brands.min.css');
            wp_enqueue_style( 'font-awesome-icons-solid', SOCIAL_SHARING_URL . 'assets/css/solid.min.css');
       }
   
}
add_action( 'wp_enqueue_scripts', 'social_sharing_assets', 10);

// Load text domain for translations
function social_sharing_init() {

    load_plugin_textdomain( 'social-sharing', false, SOCIAL_SHARING_DIR . 'languages/' );
    
}
add_action('plugins_loaded', 'social_sharing_init');


