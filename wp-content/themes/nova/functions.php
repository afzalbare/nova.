<?php

/**
 * Nova Theme Functions and Definitions
 *
 * @package Nova
 */

// -------------------------------------------------------------
// ১. বেসিক থিম সাপোর্ট (Basic Theme Setup)
// -------------------------------------------------------------
function nova_theme_setup()
{
    // ব্রাউজারের ট্যাবে স্বয়ংক্রিয় পেজ টাইটেল হ্যান্ডেল করার জন্য
    add_theme_support('title-tag');

    // পোস্ট ও পেজে ফিচারড ইমেজ (Thumbnail) সাপোর্ট করার জন্য
    add_theme_support('post-thumbnails');

    // সার্চ ফর্ম, কমেন্ট ফর্ম ইত্যাদিতে আধুনিক HTML5 মার্কআপ ব্যবহারের জন্য
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
}
add_action('after_setup_theme', 'nova_theme_setup');


// -------------------------------------------------------------
// ২. প্রয়োজনীয় মডিউল ইনক্লুড (Include Core Theme Modules)
// -------------------------------------------------------------

// গুটেনবার্গ এডিটর ও ACF কাস্টম ব্লক স্বয়ংক্রিয়ভাবে লোড করার জন্য
require get_template_directory() . '/_/inc/_gutenberg.php';

// হেডার ও ফুটার ন্যাভিগেশন মেনু রেজিস্ট্রেশনের জন্য
require get_template_directory() . '/_/inc/_register-navs.php';

// WooCommerce সাপোর্ট এবং এর কাস্টমাইজেশন পরিচালনার জন্য
require get_template_directory() . '/_/inc/_woocommerce.php';

// নিচের ফাইলগুলো ভবিষ্যতে প্রয়োজন হলে তৈরি করে আনকমেন্ট করতে পারেন:
// require get_template_directory() . '/_/inc/_custom-wpadmin.php'; // অ্যাডমিন প্যানেল কাস্টমাইজেশন
// require get_template_directory() . '/_/inc/_404-acf.php';         // 404 পেজের ACF সেটিংস
// require get_template_directory() . '/_/inc/_disable-comment.php'; // কমেন্ট অপশন বন্ধ রাখার জন্য


// -------------------------------------------------------------
// ৩. সিএসএস এবং জাভাস্ক্রিপ্ট লোড (Enqueue Styles & Scripts)
// -------------------------------------------------------------
function nova_site_styles_scripts()
{
    $theme_dir = get_template_directory();
    $theme_url = get_template_directory_uri();

    // Font Awesome CDN (আইকন প্রদর্শনের জন্য)
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), '6.4.2');

    // Swiper CSS (ব্যানার, প্রোডাক্ট বা টেস্টিমোনিয়াল স্লাইডারের জন্য)
    wp_enqueue_style('swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0');

    // Tailwind CSS - প্রধান কম্পাইল করা থিম স্টাইলশিট (nova.min.css)
    $css_file = $theme_dir . '/_/css/nova.min.css';
    $css_ver  = file_exists($css_file) ? filemtime($css_file) : '1.0.0';
    wp_enqueue_style('nova-theme-style', $theme_url . '/_/css/nova.min.css', array(), $css_ver);

    // Swiper JS (স্লাইডারের ফাংশনালিটির জন্য)
    wp_enqueue_script('swiper-script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true);


    // GSAP Core
    wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js', array(), '3.12.7', true);

    // ScrollTrigger (স্ক্রিনশটে থাকা ScrollTrigger প্লাগইন)
    wp_enqueue_script('gsap-scroll-trigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js', array('gsap'), '3.12.7', true);

    // Custom Theme JavaScript (main.js)
    $js_file = $theme_dir . '/_/js/main.js';
    $js_ver  = file_exists($js_file) ? filemtime($js_file) : '1.0.0';
    wp_enqueue_script('nova-custom-script', $theme_url . '/_/js/main.js', array('jquery', 'gsap', 'gsap-scroll-trigger'), $js_ver, true);
}
add_action('wp_enqueue_scripts', 'nova_site_styles_scripts');


// -------------------------------------------------------------
// ৪. ওয়ার্ডপ্রেস লগইন পেজে কাস্টম লোগো (Custom Login Page Logo)
// -------------------------------------------------------------
function nova_login_logo()
{
    $logo_url = get_template_directory_uri() . '/_/images/logo.png';
?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            background-image: url('<?php echo esc_url($logo_url); ?>');
            background-size: contain;
            height: 70px;
            width: 250px;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'nova_login_logo');


// লগইন পেজের লোগোতে হোভার করলে সাইটের নাম প্রদর্শনের জন্য
function nova_custom_login_title()
{
    return get_option('blogname');
}
add_filter('login_headertext', 'nova_custom_login_title');


// -------------------------------------------------------------
// ৫. হেল্পার ফাংশন (Helper Functions)
// -------------------------------------------------------------
// ksa: ব্লকে কাস্টম ক্লাস বা স্যানিটাইজড টেক্সট সুরক্ষিতভাবে প্রিন্ট করার জন্য
function ksa($content)
{
    echo wp_kses($content, array());
}
