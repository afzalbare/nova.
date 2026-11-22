<?php
/**
 * Gutenberg and ACF Blocks Registration
 *
 * @package Nova
 */

// 'blocks' ফোল্ডারের ভেতর থাকা সমস্ত ACF Block স্বয়ংক্রিয়ভাবে রেজিস্টার করার ফাংশন
function nova_register_acf_blocks() {
    $blocks_dir = get_template_directory() . '/blocks/';

    if (is_dir($blocks_dir)) {
        $blocks = scandir($blocks_dir);
        $blocks = array_diff($blocks, array('..', '.', '.DS_Store', '_base-block'));

        foreach ($blocks as $block) {
            $block_json = $blocks_dir . $block . '/block.json';
            if (file_exists($block_json)) {
                register_block_type($block_json);
            }
        }
    }
}
add_action('init', 'nova_register_acf_blocks', 5);


// ACF Options Page (পুরো সাইটের গ্লোবাল সেটিংস ম্যানেজ করার জন্য)
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Site Settings',
        'menu_title' => 'Site Settings',
        'menu_slug'  => 'site-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'icon_url'   => 'dashicons-admin-generic',
    ));
}
