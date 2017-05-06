<?php
/**
 * Plugin Conflicts MU
 *
 * Plugin Name:       Plugin Conflicts MU
 * Plugin URI:        http://webgilde.com
 * Description:       Find conflicts between plugins – needed mu version of Plugin Conflicts plugin
 * Version:           1.0.0
 * Author:            Thomas Maier
 * Author URI:        https://webgilde.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

/* 
 * this is a mu-plugin which means it is loaded before normal plugins and 
 * therefore can prevent normal plugins from being loaded
 */

class Plugin_Conflicts_MU{
    
        /**
         * change active plugins for the current page request
         * 
         * @since 1.0.0
         * @param arr $active_plugins list with active plugins
         * @return arr $active_plugins new active plugins list
         */
        public static function set_active_plugins_option( $active_plugins = '' ){

                // check if we are in the frontend
                if( is_admin() ){
                    return $active_plugins;
                }

                // get options
                $options = get_option( 'plugin-conflicts' );

                // check if enabled
                if( ! isset( $_COOKIE['plugin_conflicts_enabled'] ) ){
                        return $active_plugins;
                }

                // switch through plugin states
                if( isset( $options[ 'plugins'] ) && is_array( $options[ 'plugins'] ) ){
                    
                        foreach( $options[ 'plugins'] as $_plugin => $_state ){
                                switch( $_state ){
                                        case 'active' : // activate plugin
                                            if( ! in_array( $_plugin, $active_plugins ) ){
                                                    $active_plugins[] = $_plugin;
                                            }
                                            break;
                                        case 'inactive' : // deactivate plugin
                                            if( FALSE !== $_plugin_key = array_search( $_plugin, $active_plugins ) ){
                                                    unset( $active_plugins[ $_plugin_key ] );
                                            }
                                            break;
                                }
                        }
                }

                return $active_plugins;
        }
    
}

add_filter('option_active_plugins', array( 'Plugin_Conflicts_MU', 'set_active_plugins_option' ), 10, 1);