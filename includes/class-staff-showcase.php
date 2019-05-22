<?php
defined('ABSPATH') or die();

/**
 * Main Staff Showcase class
 *
 * @class StaffShowcase
 */
class StaffShowcase
{
    /**
     * @var string
     */
    public $version = '1.0.0';

    /**
     * Single instance
     *
     * @var StaffShowcase
     */
    protected static $_instance = null;

    /**
     * Query instance
     *
     * @var StaffShowcase query
     */
    public $query = null;

    /**
     * Return instances of StaffShowcase
     * ensuring only one instance is loaded.
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct()
    {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    private function define_constants()
    {
        define('RN_SS_ABSPATH', dirname(RN_SS_PLUGIN_FILE) . '/');
        define('RN_SS_PLUGIN_BASENAME', plugin_basename(RN_SS_PLUGIN_FILE));
        define('RN_SS_VERSION', $this->version);
    }

    private function init_hooks()
    {
        add_action('init', 'SS_Post_Types::init');
        add_action('init', 'SS_Admin::init');
    }

    public function includes()
    {
        require_once RN_SS_ABSPATH . 'includes/class-ss-post-types.php';
        require_once RN_SS_ABSPATH . 'includes/admin/class-ss-admin.php';
    }
}