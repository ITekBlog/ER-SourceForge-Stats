<?php

/*
  Plugin Name: ER SourceForge Stats
  Plugin URI: http://itekblog.com/wordpress-plugins/er-sourceforge-stats
  Description: ER SourceForge Stats allows you to insert SourceForge download statistics into your page using a simple shortcode.
  Version: 1.0.0
  Author: ER (ET & RaveMaker)
  Author URI: http://itekblog.com
  License: GPL3
  Copyright 2013 ER
 */

/**
 * Main class for the plugin.
 *
 * @since 1.0.0
 *
 * @author ER (ET & RaveMaker)
 */
class ER_SourceForge_Stats {

    public function __construct() {

        // Include json parser
        include 'ersfParser.php';

        // define consts.
        define('SOURCEFORGE_STATS_PLUGIN_SLUG', 'er-source-forge-stats');
        define('SOURCEFORGE_STATS_PLUGIN_NAME', 'ER SourceForge Stats');
        define('SOURCEFORGE_STATS_PLUGIN_SHORTCODE_NAME', 'sf');

        // Create settings page.
        add_action('admin_menu', array($this, 'create_admin_menu'));
        
        if (!is_admin()) { // Only if no admin page.
            // Add shortcode.
            add_shortcode(SOURCEFORGE_STATS_PLUGIN_SHORTCODE_NAME, array($this, 'register_shortcode'));
        }
    }

    public function register_shortcode($atts) {
        extract(shortcode_atts(array(
                    'project' => 'erpxe',
                    'start_date' => '1999-01-01',
                    'end_date' => date('Y-m-d'),
                    'file' => '',
                        ), $atts));
        $JSON_URL = "";
        if ($file=='') {
            $JSON_URL = "http://sourceforge.net/projects/{$project}/files/stats/json?start_date={$start_date}&end_date={$end_date}";
        } else {
            $JSON_URL = "http://sourceforge.net/projects/{$project}/files/{$file}/stats/json?start_date={$start_date}&end_date={$end_date}";
        }
        
        $parser = new SimpleXmlParser();
        return $parser->getData($JSON_URL);
    }

    public function assets() {
        
    }

    public function admin_assets() {

        // name of settings page
        $settings = 'settings_page_' . SOURCEFORGE_STATS_PLUGIN_SLUG;
        // Bail out early if we are not on a page add/edit screen.
        // First part (before &&) is checks if it is a page. second part to check if this is the settings page.
        if ((!( 'post' == get_current_screen()->base && 'page' == get_current_screen()->id ) ) && (!( $settings == get_current_screen()->base && $settings == get_current_screen()->id ) ))
            return;
    }
    
    public function create_admin_menu() {
        $page_title = SOURCEFORGE_STATS_PLUGIN_NAME;
        $menu_title = $page_title;
        $capability = 'manage_options';
        $menu_slug = SOURCEFORGE_STATS_PLUGIN_SLUG;
        $function = array($this, 'create_setting_page');
        add_options_page($page_title, $menu_title, $capability, $menu_slug, $function);
    }

    public function create_setting_page() {
        include("howto.php");
    }


}

// Instantiate the class.
$ersourceforgestats = new ER_SourceForge_Stats();