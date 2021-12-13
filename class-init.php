<?php

namespace PROPERTY_MANAGER_CLIENT;
use PROPERTY_MANAGER_CLIENT as PMC;

include 'class-loader.php';
include 'class-admin.php';
include 'class-front.php';


class Init {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @var      Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_base_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_basename;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * The text domain of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $plugin_text_domain;


    // define the core functionality of the plugin.
    public function __construct() {

        $this->plugin_name = PMC\PLUGIN_NAME;
        $this->version = PMC\PLUGIN_VERSION;
        $this->plugin_basename = PMC\PLUGIN_BASENAME;
        $this->plugin_text_domain = PMC\PLUGIN_TEXT_DOMAIN;

        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_client_hooks();
    }

    /**
     * Loads the following required dependencies for this plugin.
     *
     * - Loader - Orchestrates the hooks of the plugin.
     *
     * @access    private
     */
    private function load_dependencies() {
        $this->loader = new Loader();

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * Callbacks are documented in inc/admin/class-admin.php
     *
     * @access    private
     */
    private function define_admin_hooks() {
        $plugin_admin = new Admin( $this->get_plugin_name(), $this->get_version(), $this->get_plugin_text_domain() );

        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );

        $this->loader->add_action('admin_init', $plugin_admin, 'register_settings');

        $this->loader->add_action( 'admin_post_save_setting_hook', $plugin_admin, 'save_setting');

        $this->loader->add_action( 'admin_notices', $plugin_admin, 'print_client_plugin_admin_notices');
    }

    private function define_client_hooks(){
        $plugin_client = new Front( $this->get_plugin_name(), $this->get_version(), $this->get_plugin_text_domain() );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_client, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_client, 'enqueue_scripts' );
        $plugin_client->add_short_code();
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @return    Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

    /**
     * Retrieve the text domain of the plugin.
     *
     * @since     1.0.0
     * @return    string    The text domain of the plugin.
     */
    public function get_plugin_text_domain() {
        return $this->plugin_text_domain;
    }

}