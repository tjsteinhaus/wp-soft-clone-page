<?php

namespace WPClonePage\Admin;

class SaveData {

    /**
     * WP Nonce Action
     */
    const NONCE_ACTION = 'WP_Clone_Page_Save';

    /**
     * WP Nonce Name
     */
    const NONCE_NAME = 'WP_Clone_Page';

    /**
     * Initialization to save the meta box data
     */
    public static function init() {
        add_action( 'save_post', array( __CLASS__, 'saveData' ) );
    }

    /**
     * Save the data to the meta box and perform the clone.
     * 
     * @since 07/24/2018
     * @author Tyler Steinhaus
     */
    public function saveData( int $post_id ) {
        // Check to see if multiple items should flag so the data isn't saved
        if( 
            !wp_verify_nonce( $_POST[self::NONCE_NAME], self::NONCE_ACTION )
        ) {
            return;
        }

        $pageToclone = ( isset( $_POST['wp_clone_page__page'] ) && $_POST['wp_clone_page__page'] != '' ) ? $_POST['wp_clone_page__page'] : '';
        $whatToClone = ( isset( $_POST['wp_clone_page__clone'] ) && $_POST['wp_clone_page__clone'] != '' ) ? $_POST['wp_clone_page__clone'] : '';

        update_post_meta( $post_id, 'wp_clone_page__page', $pageToclone );
        update_post_meta( $post_id, 'wp_clone_page__clone', $whatToClone );
    }
}