<?php
if( !defined( 'ABSPATH' ) ) exit;

class DSSM_ADMIN_SETTINGS_HANDLER {
	function startup() {
		add_action( 'admin_init', array( $this, 'settings_update' ) );
		add_action( 'admin_notices', array( $this, 'add_notices' ) );
	}

	// Update Settings to DB.
	function settings_update() {
		register_setting( 'dssm-settings', 'dssm-settings' );
	}

	// display custom admin notices.
	function add_notices() {
		$screen = get_current_screen();

		if( $screen->id === 'divspot_page_dssm-settings' ) {
			if( isset( $_GET['settings-updated'] ) ) { ?>
				<div class="notice notice-success is-dismissible mt-2 mr-0 mb-2 ml-0">
					<p><?php _e( 'Settings saved.', 'ds-site-message' ); ?></p>
				</div>
			<?php }
		}
	}
}
