<?php

if (!defined('ABSPATH')) {
    exit;
}

class WC_VisualCard_Manager {

    public function __construct() {
        add_action('wp_enqueue_scripts', array( $this, 'enqueue_visual_card'));
    }

    public function enqueue_visual_card() {
        if (is_checkout()){
            wp_enqueue_style('wc-visual-card-css', plugins_url('assets/css/jquery.card.min.css', plugin_dir_path(__FILE__)), array(), WC_VisualCard::VERSION, 'all');
            wp_enqueue_script('wc-visual-card-js', plugins_url('assets/js/jquery.card.js', plugin_dir_path(__FILE__)), array('jquery'), WC_VisualCard::VERSION, true);

            //BusinessPay
            wp_enqueue_style('wc-visual-card-businesspay-css', plugins_url('assets/css/jquery.card.businesspay.css', plugin_dir_path(__FILE__)), array(), WC_VisualCard::VERSION, 'all');
            wp_enqueue_script('wc-visual-card-businesspay-js', plugins_url('assets/js/jquery.card.businesspay.js', plugin_dir_path(__FILE__)), array('jquery'), WC_VisualCard::VERSION, true);
        }
    }
}