<?php
/**
 * DS Site Message Default Settings
 *
 * This file defines the default settings for the DS Site Message plugin.
 * These settings are used when the plugin is first activated or reset.
 *
 * @package DS_Site_Message
 * @since 1.0.0
 */

$default_settings = [
	'content' => [
		'heading' => get_bloginfo(),
		'body'    => 'We are currently undergoing maintenance.<br />Please check back in 10 minutes.',
	],
	'design'  => [
		'font'       => [
			'color'      => '#fff',
			'panel'      => true,
			'panelcolor' => 'rgba( 0, 0, 0, 0.7 )',
			'align'      => 'center',
			'pos'        => 'right',
		],
		'background' => [
			'enabled'      => 1,
			'image_active' => 'coffee',
			'images'       => [
				'default' => [
					[
						'name' => 'lights',
						'url'  => DSSM_ASSETS . 'images/lights.jpg',
					],
					[
						'name' => 'bricks',
						'url'  => DSSM_ASSETS . 'images/bricks.jpg',
					],
					[
						'name' => 'pencils',
						'url'  => DSSM_ASSETS . 'images/pencils.jpg',
					],
					[
						'name' => 'coffee',
						'url'  => DSSM_ASSETS . 'images/coffee.jpg',
					],
					[
						'name' => 'clock',
						'url'  => DSSM_ASSETS . 'images/clock.jpg',
					],
				],
			],
		],
	],
];
