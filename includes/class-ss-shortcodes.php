<?php
defined('ABSPATH') or die();


class SS_Shortcodes
{
    public static function init()
    {
        add_shortcode('staff', 'SS_Shortcodes::staff_display');
    }

    /**
     * Outputs the list of published staff members using
     * either a template part file specified in the 'template-part'
     * attribute passed into the shortcode or the default template-parts file
     * included in the plugin
     *
     * @param $atts array
     * @return string
     */
    public static function staff_display($atts)
    {
        $staff = new WP_Query(array('post_type' => 'ss_staff_member', 'post_status' => 'publish'));
        if (!empty($atts['template-part']) && file_exists(get_template_directory_uri() . $atts['template-part']))
        {
            ob_start();
            get_template_part($atts['template-part']);
            return ob_get_clean();
        }

        ob_start();
        include RN_SS_ABSPATH . 'template-parts/staff.php';
        return ob_get_clean();
    }
}
