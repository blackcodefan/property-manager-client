<?php
namespace PROPERTY_MANAGER_CLIENT;

class ClientApi
{
    public function verify_credential($url, $username, $password){

        $res = wp_remote_post($url.'/wp-json/pma/v1/verify-credential',
            array(
                "headers"=> array(
                    'Content-Type' => 'application/json; charset=utf-8',
                    'Authorization' => 'Basic '.base64_encode("{$username}:{$password}")
                ),
                'method'    => 'POST',
                'timeout' => 75
            ));

        return $res;
    }

    public function fetch_videos($url, $username, $password){
        $url = $url."/wp-json/pma/v1/fetch-videos";
//        $local_url = "http://localhost/wordpress/wp-json/pma/v1/fetch-videos";
        $res = wp_remote_post($url,
            array(
                "headers"=> array(
                    'Content-Type' => 'application/json; charset=utf-8',
                    'Authorization' => 'Basic '.base64_encode("{$username}:{$password}")
                ),
                'method'    => 'POST',
                'timeout' => 75
            ));
        return $res;
    }
}