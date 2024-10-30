<?php

/*
Plugin Name: Cloned Content
Description: Easily broadcast content on your website to multiple pages using shortcodes. Allows you to edit content in one location instead of having to edit in multiple.
Author: WP Codeus
Version: 1.0.0
Author URI: https://wpcodeus.com/
*/

// If this file is called directly, abort

if ( ! defined( 'ABSPATH' ) ) {
     die ('Silly human what are you doing here');
}

// The core plugin file that is used to define internationalization, hooks and functions

require( plugin_dir_path( __FILE__ ) . '/include/plugin-functions.php');


// Plugin file that manages admin views and functionality

require( plugin_dir_path( __FILE__ ) . '/admin/admin-functions.php');


// Plugin file that manages stylsheets

require( plugin_dir_path( __FILE__ ) . '/styling/styling-functions.php');
