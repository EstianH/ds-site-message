<?php
/*
Plugin Name:  DS Site Message
Plugin URI:   https://www.divspot.co.za/plugin-ds-site-message/
Description:  Add site messages to your wordpress site.
Version:      1.13
Author:       EstianH
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
define('DSSM_ASSETS'  , DSSM_URL . 'assets/' ); // FTP Path
define('DSSM_TITLE'   , 'DS Site Message' );
define('DSSM_SLUG'    , 'ds-site-message' ); // Plugin slug.
define('DSSM_VERSION' , '1.13' );


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
		if ( is_admin() ) {
			require_once DSSM_ROOT . 'admin/inc/class-admin.php';
			$dssm_admin = DS_SITE_MESSAGE_ADMIN::get_instance();
		}
	}
}

add_action( 'plugins_loaded', array( 'DS_SITE_MESSAGE', 'get_instance' ) );
