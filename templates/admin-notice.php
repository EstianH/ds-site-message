<?php if(!defined('ABSPATH')) exit; ?>
<style type="text/css">#dssm-admin-notice-container{ position: fixed; z-index: 999; bottom: 0; left: 50%; transform: translate(-50%, 0); width: 100%; max-width: 400px; text-align: center; box-sizing: border-box; padding: 20px; background: #fff; border-radius: 5px; -webkit-box-shadow: 0px 0px 20px -2px rgba(0,0,0,0.15); -moz-box-shadow: 0px 0px 20px -2px rgba(0,0,0,0.15); box-shadow: 0px 0px 20px -2px rgba(0,0,0,0.15); }#dssm-admin-notice-container > h2{ margin: 0 0 10px 0; }#dssm-admin-notice-container > a{ transition: all 0.2s ease-in-out; display: block; padding: 10px; max-width: 150px; margin: 10px auto 0; background: #e8e8e8; border-radius: 3px; color: #515151; }#dssm-admin-notice-container > a:hover{ background: #515151; color: #fff; }@media(min-width: 576px){ #dssm-admin-notice-container{ bottom: 10px; } }</style>
<div id="dssm-admin-notice-container">
    <h2><?php echo DSSM_TITLE; ?></h2>
    <span><?php _e('Your message is active. Only administrators have access to the website in this mode.'); ?></span>
    <a href="<?php echo get_home_url(); ?>?dssm-preview"><?php _e('Preview'); ?></a>
</div>