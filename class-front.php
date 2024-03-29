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
        wp_enqueue_style( 'select2-css', plugin_dir_url( __FILE__ ) . 'css/select2.css', array(), $this->version, 'all' );

    }

    public function enqueue_scripts() {

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/property-manager-front.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script('select2-js', plugin_dir_url( __FILE__ ) . 'js/select2.js', array( 'jquery' ), $this->version, false );

    }

    public function add_short_code(){
        add_shortcode( 'pmc-listing', array($this, 'list_tour_videos'));
    }

    public function list_tour_videos($attrs){
        $u = get_option('pmc_u');
        $p = get_option('pmc_p');
        $url = get_option('pmc_url');
        if(empty($url))
            $url = 'https://whicksvideo.wpengine.com';

        if (isset($_GET['building_id'])){
            $building = $_GET['building_id'];
        }else {
            $building = null;
        }

        $response = $this->api->fetch_videos($url, $u, $p);
        if (gettype($response) == 'array'){

            $videos = json_decode($response['body'])->videos;
            $grouped_videos = $this->group_by('building_id', $videos, $building);
            $buildings = $grouped_videos[0];
            $building_labels = $grouped_videos[1];

            if (isset($attrs['template']) && $attrs['template'] == 'accordion'){
                $template = 'views/front-accordion.php';
            }else {
                $template = 'views/front-tile.php';
            }

            ob_start();
            include($template);
            $content = ob_get_contents();
            ob_end_clean();

            return $content;

        }else{
            return '<h2>Your credential is invalid.</h2>';
        }

    }

    private function group_by($key, $data, $selected_building = null) {
        $buildings = [];
        $building_labels = [];

        foreach($data as $val) {
            if(isset($key, $val)){
                if (empty($selected_building)){
                    $buildings[$val->$key][] = $val;
                }else if ($val->$key == $selected_building){
                    $buildings[$val->$key][] = $val;
                }
                $building_labels[$val->$key] = $val->building_name;
            }else{
                $buildings[""][] = $val;
            }
        }

        $sort_results = [];


        foreach ($buildings as $key=>$building){
            $unique = [];
            $line = [];
            foreach ($building as $video){
                if ($video->apartrange == "1") {
                    array_push($line, $video);
                }else {
                    array_push($unique, $video);
                }
            }
            if ($building[0]->listing_order)
                $sort_results[$key] = array_merge($line, $unique);
            else
                $sort_results[$key] = array_merge($unique, $line);
        }

        $first_key = array_key_first($sort_results);

        return [[$sort_results[$first_key]], $building_labels];
    }
}