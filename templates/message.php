<?php
if ( !defined( 'ABSPATH' ) ) exit;

$dssm = DS_SITE_MESSAGE::get_instance();
echo '<pre>'; print_r($dssm->settings); echo '</pre>';
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php
	/*
	██   ██ ███████  █████  ██████
	██   ██ ██      ██   ██ ██   ██
	███████ █████   ███████ ██   ██
	██   ██ ██      ██   ██ ██   ██
	██   ██ ███████ ██   ██ ██████
	*/
	?>
	<head>
		<link
			rel="icon"
      type="image/png"
      href="<?php echo ( !empty( $dssm->settings['content']['favicon'] ) ? $dssm->settings['content']['favicon'] : DSSM_ASSETS . 'images/icon-xs.png' ); ?>" />
		<link
      type="text/css"
      href="<?php echo DSSM_ASSETS . 'css/style.css?v=' . DSSM_VERSION; ?>"
      rel="stylesheet" />
		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
		<link
      href="https://fonts.googleapis.com/css?family=Ubuntu"
      rel="stylesheet">
		<meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<style type="text/css">
			body {
				<?php
				if ( !empty( $dssm->settings['design']['background']['color'] ) )
					echo 'background-color: ' . $dssm->settings['design']['background']['color'] . ';';

				if (
					   !empty( $dssm->settings['design']['background']['image_active'] )
					&& !empty( $dssm->settings['design']['background']['images'] )
				)
					foreach ( $dssm->settings['design']['background']['images'] as $type => $images )
						foreach ( $images as $key => $image )
							if ( $image['name'] === $dssm->settings['design']['background']['image_active'] )
								echo 'background-image: url(" ' . $dssm->settings['design']['background']['images'][$type][$key]['url'] . ' ");';
				?>
			}

			a,
			body {
				<?php
				if ( !empty( $dssm->settings['design']['font']['color'] ) )
					echo 'color: ' . $dssm->settings['design']['font']['color'] . ';';
				?>
			}

			#main-container {
				<?php
				if ( !empty( $dssm->settings['design']['font']['panel'] ) )
					echo 'background-color: ' . (
							!empty( $dssm->settings['design']['font']['panelcolor'] )
							? $dssm->settings['design']['font']['panelcolor']
							: 'rgba( 0, 0, 0, 0.7 )'
						) . ';';
				?>
			}

			@media( min-width: 992px ) {
				#main-container {
					<?php
					if ( !empty( $dssm->settings['design']['font']['pos'] ) )
						echo $dssm->settings['design']['font']['pos'] . ';';
					?>
				}
			}

			<?php
			if ( !empty( $dssm->settings['design']['css']['custom'] ) )
				echo $dssm->settings['design']['css']['custom'];
			?>
		</style>
	</head>
	<?php
	/*
	██████   ██████  ██████  ██    ██
	██   ██ ██    ██ ██   ██  ██  ██
	██████  ██    ██ ██   ██   ████
	██   ██ ██    ██ ██   ██    ██
	██████   ██████  ██████     ██
	*/
	?>
	<body>
		<?php
		if ( !empty( $dssm->settings['content']['insert'] ) )
			foreach ( $dssm->settings['content']['insert'] as $insert )
				echo $insert;
		?>
		<div id="main-container">
			<div id="message" class="<?php echo ( !empty( $dssm->settings['design']['font']['align'] ) ? $dssm->settings['design']['font']['align'] : '' ); ?>">
				<div id="message-heading">
					<?php
					if ( !empty( $dssm->settings['content']['logo'] ) )
						echo '<div id="logo">
								<img src="' . $dssm->settings['content']['logo'] . '" />
							</div>';

					if ( !empty( $dssm->settings['content']['heading'] ) )
						echo '<h1>' . $dssm->settings['content']['heading'] . '</h1>';
					?>
				</div>
				<?php
				if ( !empty( $dssm->settings['content']['body'] ) )
					echo '<div id="message-text">' .
							wpautop( $dssm->settings['content']['body'] ) .
						'</div>';
				?>
				<div id="message-socials">
					<?php
					if ( !empty( $dssm->settings['content']['social'] ) )
						foreach ( $dssm->settings['content']['social'] as $social => $data)
							if ( !empty( $data['url'] ) && $data['url'] )
								echo '<a class="social-icon ' . $social . ' textcenter" href="' . $data['url'] . '" target="_blank">
										<i class="' . $data['icon'] . '"></i>
									</a>';
					?>
				</div>
			</div>
		</div>
	</body>
</html>
