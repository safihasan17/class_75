<?php
/**
 * Plugin Name: HR Management Lite (Custom Table Edition)
 * Description: Employee, Department, Designation, Notice, and Holiday management using custom List/Add/Edit admin pages.
 * Version: 1.0.0
 * Author: Your Name
 * Text Domain: hrml
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'HRML_PATH', plugin_dir_path( __FILE__ ) );
define( 'HRML_URL', plugin_dir_url( __FILE__ ) );

require_once HRML_PATH . 'inc/db-tables.php';
require_once HRML_PATH . 'inc/module-config.php';
require_once HRML_PATH . 'inc/crud-engine.php';
require_once HRML_PATH . 'inc/admin-menu.php';
require_once HRML_PATH . 'inc/shortcodes.php';

register_activation_hook( __FILE__, 'hrml_create_tables' );
