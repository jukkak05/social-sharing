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
        'social_sharing_settings', 
        'social_sharing_settings_sanitize_callback' 
    );

    // Social media sites section
    add_settings_section( 
        'social_sharing_settings_sites_section', 
        '',
        'social_sharing_settings_sites_section_callback',
        'social-sharing' 
    );

    // Styles section
    add_settings_section( 
        'social_sharing_settings_styles_section', 
        esc_html__( 'Appearance', 'social-sharing' ),
        'social_sharing_settings_styles_section_callback',
        'social-sharing' 
    );

}
add_action( 'admin_init', 'social_sharing_settings_section', 10 );

function social_sharing_settings_sites_section_callback() {
    echo '<p>';
    esc_html_e( 'Use shortcode [social-sharing] for settings page version. If you use shortcode attributes then these settings are overridden.','social-sharing' );
    echo '<br><br>';
    esc_html_e( 'Available attributes are: facebook=1 twitter=1 linkedin=1 pinterest=1 whatsapp=1 email=1 twitterhandle=handle.','social-sharing' );
    echo '</p>';
}

function social_sharing_settings_styles_section_callback() {
}

function social_sharing_settings_fields () {

    // Sites checkboxes
    add_settings_field( 
        'social_sharing_settings_sites', 
        esc_html__( 'Social Media Sites', 'social-sharing' ),
        'social_sharing_settings_sites_callback', 
        'social-sharing', 
        'social_sharing_settings_sites_section' 
    );

    // Twitter handle input text
    add_settings_field( 
        'social_sharing_settings_twitter_handle', 
        esc_html__( 'Twitter handle', 'social-sharing' ),
        'social_sharing_settings_twitter_handle_callback', 
        'social-sharing', 
        'social_sharing_settings_sites_section'
    );

    // Buttons background color
    add_settings_field( 
        'social_sharing_settings_buttons_background', 
        esc_html__( 'Background color', 'social-sharing' ),
        'social_sharing_settings_buttons_background_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section'
    );

    // Buttons background hover
    add_settings_field( 
        'social_sharing_settings_buttons_background_hover', 
        esc_html__( 'Background hover','social-sharing' ), 
        'social_sharing_settings_buttons_background_hover_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section'
    );

    // Buttons icon color
    add_settings_field( 
        'social_sharing_settings_butttons_icon_color', 
        esc_html__( 'Icon color', 'social-sharing' ), 
        'social_sharing_settings_buttons_icon_color_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section'
    );

    // Buttons icon hover color
    add_settings_field( 
        'social_sharing_settings_butttons_icon_hover_color', 
        esc_html__( 'Icon hover color', 'social-sharing' ), 
        'social_sharing_settings_buttons_icon_hover_color_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section'
    );

    // Buttons icon size
    add_settings_field( 
        'social_sharing_settings_icon_size', 
        esc_html__( 'Size', 'social-sharing' ), 
        'social_sharing_settings_icon_size_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section'
    );

    // Buttons style
    add_settings_field( 
        'social_sharing_settings_buttons_style', 
        esc_html__( 'Style', 'social-sharing' ), 
        'social_sharing_settings_buttons_style_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section' 
    );

     // Sharing title
     add_settings_field( 
        'social_sharing_settings_sharing_title', 
        esc_html__( 'Show sharing title', 'social-sharing' ), 
        'social_sharing_settings_sharing_title_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section' 
    );

    // Stylesheet
    add_settings_field( 
        'social_sharing_settings_stylesheet', 
        esc_html__( 'Buttons stylesheet', 'social-sharing' ), 
        'social_sharing_settings_stylesheet_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section' 
    );

    // Font awesome css
    add_settings_field(
        'social_sharing_settings_font_awesome', 
        esc_html__( 'Font awesome stylesheet', 'social-sharing' ), 
        'social_sharing_settings_font_awesome_callback', 
        'social-sharing', 
        'social_sharing_settings_styles_section' 
    );
   
}
add_action('admin_init', 'social_sharing_settings_fields', 10);

function social_sharing_settings_sites_callback() {

    $options = get_option( 'social_sharing_settings' );

    $facebook = '';
    $twitter = '';
    $linkedin = '';
    $pinterest = '';
    $whatsapp = '';
    $email = '';

    if ( isset($options['facebook']) ) {
         $facebook = $options['facebook'];
    }

    if ( isset($options['twitter']) ) {
        $twitter = $options['twitter'];
    }
   
    if ( isset($options['linkedin']) ) {
        $linkedin = $options['linkedin'];
    }

    if ( isset($options['pinterest']) ) {
        $pinterest = $options['pinterest'];
    }

    if ( isset($options['whatsapp']) ) {
        $whatsapp = $options['whatsapp'];
    }

    if ( isset($options['email']) ) {
        $email = $options['email'];
    }

    $html = '<input type="checkbox" id="facebook" name="social_sharing_settings[facebook]" value="1"' . checked( 1, $facebook, false ) . '/>';
    $html .= '<label for="facebook">Facebook</label>&nbsp;';

    $html .= '<input type="checkbox" id="twitter" name="social_sharing_settings[twitter]"  value="1"' . checked( 1, $twitter, false ) . '/>';
    $html .= '<label for="twitter">Twitter&nbsp;</label>&nbsp;';

    $html .= '<input type="checkbox" id="linkedin" name="social_sharing_settings[linkedin]" value="1"' . checked( 1, $linkedin, false ) . '/>';
    $html .= '<label for="linkedin">LinkedIN&nbsp;</label>&nbsp;';

    $html .= '<input type="checkbox" id="pinterest" name="social_sharing_settings[pinterest]" value="1"' . checked( 1, $pinterest, false ) . '/>';
    $html .= '<label for="pinterest">Pinterest&nbsp;</label>';

    $html .= '<input type="checkbox" id="whatsapp" name="social_sharing_settings[whatsapp]" value="1"' . checked( 1, $whatsapp, false ) . '/>';
    $html .= '<label for="whatsapp">Whatsapp&nbsp;</label>';

    $html .= '<input type="checkbox" id="email" name="social_sharing_settings[email]" Value="1"' . checked( 1, $email, false ) . '/>';
    $html .= '<label for="email">Email&nbsp;</label>&nbsp;';

    echo $html;

}

