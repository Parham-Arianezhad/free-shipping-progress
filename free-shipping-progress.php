<?php
/**
 * Plugin Name: Free Shipping Progress
 * Plugin URI: https://github.com/Parham-Arianezhad/free-shipping-progress.git
 * Description: Show remaining amount to reach free shipping.
 * Version: 1.0.0
 * Author: Parham Arianezhad
 * Author URI: https://www.linkedin.com/in/parham-arianezhad/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: free-shipping-progress
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

// Plugin constants
define('FSP_PATH', plugin_dir_path(__FILE__));
define('FSP_URL', plugin_dir_url(__FILE__));
define('FSP_VERSION', '1.0.0');

require_once FSP_PATH . 'includes/class-plugin.php';


require_once FSP_PATH . 'public/class-display.php';
new FSP_Display();