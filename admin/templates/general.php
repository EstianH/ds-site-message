<?php if(!defined('ABSPATH')) exit; ?>
<?php $API_Data = wp_remote_get('https://www.divspot.co.za/wp-json/ds-api/v1/plugin-list'); ?>
<?php $plugin_list = (isset($API_Data['response']['code']) && $API_Data['response']['code'] == '200' ? json_decode($API_Data['body'], true) : array()); ?>
<div id="ds-wrapper">
    <h1>Thank you for using Divspot</h1>
    <div class="wrap mt-0">
        <h2 class="pt-0 pb-0"></h2><!-- WP Notices render after the first <h2> tag in class="wrap" -->
        <div class="ds-blocks-container">
            <?php if($plugin_list){ ?>
                <div class="ds-row clearfix">
                    <h2><?php _e('DS Plugins'); ?></h2>
                    <?php foreach($plugin_list as $plugin => $data){ ?>
                        <?php $active = is_plugin_active($plugin . '/' . $plugin . '.php'); ?>
                            <div class="ds-block ds-col ds-col-3 textcenter">
                                <?php if(!$active){ ?><a href="<?php echo $data['url']; ?>" target="_blank"><?php } ?>
                                    <img class="ds-row" src="<?php echo $data['img']; ?>" />
                                    <div class="ds-row pt-2 pr-3 pb-3 pl-3<?php echo ($active ? ' success' : ''); ?>">
                                        <h2 class="mt-0 mb-0"><?php echo $data['name']; ?></h2>
                                        <?php if($active){ ?><small>Installed & Active</small><span class="dashicons dashicons-yes"></span>
                                        <?php } else{ ?><small>View</small><?php } ?>
                                    </div>
                                <?php if(!$active){ ?></a><?php } ?>
                            </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="ds-row clearfix ds-row-equal-height">
                <div class="ds-block ds-col ds-col-6 mt-2">
                    <label class="ds-block-title pt-2 pr-2 pb-2 pl-2 expanded">
                        <h2 class="mt-0 mb-0">
                            <span class="dashicons dashicons-feedback"></span>
                            <?php _e('Support'); ?>
                        </h2>
                    </label>
                    <?php $ds_support_nonce = wp_create_nonce('nds_add_user_meta_form_nonce'); ?>
                    <div class="pt-2 pr-2 pb-2 pl-2">
                        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                            <input type="hidden" name="action" value="ds_support" />
                            <input type="hidden" name="ds_nonce" value="<?php echo $ds_support_nonce; ?>" />
                            <div class="ds-row clearfix border-bottom border-grey pb-1">
                                <label class="ds-col ds-col-3 ds-2col"><?php _e('Full Name'); ?>:</label>
                                <div class="ds-col ds-col-9">
                                    <input required class="ds-col-12" type="text" name="ds_name" value="" placeholder="Your full name" />
                                </div>
                            </div>
                            <div class="ds-row clearfix pt-1 pb-1 border-bottom border-grey">
                                <label class="ds-col ds-col-3 ds-2col"><?php _e('Plugin'); ?>:</label>
                                <div class="ds-col ds-col-9">
                                    <select required class="ds-col-12" name="ds_plugin">
                                        <?php foreach($plugin_list as $plugin => $data){ ?>
                                            <?php if(is_plugin_active($plugin . '/' . $plugin . '.php')){ ?>
                                                <option value="<?php echo $data['name']; ?>"><?php echo $data['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="ds-row clearfix pt-1 pb-1 border-bottom border-grey">
                                <label class="ds-col ds-col-3 ds-2col"><?php _e('Message'); ?>:</label>
                                <div class="ds-col ds-col-9">
                                    <textarea required class="ds-col-12" name="ds_message" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="ds-row clearfix pt-1">
                                <div class="ds-col ds-col-12 textright pt-1">
                                    <?php submit_button('Request Support'); ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="ds-block ds-col ds-col-6 mt-2">
                    <label class="ds-block-title pt-2 pr-2 pb-2 pl-2 expanded">
                        <h2 class="mt-0 mb-0">
                            <span class="dashicons dashicons-feedback"></span>
                            <?php _e('Review'); ?>
                        </h2>
                    </label>
                    <div class="pt-2 pr-2 pb-2 pl-2">
                        Thank you for using DivSpot. If you like my plugins please support me by<br /><a href="#" target="_blank">submitting a review</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>