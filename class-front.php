<?php
namespace PROPERTY_MANAGER_CLIENT;

class Front
{

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

    public function enqueue_styles() {

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/property-manager-front.css', array(), $this->version, 'all' );

    }

    public function enqueue_scripts() {

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/property-manager-front.js', array( 'jquery' ), $this->version, false );

    }

    public function add_short_code(){
        add_shortcode( 'pmc-listing', array($this, 'list_tour_videos'));
    }

    public function list_tour_videos(){
        $u = get_option('pmc_u');
        $p = get_option('pmc_p');
        $response = $this->api->fetch_videos($u, $p);
        if (gettype($response) == 'array'){

            $videos = json_decode($response['body'])->videos;
            $buildings = $this->group_by('building_id', $videos);

            ob_start();
            include('views/front.php');
            $content = ob_get_contents();
            ob_end_clean();

            return $content;

        }else{
            return '<h2>Your credential is invalid.</h2>';
        }


    }

    private function group_by($key, $data) {
        $result = array();

        foreach($data as $val) {
            if(array_key_exists($key, $val)){
                $result[$val->$key][] = $val;
            }else{
                $result[""][] = $val;
            }
        }

        return $result;
    }
}