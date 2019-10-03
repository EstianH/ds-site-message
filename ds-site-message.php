<?php
/*
Plugin Name:  DS Site Message
Plugin URI:   https://www.divspot.co.za/plugin-ds-site-message/
Description:  Add a maintenance or coming soon page to your wordpress site.
Version:      1.14
Author:       divSpot
Author URI:   https://www.divspot.co.za
License:      GPLv3 or later
License URI:  https://www.gnu.org/licenses/gpl-3.0.html
*/

if( !defined( 'ABSPATH' ) ) exit;


/*
██████  ███████ ███████ ██ ███    ██ ██ ████████ ██  ██████  ███    ██ ███████
██   ██ ██      ██      ██ ████   ██ ██    ██    ██ ██    ██ ████   ██ ██
██   ██ █████   █████   ██ ██ ██  ██ ██    ██    ██ ██    ██ ██ ██  ██ ███████
██   ██ ██      ██      ██ ██  ██ ██ ██    ██    ██ ██    ██ ██  ██ ██      ██
██████  ███████ ██      ██ ██   ████ ██    ██    ██  ██████  ██   ████ ███████
*/
if( !defined( 'DIVSPOT_URL' ) )
	define( 'DIVSPOT_URL', 'https://www.divspot.co.za' );

define('DSSM_BASENAME', plugin_basename( __FILE__ ) );
define('DSSM_URL'     , plugins_url( '', DSSM_BASENAME ) . '/' ); // User-Friendly URL
define('DSSM_ROOT'    , __DIR__ . '/' ); // FTP Path
define('DSSM_ADMIN'   , DSSM_URL . 'admin/' ); // FTP Path
define('DSSM_ASSETS'  , DSSM_URL . 'assets/' ); // FTP Path
define('DSSM_TITLE'   , 'DS Site Message' );
define('DSSM_SLUG'    , 'ds-site-message' ); // Plugin slug.
define('DSSM_VERSION' , '1.14' );


/*
██████  ███████     ███████ ██ ████████ ███████     ███    ███ ███████ ███████ ███████  █████   ██████  ███████
██   ██ ██          ██      ██    ██    ██          ████  ████ ██      ██      ██      ██   ██ ██       ██
██   ██ ███████     ███████ ██    ██    █████       ██ ████ ██ █████   ███████ ███████ ███████ ██   ███ █████
██   ██      ██          ██ ██    ██    ██          ██  ██  ██ ██           ██      ██ ██   ██ ██    ██ ██
██████  ███████     ███████ ██    ██    ███████     ██      ██ ███████ ███████ ███████ ██   ██  ██████  ███████
*/
class DS_SITE_MESSAGE {
	/**
	 * Class instance.
	 *
	 * @access private
	 * @static
	 * @var DS_SITE_MESSAGE
	 */
	private static $instance;

	/**
	 * Saved settings.
	 *
	 * @access public
	 */
	public $settings;

	/**
	 * Returns the instance of the class.
	 *
	 * @access public
	 * @static
	 * @return DS_SITE_MESSAGE $instance
	 */
	public static function get_instance() {
		if ( NULL === self::$instance )
			self::$instance = new DS_SITE_MESSAGE();

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @access private
	 */
	private function __construct() {
		$this->settings = get_option( 'dssm_settings' );

		// Only activate front-end with an enabled or preview status.
		if ( !is_admin() ) {
			if (
				   ( !empty( $_GET['dssm-preview'] ) && true === ( bool )$_GET['dssm-preview'] )
				|| ( !empty( $this->settings['content']['enabled'] ) && !current_user_can( 'edit_plugins' ) )
			)
				add_filter( 'template_include', array( $this, 'render_message_page' ), 99, 1 );
			else if ( !empty( $this->settings['content']['enabled'] ) ) // Render a front-end maintenance notice message for administrators.
				add_action( 'wp_footer', function() {
					load_template( DSSM_ROOT . 'templates/admin-notice.php' );
				} );
		}
	}

	/**
	 * Render the maintenance message template.
	 *
	 * @access public
	 * @param string $template The path of the template to be loaded.
	 */
	public function render_message_page( $template ) {
		if ( file_exists( DSSM_ROOT . 'templates/message.php' ) )
			return DSSM_ROOT . 'templates/message.php';

		return $template;
	}
}

add_action( 'plugins_loaded', array( 'DS_SITE_MESSAGE', 'get_instance' ) );


/*
 █████  ██████  ███    ███ ██ ███    ██
██   ██ ██   ██ ████  ████ ██ ████   ██
███████ ██   ██ ██ ████ ██ ██ ██ ██  ██
██   ██ ██   ██ ██  ██  ██ ██ ██  ██ ██
██   ██ ██████  ██      ██ ██ ██   ████
*/
if ( is_admin() ) {
	require_once DSSM_ROOT . 'admin/inc/class-admin.php';
	add_action( 'plugins_loaded', array( 'DS_SITE_MESSAGE_ADMIN', 'get_instance' ) );
}
