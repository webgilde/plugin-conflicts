<?php
/**
 * Plugin Conflicts
 *
 * Plugin Name:       Plugin Conflicts
 * Plugin URI:        http://webgilde.com
 * Description:       Find conflicts between plugins.
 * Version:           1.0.0
 * Author:            Thomas Maier
 * Author URI:        https://webgilde.com
 * Text Domain:       plugin-conflicts
 * Domain Path:       /languages
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}

// load basic path and url to the plugin
define( 'PC_BASE_PATH', plugin_dir_path( __FILE__ ) );
define( 'PC_BASE_URL', plugin_dir_url( __FILE__) );
define( 'PC_BASE_DIR', dirname( plugin_basename( __FILE__ ) ) );
define( 'PC_VERSION', '1.0.0' );
define( 'PC_SLUG', 'plugin-conflicts' );

require_once PC_BASE_PATH . 'plugin.php';

register_activation_hook( __FILE__ , array( Plugin_Conflicts::get_instance(), 'activation') );
register_deactivation_hook( __FILE__,  array( Plugin_Conflicts::get_instance(), 'deactivation') );            

if ( !is_admin() && ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) ) {
    require_once PC_BASE_PATH . 'public/public.php';
    new Plugin_Conflicts_Public;
} else {
    require_once PC_BASE_PATH . 'admin/admin.php';
    new Plugin_Conflicts_Admin;
}