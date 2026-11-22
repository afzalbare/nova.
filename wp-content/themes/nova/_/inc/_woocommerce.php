<?php
/**
 * WooCommerce Setup and Compatibility
 *
 * @package Nova
 */

function nova_woocommerce_setup() {
    // WooCommerce থিম সাপোর্ট চালু করা
    add_theme_support('woocommerce');

    // সিঙ্গেল প্রোডাক্ট পেজের গ্যালারি ফিচারগুলো সচল করা
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'nova_woocommerce_setup');
