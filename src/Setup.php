<?php

namespace WPClonePage;

class Setup {
    /**
     * Plugin ID
     */
    const PLUGIN_ID = 'WP_Clone_Page';

    /**
     * Plugin Name
     */
    const PLUGIN_NAME = 'WP Clone Page';

    /**
     * Initialization of the plugin
     */
    public function init() {
        // Only fire in the admin panel
        if( is_admin() ) {
            \WPClonePage\Admin\CreateMetaBox::init();
            \WPClonePage\Admin\SaveData::init();
        } else { // Public side 
            \WPClonePage\Frontend\SoftClone::init();
        }
    }
}