<?php
if(!defined('ABSPATH')) exit;

class dssm_admin{
    private $capability, $brand, $template, $slug, $plugin;
    
    function __construct(){
        $this->capability = 'edit_plugins';
        $this->brand = 'Divspot';
        $this->template = 'load_main';
        $this->slug = 'ds-general';
        $this->plugin = array(
            'name' => DSSM_TITLE,
            'template' => 'load_settings',
            'slug' => 'dssm-settings'
        );
    }
    
    function startup(){
        // Register and handle settings.
        require_once DSSM_ROOT . 'admin/includes/dssm-admin-class-settings.php';
        $settings_handler = new dssm_admin_settings_handler();
        $settings_handler->startup();
        
        // Register styles and scripts.
        if(!wp_style_is('ds-style')){
            wp_register_style('ds-style', DSSM_ASSETS . 'admin/css/general.css', array(), DSSM_VERSION);
        }
        
        wp_register_style('dssm-style', DSSM_ASSETS . 'admin/css/style.css', array(), DSSM_VERSION);
        wp_register_script('dssm-script', DSSM_ASSETS . 'admin/js/script.js', array(), DSSM_VERSION);
        
        add_action('admin_enqueue_scripts', function(){
            wp_enqueue_style('ds-style');
            wp_enqueue_style('dssm-style');
            
            if(get_current_screen()->id === 'divspot_page_dssm-settings'){
                wp_enqueue_script('dssm-script');
                wp_enqueue_media(); // WP Media
            }
        });
        
        // Setup admin menu
        if(!isset($GLOBALS['admin_page_hooks'][$this->slug])){ // Load general page.
            add_menu_page($this->brand, $this->brand, $this->capability, $this->slug, array($this, $this->template), '', 79);
            add_submenu_page($this->slug, 'General', 'General', $this->capability, $this->slug, array($this, $this->template));
        }

        add_submenu_page($this->slug, $this->plugin['name'], $this->plugin['name'], $this->capability, $this->plugin['slug'], array($this, $this->plugin['template']));
        
        // Add plugin list settings link.
        add_filter("plugin_action_links_" . DSSM_BASENAME, function($links){
            $settings_link = '<a href="' . esc_url(admin_url('/admin.php')) . '?page=' . $this->plugin['slug'] . '">' . __('Settings') . '</a>';
            array_push($links, $settings_link);
            return $links;
        });
    }
    
    // Load Main Template (General Page)
    function load_main(){
        load_template(DSSM_ROOT . 'admin/templates/general.php');
    }
    
    // Load Settings Template
    function load_settings(){
        load_template(DSSM_ROOT . 'admin/templates/settings.php');
    }
}
