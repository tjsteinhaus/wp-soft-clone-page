<?php
/**
 * 
 * Plugin Name: WP Clone Page
 * Plugin URI: https://github.com/tjsteinhaus/wp-clone-page
 * Description: You now have the ability to create a new page and link it to an existing page and use all the pages content and post meta.
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