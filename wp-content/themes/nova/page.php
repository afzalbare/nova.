<?php
/**
 * The template for displaying all pages
 *
 * @package Nova
 */

get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();
        // Gutenberg ও ACF Blocks রেন্ডার করার জন্য the_content() অপরিহার্য
        the_content();
    endwhile;
endif;

get_footer();
