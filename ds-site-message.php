<?php
/*
Plugin Name:  DS Site Message
Plugin URI:   https://www.divspot.co.za/plugin-ds-site-message/
Description:  Add site messages to your wordpress site.
Version:      1.1215
Author:       EstianH
Author URI:   https://www.divspot.co.za
License:      GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

if(!defined('ABSPATH')) exit;

// Definitions
if(!defined('DIVSPOT_URL')) define('DIVSPOT_URL', 'https://www.divspot.co.za');
define('DSSM_BASENAME', plugin_basename(__FILE__));
define('DSSM_URL', plugins_url('', DSSM_BASENAME) . '/'); // User-Friendly URL
define('DSSM_ROOT', __DIR__ . '/'); // FTP Path
define('DSSM_ASSETS', DSSM_URL . 'assets/'); // FTP Path
define('DSSM_TITLE', 'DS Site Message');
define('DSSM_VERSION', '1.1215');

/* ================== STARTUP ================== */
$dssm = new ds_site_message();

class ds_site_message{
    function startup(){
        $dssm_settings = get_option('dssm-settings');
        global $pagenow; // WP Global.
        
        if(is_admin()){
            require_once DSSM_ROOT . '/admin/admin.php';
        } else{
            if((isset($dssm_settings['content']['status']) && $dssm_settings['content']['status'] && !current_user_can('edit_plugins')) || isset($_GET['dssm-preview'])){
                // Deny Site Message when Wordpress loads the login page, and when an API call is made.
                if(($pagenow != 'wp-login.php' && !strpos($_SERVER['REQUEST_URI'], 'ds-api'))){
                    if(isset($dssm_settings['content']['headers']) && $dssm_settings['content']['headers']){
                        header('HTTP/1.1 503 Service Temporarily Unavailable');
                        header('Status: 503 Service Temporarily Unavailable');
                        header('Retry-After: ' . ($dssm_settings['content']['retryafter'] ? $dssm_settings['content']['retryafter'] : '600'));
                    }

                    // Load message template.
                    load_template(DSSM_ROOT . 'templates/message.php');
                    die();
                }
            } else if(isset($dssm_settings['content']['status']) && $dssm_settings['content']['status']){
                add_action('wp_footer', function(){ load_template(DSSM_ROOT . 'templates/admin-notice.php'); });
            }
        }
    }
    
    function activate(){
        update_option('dssm-version', DSSM_VERSION);
        
        if(!get_option('dssm-settings')){
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
                                array('name' => 'lights', 'url' => DSSM_ASSETS . 'images/lights.jpg'),
                                array('name' => 'bricks', 'url' => DSSM_ASSETS . 'images/bricks.jpg'),
                                array('name' => 'pencils', 'url' => DSSM_ASSETS . 'images/pencils.jpg'),
                                array('name' => 'coffee', 'url' => DSSM_ASSETS . 'images/coffee.jpg'),
                                array('name' => 'clock', 'url' => DSSM_ASSETS . 'images/clock.jpg')
                            )
                        )
                    )
                )
            );
            update_option('dssm-settings', $default_settings);
        }
        
        $this->dssm_legacy_cleaner();
    }
    
    function deactivate(){
        
    }
    
    /**
     * @description Update Database settings if versions differ.
     */
    function update_settings(){
        if(DSSM_VERSION !== get_option('dssm-version')) $this->activate();
    }
    
    /**
     * @description Handle legacy dssm options.
     */
    function dssm_legacy_cleaner(){
        delete_option('dssm-content');
        delete_option('dssm-design');
        delete_option('dssm-sections');
    }
}
add_action('init', array($dssm, 'startup'));
/* ================== STARTUP END ================== */
/* ================== ACTIVATION / DEACTIVATION ================== */
register_activation_hook(__FILE__, array($dssm, 'activate'));
register_deactivation_hook(__FILE__, array($dssm, 'deactivate'));
add_action('plugins_loaded', array($dssm, 'update_settings'));
/* ================== ACTIVATION / DEACTIVATION END ================== */