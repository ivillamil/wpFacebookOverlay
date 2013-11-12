<?php
/*
Plugin Name: Facebook LikeBox Overlay
Plugin URI: http://qualium.mx
Description: Shows an overlay layer with the facebook likebox
Version: 1.0
Author: Ivan Villamil
Author URI: qualium.mx
Author Email: qualium.mx
License:

  Copyright 2011

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Facebook_Likebox_Overlay extends WP_Widget
{
    function __construct()
    {
        $this->init_plugin_constants();

        $widget_opts = array(
            'classname'     => PLUGIN_NAME,
            'description'   => __('Shows an overlay layer with the facebook likebox', PLUGIN_LOCALE)
        );

        $this->WP_Widget(PLUGIN_SLUG, __(PLUGIN_NAME,PLUGIN_LOCALE), $widget_opts);
        load_plugin_textdomain(PLUGIN_LOCALE, false, dirname(plugin_basename(__FILE__)) . '/lang/');

        $this->register_scripts_and_styles();
    }

    /**
     * Outputs the content of the widget.
     *
     * @args            The array of form elements
     * @instance
     */
    function widget($args, $instance)
    {
        extract($args, EXTR_SKIP);
        echo $before_widget;

        $title = empty($instance['title']) ? '' : apply_filters('title', $instance['title']);
        $code  = empty($instance['code']) ? '' : $instance['code'];

        include(WP_PLUGIN_DIR . '/' . PLUGIN_SLUG . '/views/widget.php');

        echo $after_widget;

    }


    /**
     * Processes the widget's options to be saved.
     *
     * @new_instance    The previous instance of values before the update.
     * @old_instance    The new instance of values to be generated via the update.
     */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags(stripslashes($new_instance['title']) );
        $instance['code']  = $new_instance['code'];

        return $instance;
    }


    /**
     * Generates the administration form for the widget.
     *
     * @instance    The array of keys and values for the widget.
     */
    function form($instance)
    {
        $instance = wp_parse_args(
            (array)$instance,
            array(
                'title' => __('Facebook',PLUGIN_LOCALE),
                'code'  => ''
            )
        );

        $title  = strip_tags(stripslashes($instance['title']) );
        $code   = $instance['code'];

        include(WP_PLUGIN_DIR . '/' . PLUGIN_SLUG . '/views/admin.php');
    }


    /* ---------------------------------------------------------------------- *
     * PRIVATE FUNCTIONS
     * ---------------------------------------------------------------------- */

    /**
     * Initializes constants used for convenience throughout
     * the plugin.
     */
    private function init_plugin_constants()
    {

        if(!defined('PLUGIN_LOCALE')) {
            define('PLUGIN_LOCALE', 'facebook-likebox-overlay');
        }

        if(!defined('PLUGIN_NAME')) {
            define('PLUGIN_NAME', 'Facebook Likebox Overlay');
        }

        if(!defined('PLUGIN_SLUG')) {
            define('PLUGIN_SLUG', 'facebook-likebox-overlay');
        }

    }

    /**
     * Registers and enqueues stylesheets for the administration panel and the
     * public facing site.
     */
    private function register_scripts_and_styles()
    {
        if(is_admin()) {
            $this->load_script(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/js/admin.js', array('jquery'), null, true);  // handle, src, deps, version, in_footer
            $this->load_style(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/css/admin.css');      // handle, src, deps, version, media
        } else {
            $this->load_script(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/js/widget.js', array('jquery'), null, true);
            $this->load_style(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/css/widget.css');
        }
    }

    private function load_style($name, $file_path, $deps = null, $version = null, $media = null) {
        $params = array();
        if ( isset($deps) ) $params['dependencies'] = $deps;
        if ( isset($version) ) $params['version'] = $version;
        if ( isset($media) ) $params['media'] = $media;

        $this->wp_load_file($name, $file_path, false, $params);
    }

    private function load_script($name, $file_path, $deps = null, $version = null, $in_footer = false) {
        $params = array();
        if ( isset($deps) ) $params['dependencies'] = $deps;
        if ( isset($version) ) $params['version'] = $version;
        if ( isset($in_footer) ) $params['in_footer'] = $in_footer;

        $this->wp_load_file($name, $file_path, true, $params);
    }

    /**
     * Helper function for registering and enqueueing scripts and styles.
     *
     * @name    The     ID to register with WordPress
     * @file_path       The path to the actual file
     * @is_script       Optional argument for if the incoming file_path is a JavaScript source file.
     */
    private function wp_load_file($name, $file_path, $is_script = false, $params = array())
    {
        extract( $params, EXTR_SKIP );

        $url    = WP_PLUGIN_URL . $file_path;
        $file   = WP_PLUGIN_DIR . $file_path;

        if(file_exists($file)) {
            if($is_script) {
                wp_register_script($name, $url, $dependencies, $version, $in_footer);
                wp_enqueue_script($name);
            } else {
                wp_register_style($name, $url, $dependencies, $version, $media);
                wp_enqueue_style($name);
            }
        }
    }
}
add_action('widgets_init', create_function('','register_widget("Facebook_Likebox_Overlay");'));