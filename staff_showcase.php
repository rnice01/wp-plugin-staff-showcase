<?php
defined('ABSPATH') or die();

/**
 * Plugin Name: Staff Showcase
 * Plugin URI: localhost
 * Description: Plugin for adding an admin page to add staff members to show off on a page using shortcode.
 * Version: 1.0.0
 * Author: Rob Nice
 * Author URI: localhost
 *
 * @package StaffShowcase
 */

 if (!defined('RN_SS_PLUGIN_FILE')) {
     define('RN_SS_PLUGIN_FILE', __FILE__);
 }

 if (!class_exists('StaffShowcase')) {
     include_once dirname(__FILE__) . '/includes/class-staff-showcase.php';
 }


 function RN_SS () {
     return StaffShowcase::instance();
 }

 $GLOBALS['staff_showcase'] = RN_SS();
