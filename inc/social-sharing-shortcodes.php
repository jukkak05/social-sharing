<?php

function social_sharing_shortcodes ( $atts = '' ) {

    // Create array for different social media sites
    // These are the parameters user can input when using shortcode
    $site = shortcode_atts( array(
        'facebook' => 0,
        'twitter' => 0,
        'pinterest' => 0,
        'email' => 0,
        'linkedin' => 0,
        'twitterhandle' => '',
        'sharetitle' => '',
    ), $atts );

    // Button containers with social media site attributes
    if ( max($site) === 0 ) {
        
        $buttons = settingsPageButtons();

    } 
    else {

        $buttons = shortCodeButtons($site);

    }

    return $buttons;

}
add_shortcode( 'social-sharing', 'social_sharing_shortcodes');

function settingsPageButtons() {

    // Get options
    $options = get_option('social_sharing_settings');

    // Variables for settings
    $facebook_setting = '';
    $twitter_setting = '';
    $linkedin_setting = '';
    $email_setting = '';
    $twitter_handle_setting = '';
    $pinterest_setting = '';
    $background = '';
    $background_hover = '';
    $icon_color = '';
    $icon_hover_color = '';
    $size = '';
    $style = '';
    $sharing_title = '';

    // Check if settings have been saved and apply escaping
    if ( isset($options['facebook']) ) {
        $facebook_setting = preg_replace("/[^1]/", "", $options['facebook'] );
    }

    if ( isset($options['twitter']) ) {
        $twitter_setting = preg_replace("/[^1]/", "", $options['twitter'] );
    }

    if ( isset($options['email']) ) {
        $email_setting = preg_replace("/[^1]/", "", $options['email'] );
    }

    if ( isset($options['linkedin']) ) {
        $linkedin_setting = preg_replace("/[^1]/", "", $options['linkedin'] );
    }

    if ( isset($options['pinterest']) ) {
        $pinterest_setting = preg_replace("/[^1]/", "", $options['pinterest'] );
    }

    if ( isset($options['twitter_handle']) ) {
        $twitter_handle_setting = esc_attr($options['twitter_handle']);
    }

    if ( isset($options['background']) ) {
        $background = esc_attr($options['background']);
    }

    if ( isset($options['background_hover']) ) {
        $background_hover = esc_attr($options['background_hover']);
    }

    if ( isset($options['icon_color']) ) {
        $icon_color = esc_attr($options['icon_color']);
    }

    if ( isset($options['icon_hover_color']) ) {
        $icon_hover_color = esc_attr($options['icon_hover_color']);
    }

    if ( isset($options['size']) ) {
        $size = preg_replace("/[^1-3]/", "", $options['size'] );
    }

    if ( isset($options['style']) ) {
        $style = preg_replace("/[^1-2]/", "", $options['style'] );
    }

    if ( isset($options['sharing_title']) ) {
        $sharing_title = esc_attr($options['sharing_title']);
    }

    // Output when settings page
    $output = '<div id="social-sharing">'; 

    if ($sharing_title) {
        $output .= '<span>' . esc_html__( 'Share: ', 'social-sharing' ) . '</span>';
    } else {
        $output .= '<span class="screen-reader-text">' . esc_html__( 'Share: ', 'social-sharing' ) . '</span>';
    }

    $output .= '<ul id="social-sharing-buttons"' . 'data-settings-page="1"' . 'data-facebook="' . $facebook_setting . '"';
    $output .= 'data-twitter="' . $twitter_setting . '"' . 'data-twitter-handle="' . $twitter_handle_setting . '"';
    $output .= 'data-pinterest="' . $pinterest_setting . '"' . 'data-email="' . $email_setting . '"';
    $output .= 'data-linkedin="' . $linkedin_setting . '"' . 'data-background="' . $background . '"';
    $output .= 'data-hover="' . $background_hover . '"' . 'data-icon-color="'. $icon_color . '"';
    $output .= 'data-icon-hover-color="' . $icon_hover_color . '"' . 'data-size="' . $size . '"';
    $output .= 'data-style="' . $style . '"' . 'data-sharing-title="' . $sharing_title . '"' . '></ul></div>';

    return $output;

}

function shortCodeButtons($site) {

    $escaped_site = array();

    // Escape attributes before output
    foreach ($site as $key => $val) {
        
        if ($key == 'twitterhandle') {

           $escaped_twitter_handle = preg_replace("/[^a-z]/", "", $val);

        } else {

            $escaped_site[$key] = preg_replace("/[^0-1]/", "", $val );

        }
    }

    // Output when shortcode attributes
    $output = '<div id="social-sharing">' . '<span class="screen-reader-text">' . esc_html__( 'Share: ', 'social-sharing' ) . '</span>'; 
    $output .= '<ul id="social-sharing-buttons" data-facebook="' . $escaped_site['facebook'] .'" ';
    $output .= 'data-twitter="' . $escaped_site['twitter'] . '" ' . 'data-twitter-handle="' . $escaped_twitter_handle . '" ';
    $output .= 'data-pinterest="' . $escaped_site['pinterest'] . '" ' . 'data-email="' . $escaped_site['email'] . '" ';
    $output .= 'data-linkedin="' . $escaped_site['linkedin'] . '">';
    $output .= '</ul></div>';

    return $output;

}