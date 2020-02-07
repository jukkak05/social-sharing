<?php

function social_sharing_settings_page() {

    // Plugin settings page setup
    add_options_page( 
        'Social Sharing',
        'Social Sharing', 
        'manage_options', 
        'social-sharing', 
        'social_sharing_settings_page_markup' 
    );

}
add_action( 'admin_menu', 'social_sharing_settings_page', 10  );

function social_sharing_settings_page_markup() {

    // Double check user capabilities 

    if ( !current_user_can( 'manage_options' ) ) {

        return;

    }

    // Settings page markup

    include ( SOCIAL_SHARING_DIR . 'templates/social-sharing-settings-page.php');

}

function social_sharing_settings_section() {

    // If plugin settings don't exist, then create them in db table wp_options
    if ( !get_option( 'social_sharing_settings' ) ) {

        add_option( 'social_sharing_settings' );

    }

    // Register our setting so that $_POST handling is done for us and
 	// our callback function just has to echo the <input>
     register_setting( 
        'social_sharing_settings', 
        'social_sharing_settings' 
    );

    // Social media sites section
    add_settings_section( 
        'social_sharing_settings_sites_section', 
        'Sites',
        'social_sharing_settings_sites_section_callback',
        'social-sharing' 
    );

    // Styles section
    add_settings_section( 
        'social_sharing_settings_styles_section', 
        'Appearance',
        'social_sharing_settings_styles_section_callback',
        'social-sharing' 
    );

}
add_action( 'admin_init', 'social_sharing_settings_section', 10 );

function social_sharing_settings_sites_section_callback() {
}

function social_sharing_settings_styles_section_callback() {
}

function social_sharing_settings_fields () {

    // Sites checkboxes
    add_settings_field( 
        'social_sharing_settings_sites', 
        'Social Sharing Sites', 
        'social_sharing_settings_sites_callback', 
        'social-sharing', 
        'social_sharing_settings_sites_section' 
    );

    // Twitterid input text
    add_settings_field( 
        'social_sharing_settings_twitterid', 
        'Twitter handle', 
        'social_sharing_settings_twitterid_callback', 
        'social-sharing', 
        'social_sharing_settings_sites_section'
    );

    // Buttons background color
    add_settings_field( 
        'social_sharing_settings_buttons_background', 
        'Buttons bg color', 
        'social_sharing_settings_buttons_background_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section'
    );

    // Buttons background hover
    add_settings_field( 
        'social_sharing_settings_buttons_background_hover', 
        'Buttons bg hover', 
        'social_sharing_settings_buttons_background_hover_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section'
    );

    // Buttons icon color
    add_settings_field( 
        'social_sharing_settings_butttons_icon_color', 
        'Buttons icon color', 
        'social_sharing_settings_buttons_icon_color_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section'
    );

    // Buttons icon size
    add_settings_field( 
        'social_sharing_settings_icon_size', 
        'Buttons icon size', 
        'social_sharing_settings_icon_size_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section'
    );

    // Buttons style

    add_settings_field( 
        'social_sharing_settings_buttons_style', 
        'Buttons style', 
        'social_sharing_settings_buttons_style_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section' 
    );


}
add_action('admin_init', 'social_sharing_settings_fields', 10);

function social_sharing_settings_sites_callback() {

    $options = get_option( 'social_sharing_settings' );

    $facebook = '';
    $twitter = '';
    $email = '';
    $linkedin = '';
    $pinterest = '';

    if ( isset($options['facebook']) ) {
         $facebook = $options['facebook'];
    }

    if ( isset($options['twitter']) ) {
        $twitter = $options['twitter'];
    }
    if ( isset($options['email']) ) {
        $email = $options['email'];
    }

    if ( isset($options['linkedin']) ) {
        $linkedin = $options['linkedin'];
    }

    if ( isset($options['pinterest']) ) {
        $pinterest = $options['pinterest'];
    }

    $html = '<input type="checkbox" id="facebook" name="social_sharing_settings[facebook]" value="1"' . checked( 1, $facebook, false ) . '/>';
    $html .= '<label for="facebook">Facebook</label>';

    $html .= '<input type="checkbox" id="twitter" name="social_sharing_settings[twitter]"  value="1"' . checked( 1, $twitter, false ) . '/>';
    $html .= '<label for="twitter">Twitter</label>';

    $html .= '<input type="checkbox" id="email" name="social_sharing_settings[email]" Value="1"' . checked( 1, $email, false ) . '/>';
    $html .= '<label for="email">Email</label>';

    $html .= '<input type="checkbox" id="linkedin" name="social_sharing_settings[linkedin]" value="1"' . checked( 1, $linkedin, false ) . '/>';
    $html .= '<label for="linkedin">LinkedIN</label>';

    $html .= '<input type="checkbox" id="pinterest" name="social_sharing_settings[pinterest]" value="1"' . checked( 1, $pinterest, false ) . '/>';
    $html .= '<label for="pinterest">Pinterest</label>';

    echo $html;

}

