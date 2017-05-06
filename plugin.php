<?php

/**
 * common functions
 *
 * - textdomain
 *
 * @since 1.0.0
 */
class Plugin_Conflicts {

	/**
	 *
	 * @var Plugin_Conflicts
	 */
	protected static $instance;

	/**
	 * plugin options
	 *
	 * @since   1.0.0
	 * @var     array (if loaded)
	 */
	protected $options;

	private function __construct() {
                $this->load_plugin_textdomain();
		add_action( 'plugins_loaded', array( $this, 'wp_plugins_loaded' ) );
	}

	/**
	 *
	 * @return Plugin_Conflicts
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function wp_plugins_loaded() {

	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'plugin-conflicts', false, PC_BASE_DIR . '/languages' );
	}

	/**
	 * return plugin options
	 *
	 * @since 1.0.0
	 * @return array $options
	 * @todo parse default options
	 */
	public function options() {
		if ( ! isset( $this->options ) ) {
			$this->options = get_option( PC_SLUG, array() );
		}

		return $this->options;
	}
        
        /**
         * on activation
         * 
         * @since 1.0.0
         */
        public function activation(){
                
                /* // rather check if could be created and add a warning in admin if not
                 * if ( !file_exists( WPMU_PLUGIN_DIR ) ) {
			@mkdir( WPMU_PLUGIN_DIR );
		}*/

		if ( file_exists( WPMU_PLUGIN_DIR . "/plugin-conflicts-mu.php" ) ) {
			unlink(WPMU_PLUGIN_DIR . "/plugin-conflicts-mu.php");
		}
		
		if ( file_exists( PC_BASE_PATH . "/mu/plugin-conflicts-mu.php" ) ) {
			copy( PC_BASE_PATH . "/mu/plugin-conflicts-mu.php", WPMU_PLUGIN_DIR . "/plugin-conflicts-mu.php");
		}
        }
        
        /**
         * on deactivation
         * 
         * @since 1.0.0
         */
        public function deactivation(){
        }

}
