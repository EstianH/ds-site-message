<?php
$default_settings = array(
	'content' => array(
		'heading' => get_bloginfo(),
		'body' => 'We are currently undergoing maintenance.<br />Please check back in 10 minutes.',
	),
	'design' => array(
		'font' => array(
			'color' => '#fff',
			'panel' => true,
			'align' => 'textcenter',
			'pos' => 'margin-left: auto'
		),
		'background' => array(
			'image' => array(
				'name' => 'coffee',
				'url' => DSSM_ASSETS . 'images/coffee.jpg',
			),
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
