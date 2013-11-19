<?php

class Content_Overlay {

    function __construct() {

        add_action( 'wp_footer', array( &$this, 'register_templates' ) );
        add_action( 'wp_enqueue_scripts', array( &$this, 'register_scripts' ) );
        add_action( 'admin_menu', array( &$this, 'setup_options' ) );
        add_action( 'admin_init', array( &$this, 'setup_options_section' ) );

    }

    public function register_templates() {
        echo '<script type="text/template" id="popupTemplate">' . file_get_contents(CONTOVER_PATH . 'inc/views/popupTpl.html') . '</script>';
    }

    public function register_scripts() {
        wp_register_style( 'content-overlay-style', CONTOVER_URI . '/css/content-overlay.css' );
        wp_enqueue_style( 'content-overlay-style' );

        wp_register_script( 'content-overlay-script',  CONTOVER_URI . '/js/content-overlay.js', array('jquery'), null, true );
        wp_enqueue_script( 'content-overlay-script' );

        $options = get_option( 'content_overlay_settings' );
        wp_localize_script( 'content-overlay-script', 'contentSettings', $options );
    }

    public function setup_options() {
        add_submenu_page(
            $parent_slug = 'options-general.php',
            $page_title  = __( 'Content Overlay', CONTOVER_SLUG ),
            $menu_title  = __( 'Content Overlay', CONTOVER_SLUG ),
            $capability  = 'activate_plugins',
            $menu_slug   = 'content_overlay',
            $callback    = array( &$this, 'display_options' )
        );
    }

    public function setup_options_section() {
        if ( ! get_option( 'content_overlay_settings' ) )
            add_option( 'content_overlay_settings' );

        add_settings_section(
            $id          = 'content_overlay_settings_section',
            $title       = '',
            $callback    = array( &$this, 'display_options_section' ),
            $page        = 'content_overlay_settings'
        );

        /*
        add_settings_field(
            $id          = 'content_overlay',
            $title       = __( 'Content Overlay Code', CONTOVER_SLUG ),
            $callback    = array( &$this, 'display_content_field' ),
            $page        = 'content_overlay_settings',
            $section     = 'content_overlay_settings_section'
        );
        */

        register_setting( 'content_overlay_settings', 'content_overlay_settings' );
    }

    public function display_options() {

        include_once CONTOVER_PATH . '/inc/views/page.php';
    }

    public function display_options_section() {
        $options = get_option( 'content_overlay_settings' );
        include_once CONTOVER_PATH . '/inc/views/settings.php';
    }

    public function display_content_field( $args ) {
        $options = get_option( 'content_overlay_settings' );
        include_once CONTOVER_PATH . '/inc/views/settings.php';
    }

}

new Content_Overlay();