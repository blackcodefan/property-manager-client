<?php

/**
 * Plugin Name: Property Manager Client
 * Description: Property tour video listing plugin
 * Author: MingRi Jin
 * Author URI: https://github.com/blackcodefan
 * Version: 1.0
 * Text Domain: property-manager-client
 */

namespace PROPERTY_MANAGER_CLIENT;

include 'class-init.php';

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Define Constants
 */

define( __NAMESPACE__ . '\PMC', __NAMESPACE__ . '\\' );

define( PMC . 'PLUGIN_NAME', 'property-manager-client' );

define( PMC . 'PLUGIN_VERSION', '1.0.0' );

define( PMC . 'PLUGIN_NAME_DIR', plugin_dir_path( __FILE__ ) );

define( PMC . 'PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );

define( PMC . 'PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

define( PMC . 'PLUGIN_TEXT_DOMAIN', 'property-manager-client' );

add_action('init', PMC.'property_manager_client_init');

function property_manager_client_init() {
    return PropertyManagerClient::init();
}

/**
 * Plugin Singleton Container
 *
 * Maintains a single copy of the plugin app object
 *
 * @since    1.0.0
 */
class PropertyManagerClient {

    static $init;
    /**
     * Loads the plugin
     *
     * @access    public
     */
    public static function init() {

        if ( null == self::$init ) {
            self::$init = new Init();
            self::$init->run();
        }

        return self::$init;
    }

}