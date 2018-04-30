<?php
/*
Plugin Name:  DS Site Message
Plugin URI:   https://www.divspot.co.za/plugin-ds-site-message/
Description:  Add site messages to your wordpress site.
Version:      1.11
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
define('DSSM_VERSION', '1.11');

/* ================== STARTUP ================== */
$dssm = new ds_site_message();

class ds_site_message{
    function startup(){
        $dssm_content = get_option('dssm-content');
        global $pagenow; // WP Global.
        
        if(is_admin()){
            require_once DSSM_ROOT . '/admin/admin.php';
        } else{
            if((isset($dssm_content['general']['status']) && $dssm_content['general']['status'] && !current_user_can('edit_plugins')) || isset($_GET['dssm-preview'])){
                // Deny Site Message when Wordpress loads the login page, and when an API call is made.
                if(($pagenow != 'wp-login.php' && !strpos($_SERVER['REQUEST_URI'], 'ds-api'))){
                    if(isset($dssm_content['general']['headers']) && $dssm_content['general']['headers']){
                        header('HTTP/1.1 503 Service Temporarily Unavailable');
                        header('Status: 503 Service Temporarily Unavailable');
                        header('Retry-After: ' . ($dssm_content['general']['retryafter'] ? $dssm_content['general']['retryafter'] : '600'));
                    }

                    // Load message template.
                    load_template(DSSM_ROOT . 'templates/message.php');
                    die();
                }
            } else if(isset($dssm_content['general']['status']) && $dssm_content['general']['status']){
                add_action('wp_footer', function(){ load_template(DSSM_ROOT . 'templates/admin-notice.php'); });
            }
        }
    }
    
    function activate(){
        update_option('dssm-version', DSSM_VERSION);
        
        if(!get_option('dssm-content') || !get_option('dssm-design')){
            $default_settings = array(
                'text' => array(
                    'heading' => get_bloginfo(),
                    'body' => 'We are currently undergoing maintenance.<br />Please check back in 10 minutes.',
                )
            );
            update_option('dssm-content', $default_settings);
            
            $default_settings = array(
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
            );
            update_option('dssm-design', $default_settings);
        }
    }
    
    function deactivate(){
        
    }
    
    // Update Database settings if versions differ.
    function update_settings(){
        if(DSSM_VERSION !== get_option('dssm-version')) $this->activate();
    }
}
add_action('init', array($dssm, 'startup'));
/* ================== STARTUP END ================== */
/* ================== ACTIVATION / DEACTIVATION ================== */
register_activation_hook(__FILE__, array($dssm, 'activate'));
register_deactivation_hook(__FILE__, array($dssm, 'deactivate'));
add_action('plugins_loaded', array($dssm, 'update_settings'));
/* ================== ACTIVATION / DEACTIVATION END ================== */