<?php
namespace PROPERTY_MANAGER_CLIENT;

class ClientApi
{
    public function verify_credential($username, $password){

        $res = wp_remote_post('http://localhost/coupon/wp-json/pma/v1/verify-credential',
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

    public function fetch_videos($username, $password){
        $res = wp_remote_post('http://localhost/coupon/wp-json/pma/v1/fetch-videos',
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