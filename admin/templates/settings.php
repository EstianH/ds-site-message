<?php if(!defined('ABSPATH')) exit; ?>
<?php
$tabs = array('content', 'design');
$active_tab = (isset($_GET['tab']) ? $_GET['tab'] : $tabs[0]);

$dssm_settings = get_option('dssm-settings');

$aligns = array('left' => 'textleft', 'center' => 'textcenter', 'right' => 'textright');
$positions = array('left' => 'margin-right: auto', 'full-width' => 'max-width: 100%', 'right' => 'margin-left: auto');
$editor = array(
	'content' => (isset($dssm_settings['content']['body']) ? $dssm_settings['content']['body'] : ''),
	'editor_id' => 'dssmsettingsbody',
	'arguments' => array(
		'media_buttons' => false,
		'textarea_name' => 'dssm-settings[content][body]',
		'textarea_rows' => 8
	)
); ?>
<div id="ds-wrapper">
	<h1><?php echo DSSM_TITLE; ?></h1>
	<div class="wrap mt-0">
		<h2 class="pt-0 pb-0"></h2><!-- WP Notices render after the first <h2> tag in class="wrap" -->
		<h2 class="nav-tab-wrapper">
			<?php foreach($tabs as $tab){ ?>
				<a href="#<?php echo $tab; ?>" class="nav-tab<?php echo ($tab === $active_tab ? ' nav-tab-active' : ''); ?> ds-nav"><?php echo ucfirst($tab); ?></a>
			<?php } ?>
				<a href="<?php echo home_url() . '?dssm-preview'; ?>" class="nav-tab nav-tab-link" target="_blank"><?php _e('Live Preview'); ?></a>
		</h2>
		<div class="ds-blocks-container">
			<form method="post" action="options.php">
				<?php settings_fields('dssm-settings'); ?>
				<div id="content" class="tab-content active">
					<div class="ds-row clearfix">
						<div class="ds-block ds-col ds-col-12 mt-1">
							<label class="ds-block-title pt-2 pr-2 pb-2 pl-2">
								<h2 class="mt-0 mb-0">
									<span class="dashicons dashicons-admin-generic"></span>
									<?php _e('General'); ?>
								</h2>
							</label>
							<div class="pt-2 pr-2 pb-2 pl-2">
								<div class="ds-row clearfix pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Enabled'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col">
										<input name="dssm-settings[content][status]" type="checkbox" value="1"<?php echo (isset($dssm_settings['content']['status']) ? ' checked="checked"' : ''); ?> />
									</div>
								</div>
								<div class="ds-row clearfix pt-1">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Add temporarily unavailable headers (503):'); ?></label>
									<div class="ds-col ds-col-9 ds-2col">
										<input id="headers" name="dssm-settings[content][headers]" type="checkbox" value="1"<?php echo (isset($dssm_settings['content']['headers']) ? ' checked="checked"' : ''); ?> />
									</div>
								</div>
								<div id="retryafter" class="ds-row clearfix pt-1 mt-1 border-top border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Retry-After (in seconds)'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col">
										<input class="ds-col-12" name="dssm-settings[content][retryafter]" type="number" value="<?php echo (isset($dssm_settings['content']['retryafter']) ? $dssm_settings['content']['retryafter'] : ''); ?>" placeholder="600" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="ds-row clearfix">
						<div class="ds-block ds-col ds-col-12 mt-1">
							<label class="ds-block-title pt-2 pr-2 pb-2 pl-2">
								<h2 class="mt-0 mb-0">
									<span class="dashicons dashicons-text"></span>
									<?php _e('Message'); ?>
								</h2>
							</label>
							<div class="pt-2 pr-2 pb-2 pl-2">
								<div class="ds-row clearfix pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Heading'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col">
										<input class="ds-col-12" name="dssm-settings[content][heading]" type="text" value="<?php echo (isset($dssm_settings['content']['heading']) ? $dssm_settings['content']['heading'] : ''); ?>" />
									</div>
								</div>
								<div class="ds-row clearfix pt-1 pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Logo'); ?>:</label>
									<div id="logo" class="ds-col ds-col-9 ds-2col ds-image-load<?php echo (isset($dssm_settings['content']['logo']) && $dssm_settings['content']['logo'] ? ' loaded' : ''); ?>">
										<div>
											<input name="dssm-settings[content][logo]" type="hidden" value="<?php echo (isset($dssm_settings['content']['logo']) && $dssm_settings['content']['logo'] ? $dssm_settings['content']['logo'] : ''); ?>" />
											<img width="100%" height="auto" src="<?php echo (isset($dssm_settings['content']['logo']) && $dssm_settings['content']['logo'] ? $dssm_settings['content']['logo'] : ''); ?>" />
										</div>
										<button id="logo-add" class="button button-primary ds-image-add" type="button"><?php _e('Add logo'); ?></button>
										<button id="logo-remove" class="button button-secondary ds-image-remove" type="button"><?php _e('Remove Logo'); ?></button>
									</div>
								</div>
								<div class="ds-row clearfix pt-1 pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Favicon'); ?>:</label>
									<div id="favicon" class="ds-col ds-col-9 ds-2col ds-image-load<?php echo (isset($dssm_settings['content']['favicon']) && $dssm_settings['content']['favicon'] ? ' loaded' : ''); ?>">
										<div>
											<input name="dssm-settings[content][favicon]" type="hidden" value="<?php echo (isset($dssm_settings['content']['favicon']) && $dssm_settings['content']['favicon'] ? $dssm_settings['content']['favicon'] : ''); ?>" />
											<img width="100%" height="auto" src="<?php echo (isset($dssm_settings['content']['favicon']) && $dssm_settings['content']['favicon'] ? $dssm_settings['content']['favicon'] : ''); ?>" />
										</div>
										<button id="favicon-add" class="button button-primary ds-image-add" type="button"><?php _e('Add Favicon'); ?></button>
										<button id="favicon-remove" class="button button-secondary ds-image-remove" type="button"><?php _e('Remove Favicon'); ?></button>
									</div>
								</div>
								<div class="ds-row clearfix pt-1">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Body'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col">
										<?php wp_editor($editor['content'], $editor['editor_id'], $editor['arguments']); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="ds-row clearfix">
						<div class="ds-block ds-col ds-col-12 mt-1">
							<label class="ds-block-title pt-2 pr-2 pb-2 pl-2">
								<h2 class="mt-0 mb-0">
									<span class="dashicons dashicons-networking"></span>
									<?php _e('Social Media'); ?>
								</h2>
							</label>
							<div class="pt-2 pr-2 pb-2 pl-2">
								<div class="ds-row clearfix pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Facebook'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col">
										<input class="ds-col-12" name="dssm-settings[content][social][facebook][url]" type="text" value="<?php echo (isset($dssm_settings['content']['social']['facebook']['url']) && $dssm_settings['content']['social']['facebook']['url'] ? $dssm_settings['content']['social']['facebook']['url'] : ''); ?>" placeholder="Leave empty to exclude" />
										<input class="ds-col-12" name="dssm-settings[content][social][facebook][icon]" type="hidden" value="fab fa-facebook-f" />
									</div>
								</div>
								<div class="ds-row clearfix pt-1 pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Twitter'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col">
										<input class="ds-col-12" name="dssm-settings[content][social][twitter][url]" type="text" value="<?php echo (isset($dssm_settings['content']['social']['twitter']['url']) && $dssm_settings['content']['social']['twitter']['url'] ? $dssm_settings['content']['social']['twitter']['url'] : ''); ?>" placeholder="Leave empty to exclude" />
										<input class="ds-col-12" name="dssm-settings[content][social][twitter][icon]" type="hidden" value="fab fa-twitter" />
									</div>
								</div>
								<div class="ds-row clearfix pt-1 pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Instagram'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col">
										<input class="ds-col-12" name="dssm-settings[content][social][instagram][url]" type="text" value="<?php echo (isset($dssm_settings['content']['social']['instagram']['url']) && $dssm_settings['content']['social']['instagram']['url'] ? $dssm_settings['content']['social']['instagram']['url'] : ''); ?>" placeholder="Leave empty to exclude" />
										<input class="ds-col-12" name="dssm-settings[content][social][instagram][icon]" type="hidden" value="fab fa-instagram" />
									</div>
								</div>
								<div class="ds-row clearfix pt-1">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Email'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col">
										<input class="ds-col-12" name="dssm-settings[content][social][email][url]" type="text" value="<?php echo (isset($dssm_settings['content']['social']['email']['url']) && $dssm_settings['content']['social']['email']['url'] ? $dssm_settings['content']['social']['email']['url'] : ''); ?>" placeholder="Leave empty to exclude" />
										<input class="ds-col-12" name="dssm-settings[content][social][email][icon]" type="hidden" value="fas fa-envelope" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="ds-row clearfix">
						<div class="ds-block ds-col ds-col-12 mt-1">
							<label class="ds-block-title pt-2 pr-2 pb-2 pl-2">
								<h2 class="mt-0 mb-0">
									<span class="dashicons dashicons-analytics"></span>
									<?php _e('Analytics'); ?>
								</h2>
							</label>
							<div class="pt-2 pr-2 pb-2 pl-2">
								<div class="ds-row clearfix">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Google Analytics'); ?>:</label>
									<div class="ds-col ds-col-9">
										<textarea name="dssm-settings[content][insert][analytics]" class="ds-col-12" rows="8"><?php echo (isset($dssm_settings['content']['insert']['analytics']) ? $dssm_settings['content']['insert']['analytics'] : ''); ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="ds-row clearfix">
						<div class="ds-block ds-col ds-col-12 mt-1 pt-2 pr-2 pb-2 pl-2">
							<?php submit_button('', 'button-primary button-hero'); ?>
						</div>
					</div>
				</div>
				<div id="design" class="tab-content">
					<div class="ds-row clearfix">
						<div class="ds-block ds-col ds-col-12 mt-1">
							<label class="ds-block-title pt-2 pr-2 pb-2 pl-2">
								<h2 class="mt-0 mb-0">
									<span class="dashicons dashicons-admin-customizer"></span>
									<?php _e('Font'); ?>
								</h2>
							</label>
							<div class="pt-2 pr-2 pb-2 pl-2">
								<div class="ds-row clearfix pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Color'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col"><input class="ds-col-12" name="dssm-settings[design][font][color]" type="text" value="<?php echo (isset($dssm_settings['design']['font']['color']) ? $dssm_settings['design']['font']['color'] : ''); ?>" placeholder="#515151" /></div>
								</div>
								<div class="ds-row clearfix pt-1 pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Panel'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col">
										<input id="panel" name="dssm-settings[design][font][panel]" type="checkbox" value="1"<?php echo (isset($dssm_settings['design']['font']['panel']) ? ' checked="checked"' : ''); ?> />
									</div>
								</div>
								<div id="panelcolor" class="ds-row clearfix pt-1 pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Panel color'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col">
										<input class="ds-col-12" name="dssm-settings[design][font][panelcolor]" type="text" value="<?php echo (isset($dssm_settings['design']['font']['panelcolor']) ? $dssm_settings['design']['font']['panelcolor'] : ''); ?>" placeholder="#000000ad" />
									</div>
								</div>
								<div class="ds-row clearfix pt-1 pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Text align'); ?>:</label>
									<div class="ds-col ds-col-9">
										<select class="ds-col-12" name="dssm-settings[design][font][align]">
											<?php foreach($aligns as $key => $align){ ?>
											<option<?php echo ' value="' . $align . '"' . (isset($dssm_settings['design']['font']['align']) && $align == $dssm_settings['design']['font']['align'] ? ' selected="selected"' : ''); ?>><?php echo ucfirst($key); ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="ds-row clearfix pt-1 pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Message position'); ?>:</label>
									<div class="ds-col ds-col-9">
										<select class="ds-col-12" name="dssm-settings[design][font][pos]">
											<?php foreach($positions as $key => $pos){ ?>
												<option<?php echo ' value="' . $pos . '"' . (isset($dssm_settings['design']['font']['pos']) && $pos == $dssm_settings['design']['font']['pos'] ? ' selected="selected"' : ''); ?>><?php echo ucfirst($key); ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="ds-row clearfix">
						<div class="ds-block ds-col ds-col-12 mt-1">
							<label class="ds-block-title pt-2 pr-2 pb-2 pl-2">
								<h2 class="mt-0 mb-0">
									<span class="dashicons dashicons-admin-customizer"></span>
									<?php _e('Background'); ?>
								</h2>
							</label>
							<div class="pt-2 pr-2 pb-2 pl-2">
								<div class="ds-row clearfix pb-1 border-bottom border-grey">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Color'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col"><input class="ds-col-12" name="dssm-settings[design][background][color]" type="text" value="<?php echo (isset($dssm_settings['design']['background']['color']) ? $dssm_settings['design']['background']['color'] : ''); ?>" placeholder="#fff" /></div>
								</div>
								<div class="ds-row clearfix pt-1">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Image'); ?>:</label>
									<div class="ds-col ds-col-9 ds-2col">
										<input id="use-background-image" type="checkbox" value="1"<?php echo (isset($dssm_settings['design']['background']['image']) ? ' checked="checked"' : ''); ?> />
										<input id="image-name" name="dssm-settings[design][background][image][name]" type="hidden" value="<?php echo (isset($dssm_settings['design']['background']['image']['name']) ? $dssm_settings['design']['background']['image']['name'] : ''); ?>" />
										<input id="image-url" name="dssm-settings[design][background][image][url]" type="hidden" value="<?php echo (isset($dssm_settings['design']['background']['image']['url']) ? $dssm_settings['design']['background']['image']['url'] : ''); ?>" />
										<div id="image-picker" class="ds-row ds-row-auto-height pt-1 mt-1">
											<?php foreach($dssm_settings['design']['background']['images'] as $type => $images){ ?>
												<?php foreach($images as $key => $image){ ?>
												<label<?php echo ($type == 'custom' ? ' id="custom-' . $key . '"' : ''); ?> class="image-radio ds-col ds-col-4 <?php echo $type; ?>">
													<div class="remove">X</div>
													<input name="dssm-settings[design][background][images][<?php echo $type; ?>][<?php echo $key; ?>][name]" type="hidden" value="<?php echo $image['name']; ?>" />
													<input name="dssm-settings[design][background][images][<?php echo $type; ?>][<?php echo $key; ?>][url]" type="hidden" value="<?php echo $image['url']; ?>" />
													<input type="radio"<?php echo (isset($dssm_settings['design']['background']['image']) && $dssm_settings['design']['background']['image']['name'] == $image['name'] ? ' checked="checked"' : ''); ?> />
													<img width="100%" height="auto" src="<?php echo $image['url']; ?>" />
												</label>
												<?php } ?>
											<?php } ?>
											<button id="image-add" class="image-radio ds-col ds-col-4 mb-1" type="button">+ <?php _e('Upload Image'); ?></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="ds-row clearfix">
						<div class="ds-block ds-col ds-col-12 mt-1">
							<label class="ds-block-title pt-2 pr-2 pb-2 pl-2">
								<h2 class="mt-0 mb-0">
									<span class="dashicons dashicons-carrot"></span>
									<?php _e('Custom'); ?>
								</h2>
							</label>
							<div class="pt-2 pr-2 pb-2 pl-2">
								<div class="ds-row clearfix">
									<label class="ds-col ds-col-3 ds-2col"><?php _e('Custom css'); ?>:</label>
									<div class="ds-col ds-col-9">
										<textarea name="dssm-settings[design][css][custom]" class="ds-col-12" rows="8"><?php echo (isset($dssm_settings['design']['css']['custom']) ? $dssm_settings['design']['css']['custom'] : ''); ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="ds-row clearfix">
						<div class="ds-block ds-col ds-col-12 mt-1 pt-2 pr-2 pb-2 pl-2">
							<?php submit_button('', 'button-primary button-hero'); ?>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
