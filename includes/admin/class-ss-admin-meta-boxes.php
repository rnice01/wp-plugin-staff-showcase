<?php
defined('ABSPATH') or die();


class SS_Admin_Meta_Boxes
{
    public static function init()
    {
        add_meta_box(
            'staff_name_meta_box',
            'Name',
            'SS_Admin_Meta_Boxes::display_name_meta_box',
            'ss_staff_member',
            'normal',
            'high'
        );
        add_meta_box(
            'staff_title_meta_box',
            'Title',
            'SS_Admin_Meta_Boxes::display_title_meta_box',
            'ss_staff_member',
            'normal',
            'high'
        );

        add_meta_box(
            'staff_bio_meta_box',
            'Bio',
            'SS_Admin_Meta_Boxes::display_bio_meta_box',
            'ss_staff_member',
            'normal',
            'high'
        );

        add_action('save_post', 'SS_Admin_Meta_Boxes::save_staff_meta', 1, 2);
    }

    public static function display_bio_meta_box()
    {
        global $post;
        $bio = get_post_meta($post->ID, 'bio', true);
        echo '<textarea rows="5" cols="100%" name="staff_bio" class="widefat">' . esc_textarea($bio) . '</textarea>';
    }

    public static function display_title_meta_box()
    {
        global $post;
        $title = get_post_meta($post->ID, 'title', true);
        echo '<input type="text" name="staff_title" value="' . esc_textarea($title) . '" class="widefat" placeholder="Staff\'s Title" />';
    }

    public static function display_name_meta_box()
    {
        wp_nonce_field(basename(__FILE__), 'staff_fields');
        global $post;
        $name = get_post_meta($post->ID, 'name', true);
        echo '<input type="text" name="staff_name" value="' . esc_textarea($name) . '" class="widefat" placeholder="First and Last Name" />';
    }

    public static function save_staff_meta($postId, $post)
    {
        if ('revision' === $post->post_type) {
            return $postId;
        }

        if (!current_user_can('edit_post', $postId)) {
            return $postId;
        }

        if (!isset(
            $_POST['staff_name'],
            $_POST['staff_title'],
            $_POST['staff_bio']
            ) || !wp_verify_nonce($_POST['staff_fields'], basename(__FILE__)) ) {
           return $postId;
        }

        $staffMeta['name'] = esc_textarea($_POST['staff_name']);
        $staffMeta['title'] = esc_textarea($_POST['staff_title']);
        $staffMeta['bio'] = esc_textarea($_POST['staff_bio']);

        foreach ($staffMeta as $key => $value) {
            if (!$value) {
                delete_post_meta($postId, $key);
                continue;
            }

            if (get_post_meta($postId, $key, false)) {
                update_post_meta($postId, $key, $value);
            } else {
                add_post_meta($postId, $key, $value);
            }
        }
        return $postId;
    }
}