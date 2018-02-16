<?php
/*
Plugin Name:  DS Site Message
Plugin URI:   https://www.divspot.co.za
Description:  Add site messages to your wordpress site.
Version:      0.1
Author:       EstianH
Author URI:   https://www.divspot.co.za
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

if(!defined('ABSPATH')) exit;

// Definitions
define('DSSM_BASENAME', plugin_basename(__FILE__));
define('DSSM_URL', plugins_url('', DSSM_BASENAME) . '/'); // User-Friendly URL
define('DSSM_ROOT', __DIR__ . '/'); // FTP Path
define('DSSM_ASSETS', DSSM_URL . 'assets/'); // FTP Path
define('DSSM_TITLE', 'DS Site Message');
define('DSSM_VERSION', '0.25');

/* ================== STARTUP ================== */
$dssm = new dssm();

class dssm{
    function startup(){
        $dssm_settings = get_option('dssm-settings');
        global $pagenow; // WP Global.
        
        if(is_admin()){
            add_action('admin_menu', function(){
                require_once DSSM_ROOT . '/admin/admin.php';
                $dssm_admin = new dssm_admin();
                $dssm_admin->startup();
            });
        } else{
            if((isset($dssm_settings['general']['status']) && $dssm_settings['general']['status'] && !current_user_can('edit_plugins')) || isset($_GET['dssm-preview'])){
                // Deny Site Message when Wordpress loads the login page, and when an API call is made.
                if(($pagenow != 'wp-login.php' && !strpos($_SERVER['REQUEST_URI'], 'ds-api'))){
                    if(isset($dssm_settings['general']['headers']) && $dssm_settings['general']['headers']){
                        header('HTTP/1.1 503 Service Temporarily Unavailable');
                        header('Status: 503 Service Temporarily Unavailable');
                        header('Retry-After: ' . ($dssm_settings['general']['retryafter'] ? $dssm_settings['general']['retryafter'] : '600'));
                    }

                    // Load message template.
                    load_template(DSSM_ROOT . 'templates/message.php');
                    die();
                }
            } else if(isset($dssm_settings['general']['status']) && $dssm_settings['general']['status']){
                add_action('wp_footer', function(){ load_template(DSSM_ROOT . 'templates/admin-notice.php'); });
            }
        }
    }
    
    function activate(){
        if(!get_option('dssm-settings')){
            $default_settings = array(
                'general' => 1,
                'message' => 1
            );
            update_option('dssm-sections', $default_settings);
            
            $default_settings = array(
                'text' => array(
                    'heading' => get_bloginfo(),
                    'body' => 'We are currently undergoing maintenance.<br />Please check back in 10 minutes.',
                ),
                'font' => array(
                    'color' => '#fff',
                    'panel' => true,
                    'align' => 'textcenter',
                    'pos' => 'margin-left: auto'
                ),
                'background' => array(
                    'image' => array(
                        'name' => 'coffee',
                        'url' => DSSM_URL . 'images/coffee.jpg',
                    ),
                    'images' => array(
                        'default' => array(
                            array(
                                'name' => 'lights',
                                'url' => DSSM_ASSETS . 'images/lights.jpg'
                            ),
                            array(
                                'name' => 'bricks',
                                'url' => DSSM_ASSETS . 'images/bricks.jpg'
                            ),
                            array(
                                'name' => 'pencils',
                                'url' => DSSM_ASSETS . 'images/pencils.jpg'
                            ),
                            array(
                                'name' => 'coffee',
                                'url' => DSSM_ASSETS . 'images/coffee.jpg'
                            ),
                            array(
                                'name' => 'clock',
                                'url' => DSSM_ASSETS . 'images/clock.jpg'
                            )
                        )
                    )
                )
            );
            update_option('dssm-settings', $default_settings);
        }
    }
    
    function deactivate(){
        
    }
}
add_action('init', array($dssm, 'startup'));
/* ================== STARTUP END ================== */
/* ================== ACTIVATION / DEACTIVATION ================== */
register_activation_hook(__FILE__, array($dssm, 'activate'));
register_deactivation_hook(__FILE__, array($dssm, 'deactivate'));
/* ================== ACTIVATION / DEACTIVATION END ================== */