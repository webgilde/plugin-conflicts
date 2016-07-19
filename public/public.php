<?php

class Plugin_Conflicts_Public {
    
    	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 * @var      object
	 */
	private static $instance = null;
        
        /**
	 *
	 * @var Plugin_Conflicts
	 */
	protected $plugin;
        
        public function __construct(){
                $this->plugin = Plugin_Conflicts::get_instance();
        }

        
        /**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 * @return    Plugin_Conflicts_Public    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
    
}