<?php
/**
 * Register Navigation Menus
 *
 * @package Nova
 */

function nova_register_menus() {
    register_nav_menus(
        array(
            'primary_menu' => esc_html__('Primary Menu', 'nova'),
            'footer_menu'  => esc_html__('Footer Menu', 'nova'),
        )
    );
}
add_action('init', 'nova_register_menus');
