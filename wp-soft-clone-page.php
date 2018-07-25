<?php
/**
 * 
 * Plugin Name: WP Soft Clone Page
 * Plugin URI: https://github.com/tjsteinhaus/wp-soft-clone-page
 * Description: Soft cloning gives you the ability to clone your pages title, content, page meta, and page template into a new page.
 * Author: Tyler Steinhaus
 * Version: 1.0
 * Author URI: https://tylersteinhaus.com
*/

namespace WPClonePage;

define( 'WPClonePage_DIR', plugin_dir_path( __FILE__ ) . 'src/' );

require __DIR__ . '/vendor/autoload.php';

add_action( 'init', function() {
	// Start the engines
    $WPClonePage = new \WPClonePage\Setup;
    $WPClonePage->init();
}, 0 );