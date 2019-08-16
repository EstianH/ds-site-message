<?php if( !defined( 'ABSPATH' ) ) exit;

$dssm = DS_SITE_MESSAGE::get_instance();

$tabs = array( 'content', 'design' );
$active_tab = ( !empty( $_GET['tab'] ) ? $_GET['tab'] : $tabs[0] );

$aligns = array(
	'left'   => 'textleft',
	'center' => 'textcenter',
	'right'  => 'textright'
);

$positions = array(
	'left'       => 'margin-right: auto',
	'full-width' => 'max-width: 100%',
	'right'      => 'margin-left: auto'
);

$editor = array(
	'content'         => ( !empty( $dssm->settings['content']['body'] ) ? $dssm->settings['content']['body'] : '' ),
	'editor_id'       => 'dssmsettingsbody',
	'arguments'       => array(
		'media_buttons' => false,
		'textarea_name' => 'dssm_settings[content][body]',
		'textarea_rows' => 8
	)
);
?>

<div class="ds-wrapper">
	<h1><?php echo DSSM_TITLE; ?></h1>
	<div class="wrap mt-0">
		<div class="ds-container ds-p-0 ds-mb-2">
			<div class="ds-row">
				<div class="ds-col">
					<h2 class="pt-0 pb-0 ds-d-none"></h2><!-- WP Notices render after the first <h2> tag in class="wrap" -->
					<div class="ds-tab-nav-wrapper ds-tab-nav-wrapper-animate">
						<?php
						foreach( $tabs as $tab )
							echo '<a href="#' . $tab . '" class="ds-tab-nav' . ( $active_tab === $tab ? ' active' : '' ) . '">' . ucfirst( $tab ) . '</a>';

						echo '<a href="' . home_url() . '?dssm-preview=true" class="ds-tab-nav ds-tab-nav-link ds-ml-1" target="_blank">' . __( 'Live Preview', DSSM_SLUG ) . '</a>';
						?>
					</div><!-- .ds-tab-nav-wrapper -->
				</div><!-- .ds-col -->
			</div><!-- .ds-row -->
		</div><!-- .ds-container -->
		<div class="ds-container ds-p-0">
			<div class="ds-row">
				<?php
				/*
				███    ███  █████  ██ ███    ██
				████  ████ ██   ██ ██ ████   ██
				██ ████ ██ ███████ ██ ██ ██  ██
				██  ██  ██ ██   ██ ██ ██  ██ ██
				██      ██ ██   ██ ██ ██   ████
				*/
				?>
				<div class="ds-col-12 ds-col-lg-9 ds-mb-2">
					<form method="post" action="options.php">
						<?php settings_fields( 'dssm_settings' ); ?>
						<?php
						/*
						████████  █████  ██████                 ██████  ██████  ███    ██ ████████ ███████ ███    ██ ████████
						   ██    ██   ██ ██   ██               ██      ██    ██ ████   ██    ██    ██      ████   ██    ██
						   ██    ███████ ██████      █████     ██      ██    ██ ██ ██  ██    ██    █████   ██ ██  ██    ██
						   ██    ██   ██ ██   ██               ██      ██    ██ ██  ██ ██    ██    ██      ██  ██ ██    ██
						   ██    ██   ██ ██████                 ██████  ██████  ██   ████    ██    ███████ ██   ████    ██
						*/
						?>
						<div id="content" class="ds-tab-content active">
							<?php
							/*
							██████  ██       ██████   ██████ ██   ██                ██████  ███████ ███    ██ ███████ ██████   █████  ██
							██   ██ ██      ██    ██ ██      ██  ██                ██       ██      ████   ██ ██      ██   ██ ██   ██ ██
							██████  ██      ██    ██ ██      █████       █████     ██   ███ █████   ██ ██  ██ █████   ██████  ███████ ██
							██   ██ ██      ██    ██ ██      ██  ██                ██    ██ ██      ██  ██ ██ ██      ██   ██ ██   ██ ██
							██████  ███████  ██████   ██████ ██   ██                ██████  ███████ ██   ████ ███████ ██   ██ ██   ██ ███████
							*/
							?>
							<div class="ds-row ds-mb-2">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2>
												<span class="dashicons dashicons-admin-generic"></span>
												<?php _e( 'General', DSSM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Enabled', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<label class="ds-toggler">
														<input
															name="dssm_settings[content][enabled]"
															type="checkbox"
															value="1"
															<?php echo ( !empty( $dssm->settings['content']['enabled'] ) ? ' checked="checked"' : ''); ?> />
															<span></span>
													</label>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-row ds-flex-align-center ds-ml-auto ds-mr-auto ds-block-toggler<?php echo ( !empty( $dssm->settings['content']['headers'] ) ? ' active' : ''); ?>">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Add temporarily unavailable headers (503)', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<label class="ds-toggler">
														<input
															name="dssm_settings[content][headers]"
															type="checkbox"
															value="1"
															class="ds-block-toggler-input"
															<?php echo ( !empty( $dssm->settings['content']['headers'] ) ? ' checked="checked"' : ''); ?> />
															<span></span>
													</label>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-block-toggler-block">
												<div class="ds-row ds-flex-align-center ds-mt-2 ds-ml-auto ds-mr-auto">
													<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
														<?php _e( 'Retry-After (in seconds)', DSSM_SLUG ); ?>:
													</div>
													<div class="ds-col-12 ds-col-lg-9 ds-p-0">
														<input
															class="ds-input-box"
															name="dssm_settings[content][retryafter]"
															type="number"
															value="<?php echo ( !empty( $dssm->settings['content']['retryafter'] ) ? $dssm->settings['content']['retryafter'] : ''); ?>"
															placeholder="600" />
													</div><!-- .ds-col -->
												</div><!-- .ds-row -->
											</div><!-- .ds-block-toggler-block -->
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
							<?php
							/*
							██████  ██       ██████   ██████ ██   ██               ███    ███ ███████ ███████ ███████  █████   ██████  ███████
							██   ██ ██      ██    ██ ██      ██  ██                ████  ████ ██      ██      ██      ██   ██ ██       ██
							██████  ██      ██    ██ ██      █████       █████     ██ ████ ██ █████   ███████ ███████ ███████ ██   ███ █████
							██   ██ ██      ██    ██ ██      ██  ██                ██  ██  ██ ██           ██      ██ ██   ██ ██    ██ ██
							██████  ███████  ██████   ██████ ██   ██               ██      ██ ███████ ███████ ███████ ██   ██  ██████  ███████
							*/
							?>
							<div class="ds-row ds-mb-2">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2>
												<span class="dashicons dashicons-text"></span>
												<?php _e( 'Message', DSSM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Heading', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<input
														class="ds-input-box"
														name="dssm_settings[content][heading]"
														type="text"
														value="<?php echo ( !empty( $dssm->settings['content']['heading'] ) ? $dssm->settings['content']['heading'] : ''); ?>"
														placeholder="Leave empty for no heading..." />
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<?php $content_logo_url = ( !empty( $dssm->settings['content']['logo'] ) ? $dssm->settings['content']['logo'] : '' ); ?>
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Logo', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<div id="logo" class="ds-image-load<?php echo ( !empty( $content_logo_url ) ? ' loaded' : '' ); ?>">
														<div class="ds-row">
															<div class="ds-col-6 ds-col-lg-3">
																<input
																	name="dssm_settings[content][logo]"
																	type="hidden"
																	value="<?php echo $content_logo_url; ?>" />
																<img
																	width="100%"
																	height="auto"
																	src="<?php echo $content_logo_url; ?>" />
															</div>
														</div>
														<button class="button button-secondary ds-image-add" type="button">
															<?php _e( 'Add logo', DSSM_SLUG ); ?>
														</button>
														<button class="button button-secondary ds-image-remove" type="button">
															<?php _e( 'Remove Logo', DSSM_SLUG ); ?>
														</button>
													</div>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<?php $content_favicon_url = ( !empty( $dssm->settings['content']['favicon'] ) ? $dssm->settings['content']['favicon'] : '' ); ?>
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Favicon', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<div id="favicon" class="ds-image-load<?php echo ( !empty( $content_favicon_url ) ? ' loaded' : '' ); ?>">
														<div class="ds-row">
															<div class="ds-col-2 ds-col-lg-1">
																<input
																	name="dssm_settings[content][favicon]"
																	type="hidden"
																	value="<?php echo $content_favicon_url; ?>" />
																<img
																	width="100%"
																	height="auto"
																	src="<?php echo $content_favicon_url; ?>" />
															</div>
														</div>
														<button class="button button-secondary ds-image-add" type="button">
															<?php _e( 'Add favicon', DSSM_SLUG ); ?>
														</button>
														<button class="button button-secondary ds-image-remove" type="button">
															<?php _e( 'Remove favicon', DSSM_SLUG ); ?>
														</button>
													</div>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-row ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Body', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<?php wp_editor( $editor['content'], $editor['editor_id'], $editor['arguments'] ); ?>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
							<?php
							/*
							██████  ██       ██████   ██████ ██   ██               ███████  ██████   ██████ ██  █████  ██
							██   ██ ██      ██    ██ ██      ██  ██                ██      ██    ██ ██      ██ ██   ██ ██
							██████  ██      ██    ██ ██      █████       █████     ███████ ██    ██ ██      ██ ███████ ██
							██   ██ ██      ██    ██ ██      ██  ██                     ██ ██    ██ ██      ██ ██   ██ ██
							██████  ███████  ██████   ██████ ██   ██               ███████  ██████   ██████ ██ ██   ██ ███████
							*/
							?>
							<div class="ds-row ds-mb-2">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2>
												<span class="dashicons dashicons-networking"></span>
												<?php _e( 'Social Media', DSSM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Facebook', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<input
														class="ds-input-box"
														name="dssm_settings[content][social][facebook][url]"
														type="text"
														value="<?php echo ( !empty( $dssm->settings['content']['social']['facebook']['url'] ) ? $dssm->settings['content']['social']['facebook']['url'] : ''); ?>"
														placeholder="Leave empty to exclude" />
													<input
														name="dssm_settings[content][social][facebook][icon]"
														type="hidden"
														value="fab fa-facebook-f" />
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Twitter', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<input
														class="ds-input-box"
														name="dssm_settings[content][social][twitter][url]"
														type="text"
														value="<?php echo ( !empty( $dssm->settings['content']['social']['twitter']['url'] ) ? $dssm->settings['content']['social']['twitter']['url'] : ''); ?>"
														placeholder="Leave empty to exclude" />
													<input
														name="dssm_settings[content][social][twitter][icon]"
														type="hidden"
														value="fab fa-twitter" />
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Instagram', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<input
														class="ds-input-box"
														name="dssm_settings[content][social][instagram][url]"
														type="text"
														value="<?php echo ( !empty( $dssm->settings['content']['social']['instagram']['url'] ) ? $dssm->settings['content']['social']['instagram']['url'] : ''); ?>"
														placeholder="Leave empty to exclude" />
													<input
														name="dssm_settings[content][social][instagram][icon]"
														type="hidden"
														value="fab fa-instagram" />
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-row ds-flex-align-center ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Email', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<input
														class="ds-input-box"
														name="dssm_settings[content][social][email][url]"
														type="text"
														value="<?php echo ( !empty( $dssm->settings['content']['social']['email']['url'] ) ? $dssm->settings['content']['social']['email']['url'] : ''); ?>"
														placeholder="Leave empty to exclude" />
													<input
														name="dssm_settings[content][social][email][icon]"
														type="hidden"
														value="fab fa-envelope" />
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
							<?php
							/*
							██████  ██       ██████   ██████ ██   ██                █████  ███    ██  █████  ██   ██    ██ ████████ ██  ██████ ███████
							██   ██ ██      ██    ██ ██      ██  ██                ██   ██ ████   ██ ██   ██ ██    ██  ██     ██    ██ ██      ██
							██████  ██      ██    ██ ██      █████       █████     ███████ ██ ██  ██ ███████ ██     ████      ██    ██ ██      ███████
							██   ██ ██      ██    ██ ██      ██  ██                ██   ██ ██  ██ ██ ██   ██ ██      ██       ██    ██ ██           ██
							██████  ███████  ██████   ██████ ██   ██               ██   ██ ██   ████ ██   ██ ███████ ██       ██    ██  ██████ ███████
							*/
							?>
							<div class="ds-row ds-mb-2">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2>
												<span class="dashicons dashicons-analytics"></span>
												<?php _e( 'Analytics', DSSM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Google Analytics', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<textarea
														name="dssm_settings[content][insert][googleanalytics]"
														class="ds-input-box"
														rows="8"><?php echo ( !empty( $dssm->settings['content']['insert']['googleanalytics'] ) ? $dssm->settings['content']['insert']['googleanalytics'] : '' ); ?></textarea>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
							<div class="ds-row">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-body ds-p-1">
											<?php submit_button('', 'button-primary button-hero', '', false ); ?>
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
						</div><!-- #content.ds-tab-content -->
						<?php
						/*
						████████  █████  ██████                ██████  ███████ ███████ ██  ██████  ███    ██
						   ██    ██   ██ ██   ██               ██   ██ ██      ██      ██ ██       ████   ██
						   ██    ███████ ██████      █████     ██   ██ █████   ███████ ██ ██   ███ ██ ██  ██
						   ██    ██   ██ ██   ██               ██   ██ ██           ██ ██ ██    ██ ██  ██ ██
						   ██    ██   ██ ██████                ██████  ███████ ███████ ██  ██████  ██   ████
						*/
						?>
						<div id="design" class="ds-tab-content">
							<?php
							/*
							██████  ██       ██████   ██████ ██   ██               ███████  ██████  ███    ██ ████████
							██   ██ ██      ██    ██ ██      ██  ██                ██      ██    ██ ████   ██    ██
							██████  ██      ██    ██ ██      █████       █████     █████   ██    ██ ██ ██  ██    ██
							██   ██ ██      ██    ██ ██      ██  ██                ██      ██    ██ ██  ██ ██    ██
							██████  ███████  ██████   ██████ ██   ██               ██       ██████  ██   ████    ██
							*/
							?>
							<div class="ds-row ds-mb-2">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2>
												<span class="dashicons dashicons-admin-customizer"></span>
												<?php _e( 'Font', DSSM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Color', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<input
														class="wp-color-picker"
														data-alpha="true"
														name="dssm_settings[design][font][color]"
														type="text"
														value="<?php echo ( !empty( $dssm->settings['design']['font']['color'] ) ? $dssm->settings['design']['font']['color'] : '#fff' ); ?>"
														placeholder="#fff" />
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-ml-auto ds-mr-auto ds-block-toggler<?php echo ( !empty( $dssm->settings['design']['font']['panel'] ) ? ' active' : ''); ?>">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Panel', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<label class="ds-toggler">
														<input
															name="dssm_settings[design][font][panel]"
															type="checkbox"
															value="1"
															class="ds-block-toggler-input"
															<?php echo ( !empty( $dssm->settings['design']['font']['panel'] ) ? ' checked="checked"' : ''); ?> />
															<span></span>
													</label>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-block-toggler-block">
												<div class="ds-row ds-flex-align-center ds-ml-auto ds-mr-auto ds-mb-1">
													<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
														<?php _e( 'Panel color', DSSM_SLUG ); ?>:
													</div>
													<div class="ds-col-12 ds-col-lg-9 ds-p-0">
														<input
															class="wp-color-picker"
															data-alpha="true"
															name="dssm_settings[design][font][panelcolor]"
															type="text"
															value="<?php echo ( !empty( $dssm->settings['design']['font']['panelcolor'] ) ? $dssm->settings['design']['font']['panelcolor'] : 'rgba( 0, 0, 0, 0.7 )'); ?>"
															placeholder="rgba( 0, 0, 0, 0.7 )" />
													</div><!-- .ds-col -->
												</div><!-- .ds-row -->
											</div><!-- .ds-block-toggler-block -->
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-pt-1 ds-bb ds-bt ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Text align', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<select class="ds-input-box" name="dssm_settings[design][font][align]">
														<?php foreach( $aligns as $key => $align ) {
															echo '<option value="' . $align . '"' .
																(
																	      !empty( $dssm->settings['design']['font']['align'] )
																	&& $align === $dssm->settings['design']['font']['align']
																	? ' selected="selected"'
																	: ''
																) .
																'>' . ucfirst( $key ) .
															'</option>';
														} ?>
													</select>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-row ds-flex-align-center ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Message position', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<select class="ds-input-box" name="dssm_settings[design][font][pos]">
														<?php foreach( $positions as $key => $pos ) {
															echo '<option value="' . $pos . '"' .
																(
																	    !empty( $dssm->settings['design']['font']['pos'] )
																	&& $pos === $dssm->settings['design']['font']['pos']
																	? ' selected="selected"'
																	: ''
																) .
																'>' . ucfirst( $key ) .
															'</option>';
														} ?>
													</select>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
							<?php
							/*
							██████  ██       ██████   ██████ ██   ██               ██████   █████   ██████ ██   ██  ██████  ██████   ██████  ██    ██ ███    ██ ██████
							██   ██ ██      ██    ██ ██      ██  ██                ██   ██ ██   ██ ██      ██  ██  ██       ██   ██ ██    ██ ██    ██ ████   ██ ██   ██
							██████  ██      ██    ██ ██      █████       █████     ██████  ███████ ██      █████   ██   ███ ██████  ██    ██ ██    ██ ██ ██  ██ ██   ██
							██   ██ ██      ██    ██ ██      ██  ██                ██   ██ ██   ██ ██      ██  ██  ██    ██ ██   ██ ██    ██ ██    ██ ██  ██ ██ ██   ██
							██████  ███████  ██████   ██████ ██   ██               ██████  ██   ██  ██████ ██   ██  ██████  ██   ██  ██████   ██████  ██   ████ ██████
							*/
							?>
							<div class="ds-row ds-mb-2">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2>
												<span class="dashicons dashicons-images-alt"></span>
												<?php _e( 'Background', DSSM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-flex-align-center ds-pb-1 ds-mb-1 ds-bb ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Color', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<input
														class="ds-input-box"
														name="dssm_settings[design][background][color]"
														type="text"
														value="<?php echo ( !empty( $dssm->settings['design']['background']['color'] ) ? $dssm->settings['design']['background']['color'] : ''); ?>"
														placeholder="#fff" />
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-row ds-flex-align-center ds-ml-auto ds-mr-auto ds-block-toggler<?php echo ( !empty( $dssm->settings['design']['background']['enabled'] ) ? ' active' : ''); ?>">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Image', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<label class="ds-toggler">
														<input
															type="checkbox"
															name="dssm_settings[design][background][enabled]"
															class="ds-block-toggler-input"
															value="1"
															<?php echo ( !empty( $dssm->settings['design']['background']['enabled'] ) ? ' checked="checked"' : ''); ?> />
															<span></span>
													</label>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-block-toggler-block">
												<div class="ds-row ds-flex-align-center ds-mt-2 ds-ml-auto ds-mr-auto">
													<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">

													</div>
													<div class="ds-col-12 ds-col-lg-9 ds-p-0">
														<input
															id="background-image-name"
															name="dssm_settings[design][background][image_active]"
															type="hidden"
															value="<?php echo ( !empty( $dssm->settings['design']['background']['image_active'] ) ? $dssm->settings['design']['background']['image_active'] : ''); ?>" />
														<div id="background-image-picker" class="ds-row">
															<?php
															$background_images = ( !empty( $dssm->settings['design']['background']['images'] ) ? $dssm->settings['design']['background']['images'] : array() );

															foreach( $background_images as $type => $images ) {
																foreach( $images as $key => $image ) { ?>
																	<label<?php echo ( 'custom' === $type ? ' id="custom-' . $key . '"' : '' ); ?> class="ds-radio ds-radio-image ds-col ds-col-lg-4 <?php echo $type; ?> ds-mb-2">
																		<?php echo ( 'custom' === $type ? '<div class="remove">X</div>' : '' ); ?>
																		<input
																			name="dssm_settings[design][background][images][<?php echo $type; ?>][<?php echo $key; ?>][name]"
																			type="hidden"
																			value="<?php echo $image['name']; ?>" />
																		<input
																			name="dssm_settings[design][background][images][<?php echo $type; ?>][<?php echo $key; ?>][url]"
																			type="hidden"
																			value="<?php echo $image['url']; ?>" />
																		<input
																			type="radio"
																			<?php echo ( !empty( $dssm->settings['design']['background']['image_active'] ) && $image['name'] === $dssm->settings['design']['background']['image_active']  ? ' checked="checked"' : ''); ?> />
																		<img width="100%" height="auto" src="<?php echo $image['url']; ?>" />
																	</label>
																<?php } ?>
															<?php } ?>
															<div class="ds-col ds-col-lg-4 ds-mb-2">
																<button id="background-image-add" type="button">
																	<?php _e('+ Upload Image'); ?>
																</button>
															</div>
														</div>
													</div><!-- .ds-col -->
												</div><!-- .ds-row -->
											</div><!-- .ds-block-toggler-block -->
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
							<?php
							/*
							██████  ██       ██████   ██████ ██   ██                ██████ ███████ ███████
							██   ██ ██      ██    ██ ██      ██  ██                ██      ██      ██
							██████  ██      ██    ██ ██      █████       █████     ██      ███████ ███████
							██   ██ ██      ██    ██ ██      ██  ██                ██           ██      ██
							██████  ███████  ██████   ██████ ██   ██                ██████ ███████ ███████
							*/
							?>
							<div class="ds-row ds-mb-2">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2>
												<span class="dashicons dashicons-carrot"></span>
												<?php _e( 'Custom', DSSM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-ml-auto ds-mr-auto">
												<div class="ds-col-12 ds-col-lg-3 ds-p-0 ds-pr-lg-2">
													<?php _e( 'Custom CSS', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9 ds-p-0">
													<textarea
														name="dssm_settings[design][custom][css]"
														class="ds-input-box"
														rows="8"><?php echo ( !empty( $dssm->settings['design']['custom']['css'] ) ? $dssm->settings['design']['custom']['css'] : '' ); ?></textarea>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
							<div class="ds-row">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-body ds-p-1">
											<?php submit_button('', 'button-primary button-hero', '', false ); ?>
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
						</div><!-- #design.ds-tab-content -->
					</form>
				</div><!-- .ds-col -->
				<?php
				/*
				███████ ██ ██████  ███████ ██████   █████  ██████
				██      ██ ██   ██ ██      ██   ██ ██   ██ ██   ██
				███████ ██ ██   ██ █████   ██████  ███████ ██████
				     ██ ██ ██   ██ ██      ██   ██ ██   ██ ██   ██
				███████ ██ ██████  ███████ ██████  ██   ██ ██   ██
				*/
				?>
				<div class="ds-col-12 ds-col-lg-3">
					<div class="ds-row ds-mb-2">
						<div class="ds-col">
							<div class="ds-block">
								<div class="ds-block-title">
									<h2>
										<span class="dashicons dashicons-feedback"></span>
										<?php _e( 'Support', DSSM_SLUG ); ?>
									</h2>
								</div>
								<div class="ds-block-body">
									<?php _e( 'If you require assistance please open a support ticket on the divSpot website by filling in the <a href="https://www.divspot.co.za/support" target="_blank">support form</a>.', DSSM_SLUG ); ?>
								</div><!-- .ds-block-body -->
							</div><!-- .ds-block -->
						</div><!-- .ds-col -->
					</div><!-- .ds-row -->
					<div class="ds-row ds-mb-2">
						<div class="ds-col">
							<div class="ds-block">
								<div class="ds-block-title">
									<h2>
										<span class="dashicons dashicons-feedback"></span>
										<?php _e( 'Review', DSSM_SLUG ); ?>
									</h2>
								</div>
								<div class="ds-block-body">
									<?php _e( 'Thank you for using divSpot. If you like our plugins please support us by <a href="https://wordpress.org/plugins/ds-site-message/#reviews" target="_blank">submitting a review</a>.', DSSM_SLUG ); ?>
								</div><!-- .ds-block-body -->
							</div><!-- .ds-block -->
						</div><!-- .ds-col -->
					</div><!-- .ds-row -->
				</div><!-- .ds-col -->
			</div><!-- .ds-row -->
		</div><!-- .ds-container -->
	</div><!-- .wrap -->
</div><!-- .ds-wrapper -->
