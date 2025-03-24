<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dssm = DS_SITE_MESSAGE::get_instance();

if ( ! empty( $dssm->settings['content']['headers'] ) ) {
	$protocol = 'HTTP/1.0';

	if ( 'HTTP/1.1' === $_SERVER['SERVER_PROTOCOL'] ) {
		$protocol = 'HTTP/1.1';
	}

	header( $protocol . ' 503 Service Temporarily Unavailable' );
	header( 'Status: 503 Service Temporarily Unavailable' );
	header( 'Retry-After: ' . ( ! empty( $dssm->settings['content']['retryafter'] ) ? absint( $dssm->settings['content']['retryafter'] ) : '600' ) );
}
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php
	/**
	 * Head section of the maintenance page.
	 */
	?>
	<head>
		<title><?php echo esc_html($dssm->settings['content']['heading']); ?></title>
		<link
			rel="shortcut icon"
			type="image/x-icon"
			href="<?php echo esc_url( ! empty( $dssm->settings['content']['favicon'] ) ? $dssm->settings['content']['favicon'] : DSSM_ASSETS . 'images/icon-xs.png' ); ?>" />
		<link
			type="text/css"
			href="<?php echo esc_url( DSSM_ASSETS . 'css/style.css?v=' . DSSM_VERSION ); ?>"
			rel="stylesheet" />
		<script defer src="<?php echo esc_url( 'https://use.fontawesome.com/releases/v5.10.2/js/all.js' ); ?>"></script>
		<link
			href="<?php echo esc_url( 'https://fonts.googleapis.com/css?family=' . ( ! empty( $dssm->settings['design']['font']['family'] ) ? $dssm->settings['design']['font']['family'] : 'Montserrat' ) ); ?>"
			rel="stylesheet" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<style type="text/css">
			* {
				<?php echo 'font-family: ' . esc_attr( ! empty( $dssm->settings['design']['font']['family'] ) ? $dssm->settings['design']['font']['family'] : 'Montserrat' ) . ';'; ?>
			}

			h1 {
				<?php
				if ( ! empty( $dssm->settings['design']['font']['headingfontsize'] ) ) {
					echo 'font-size: ' . esc_attr($dssm->settings['design']['font']['headingfontsize']) . ';';
				}

				if ( ! empty( $dssm->settings['design']['font']['headinglineheight'] ) ) {
					echo 'line-height: ' . esc_attr($dssm->settings['design']['font']['headinglineheight']) . ';';
				}
				?>
			}

			p {
				<?php
				if ( ! empty( $dssm->settings['design']['font']['messagefontsize'] ) ) {
					echo 'font-size: ' . esc_attr($dssm->settings['design']['font']['messagefontsize']) . ';';
				}

				if ( ! empty( $dssm->settings['design']['font']['messagelineheight'] ) ) {
					echo 'line-height: ' . esc_attr($dssm->settings['design']['font']['messagelineheight']) . ';';
				}
				?>
			}

			body {
				<?php
				if ( ! empty( $dssm->settings['design']['background']['color'] ) ) {
					echo 'background-color: ' . esc_attr($dssm->settings['design']['background']['color']) . ';';
				}

				if (
						! empty( $dssm->settings['design']['background']['enabled'] )
					&& ! empty( $dssm->settings['design']['background']['image_active'] )
					&& ! empty( $dssm->settings['design']['background']['images'] )
				) {
					foreach ( $dssm->settings['design']['background']['images'] as $type => $images ) {
						foreach ( $images as $key => $image ) {
							if ( $image['name'] === $dssm->settings['design']['background']['image_active'] ) {
								echo 'background-image: url("' . esc_url($dssm->settings['design']['background']['images'][ $type ][ $key ]['url']) . '");
									    background-position: center center;
											background-size: cover;
											background-repeat: no-repeat;';
							}
						}
					}
				}
				?>
			}

			a,
			body {
				<?php
				if ( ! empty( $dssm->settings['design']['font']['color'] ) ) {
					echo 'color: ' . $dssm->settings['design']['font']['color'] . ';';
				}
				?>
			}

			#main-container {
				<?php
				if ( ! empty( $dssm->settings['design']['font']['panel'] ) ) {
					echo 'background-color: ' . (
							! empty( $dssm->settings['design']['font']['panelcolor'] )
							? $dssm->settings['design']['font']['panelcolor']
							: 'rgba( 0, 0, 0, 0.7 )'
						) . ';';
				}

				if ( ! empty( $dssm->settings['design']['font']['align'] ) ) {
					if ( 'center' === $dssm->settings['design']['font']['align'] ) {
						echo 'text-align: center;';
					} elseif ( 'right' === $dssm->settings['design']['font']['align'] ) {
						echo 'text-align: right;';
					}
				}

				if ( ! empty( $dssm->settings['design']['font']['pos'] ) ) {
					if ( 'full-width' === $dssm->settings['design']['font']['pos'] ) {
						echo 'max-width: unset;';
					} elseif ( 'right' === $dssm->settings['design']['font']['pos'] ) {
						echo 'margin-left: auto;';
					}
				}
				?>
			}

			@media( min-width: 992px ) {

			}

			<?php
			if ( ! empty( $dssm->settings['design']['custom']['css'] ) ) {
				echo $dssm->settings['design']['custom']['css'];
			}
			?>
		</style>
	</head>
	<?php
	/**
	 * Body section of the maintenance page.
	 */
	?>
	<body>
		<?php
		if ( ! empty( $dssm->settings['content']['insert'] ) ) {
			foreach ( $dssm->settings['content']['insert'] as $insert ) {
				echo wp_kses_post( $insert );
			}
		}
		?>
		<div id="main-container">
			<div id="message" class="<?php echo esc_attr( ! empty( $dssm->settings['design']['font']['align'] ) ? $dssm->settings['design']['font']['align'] : '' ); ?>">
				<div id="message-heading">
					<?php
					if ( ! empty( $dssm->settings['content']['logo'] ) ) {
						echo '<div id="logo">
								<img src="' . esc_url( $dssm->settings['content']['logo'] ) . '" alt="' . esc_attr__( 'Site Logo', DSSM_SLUG ) . '" />
							</div>';
					}

					if ( ! empty( $dssm->settings['content']['heading'] ) ) {
						echo '<h1>' . esc_html( $dssm->settings['content']['heading'] ) . '</h1>';
					}
					?>
				</div>
				<?php
				if ( ! empty( $dssm->settings['content']['body'] ) ) {
					echo '<div id="message-text">' .
							wp_kses_post( wpautop( $dssm->settings['content']['body'] ) ) .
						'</div>';
				}
				?>
				<div id="message-socials">
					<?php
					if ( ! empty( $dssm->settings['content']['social'] ) ) {
						foreach ( $dssm->settings['content']['social'] as $social => $data ) {
							if ( ! empty( $data['url'] ) && $data['url'] ) {
								if ( 'email' === $social ) {
									$data['url'] = 'mailto:' . sanitize_email( $data['url'] );
								}

								echo '<a class="social-icon ' . esc_attr( $social ) . ' textcenter" href="' . esc_url( $data['url'] ) . '" target="_blank" rel="noopener noreferrer">
										<i class="' . esc_attr( $data['icon'] ) . '"></i>
									</a>';
							}
						}
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>
