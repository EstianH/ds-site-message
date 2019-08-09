<?php
if ( !defined( 'ABSPATH' ) ) exit;

delete_option( 'dssm_settings' );
delete_option( 'dssm_version' );

/**
 * Legacy options.
 * Used by v1.1215 and earlier.
 */
delete_option( 'dssm-settings' );
delete_option( 'dssm-version' );
delete_option( 'dssm-content' );
delete_option( 'dssm-design' );
delete_option( 'dssm-sections' );
