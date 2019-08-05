<?php if ( !defined( 'ABSPATH' ) ) exit; ?>

<?php $dssm_settings = get_option( 'dssm-settings' ); ?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php //DS Site message prevents WP from loading beyond action 'init'. Manual Stylesheet linking required. ?>
		<link rel="icon" type="image/png" href="<?php echo ( isset( $dssm_settings['content']['favicon'] ) && $dssm_settings['content']['favicon'] ? $dssm_settings['content']['favicon'] : DSSM_ASSETS . 'images/icon-xs.png' ); ?>" />
		<link type="text/css" href="<?php echo DSSM_ASSETS . 'css/style.css?v=' . DSSM_VERSION; ?>" rel="stylesheet" />
		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<style type="text/css">
			body {
				<?php echo ( isset( $dssm_settings['design']['background']['color'] ) && $dssm_settings['design']['background']['color'] ? 'background-color: ' . $dssm_settings['design']['background']['color'] . ';' : '' ); ?>
				<?php echo ( isset( $dssm_settings['design']['background']['image'] ) && $dssm_settings['design']['background']['image'] ? 'background-image: url(' . $dssm_settings['design']['background']['image']['url'] . ');' : '' ); ?>
			}

			a,
			body {
				<?php echo ( isset( $dssm_settings['design']['font']['color'] ) && $dssm_settings['design']['font']['color'] ? 'color: ' . $dssm_settings['design']['font']['color'] . ';' : '' ); ?>
			}

			#main-container {
				<?php echo ( isset( $dssm_settings['design']['font']['panel'] ) ? 'background-color: ' . ( isset( $dssm_settings['design']['font']['panelcolor'] ) && $dssm_settings['design']['font']['panelcolor'] ? $dssm_settings['design']['font']['panelcolor'] : '#00000080') . ';' : ''); ?>
			}

			@media ( min-width: 992px ) {
				#main-container {
					<?php echo ( isset( $dssm_settings['design']['font']['pos'] ) ? $dssm_settings['design']['font']['pos'] . ';' : '' ); ?>
				}
			}

			<?php echo ( isset( $dssm_settings['design']['css']['custom'] ) ? $dssm_settings['design']['css']['custom'] : ''); ?>
		</style>
	</head>
	<body>
		<?php if( isset( $dssm_settings['content']['insert'] ) ) {
			foreach( $dssm_settings['content']['insert'] as $insert ) {
				echo $insert;
			}
		} ?>
		<div id="main-container">
			<div id="message" class="<?php echo ( isset( $dssm_settings['design']['font']['align'] ) ? $dssm_settings['design']['font']['align'] : '' ); ?>">
				<div id="message-heading">
					<?php if( isset( $dssm_settings['content']['logo'] ) && $dssm_settings['content']['logo'] ) { ?><div id="logo"><img src="<?php echo $dssm_settings['content']['logo']; ?>" /></div><?php } ?>
					<?php if( isset( $dssm_settings['content']['heading'] ) && $dssm_settings['content']['heading'] ) { ?><h1><?php echo $dssm_settings['content']['heading']; ?></h1><?php } ?>
				</div>
				<?php if( isset( $dssm_settings['content']['body'] ) ) { ?><div id="message-text"><p id="message-text" class="mb-0"><?php echo wpautop( $dssm_settings['content']['body'] ); ?></p></div><?php } ?>
				<div id="message-socials">
					<?php if( isset( $dssm_settings['content']['social'] ) ) { ?>
						<?php foreach( $dssm_settings['content']['social'] as $social => $data ) { ?>
							<?php if( isset($data['url'] ) && $data['url'] ) { ?><a class="social-icon<?php echo ' ' . $social; ?> textcenter" href="<?php echo $data['url']; ?>" target="_blank"><i class="<?php echo $data['icon']; ?>"></i></a><?php } ?>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</body>
</html>
