<?php
if( !defined( 'ABSPATH' ) ) exit;


/*
██████  ███████     ███████ ██ ████████ ███████     ███    ███ ███████ ███████ ███████  █████   ██████  ███████      █████  ██████  ███    ███ ██ ███    ██
██   ██ ██          ██      ██    ██    ██          ████  ████ ██      ██      ██      ██   ██ ██       ██          ██   ██ ██   ██ ████  ████ ██ ████   ██
██   ██ ███████     ███████ ██    ██    █████       ██ ████ ██ █████   ███████ ███████ ███████ ██   ███ █████       ███████ ██   ██ ██ ████ ██ ██ ██ ██  ██
██   ██      ██          ██ ██    ██    ██          ██  ██  ██ ██           ██      ██ ██   ██ ██    ██ ██          ██   ██ ██   ██ ██  ██  ██ ██ ██  ██ ██
██████  ███████     ███████ ██    ██    ███████     ██      ██ ███████ ███████ ███████ ██   ██  ██████  ███████     ██   ██ ██████  ██      ██ ██ ██   ████
*/
class DS_SITE_MESSAGE_ADMIN {
	/**
	 * Class instance.
	 *
	 * @access private
	 * @static
	 * @var DS_SITE_MESSAGE_ADMIN
	 */
	private static $instance;

