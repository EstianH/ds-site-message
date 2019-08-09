<?php if( !defined( 'ABSPATH' ) ) exit;

global $dssm_admin;

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
	'content'         => ( !empty( $dssm_admin->settings['content']['body'] ) ? $dssm_admin->settings['content']['body'] : '' ),
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

						echo '<a href="' . home_url() . '?dssm-preview" class="ds-tab-nav ds-tab-nav-link" target="_blank">' . __( 'Live Preview', DSSM_SLUG ) . '</a>';
						?>
					</div><!-- .ds-tab-nav-wrapper -->
				</div><!-- .ds-col -->
			</div><!-- .ds-row -->
		</div><!-- .ds-container -->
		<div class="ds-container ds-p-0">
			<div class="ds-row">
				<div class="ds-col-12 ds-col-lg-9">
					<form method="post" action="options.php">
						<?php settings_fields( 'dssm_settings' ); ?>
						<div id="content" class="ds-tab-content active">
							<div class="ds-row ds-mb-2">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2 class="mt-0 mb-0">
												<span class="dashicons dashicons-admin-generic"></span>
												<?php _e( 'General', DSSM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-flex-align-center ds-mb-2">
												<div class="ds-col-12 ds-col-lg-3">
													<?php _e( 'Enabled', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9">
													<label class="ds-toggler">
														<input
															name="dssm_settings[content][enabled]"
															type="checkbox"
															value="1"
															<?php echo ( !empty( $dssm_admin->settings['content']['enabled'] ) ? ' checked="checked"' : ''); ?> />
															<span></span>
													</label>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-row ds-flex-align-center ds-block-toggler ds-mb-2">
												<div class="ds-col-12 ds-col-lg-3">
													<?php _e( 'Add temporarily unavailable headers (503)', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9">
													<label class="ds-toggler">
														<input
															name="dssm_settings[content][headers]"
															type="checkbox"
															value="1"
															class="ds-block-toggler-input"
															<?php echo ( !empty( $dssm_admin->settings['content']['headers'] ) ? ' checked="checked"' : ''); ?> />
															<span></span>
													</label>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-block-toggler-block<?php echo ( !empty( $dssm_admin->settings['content']['headers'] ) ? ' active' : ''); ?> border-0">
												<div class="ds-row ds-flex-align-center">
													<div class="ds-col-12 ds-col-lg-3">
														<?php _e( 'Retry-After (in seconds)', DSSM_SLUG ); ?>:
													</div>
													<div class="ds-col-12 ds-col-lg-9">
														<input
															class="ds-input-box"
															name="dssm-settings[content][retryafter]"
															type="number"
															value="<?php echo ( !empty( $dssm_admin->settings['content']['retryafter'] ) ? $dssm_admin->settings['content']['retryafter'] : ''); ?>"
															placeholder="600" />
													</div><!-- .ds-col -->
												</div><!-- .ds-row -->
											</div><!-- .ds-row -->
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
							<div class="ds-row">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2 class="mt-0 mb-0">
												<span class="dashicons dashicons-text"></span>
												<?php _e( 'Message', DSSM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">
											<div class="ds-row ds-flex-align-center ds-mb-2">
												<div class="ds-col-12 ds-col-lg-3">
													<?php _e( 'Heading', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9">
													<input
														class="ds-input-box"
														name="dssm-settings[content][heading]"
														type="text"
														value="<?php echo ( !empty( $dssm_admin->settings['content']['heading'] ) ? $dssm_admin->settings['content']['heading'] : ''); ?>"
														placeholder="Leave empty for no heading..." />
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
											<div class="ds-row ds-flex-align-center ds-mb-2">
												<div class="ds-col-12 ds-col-lg-3">
													<?php _e( 'Logo', DSSM_SLUG ); ?>:
												</div>
												<div class="ds-col-12 ds-col-lg-9">
													<div id="logo" class="ds-image-load<?php echo ( !empty( $dssm_admin->settings['content']['logo'] ) && $dssm_admin->settings['content']['logo'] ? ' loaded' : '' ); ?>">
														<div>
															<input
																name="dssm-settings[content][logo]"
																type="hidden"
																value="<?php echo ( isset( $dssm_admin->settings['content']['logo'] ) && $dssm_admin->settings['content']['logo'] ? $dssm_admin->settings['content']['logo'] : '' ); ?>" />
															<img
																width="100%"
																height="auto"
																src="<?php echo ( !empty( $dssm_admin->settings['content']['logo'] ) && $dssm_admin->settings['content']['logo'] ? $dssm_admin->settings['content']['logo'] : ''); ?>" />
														</div>
														<button id="logo-add" class="button button-primary ds-image-add" type="button">
															<?php _e( 'Add logo', DSSM_SLUG ); ?>
														</button>
														<button id="logo-remove" class="button button-secondary ds-image-remove" type="button">
															<?php _e( 'Remove Logo', DSSM_SLUG ); ?>
														</button>
													</div>
												</div><!-- .ds-col -->
											</div><!-- .ds-row -->
										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
						</div><!-- #content.ds-tab-content -->
						<div id="design" class="ds-tab-content">
							<div class="ds-row">
								<div class="ds-col">
									<div class="ds-block">
										<div class="ds-block-title">
											<h2 class="mt-0 mb-0">
												<span class="dashicons dashicons-admin-generic"></span>
												<?php _e( 'Design', DSSM_SLUG ); ?>
											</h2>
										</div>
										<div class="ds-block-body">

										</div><!-- .ds-block-body -->
									</div><!-- .ds-block -->
								</div><!-- .ds-col -->
							</div><!-- .ds-row -->
						</div><!-- #design.ds-tab-content -->
					</form>
				</div><!-- .ds-col -->
				<div class="ds-col-12 ds-col-lg-3"></div>
			</div><!-- .ds-row -->
		</div><!-- .ds-container -->
	</div><!-- .wrap -->
</div><!-- .ds-wrapper -->
