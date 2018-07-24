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
        \WPClonePage\Admin\CreateMetaBox::init();
    }
}