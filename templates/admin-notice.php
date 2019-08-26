<?php if( !defined( 'ABSPATH' ) ) exit; ?>
<style type="text/css">
	#dssm-admin-notice-container {
		box-sizing: border-box;
		font-family: inherit;
		font-size: 15px;
		position: fixed;
		bottom: 0;
		z-index: 999999;
		max-width: 400px;
		padding: 15px 20px;
		background: #fff;
		-webkit-box-shadow: 0px 0px 20px -2px rgba( 0, 0, 0, 0.15 );
		-moz-box-shadow: 0px 0px 20px -2px rgba(0, 0, 0, 0.15 );
		box-shadow: 0px 0px 20px -2px rgba(0, 0, 0, 0.15 );
		border-radius: 5px;
		text-align: center;
	}

	#dssm-admin-notice-container > * {
		box-sizing: inherit;
		font-family: inherit;
	}

	#dssm-admin-notice-container > .close {
		position: absolute;
		top: 0;
		right: 0;
		padding: 4.5px 8.7px;
		cursor: pointer;
	}

	#dssm-admin-notice-container > h2 {
		font-size: 22px;
		margin: 0 0 10px;
	}

	#dssm-admin-notice-container > a {
		display: block;
		padding: 10px;
		max-width: 150px;
		margin: 15px auto 0;
		background: #515151;
		color: #fff;
		text-transform: uppercase;
		border-radius: 2px;
		font-weight: bold;
		font-size: 12px;
		letter-spacing: 1px;
	}

	@media ( min-width: 768px ) {
		#dssm-admin-notice-container {
			transform: translatex( -50% );
			left: 50%;
			margin-bottom: 15px;
		}
	}
</style>
<div id="dssm-admin-notice-container">
		<h2><?php echo _e( 'MAINTENANCE MODE', DSSM_SLUG ); ?></h2>
		<span class="close" onclick="jQuery( this ).parent( '#dssm-admin-notice-container' ).fadeOut( function() { jQuery( this ).remove(); } );">&times;</span>
		<span><?php _e( 'Your website is currently in maintenance mode.', DSSM_SLUG ); ?></span>
		<a href="<?php echo get_home_url(); ?>?dssm-preview=true" target="_blank"><?php _e( 'Preview', DSSM_SLUG ); ?></a>
</div>
