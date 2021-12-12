<?php
namespace PROPERTY_MANAGER_CLIENT;

class SettingController
{
    private $db;
    private $current_user;

    public function __construct()
    {
        global $wpdb;

        $this->db = $wpdb;
        $this->current_user = wp_get_current_user();
    }

    public function get(){

    }
}