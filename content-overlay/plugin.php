<?php
/*
Plugin Name: Content Overlay
Plugin URI: http://qualium.mx
Description: Shows an overlay with the html content
Version: 1.0
Author: Ivan Villamil
Author URI: http://qualium.mx
License: GPLv2
*/

define('CONTOVER_PATH', plugin_dir_path(__FILE__));
define('CONTOVER_SLUG', 'content-overlay');
define('CONTOVER_URI', get_bloginfo('url') . '/wp-content/plugins/' . CONTOVER_SLUG);

require( CONTOVER_PATH . 'inc/ContentOverlay.php' );