	/**
	 * Returns the instance of the class.
	 *
	 * @access public
	 * @static
	 * @return DS_SITE_MESSAGE_ADMIN $instance
	 */
	public static function get_instance() {
		if ( NULL === self::$instance )
			self::$instance = new DS_SITE_MESSAGE_ADMIN();

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @access private
	 */
	private function __construct() {
		// Version check settings.
		$this->update_settings_maybe();

		// Register the admin settings page.
		add_action( 'admin_menu', array( $this, 'render_admin_menu' ) );

		// Enqueue admin assets.
		add_action( 'admin_enqueue_scripts', function( $hook ) {
			if( 'tools_page_' . DSSM_SLUG !== $hook ) // Enqueue only on the appropriate page.
				return;

			// WP Assets.
			wp_enqueue_media(); // WP Media
			wp_enqueue_style  ( 'wp-color-picker' ); // WP Color Picker
			wp_enqueue_script (
				'wp-color-picker-alpha',
				DSSM_ADMIN . 'assets/vendors/wp-color-picker-alpha/wp-color-picker-alpha.min.js',
				array( 'wp-color-picker' ),
				DSSM_VERSION
			); // Overriden/Extended WP Color Picker
			wp_enqueue_script( 'jquery-form' ); // WP jQuery for forms.

			// Plugin Assets.
			wp_enqueue_script ( 'dssm-script', DSSM_ADMIN . 'assets/js/script.js',  array( 'jquery-core', 'wp-color-picker-alpha' ), DSSM_VERSION );
			wp_enqueue_style  ( 'dssm-style',  DSSM_ADMIN . 'assets/css/style.css', array(), DSSM_VERSION );

			// Enqueue vendor assets.
			wp_enqueue_script ( 'dsc-script', DSSM_ADMIN . 'assets/vendors/ds-core/js/script.js',  array( 'jquery-core' ), DSSM_VERSION );
			wp_enqueue_style  (  'dsc-style', DSSM_ADMIN . 'assets/vendors/ds-core/css/style.css', array(), DSSM_VERSION );
		} );

		// Filters
		add_filter( 'plugin_action_links_' . DSSM_BASENAME, array( $this, 'register_plugin_action_links' ), 10, 1 ); // Add plugin list settings link.

		// Register plugin settings.
		register_setting( 'dssm_settings', 'dssm_settings' );

		// Register notifications.
		add_action( 'admin_notices', array( $this, 'add_notices' ) );

		// On settings save.
		add_action( 'update_option_dssm_settings', array( $this, 'updated_dssm_settings' ), 10, 2 );
	}

	/**
	 * Add plugin admin menu items.
	 *
	 * @access public
	 * @uses $GLOBALS
	 */
	public function render_admin_menu() {
		// Return early if the slug already exists.
		if ( !empty( $GLOBALS['admin_page_hooks'][DSSM_SLUG] ) )
			return;

		add_management_page(
			DSSM_TITLE,                                 // $page_title
			DSSM_TITLE,                                 // $menu_title
			'edit_plugins',                             // $capability
			DSSM_SLUG,                                  // $menu_slug
			function() {                                // $function
				load_template( DSSM_ROOT . 'admin/templates/settings.php' );
			}                                         // $position
		);
	}

	/**
	 * Handle plugin activation.
	 *
	 * @access public
	 */
	public function activate() {
		$dssm = DS_SITE_MESSAGE::get_instance();
		require_once DSSM_ROOT . 'admin/default-settings.php';

		update_option( 'dssm_version', DSSM_VERSION );

		$db_settings = get_option( 'dssm_settings' );

		if ( empty( $db_settings ) ) {
			update_option( 'dssm_settings', $default_settings );
			$db_settings = $default_settings;
		}

		// Refresh cached settings.
		$dssm->settings = $db_settings;
	}

	/**
	 * Handle plugin deactivation.
	 *
	 * @access public
	 */
	public function deactivate() {

	}

	/**
	 * Update database settings if versions differ.
	 *
	 * @access public
	 */
	public function update_settings_maybe() {
		if ( version_compare( get_option( 'dssm_version' ), DSSM_VERSION, '<' ) )
			$this->activate();
	}

	/**
	 * Add plugin action links to the plugin page.
	 *
	 * @access public
	 * @param array  $links Plugin links.
	 * @return array $links Updated plugin links.
	 */
	public function register_plugin_action_links( $links ) {
		$settings_link = '<a href="' . esc_url( admin_url( '/tools.php' ) ) . '?page=' . DSSM_SLUG . '">' . __( 'Settings', DSSM_SLUG ) . '</a>';
		array_push( $links, $settings_link );

		return $links;
	}

	/**
	 * Display admin notifications.
	 *
	 * @access public
	 */
	public function add_notices() {
		if ( 'toplevel_page_' . DSSM_SLUG === get_current_screen()->id )
			if ( !empty( $_GET['settings-updated'] ) )
				echo '<div class="notice notice-success is-dismissible ds-mt-2 ds-mr-0 ds-mb-2 ds-ml-0">
					<p>' . __( 'Settings saved.', DSSM_SLUG ) . '</p>
				</div>';
	}

	/**
	 * On settings save.
	 *
	 * @access public
	 */
	function updated_dssm_settings( $old_value, $value ) {
		if (
			!empty( $old_value ) && !empty( $value )
			&& $old_value !== $value
		) {
			// Clear 3rd party caches.
			$this->clear_cache_maybe();
		}
	}

	/**
	 * Clear 3rd party caches.
	 *
	 * @access public
	 */
	function clear_cache_maybe() {
		// Clear Litespeed cache.
		method_exists( 'LiteSpeed_Cache_API', 'purge_all' ) && LiteSpeed_Cache_API::purge_all();

		// Clear W3 Total Cache.
		if ( function_exists( 'w3tc_pgcache_flush' ) )
			w3tc_pgcache_flush();

		// Clear WP Super Cache.
		if ( function_exists( 'wp_cache_clear_cache' ) )
			wp_cache_clear_cache();

		// Clear WP Fastest Cache.
		if (
			          !empty( $GLOBALS['wp_fastest_cache'] )
			&& method_exists( $GLOBALS['wp_fastest_cache'], 'deleteCache' )
		)
			$GLOBALS['wp_fastest_cache']->deleteCache( true );

		// Clear Site ground.
		if (
			    class_exists( 'SG_CachePress_Supercacher' )
			&& method_exists( 'SG_CachePress_Supercacher', 'purge_cache' )
		)
			SG_CachePress_Supercacher::purge_cache(true);

		// Clear Endurance Cache.
		if ( class_exists( 'Endurance_Page_Cache' ) ) {
			$endurance = new Endurance_Page_Cache;
			$endurance->purge_all();
		}
	}
}


/*
 █████   ██████ ████████ ██ ██    ██  █████  ████████ ███████     ██ ██████  ███████  █████   ██████ ████████ ██ ██    ██  █████  ████████ ███████
██   ██ ██         ██    ██ ██    ██ ██   ██    ██    ██         ██  ██   ██ ██      ██   ██ ██         ██    ██ ██    ██ ██   ██    ██    ██
███████ ██         ██    ██ ██    ██ ███████    ██    █████     ██   ██   ██ █████   ███████ ██         ██    ██ ██    ██ ███████    ██    █████
██   ██ ██         ██    ██  ██  ██  ██   ██    ██    ██       ██    ██   ██ ██      ██   ██ ██         ██    ██  ██  ██  ██   ██    ██    ██
██   ██  ██████    ██    ██   ████   ██   ██    ██    ███████ ██     ██████  ███████ ██   ██  ██████    ██    ██   ████   ██   ██    ██    ███████
*/
/**
 * Register plugin activation hook.
 */
register_activation_hook( __FILE__, array( 'DS_SITE_MESSAGE_ADMIN', 'activate' ) );

/**
 * Register plugin deactivation hook.
 */
register_deactivation_hook( __FILE__, array( 'DS_SITE_MESSAGE_ADMIN', 'deactivate' ) );
