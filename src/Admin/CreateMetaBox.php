<?php

namespace WPClonePage\Admin;

class CreateMetaBox {

    /**
     * Where should the box be displayed?
     */
    const POSITION = 'side';

    /**
     * What order should the box be displayed in
     */
    const PRIORITY = 'low';

    /**
     * Initialization of the meta box setup
     */
    public static function init() {
        add_action( 'add_meta_boxes', array( __CLASS__, 'createMetaBox' ) );
    }

    /**
     * Register the meta box
     * 
     * @since 07/24/2018
     * @author Tyler Steinhaus
     */
    public static function createMetaBox() {
        add_meta_box( 
            \WPClonePage\Setup::PLUGIN_ID, // Metabox ID
            \WPClonePage\Setup::PLUGIN_NAME, // Metabox Name
            array( __CLASS__, 'createView' ), // Metabox Callback
            'page', // Metabox Post Types
            self::POSITION, // Metabox Position
            self::PRIORITY // Metabox Priority
        );
    }

    /**
     * Create the admin view for the metabox
     * 
     * @since 07/24/2018
     * @author Tyler Steinhaus
     */
    public static function createView( \WP_Post $post ) {
        // Which field is checked
        $cloneType = (array) get_post_meta( $post->ID, 'wp_clone_page__clone', true );

        require( WPClonePage_DIR . 'templates/admin/meta-box.php' );
    }
}