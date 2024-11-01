<?php

if (!defined('ABSPATH' )) {
    exit;
}

?>

<div class="error">
    <p><strong><?php _e(WC_BusinessPay::PLUGIN_NAME, 'woocommerce-businesspay'); ?></strong> <?php echo sprintf(__( 'depends on the Wordpress %s minimum version to work!', 'woocommerce-businesspay' ), WC_BusinessPay::VERSION_MIN_WP); ?></p>
</div>