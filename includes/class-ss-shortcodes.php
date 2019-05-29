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
     * attribute passed into the shortcode or the default HTML structure
     * specified in the method.
     *
     * @param $atts array
     * @return string
     */
    public static function staff_display($atts)
    {
        $staff_query = new WP_Query(array('post_type' => 'ss_staff_member', 'post_status' => 'publish'));

        if (!empty($atts['template-part']) && file_exists(get_template_directory_uri() . $atts['template-part']))
        {
            ob_start();
            get_template_part($atts['template-part']);
            return ob_get_clean();
        }

        $returnString = '';
        global $post;
        if ($staff_query->have_posts()) {
            while($staff_query->have_posts()) {
                $staff_query->the_post();
                    ?>
                        <div>
                            <img src="<?php get_the_post_thumbnail_url($post->ID) ?>" />
                        </div>
                    <?php
                $returnString .= '
                    <div>
                       <img src="' . get_the_post_thumbnail_url($post->ID) .'" />' .
                        '<strong>' . get_post_meta($post->ID, 'name', true) . '</strong>' .
                    '</div>';
            }
        }
        wp_reset_postdata();
        return $returnString;
    }
}
