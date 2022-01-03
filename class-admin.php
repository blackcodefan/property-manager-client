<?php

namespace PROPERTY_MANAGER_CLIENT;

include 'class-clientapi.php';


class Admin {

	private $plugin_name;


	private $version;
	

	private $plugin_text_domain;


	private $api;

	public function __construct( $plugin_name, $version, $plugin_text_domain ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->plugin_text_domain = $plugin_text_domain;
		$this->api = new ClientApi();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/property-manager-client.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
		$params = array ( 'ajaxurl' => admin_url( 'admin-ajax.php' ) );
		wp_enqueue_script( 'pmc_ajax_handle', plugin_dir_url( __FILE__ ) . 'js/property-manager-client.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( 'pmc_ajax_handle', 'params', $params );

	}
	
	/**
	 * Callback for the admin menu
	 * 
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

        add_options_page(__( 'Property Manager Client', $this->plugin_text_domain ),
            __( 'Property Manager Client', $this->plugin_text_domain ),
            'install_plugins',
            $this->plugin_name,
            array($this, 'setting_page_content')
        );

	}

	public function register_settings(){
        register_setting('pmc', 'pmc_u');
        register_setting('pmc', 'pmc_p');
    }

	public function setting_page_content() {
	    $username = get_option('pmc_u');
	    $password = get_option('pmc_p');
	    $url = get_option('pmc_url');
		include_once( 'views/setting.php' );
	}

	public function save_setting(){

        if( isset( $_POST['setting_save_nonce'] ) && wp_verify_nonce( $_POST['setting_save_nonce'], 'setting_save_nonce') ){

            $u = sanitize_text_field($_POST['pmc_u']);
            $p = sanitize_text_field($_POST['pmc_p']);
            $raw_url = sanitize_text_field($_POST['pmc_url']);

            if (filter_var($raw_url, FILTER_VALIDATE_URL)){
                $url_particles = parse_url($raw_url);
                $url = $url_particles['scheme'].'://'.$url_particles['host'];
                $response = $this->api->verify_credential($url, $u, $p);

                if (gettype($response) == 'object'){
                    $admin_notice = 'error';
                    $message = 'Credential or URL is not correct';
                }else{
                    if ($response['response']['code'] == 200){
                        update_option('pmc_u', $u);
                        update_option('pmc_p', $p);
                        update_option('pmc_url', $url);
                        $admin_notice = 'success';
                        $message = 'Credential has been saved successfully.';
                    }
                    else {
                        $admin_notice = 'error';
                        $message = 'Credential or URL is not correct';
                    }
                }
            }else{
                $admin_notice = 'error';
                $message = 'Url is not valid.  Valid format: https://example.com';
            }
            $this->custom_redirect($admin_notice, $message, $this->plugin_text_domain);
            exit;
        }else{
            wp_die( __( 'Invalid nonce specified', $this->plugin_name ), __( 'Error', $this->plugin_name ), array(
                'response' 	=> 403,
                'back_link' => 'admin.php?page=' . $this->plugin_name,

            ) );
        }
    }

	/**
	 * Redirect
	 * 
	 * @since    1.0.0
	 */
	public function custom_redirect( $admin_notice, $response, $redirect_url ) {
		wp_redirect( esc_url_raw( add_query_arg( array(
									'pmc_notice' => $admin_notice,
									'pmc_response' => $response,
									),
							admin_url('admin.php?page='. $redirect_url )
					) ) );

	}


	/**
	 * Print Admin Notices
	 * 
	 * @since    1.0.0
	 */
	public function print_client_plugin_admin_notices() {
		  if ( isset( $_REQUEST['pmc_notice'] ) ) {
				$html =	"<div class='notice notice-".$_REQUEST['pmc_notice']." is-dismissible'><p><strong>{$_REQUEST['pmc_response']}</strong></p></div>";
				echo $html;
		  }
		  else {
			  return;
		  }

	}


}