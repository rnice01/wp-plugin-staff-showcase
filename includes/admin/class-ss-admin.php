<?php
defined('ABSPATH') or die();

class SS_Admin
{
    public static function init()
    {
        self::includes();
        add_action('admin_menu', 'SS_Admin_Meta_Boxes::init');
    }

    public static function includes()
    {
       include_once dirname(__FILE__) . '/class-ss-admin-meta-boxes.php';
    }
}

