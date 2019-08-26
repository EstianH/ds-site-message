<?php
$default_settings = array(
	'content' => array(
		'heading' => get_bloginfo(),
		'body'    => 'We are currently undergoing maintenance.<br />Please check back in 10 minutes.',
	),
	'design' => array(
		'font' => array(
			'family'     => 'Montserrat',
			'color'      => '#fff',
			'panel'      => true,
			'panelcolor' => 'rgba( 0, 0, 0, 0.7 )',
			'align'      => 'center',
			'pos'        => 'right'
		),
		'background' => array(
			'image_active' => 'coffee',
			'images' => array(
				'default' => array(
					array( 'name' => 'lights',  'url' => DSSM_ASSETS . 'images/lights.jpg' ),
					array( 'name' => 'bricks',  'url' => DSSM_ASSETS . 'images/bricks.jpg' ),
					array( 'name' => 'pencils', 'url' => DSSM_ASSETS . 'images/pencils.jpg' ),
					array( 'name' => 'coffee',  'url' => DSSM_ASSETS . 'images/coffee.jpg' ),
					array( 'name' => 'clock',   'url' => DSSM_ASSETS . 'images/clock.jpg' )
				)
			)
		)
	)
);