function social_sharing_settings_twitter_handle_callback() {

    $options = get_option( 'social_sharing_settings' );

    $text_input = '';

    if ( isset( $options[ 'twitter_handle' ] ) ) {

        $text_input = $options[ 'twitter_handle' ] ;
        
    }

    echo '<input type="text" id="twitter_handle" name="social_sharing_settings[twitter_handle]" 
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

    if ( isset( $options[ 'icon_color' ] ) ) {

        $text_input = $options[ 'icon_color' ] ;
        
    }

    echo '<input type="text" id="social_sharing_buttons_icon_color" name="social_sharing_settings[icon_color]" 
    value="' . $text_input . '" />';

}

function social_sharing_settings_buttons_icon_hover_color_callback() {

    $options = get_option( 'social_sharing_settings' );

    $text_input = '';

    if ( isset( $options[ 'icon_hover_color' ] ) ) {

        $text_input = $options[ 'icon_hover_color' ] ;
        
    }

    echo '<input type="text" id="social_sharing_buttons_icon_hover_color" name="social_sharing_settings[icon_hover_color]" 
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
    $html .= '<label for="social_sharing_settings_size_small">' . esc_html__( 'Small (26x26)','social-sharing' ) . '</label>&nbsp;';

    $html .= '<input type="radio" id="social_sharing_settings_size_medium" 
    name="social_sharing_settings[size]" value="2"' . checked( 2, $size, false) . '/>';
    $html .= '<label for="social_sharing_settings_size_medium">' . esc_html__( 'Medium (38x38)', 'social-sharing' ) . '</label>&nbsp;';

    $html .= '<input type="radio" id="social_sharing_settings_size_large" 
    name="social_sharing_settings[size]" value="3"' . checked( 3, $size, false) . '/>';
    $html .= '<label for="social_sharing_settings_size_large">' . esc_html__( 'Large (46x46)','social-sharing' ) . '</label>';

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
    $html .= '<label for="social_sharing_settings_style_round">' . esc_html__( 'Round', 'social-sharing' ) . '</label>&nbsp;';

    $html .= '<input type="radio" id="social_sharing_settings_style_square" 
    name="social_sharing_settings[style]" value="2"' . checked( 2, $style, false) . '/>';
    $html .= '<label for="social_sharing_settings_style_square">' . esc_html__( 'Square', 'social-sharing' ) . '</label>';

    echo $html;

}

function social_sharing_settings_sharing_title_callback() {

    $options = get_option( 'social_sharing_settings' );

    $sharing_title = '';

    if ( isset($options['sharing_title']) ) {

        $sharing_title = $options['sharing_title'];

    }

    $html = '<input type="checkbox" id="sharing-title" name="social_sharing_settings[sharing_title]" value="1"' . checked( 1, $sharing_title, false ) . '/>';
   
    echo $html;

}

function social_sharing_settings_stylesheet_callback() {

    $options = get_option( 'social_sharing_settings' );

    $stylesheet = '';

    if ( isset($options['stylesheet']) ) {

        $stylesheet = $options['stylesheet'];

    }

    $html = '<input type="checkbox" id="stylesheet" name="social_sharing_settings[stylesheet]" value="1"' . checked( 1, $stylesheet, false ) . '/>';
   
    echo $html;

}

function social_sharing_settings_font_awesome_callback() {

    $options = get_option( 'social_sharing_settings' );

    $font_awesome = '';

    if ( isset($options['font_awesome']) ) {

        $font_awesome = $options['font_awesome'];

    }

    $html = '<input type="checkbox" id="font-awesome" name="social_sharing_settings[font_awesome]" value="1"' . checked( 1, $font_awesome, false ) . '/>';
   
    echo $html;

}

function social_sharing_settings_sanitize_callback($input) {

    $output = array();

    // Remove any array key that is not in our whitelist
    $allowed_keys = [
        'facebook', 
        'twitter', 
        'linkedin', 
        'email', 
        'pinterest', 
        'twitter_handle', 
        'background',
        'background_hover', 
        'icon_color', 
        'icon_hover_color', 
        'size', 
        'style', 
        'sharing_title',
        'stylesheet', 
        'font_awesome',
        'whatsapp',
    ];
    
    foreach ($input as $key => $value) {

        if (!in_array($key, $allowed_keys)) {
            unset($input[$key]);
        }

    }

    foreach( $input as $key => $value ) {

      if ( isset( $input[$key] ) ) {
         
            // Sanitize the strings with wordpress function            
            $output[$key] = sanitize_text_field( $input[$key] );
        } 
         
    } 
   
    return $output;

}