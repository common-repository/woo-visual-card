<?php
/**
 * Plugin Name:             WooCommerce Visual Card
 * Plugin URI:              https://www.businesspay.com.br
 * Description:             Show a visual card in WooCommerce checkout page.
 * Author:                  BusinessPay
 * Author                   URI: https://www.businesspay.com.br
 * Version:                 1.0.5
 * Text Domain:             woocommerce-visual-card
 * Domain Path:             languages/
 * License:                 GPLv2 or later
 * WC requires at least:    3.0.0
 * WC tested up to:         3.6.1
 */

if (!defined('ABSPATH')) {
    exit;
}

class WC_VisualCard {
    const VERSION = '1.0.5';
    const VERSION_MIN_PHP = '5.4';
    const VERSION_MIN_WP  = '4.7';
    const VERSION_MIN_WOO = '3.0';
    const PLUGIN_NAME     = 'Woocommerce Visual Card';
    const TEXT_DOMAIN     = 'woocommerce-visual-card';

    protected static $instance = null;

    public function __construct() {
        add_action('init', array($this, 'load_plugin_textdomain'));
        if ($this->check_dependency()){
            include_once 'includes/woocommerce-visual-card-manager.php';
            new WC_VisualCard_Manager();
        }
    }

    public function load_plugin_textdomain() {
        load_plugin_textdomain('woocommerce-visual-card', false, dirname( plugin_basename(__FILE__ )) . '/languages/');
    }

    public function check_dependency(){
        $error_num = 0;

        if (version_compare(self::get_php_version(), WC_VisualCard::VERSION_MIN_PHP, '<')){
            ++$error_num;
            add_action('admin_notices', array($this, 'notice_php'));
        }
        else{
            if (!class_exists('WooCommerce')) {
                ++$error_num;
                add_action('admin_notices', array($this, 'notice_woocommerce'));
            }
            elseif (version_compare($this->get_woo_version(), WC_VisualCard::VERSION_MIN_WOO, '<')){
                ++$error_num;
                add_action('admin_notices', array($this, 'notice_woocommerce_version'));
            }

            if (version_compare(get_bloginfo('version'), WC_VisualCard::VERSION_MIN_WP, '<')){
                ++$error_num;
                add_action('admin_notices', array($this, 'notice_wp'));
            }
        }

        return $error_num == 0;
    }


    //NOTICES

    public function notice_php() {
        include 'templates/missing-php-template.php';
    }

    public function notice_woocommerce() {
        include 'templates/missing-woocommerce-template.php';
    }

    public function notice_woocommerce_version() {
        include 'templates/missing-woocommerce-version-template.php';
    }

    public function notice_wp() {
        include 'templates/missing-wp-template.php';
    }

    public static function get_php_version(){
        $version = explode('.', PHP_VERSION);
        return $version[0] . '.' . $version[1];
    }

    public static function get_woo_version(){
        global $woocommerce;
        return $woocommerce->version;
    }

    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }

        return self::$instance;
    }
}

add_action('plugins_loaded', array('WC_VisualCard', 'get_instance'));