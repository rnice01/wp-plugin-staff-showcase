<?php

defined('ABSPATH') or die();

class SS_Post_Types
{
    public static function init()
    {
        self::register_post_types();
        add_filter('post_updated_messages', 'SS_Post_Types::add_staff_updated_messages', 10, 1);
    }

    public static function add_staff_updated_messages($msg)
    {
        $msg['ss_staff_member'] = array(
            0 => '',
            1 => 'Staff member updated',
            4 => 'Staff member updated',
            6 => 'Staff member will now be visible on the site',
            7 => 'Staff member saved.',
            8 => 'Staff member submitted.',
            10 => 'Staff member saved but not visible on the site until published.'
        );
        return $msg;
    }

    public static function register_post_types()
    {
        register_post_type('ss_staff_member',
            array(
                'labels' => array(
                    'name'              => 'Staff Showcase',
                    'add_new'           => 'Add New Member',
                    'singular_name'     => 'Staff',
                    'all_items'         => 'All Staff Members',
                    'menu_name'         => 'Our Staff',
                ),
                'description' => 'This is where you can add new staff members for your team showcase page.',
                'public'                => true,
                'show_in_menu'          => true,
                'show_ui'               => true,
                'menu_icon'            => plugins_url('assets/staff.ico', RN_SS_PLUGIN_FILE),
                'capability_type'       => 'post',
                'publicly_queryable'    => true,
                'exclude_from_search'   => true,
                'hierarchical'          => false,
                'rewrite'               => array('slug', 'ss-staff-member'),
                'supports'              => array('thumbnail', 'publicize'),
                'has_archive'           => true
            )
        );
    }
}

