<?php
/**
 * DS Site Message Uninstall
 *
 * This file runs when the plugin is uninstalled.
 * It cleans up any plugin data that should be removed.
 *
 * @package DS_Site_Message
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Clean up plugin options.
 *
 * @since 1.3
 */
delete_option( 'dssm_settings' );
delete_option( 'dssm_version' );