function social_sharing_settings_twitterid_callback() {

    $options = get_option( 'social_sharing_settings' );

    $text_input = '';

    // Get the current value of twitterid
    if ( isset( $options[ 'twitterid' ] ) ) {

        $text_input = $options[ 'twitterid' ] ;
        
    }

    echo '<input type="text" id="social_sharing_twitterid" name="social_sharing_settings[twitterid]" 
    value="' . $text_input . '" />';

}

function social_sharing_settings_buttons_background_callback() {

    $options = get_option( 'social_sharing_settings' );

    $text_input = '';

    if ( isset( $options[ 'background' ] ) ) {

        $text_input = $options[ 'background' ] ;
        
    }

    echo '<input type="text" id="social_sharing_buttons_background" name="social_sharing_settings[background]" 
    value="' . $text_input . '" />';


}

function social_sharing_settings_buttons_background_hover_callback() {

    $options = get_option( 'social_sharing_settings' );

    $text_input = '';

    if ( isset( $options[ 'background_hover' ] ) ) {

        $text_input = $options[ 'background_hover' ] ;
        
    }

    echo '<input type="text" id="social_sharing_buttons_background_hover" name="social_sharing_settings[background_hover]" 
    value="' . $text_input . '" />';


}

function social_sharing_settings_buttons_icon_color_callback() {

    $options = get_option( 'social_sharing_settings' );

    $text_input = '';

    // Get the current value of icon color 
    if ( isset( $options[ 'icon_color' ] ) ) {

        $text_input = $options[ 'icon_color' ] ;
        
    }

    echo '<input type="text" id="social_sharing_buttons_icon_color" name="social_sharing_settings[icon_color]" 
    value="' . $text_input . '" />';


}

function social_sharing_settings_icon_size_callback() {

    $options = get_option( 'social_sharing_settings' );

    $size = '';

    if ( isset($options['size']) ) {

        $size = $options['size'];

    }

    $html = '<input type="radio" id="social_sharing_settings_size_small" 
    name="social_sharing_settings[size]" value="1"' . checked( 1, $size, false) . '/>';
    $html .= '<label for="social_sharing_settings_size_small">' . 'Small' . '</label>';

    $html .= '<input type="radio" id="social_sharing_settings_size_medium" 
    name="social_sharing_settings[size]" value="2"' . checked( 2, $size, false) . '/>';
    $html .= '<label for="social_sharing_settings_size_medium">' . 'Medium' . '</label>';

    $html .= '<input type="radio" id="social_sharing_settings_size_large" 
    name="social_sharing_settings[size]" value="3"' . checked( 3, $size, false) . '/>';
    $html .= '<label for="social_sharing_settings_size_large">' . 'Large' . '</label>';

    echo $html;

}

function social_sharing_settings_buttons_style_callback() {

    $options = get_option( 'social_sharing_settings' );

    $style = '';

    if ( isset($options['style']) ) {

        $style = $options['style'];

    }

    $html = '<input type="radio" id="social_sharing_settings_style_round" 
    name="social_sharing_settings[style]" value="1"' . checked( 1, $style, false) . '/>';
    $html .= '<label for="social_sharing_settings_style_round">' . 'Round' . '</label>';

    $html .= '<input type="radio" id="social_sharing_settings_style_square" 
    name="social_sharing_settings[style]" value="2"' . checked( 2, $style, false) . '/>';
    $html .= '<label for="social_sharing_settings_style_square">' . 'Square' . '</label>';

    echo $html;


}