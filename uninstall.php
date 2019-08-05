<?php
if ( !defined( 'ABSPATH' ) ) exit;

delete_option( 'dssm-settings' );
delete_option( 'dssm-version' );

// Legacy options
delete_option( 'dssm-content' );
delete_option( 'dssm-design' );
delete_option( 'dssm-sections' );
