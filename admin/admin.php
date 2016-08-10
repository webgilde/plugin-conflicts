<?php

class Plugin_Conflicts_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 * @var      object
	 */
	private static $instance = null;

	/**
	 * Slug of the settings page
	 *
	 * @since    1.0.0
	 * @var      string
	 */
	public $plugin_screen_hook_suffix = null;

	/**
	 *
	 * @var Plugin_Conflicts
	 */
	protected $plugin;

	public function __construct() {
		$this->plugin = Plugin_Conflicts::get_instance();

		// settings page
		add_action( 'admin_init', array( $this, 'settings_init' ) );

		// add menu items
		add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 * @return    Plugin_Conflicts_Admin    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * register admin pages
	 *
	 * @since    1.0.0
	 */
	public function add_menu_page() {

		$this->plugin_screen_hook_suffix = add_management_page( __( 'Debug Plugin conflicts', 'plugin-conflicts' ), __( 'Plugin Conflicts', 'plugin-conflicts' ), 'manage_options', PC_SLUG, array(
			$this,
			'render_menu_page'
		) );

	}

	/**
	 * render plugin page
	 *
	 * @since 1.0.0
	 */
	public function render_menu_page() {
		include PC_BASE_PATH . 'admin/views/page.php';
	}


	/**
	 * initialize settings
	 *
	 * @since 1.0.0
	 */
	public function settings_init() {

		// get settings page hook
		$hook = $this->plugin_screen_hook_suffix;

		// register settings
		register_setting( PC_SLUG, PC_SLUG, array( $this, 'sanitize_settings' ) );

		// general settings section
		add_settings_section(
			'plugin_conflicts_setting_section',
			__( 'Reset Plugins', 'plugin-conflicts' ),
			array( $this, 'render_settings_section_callback' ),
			$hook
		);

		// choose plugins
		add_settings_section(
			'plugins',
			__( 'Choose Plugins', 'plugin-conflicts' ),
			array( $this, 'render_settings_plugins' ),
			$hook
		);

	}

	/**
	 * sanitize settings
	 * basically remove them when reset button was clicked
	 *
	 * @since 1.0.0
	 *
	 * @param arr $settings unsanitized settings
	 *
	 * @return arr $settings sanitized settings
	 */
	public function sanitize_settings( $settings ) {

		if ( isset( $settings['reset'] ) && isset( $settings['plugins'] ) ) {
			unset( $settings['plugins'] );
			unset( $settings['reset'] );
		}

		return $settings;
	}

	/**
	 * render settings section
	 *
	 * @since 1.0.0
	 */
	public function render_settings_section_callback() {
		// for whatever purpose there might come
		echo '<p class="description">';
		_e( 'Click here to reset your reset your plugins to the default settings', 'plugins-conflicts' );
		echo '</p>';
		echo '<input type="submit" class="button" name="plugin-conflicts[reset]" value="' . __( 'Reset Plugins', 'plugin-conflicts' ) . '"/>';
	}

	/**
	 * render setting to select plugins
	 *
	 * @since 1.0.0
	 */
	public function render_settings_plugins() {

		$options = $this->plugin->options();
		$plugins = isset( $options['plugins'] ) ? $options['plugins'] : array();

		$all_plugins = get_plugins();

		// load the template
		include PC_BASE_PATH . 'admin/views/settings-plugins.php';
	}

}
