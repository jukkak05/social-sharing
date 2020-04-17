<div class="wrap">

    <h1><?php esc_html_e( get_admin_page_title() ); ?></h1>

    <form method="post" action="options.php">
        <?php settings_fields( 'social_sharing_settings' ); ?>
        <?php do_settings_sections( 'social-sharing' ); ?>
        <?php submit_button(); ?>
    </form>

</div>
