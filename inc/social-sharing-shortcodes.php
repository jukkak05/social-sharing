<?php

function social_sharing_shortcodes ( $atts = '' ) {

    // Create array for different social media sites
    // These are the parameters user can input when using the shortcode
    $site = shortcode_atts( array(
        'facebook' => 0,
        'twitter' => 0,
        'pinterest' => 0,
        'email' => 0,
        'linkedin' => 0,
        'twitterid' => ''
    ), $atts );

    // Button containers with social media site attributes
    // Shortcode output for settings page
    if ( $site['pinterest'] == 0 && $site['facebook'] == 0 && $site['twitter'] == 0 && $site['email'] == 0 && $site['linkedin'] == 0 && $site['twitterid'] == 0) {

        // Get options
        $options = get_option('social_sharing_settings');

        // Variables for settings
        $facebook_setting = '';
        $twitter_setting = '';
        $linkedin_setting = '';
        $email_setting = '';
        $twitterid_setting = '';
        $pinterest_setting = '';
        $background = '';
        $background_hover = '';
        $icon_color = '';
        $size = '';
        $style = '';


        // Check if settings have been saved
        if ( isset($options['facebook']) ) {
            $facebook_setting = $options['facebook'];
        }

        if ( isset($options['twitter']) ) {
            $twitter_setting = $options['twitter'];
        }

        if ( isset($options['linkedin']) ) {
            $linkedin_setting = $options['linkedin'];
        }

        if ( isset($options['email']) ) {
            $email_setting = $options['email'];
        }

        if ( isset($options['twitterid']) ) {
            $twitterid_setting = $options['twitterid'];
        }

        if ( isset($options['pinterest']) ) {
            $pinterest_setting = $options['pinterest'];
        }

        if ( isset($options['background']) ) {
            $background = $options['background'];
        }

        if ( isset($options['background_hover']) ) {
            $background_hover = $options['background_hover'];
        }

        if ( isset($options['icon_color']) ) {
            $icon_color = $options['icon_color'];
        }

        if ( isset($options['size']) ) {
            $size = $options['size'];
        }

        if ( isset($options['style']) ) {
            $style = $options['style'];
        }

        // Output when settings page
        $output = '<div id="social-sharing">'; 
        $output .= '<ul id="buttons"' . 'data-facebook="' . $facebook_setting .'"';
        $output .= 'data-twitter="' . $twitter_setting . '"' . 'data-twitterid="' . $twitterid_setting . '"';
        $output .= 'data-pinterest="' . $pinterest_setting . '"' . 'data-email="' . $email_setting . '"';
        $output .= 'data-linkedin="' . $linkedin_setting . '"' . 'data-background="' . $background . '"';
        $output .= 'data-hover="' . $background_hover . '"' . 'data-icon-color="'. $icon_color . '"';
        $output .= 'data-size="' . $size . '"' . 'data-style="' . $style . '"' . '></ul></div>';

    } else {

    // Output when shortcode attributes
    $output = '<div id="social-sharing">'; 
    $output .= '<ul id="buttons"' . 'data-facebook="' . $site['facebook'] .'"';
    $output .= 'data-twitter="' . $site['twitter'] . '"' . 'data-twitterid="' . $site['twitterid'] . '"';
    $output .= 'data-pinterest="' . $site['pinterest'] . '"' . 'data-email="' . $site['email'] . '"';
    $output .= 'data-linkedin="' . $site['linkedin'] . '"';
    $output .= '></ul></div>';

    }

    return $output;

}
add_shortcode( 'social-sharing', 'social_sharing_shortcodes');