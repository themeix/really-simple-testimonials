<?php

// if direct access
if (!defined('ABSPATH')) {
    exit;
}

//Add Submenu Page

if (!function_exists('rst_testimonials_custom_submenu_page')) {
    function rst_testimonials_custom_submenu_page()
    {
        add_submenu_page('edit.php?post_type=rst_testimonial', esc_attr__('Doc & Support', 'really-simple-testimonials'), esc_attr__('Doc & Support','really-simple-testimonials'), 'manage_options', 'rst-support', 'rst_testimonials_custom_shortcode_callback');
    }
}


if (!function_exists('rst_testimonials_custom_shortcode_callback')) {
    function rst_testimonials_custom_shortcode_callback()
    {

        ?>
        <div class="wrap about-wrap full-width-layout">
            <h1><?php esc_attr_e('Welcome to Really Simple Testimonial', 'really-simple-testimonials'); ?></h1>
            <p id="tp_testimonials_shortcode_para">
            <p class="about-tex">
                <?php esc_attr_e("Thanks for installing our plugin super testimonial. If you have any Question or need any
            helps, please don't hesitate to post it on", 'really-simple-testimonials'); ?>
                <a href="https://www.themeix.com" target="_blank">
                    <?php esc_attr_e("WordPress.org Support Forum", 'really-simple-testimonials'); ?></a>
                <?php esc_attr_e("or", 'really-simple-testimonials'); ?> <a
                        href="https://www.themeix.com"
                        target="_blank"><?php esc_attr_e("Themeix.com Support Forum", 'really-simple-testimonials'); ?></a>.
            </p>
            <div class="changelog point-releases">
                <h3><?php esc_attr_e("Submit a Review", 'really-simple-testimonials'); ?></h3>
                <p><?php esc_attr_e("We spend plenty of time to develop a plugin like this and give you freely to make your life easier. If
                you like this plugin, please", 'really-simple-testimonials'); ?><a style="color:red;"
                                                                        href="https://www.themeix.com"
                                                                        target="_blank"> <?php esc_attr_e("rate it 5 stars", 'really-simple-testimonials'); ?></a>.
                    <?php esc_attr_e("If you have any problems with the", 'really-simple-testimonials'); ?>
                    <?php esc_attr_e("plugin, please", 'really-simple-testimonials'); ?> <a href="https://www.themeix.com"
                                                                         target="_blank"><?php esc_attr_e("let us know", 'really-simple-testimonials'); ?> </a><?php esc_attr_e("before leaving a review.", 'really-simple-testimonials'); ?>
                </p>
            </div>
            </p>
            <div class="testimonials_btn_area">
                <a target="_blank" href="https://www.themeix.com"
                   class="testimonials_btn"><?php esc_attr_e("Upgrade", 'really-simple-testimonials'); ?>
                    Pro</a>
                <a target="_blank" href="https://www.themeix.com"
                   class="testimonials_btn"><?php esc_attr_e("Live Preview", 'really-simple-testimonials'); ?></a>
                <a target="_blank" href="https://www.themeix.com"
                   class="testimonials_btn"><?php esc_attr_e("Documentation", 'really-simple-testimonials'); ?></a>
                <a target="_blank" href="https://www.themeix.com"
                   class="testimonials_btn"><?php esc_attr_e("Support", 'really-simple-testimonials'); ?></a><br/>
            </div>
        </div>
        <?php
    }
}

# Add the submenu page

add_action('admin_menu', 'rst_testimonials_custom_submenu_page');
