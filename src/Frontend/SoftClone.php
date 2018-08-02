<?php

namespace WPClonePage\Frontend;

class SoftClone {

    /**
     * Initialization of the public side of the website
     */
    public static function init() {
        add_filter( 'the_content', array( __CLASS__, 'the_content' ), 1 );
        add_filter( 'the_title', array( __CLASS__, 'the_title' ), 1 );
        add_filter( 'document_title_parts', array( __CLASS__, 'wp_title' ), 1 );
        add_action( 'wp_head', array( __CLASS__, 'addCanonical' ), 1 );
        add_filter( 'get_post_metadata', array( __CLASS__, 'changePostIdInMeta' ), 100, 4 );
        add_action( 'template_redirect', array( __CLASS__, 'changePostTemplate' ), 1 );
   }


    /**
     * Chnage the post id when using post meta
     * 
     * @since 07/24/2018
     * @author Tyler Steinhaus
     */
    public static function changePostIdInMeta( $metadata, $object_id, $meta_key, $single ) {
        
        $exclude_meta_keys = array(
            '_wp_page_template',
            'wp_clone_page__page',
            'wp_clone_page__clone'
        );

        if( !in_array( $meta_key, $exclude_meta_keys )  ) {
            // if( in_the_loop() ) {
            //     echo $meta_key.'<br />';
            // }
            remove_filter( 'get_post_metadata', array( __CLASS__, 'changePostIdInMeta' ), 100 );
            $getSoftClone = self::checkSoftClone( $object_id );
            $current_meta = null;
            if( self::whatShouldWeClone( 'meta' ) && $getSoftClone  ){
                $current_meta = get_post_meta( $getSoftClone->ID, $meta_key, $single );
            }
            add_filter( 'get_post_metadata', array( __CLASS__, 'changePostIdInMeta'), 100, 4 );

            return $current_meta;
        }

        return $metadata;
    }

    /**
     * Change Post Template is choosen
     * 
     * @since 07/24/2018
     * @author Tyler Steinhaus
     */
    public static function changePostTemplate( $query ) {
        $getSoftClone = self::checkSoftClone();

        if( is_main_query() && $getSoftClone && self::whatShouldWeClone( 'template' ) ) {
            if( $getSoftClone->_wp_page_template != 'default' ) {
                load_template( locate_template( $getSoftClone->_wp_page_template ) );
            }
        }
    }

    /**
     * Set the title in-between the <head> tag
     * 
     * @param $title array
     * 
     * @since 07/24/2018
     * @author Tyler Steinhaus
     */
    public static function wp_title( $title ) {
        
        $getSoftClone = self::checkSoftClone();

        if( $getSoftClone && self::whatShouldWeClone( 'title' ) ) {
            $title['title'] = $getSoftClone->post_title;
        }

        return $title;
    }

    /**
     * Add canonical tag that links back to the orignal page.
     * 
     * @since 07/24/3018
     * @author Tyler Steinhaus
     */
    public static function addCanonical() {

        $getSoftClone = self::checkSoftClone();

        if( $getSoftClone && self::whatShouldWeClone( 'content' ) ) {
            echo '<link rel="canonical" href="'.get_permalink( $getSoftClone->ID ).'" />';
        }
    }

    /**
     * Update the conttitleent with the soft clone content
     * 
     * @since 07/24/2018
     * @author Tyler Steinhaus
     */
    public static function the_title( $title ) {
        global $wp_query; 

        $getSoftClone = self::checkSoftClone();

        if( $getSoftClone && self::whatShouldWeClone( 'title' ) && in_the_loop() ) {
            return $getSoftClone->post_title;
        }

        return $title;
    }

    /**
     * Update the content with the soft clone content
     * 
     * @since 07/24/2018
     * @author Tyler Steinhaus
     */
    public static function the_content( $content ) {
        $getSoftClone = self::checkSoftClone();

        if( $getSoftClone && self::whatShouldWeClone( 'content' ) ) {
            return $getSoftClone->post_content;
        }

        return $content;
    }

    /**
     * What should we clone?
     * 
     * @since 07/24/2018
     * @author Tyler Steinhaus
     */
    public static function whatShouldWeClone( $clone ) {
        $getCloneItems = (array) get_post_meta( get_the_ID(), 'wp_clone_page__clone', true );

        if( in_array( $clone, $getCloneItems ) ) {
            return true;
        }

        return false;
    }

    /**
     * Check to see if current page is set to soft clone
     * 
     * @since 07/24/2018
     * @author Tyler Steinhaus
     */
    public static function checkSoftClone( int $post_id = null ) {
        if( is_null( $post_id ) ) {
            global $post;

            $post_id = $post->ID;
        }

        $softClone = get_post_meta( $post_id, 'wp_clone_page__page', true );

        if( !empty( $softClone ) ) {
            return get_post( $softClone );
        }

        return false;
    }

}