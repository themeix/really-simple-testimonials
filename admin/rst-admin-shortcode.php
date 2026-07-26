<?php

// if direct access
if (!defined('ABSPATH')) {
    exit;
}


//Adding Short Code in Sub Menu

if (!function_exists('rts_testimonials_add_submenu_items')) {
    function rts_testimonials_add_submenu_items()
    {
        add_submenu_page('edit.php?post_type=rst_testimonial', esc_attr__('Generate Shortcode', 'really-simple-testimonials'), esc_attr__('Generate Shortcode', 'really-simple-testimonials'), 'manage_options', 'post-new.php?post_type=rst_shortcode');
    }
}

add_action('admin_menu', 'rts_testimonials_add_submenu_items');

if (!function_exists('rst_testimonials_shortcode_generator_type')) {
    function rst_testimonials_shortcode_generator_type()
    {

        // Set UI labels for Custom Post Type
        $labels = array(
            'name' => esc_attr_x('Testimonials', 'Post Type General Name', 'really-simple-testimonials'),
            'singular_name' => esc_attr_x('Testimonial', 'Post Type Singular Name', 'really-simple-testimonials'),
            'menu_name' => esc_attr__('Testimonials', 'really-simple-testimonials'),
            'parent_item_colon' => esc_attr__('Parent Shortcode', 'really-simple-testimonials'),
            'all_items' => esc_attr__('All Shortcode', 'really-simple-testimonials'),
            'view_item' => esc_attr__('View Shortcode', 'really-simple-testimonials'),
            'add_new_item' => esc_attr__('Generate Shortcode', 'really-simple-testimonials'),
            'add_new' => esc_attr__('Generate New Shortcode', 'really-simple-testimonials'),
            'edit_item' => esc_attr__('Edit Testimonial', 'really-simple-testimonials'),
            'update_item' => esc_attr__('Update Testimonial', 'really-simple-testimonials'),
            'search_items' => esc_attr__('Search Testimonial', 'really-simple-testimonials'),
            'not_found' => esc_attr__('Not Found', 'really-simple-testimonials'),
            'not_found_in_trash' => esc_attr__('Not found in Trash', 'really-simple-testimonials'),
        );

        // Set other options for Custom Post Type
        $args = array(
            'label' => esc_attr__('Testimonial Shortcode', 'really-simple-testimonials'),
            'description' => esc_attr__('Shortcode news and reviews', 'really-simple-testimonials'),
            'labels' => $labels,
            'supports' => array('title'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => 'edit.php?post_type=rst_testimonial',
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
        );
        // Registering your Custom Post Type
        register_post_type('rst_shortcode', $args);
    }
}
add_action('init', 'rst_testimonials_shortcode_generator_type');

if (!function_exists('rst_testimonials_shortcode_clmn')) {
    function rst_testimonials_shortcode_clmn($columns)
    {

        unset($columns['date']);

        return array_merge($columns,
            array(
                'rst_shortcode' => esc_attr__('Shortcode', 'really-simple-testimonials'),
                'rst_doshortcode' => esc_attr__('Template Shortcode', 'really-simple-testimonials'),
                "date" => esc_attr__('Date', 'really-simple-testimonials'),
            )
        );
    }
}
add_filter('manage_rst_shortcode_posts_columns', 'rst_testimonials_shortcode_clmn');

if (!function_exists('rst_testimonials_shortcode_clmn_display')) {
    function rst_testimonials_shortcode_clmn_display($rstcp_column, $post_id)
    {
        if ($rstcp_column == 'rst_shortcode') {
            ?>
            <input style="background:#ddd" type="text" onClick="this.select(); execCommand('copy');"
                   value="[rstpro <?php echo 'id=&quot;' . esc_attr($post_id) . '&quot;'; ?>]" readonly/>
            <?php
        }
        if ($rstcp_column == 'rst_doshortcode') {
            ?>
            <textarea readonly cols="40" rows="2" style="background:#ddd;"
                      onClick="this.select(); execCommand('copy');"><?php echo '<?php echo do_shortcode( "[rstpro id=';
                echo "'" . esc_attr($post_id) . "']";
                echo '" ); ?>'; ?></textarea>
            <?php
        }
    }
}
add_action('manage_rst_shortcode_posts_custom_column', 'rst_testimonials_shortcode_clmn_display', 10, 2);


# Register Testimonial Meta Box
if (!function_exists('rst_testimonial_shortcode_register_meta_boxes')) {
    function rst_testimonial_shortcode_register_meta_boxes()
    {
        $attend = array('rst_shortcode');
        add_meta_box(
            'custom_meta_box_id',
            esc_attr__('Testimonial Settings', 'really-simple-testimonials'),
            'rst_testimonials_display_post_type_func',
            $attend,
            'normal'
        );
    }
}
add_action('add_meta_boxes', 'rst_testimonial_shortcode_register_meta_boxes');

# Call Back Function...

if (!function_exists('rst_testimonials_display_post_type_func')) {
    function rst_testimonials_display_post_type_func($post, $args)
    {

        #Call get post meta.
        $testimonial_cat_name = get_post_meta($post->ID, 'testimonial_cat_name', true);
        $rst_testimonial_themes = get_post_meta($post->ID, 'rst_testimonial_themes', true);
        $rst_testimonial_theme_style = get_post_meta($post->ID, 'rst_testimonial_theme_style', true);
        $rst_order_by_option = get_post_meta($post->ID, 'rst_order_by_option', true);
        $rst_image_sizes = get_post_meta($post->ID, 'rst_image_sizes', true);
        $dpstotoal_items = get_post_meta($post->ID, 'dpstotoal_items', true);
        $rst_testimonial_textalign = get_post_meta($post->ID, 'rst_testimonial_textalign', true);
        $rst_img_show_hide = get_post_meta($post->ID, 'rst_img_show_hide', true);
        $rst_img_border_radius = get_post_meta($post->ID, 'rst_img_border_radius', true);
        $rst_imgborder_width_option = get_post_meta($post->ID, 'rst_imgborder_width_option', true);
        $rst_imgborder_color_option = get_post_meta($post->ID, 'rst_imgborder_color_option', true);
        $rst_name_color_option = get_post_meta($post->ID, 'rst_name_color_option', true);
        $rst_name_fontsize_option = get_post_meta($post->ID, 'rst_name_fontsize_option', true);
        $rst_name_font_case = get_post_meta($post->ID, 'rst_name_font_case', true);
        $rst_name_font_style = get_post_meta($post->ID, 'rst_name_font_style', true);
        $rst_designation_show_hide = get_post_meta($post->ID, 'rst_designation_show_hide', true);
        $rst_desig_fontsize_option = get_post_meta($post->ID, 'rst_desig_fontsize_option', true);
        $rst_designation_color_option = get_post_meta($post->ID, 'rst_designation_color_option', true);
        $rst_designation_case = get_post_meta($post->ID, 'rst_designation_case', true);
        $rst_designation_font_style = get_post_meta($post->ID, 'rst_designation_font_style', true);
        $rst_content_show_hide = get_post_meta($post->ID, 'rst_content_show_hide', true);
        $rst_content_color = get_post_meta($post->ID, 'rst_content_color', true);
        $rst_content_fontsize_option = get_post_meta($post->ID, 'rst_content_fontsize_option', true);
        $rst_content_bg_color = get_post_meta($post->ID, 'rst_content_bg_color', true);
        $rst_content_padding = get_post_meta($post->ID, 'rst_content_padding', true);
        $rst_content_border_radius = get_post_meta($post->ID, 'rst_content_border_radius', true);
        $rst_company_show_hide = get_post_meta($post->ID, 'rst_company_show_hide', true);
        $rst_company_url_color = get_post_meta($post->ID, 'rst_company_url_color', true);
        $rst_show_rating_option = get_post_meta($post->ID, 'rst_show_rating_option', true);
        $rst_show_item_bg_option = get_post_meta($post->ID, 'rst_show_item_bg_option', true);
        $rst_rating_color = get_post_meta($post->ID, 'rst_rating_color', true);
        $rst_item_bg_color = get_post_meta($post->ID, 'rst_item_bg_color', true);
        $rst_item_padding = get_post_meta($post->ID, 'rst_item_padding', true);
        $rst_item_border_radius = get_post_meta($post->ID, 'rst_item_border_radius', true);
        $rst_item_border_color = get_post_meta($post->ID, 'rst_item_border_color', true);
        $rst_rating_fontsize_option = get_post_meta($post->ID, 'rst_rating_fontsize_option', true);

        #Call get post meta for rst_slider settings.
        $item_no = get_post_meta($post->ID, 'item_no', true);
        $loop = get_post_meta($post->ID, 'loop', true);
        $margin = get_post_meta($post->ID, 'margin', true);
        $navigation = get_post_meta($post->ID, 'navigation', true);
        $pagination = get_post_meta($post->ID, 'pagination', true);
        $autoplay = get_post_meta($post->ID, 'autoplay', true);
        $autoplay_speed = get_post_meta($post->ID, 'autoplay_speed', true);
        $stop_hover = get_post_meta($post->ID, 'stop_hover', true);
        $itemsdesktop = get_post_meta($post->ID, 'itemsdesktop', true);
        $itemsdesktopsmall = get_post_meta($post->ID, 'itemsdesktopsmall', true);
        $itemsmobile = get_post_meta($post->ID, 'itemsmobile', true);
        $autoplaytimeout = get_post_meta($post->ID, 'autoplaytimeout', true);
        $nav_text_color = get_post_meta($post->ID, 'nav_text_color', true);
        $nav_text_color_hover = get_post_meta($post->ID, 'nav_text_color_hover', true);
        $nav_bg_color = get_post_meta($post->ID, 'nav_bg_color', true);
        $nav_bg_color_hover = get_post_meta($post->ID, 'nav_bg_color_hover', true);
        $navigation_align = get_post_meta($post->ID, 'navigation_align', true);
        $navigation_style = get_post_meta($post->ID, 'navigation_style', true);
        $pagination_bg_color = get_post_meta($post->ID, 'pagination_bg_color', true);
        $pagination_bg_color_active = get_post_meta($post->ID, 'pagination_bg_color_active', true);
        $pagination_align = get_post_meta($post->ID, 'pagination_align', true);
        $pagination_style = get_post_meta($post->ID, 'pagination_style', true);
        $nav_value = get_post_meta($post->ID, 'nav_value', true);

        $rst_dots = get_post_meta($post->ID, 'dots', true);
        $rst_dots_bg_color = get_post_meta($post->ID, 'dots_bg_color', true);
        $rst_dots_text_color = get_post_meta($post->ID, 'dots_text_color', true);

        $rst_testimonial_theme_style = ($rst_testimonial_theme_style) ? $rst_testimonial_theme_style : 1;
        $nav_text_color_hover = ($nav_text_color_hover) ? $nav_text_color_hover : '#020202';
        $nav_bg_color_hover = ($nav_bg_color_hover) ? $nav_bg_color_hover : '#F43F5E';
        $nav_bg_color = ($nav_bg_color) ? $nav_bg_color : '#f2bccc';
        $pagination_bg_color_active = ($pagination_bg_color_active) ? $pagination_bg_color_active : '#9e9e9e';
        $navigation_style = ($navigation_style) ? $navigation_style : '0';
        $pagination_style = ($pagination_style) ? $pagination_style : '0';


        //declare a nonce field
        wp_nonce_field('rst_short_code_mt_box_action', 'rst_short_code_mt_box_nonce');


        ?>
        <div class="tupsetings post-grid-metabox">

            <!-- <div class="wrap"> -->
            <ul class="tab-nav">
                <li nav="1" class="nav1 active"><?php esc_attr_e('Shortcodes', 'really-simple-testimonials'); ?></li>
                <li nav="2" class="nav2 "><?php esc_attr_e('Testimonial Query ', 'really-simple-testimonials'); ?></li>
                <li nav="3" class="nav3 "><?php esc_attr_e('General Settings ', 'really-simple-testimonials'); ?></li>
                <li nav="4" class="nav4 "><?php esc_attr_e('Slider Settings', 'really-simple-testimonials'); ?></li>
                <li nav="6" class="nav6"><?php esc_attr_e('Support & Doc', 'really-simple-testimonials'); ?></li>
            </ul> <!-- tab-nav end -->


            <ul class="box">
                <!-- Tab 1 -->
                <li   class="d-block box1 tab-box ">
                    <div class="option-box">
                        <p class="option-title"><?php esc_attr_e('Shortcode', 'really-simple-testimonials'); ?></p>
                        <p class="rst_option_alert"><?php esc_attr_e('Use a unique shortcode only one time in a same page / post', 'really-simple-testimonials'); ?></p>
                        <p class="option-info"><?php esc_attr_e('Copy this shortcode and paste on post, page or text widgets where you want to display Testimonial Showcase.', 'really-simple-testimonials'); ?></p>
                        <textarea readonly cols="50" rows="1"
                                  onClick="this.select(); execCommand('copy'); ">[rstpro <?php echo 'id="' . esc_attr($post->ID) . '"'; ?>]</textarea>
                        <br/><br/>
                        <p class="option-info"><?php esc_attr_e('PHP Code:', 'really-simple-testimonials'); ?></p>
                        <p class="option-info"><?php esc_attr_e('Use PHP code to your themes file to display Testimonial Showcase.', 'really-simple-testimonials'); ?></p>
                        <textarea readonly cols="50" rows="2"
                                  onClick="this.select(); execCommand('copy');"><?php echo '<?php echo do_shortcode("[rstpro id=';
                            echo "'" . esc_attr($post->ID) . "']";
                            echo '"); ?>'; ?></textarea>
                    </div>
                </li>
                <!-- Tab 2 -->
                <li   class="box2 tab-box ">
                    <div class="wrap">
                        <div class="option-box">
                            <p class="option-title"><?php esc_attr_e('Testimonial Query', 'really-simple-testimonials'); ?></p>
                            <table class="form-table">

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="testimonial_cat_name"><?php esc_attr_e('Categories', 'really-simple-testimonials'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <ul>
                                            <?php
                                            $args = array(
                                                'taxonomy' => 'rst_testimonial_category',
                                                'orderby' => 'name',
                                                'show_count' => 1,
                                                'pad_counts' => 1,
                                                'hierarchical' => 1,
                                                'echo' => 0
                                            );
                                            $allthecats = get_categories($args);

                                            foreach ($allthecats as $category):
                                                $cat_id = $category->cat_ID;
                                                $checked = (in_array($cat_id, ( array )$testimonial_cat_name) ? ' checked="checked"' : "");
                                                echo '<li id="cat-' . esc_attr($cat_id) . '"><input type="checkbox" name="testimonial_cat_name[]" id="' . esc_attr($cat_id) . '" value="' . esc_attr($cat_id) . '"' . esc_attr($checked) . '> <label for="' . esc_attr($cat_id) . '">' . esc_attr($category->cat_name) . '</label></li>';
                                            endforeach;
                                            ?>
                                        </ul>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Categories Names only show when you publish testimonial under any categories. You can select multiple categories if you want.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Testimonial Categories -->


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_testimonial_themes"><?php esc_attr_e('Select Theme', 'really-simple-testimonials'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_testimonial_themes" id="rst_testimonial_themes"
                                                class="timezone_string">

                                            <option value="1" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '1');
                                            } ?>><?php esc_attr_e('Theme 1 (Slider)', 'really-simple-testimonials') ?></option>

                                            <option value="2" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '2');
                                            } ?>><?php esc_attr_e('Theme 2 (Slider)', 'really-simple-testimonials') ?></option>


                                            <option value="3" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '3');
                                            } ?>><?php esc_attr_e('Theme 3 (Grid)', 'really-simple-testimonials') ?></option>

                                            <option value="4" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '4');
                                            } ?>><?php esc_attr_e('Theme 4 (Grid)', 'really-simple-testimonials') ?></option>

                                            <option value="5" <?php if (isset ($rst_testimonial_themes)) {
                                                selected($rst_testimonial_themes, '5');
                                            } ?>><?php esc_attr_e('Theme 5 (Grid)', 'really-simple-testimonials') ?></option>

                                        </select>

                                        <div id="rst_imagePreview" style="display: none;">
                                            <img src="" alt="screenshot" class="rst_testimonial_themes_img"/>

                                        </div>

                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Select a theme to display testimonials.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Testimonial Themes -->


                                <script type="text/javascript">
                                    ;(function ($) {
                                        $(document).ready(function () {
                                            $('#rst_testimonial_themes').on('change', function () {
                                                var theme = $(this).val();

                                                if (theme == '') {
                                                    $('#rst_imagePreview').hide();
                                                }

                                                if (theme == '1') {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo esc_url(plugin_dir_url(__FILE__) . 'templates/screenshots/theme_1.png'); ?>');
                                                }
                                                if (theme == '2') {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo esc_url(plugin_dir_url(__FILE__) . 'templates/screenshots/theme_2.png'); ?>');
                                                }
                                                if (theme == '3') {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo esc_url(plugin_dir_url(__FILE__) . 'templates/screenshots/theme_3.png'); ?>');
                                                }
                                                if (theme == '4') {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo esc_url(plugin_dir_url(__FILE__) . 'templates/screenshots/theme_4.png'); ?>');
                                                }
                                                if (theme == '5') {
                                                    $('#rst_imagePreview').show();
                                                    $('#rst_imagePreview img').attr('src', '<?php echo esc_url(plugin_dir_url(__FILE__) . 'templates/screenshots/theme_5.png'); ?>');
                                                }



                                            });
                                        });
                                    })(jQuery);

                                </script>


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="dpstotoal_items"><?php esc_attr_e('Display Total Items', 'really-simple-testimonials'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="number" name="dpstotoal_items" id="dpstotoal_items" maxlength="4"
                                               class="timezone_string" value="<?php if ($dpstotoal_items != '') {
                                            echo esc_attr($dpstotoal_items);
                                        } else {
                                            echo esc_attr('12');
                                        } ?>">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose maximum number of items you want to display', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Order By -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_order_by_option"><?php esc_attr_e('Order By', 'really-simple-testimonials'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_order_by_option" id="rst_order_by_option"
                                                class="timezone_string">
                                            <option value="title" <?php if (isset ($rst_order_by_option)) {
                                                selected($rst_order_by_option, 'title');
                                            } ?>><?php esc_attr_e('Title', 'really-simple-testimonials') ?></option>
                                            <option value="modified" <?php if (isset ($rst_order_by_option)) {
                                                selected($rst_order_by_option, 'modified');
                                            } ?>><?php esc_attr_e('Modified', 'really-simple-testimonials') ?></option>
                                            <option value="rand" <?php if (isset ($rst_order_by_option)) {
                                                selected($rst_order_by_option, 'rand');
                                            } ?>><?php esc_attr_e('Rand', 'really-simple-testimonials') ?></option>
                                            <option value="comment_count" <?php if (isset ($rst_order_by_option)) {
                                                selected($rst_order_by_option, 'comment_count');
                                            } ?>><?php esc_attr_e('Popularity', 'really-simple-testimonials'); ?></option>
                                        </select>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Order testimonials By (Title, Modified, Random or Popularity).', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Order By -->

                                <tr>
                                    <th>
                                        <label for="rst_image_sizes"><?php esc_attr_e('Image Sizes', 'really-simple-testimonials'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_image_sizes" id="rst_image_sizes" class="rst_image_sizes">
                                            <option value="thumbnail" <?php if (isset ($rst_image_sizes)) {
                                                selected($rst_image_sizes, 'thumbnail');
                                            } ?>><?php esc_attr_e('Thumbnail', 'really-simple-testimonials') ?></option>
                                            <option value="medium" <?php if (isset ($rst_image_sizes)) {
                                                selected($rst_image_sizes, 'medium');
                                            } ?>><?php esc_attr_e('Medium', 'really-simple-testimonials') ?></option>
                                            <option value="medium_large" <?php if (isset ($rst_image_sizes)) {
                                                selected($rst_image_sizes, 'medium_large');
                                            } ?>><?php esc_attr_e('Medium large', 'really-simple-testimonials') ?></option>
                                            <option value="large" <?php if (isset ($rst_image_sizes)) {
                                                selected($rst_image_sizes, 'large');
                                            } ?>><?php esc_attr_e('Large', 'really-simple-testimonials') ?></option>
                                            <option value="full" <?php if (isset ($rst_image_sizes)) {
                                                selected($rst_image_sizes, 'full');
                                            } ?>><?php esc_attr_e('Full', 'really-simple-testimonials') ?></option>
                                        </select>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose an image size to display perfectly', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Image Size -->

                            </table>
                        </div>
                    </div>
                </li>
                <!-- Tab 3 -->
                <li   class="box3 tab-box ">
                    <div class="wrap">
                        <div class="option-box">
                            <p class="option-title"><?php esc_attr_e('General Settings', 'really-simple-testimonials'); ?></p>
                            <table class="form-table">

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_testimonial_textalign"><?php esc_attr_e('Text Align', 'really-simple-testimonials'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="radio-three" name="rst_testimonial_textalign"
                                                   value="left" <?php if ($rst_testimonial_textalign == 'left') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="radio-three"><?php esc_attr_e('Left', 'really-simple-testimonials'); ?><span
                                                        class="mark"><?php esc_attr_e('Pro', 'really-simple-testimonials'); ?></span></label>
                                            <input type="radio" id="radio-four" name="rst_testimonial_textalign"
                                                   value="center" <?php if ($rst_testimonial_textalign == 'center') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="radio-four"><?php esc_attr_e('Center', 'really-simple-testimonials'); ?></label>
                                            <input type="radio" id="radio-five" name="rst_testimonial_textalign"
                                                   value="right" <?php if ($rst_testimonial_textalign == 'right') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="radio-five"><?php esc_attr_e('Right', 'really-simple-testimonials'); ?><span
                                                        class="mark"><?php esc_attr_e('Pro', 'really-simple-testimonials'); ?></span></label>
                                        </div>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose an option for the alignment of testimonials content.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Text Align -->

                                <!--=====================Name Area Start======================-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php esc_attr_e('Name Settings Area', 'really-simple-testimonials') ?></label>
                                        <hr/>
                                    </th>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_name_color_option"><?php esc_attr_e('Name Font Color', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_name_color_option" name="rst_name_color_option"
                                               value="<?php if ($rst_name_color_option != '') {
                                                   echo esc_attr($rst_name_color_option);
                                               } else {
                                                   echo esc_attr("#020202");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for testimonial givers name.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Name Color -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_name_fontsize_option"><?php esc_attr_e('Name Font Size', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="number" name="rst_name_fontsize_option"
                                               id="rst_name_fontsize_option"
                                               min="10" max="45" class="timezone_string" required
                                               value="<?php if ($rst_name_fontsize_option != '') {
                                                   echo esc_attr($rst_name_fontsize_option);
                                               } else {
                                                   echo esc_attr('16');
                                               } ?>"> <br/>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose a font size for testimonial name.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Name Font Size-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_name_font_case"><?php esc_attr_e('Name Text Transform', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_name_font_case" id="rst_name_font_case"
                                                class="timezone_string">
                                            <option value="none" <?php if (isset ($rst_name_font_case)) {
                                                selected($rst_name_font_case, 'none');
                                            } ?>><?php esc_attr_e('Default', 'really-simple-testimonials') ?></option>
                                            <option value="capitalize" <?php if (isset ($rst_name_font_case)) {
                                                selected($rst_name_font_case, 'capitalize');
                                            } ?>><?php esc_attr_e('Capitalize', 'really-simple-testimonials') ?></option>
                                            <option value="lowercase" <?php if (isset ($rst_name_font_case)) {
                                                selected($rst_name_font_case, 'lowercase');
                                            } ?>><?php esc_attr_e('Lowercase', 'really-simple-testimonials') ?></option>
                                            <option value="uppercase" <?php if (isset ($rst_name_font_case)) {
                                                selected($rst_name_font_case, 'uppercase');
                                            } ?>><?php esc_attr_e('Uppercase', 'really-simple-testimonials') ?></option>
                                        </select><br>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Select Name Text Transform', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End name text Transform -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_name_font_style"><?php esc_attr_e('Name Text Style', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_name_font_style" id="rst_name_font_style"
                                                class="timezone_string">
                                            <option value="normal" <?php if (isset ($rst_name_font_style)) {
                                                selected($rst_name_font_style, 'normal');
                                            } ?>><?php esc_attr_e('Default', 'really-simple-testimonials') ?></option>
                                            <option value="italic" <?php if (isset ($rst_name_font_style)) {
                                                selected($rst_name_font_style, 'italic');
                                            } ?>><?php esc_attr_e('Italic', 'really-simple-testimonials') ?></option>
                                        </select><br>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Select Name Text style', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr> <!-- End name text style -->


                                <!--=====================Name Area End======================-->


                                <!--=====================Image Area Start======================-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php esc_attr_e('Image Settings Area', 'really-simple-testimonials') ?></label>
                                        <hr/>
                                    </th>
                                </tr>


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_img_show_hide"><?php esc_attr_e('Image Option', 'really-simple-testimonials'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="rst_img_show" name="rst_img_show_hide"
                                                   value="1" <?php if ($rst_img_show_hide == 1 || $rst_img_show_hide == '') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="rst_img_show"><?php esc_attr_e('Show', 'really-simple-testimonials'); ?></label>
                                            <input type="radio" id="rst_img_hide" name="rst_img_show_hide"
                                                   value="2" <?php if ($rst_img_show_hide == 2) {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="rst_img_hide"><?php esc_attr_e('Hide', 'really-simple-testimonials'); ?><span
                                                        class="mark"><?php esc_attr_e('Pro', 'really-simple-testimonials'); ?></span></label>
                                        </div>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose one option whether you want to show or hide the image of testimonial giver.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Image -->

                                <tr valign="top" id="imgBorderController" style="<?php if ($rst_img_show_hide == 2) {
                                    echo esc_attr("display:none;");
                                } ?>">
                                    <th scope="row">
                                        <label for="rst_imgborder_width_option"><?php esc_attr_e('Image Border Width', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td>
                                        <input type="number" name="rst_imgborder_width_option" min="0" max="10"
                                               value="<?php if ($rst_imgborder_width_option != '') {
                                                   echo esc_attr($rst_imgborder_width_option);
                                               } else {
                                                   echo esc_attr('1');
                                               } ?>">
                                    </td>
                                </tr> <!-- End of image border width -->

                                <tr valign="top" id="imgColor_controller" style="<?php if ($rst_img_show_hide == 2) {
                                    echo esc_attr("display:none;");
                                } ?>">
                                    <th scope="row">
                                        <label for="rst_imgborder_color_option"><?php esc_attr_e('Image Border Color', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_imgborder_color_option"
                                               name="rst_imgborder_color_option"
                                               value="<?php if ($rst_imgborder_color_option != '') {
                                                   echo esc_attr($rst_imgborder_color_option);
                                               } else {
                                                   echo esc_attr("transparent");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for image border.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Name Color -->

                                <tr valign="top" id="imgRadius_controller" style="<?php if ($rst_img_show_hide == 2) {
                                    echo esc_attr("display:none;");
                                } ?>">
                                    <th scope="row">
                                        <label for="rst_testimonial_textalign"><?php esc_attr_e('Image Border Radius', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_img_border_radius" id="rst_img_border_radius"
                                                class="timezone_string">

                                            <option value="50%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '100%');
                                            } ?>><?php esc_attr_e('100%', 'really-simple-testimonials') ?></option>


                                            <option value="0%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '0%');
                                            } ?>><?php esc_attr_e('0%', 'really-simple-testimonials') ?></option>


                                            <option value="10%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '10%');
                                            } ?>><?php esc_attr_e('10%', 'really-simple-testimonials') ?></option>
                                            <option value="15%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '15%');
                                            } ?>><?php esc_attr_e('15%', 'really-simple-testimonials') ?></option>
                                            <option value="20%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '20%');
                                            } ?>><?php esc_attr_e('20%', 'really-simple-testimonials') ?></option>
                                            <option value="25%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '25%');
                                            } ?>><?php esc_attr_e('25%', 'really-simple-testimonials') ?></option>
                                            <option value="30%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '30%');
                                            } ?>><?php esc_attr_e('30%', 'really-simple-testimonials') ?></option>
                                            <option value="40%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '40%');
                                            } ?>><?php esc_attr_e('40%', 'really-simple-testimonials') ?></option>

                                            <option value="50%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '50%');
                                            } ?>><?php esc_attr_e('50%', 'really-simple-testimonials') ?></option>

                                            <option value="80%" <?php if (isset ($rst_img_border_radius)) {
                                                selected($rst_img_border_radius, '80%');
                                            } ?>><?php esc_attr_e('80%', 'really-simple-testimonials') ?></option>


                                        </select>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Select an option for border radius of the images.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Border Radius -->

                                <!--=====================Image Area End======================-->


                                <!--=====================Designation Area Start======================-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php esc_attr_e('Designation Settings Area', 'really-simple-testimonials') ?></label>
                                        <hr/>
                                    </th>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_show_hide"><?php esc_attr_e('Designation Option', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="rst_designation_show"
                                                   name="rst_designation_show_hide"
                                                   value="1" <?php if ($rst_designation_show_hide == 1 || $rst_designation_show_hide == '') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="rst_designation_show"><?php esc_attr_e('Show', 'really-simple-testimonials'); ?></label>
                                            <input type="radio" id="rst_designation_hide"
                                                   name="rst_designation_show_hide"
                                                   value="2" <?php if ($rst_designation_show_hide == 2) {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="rst_designation_hide"><?php esc_attr_e('Hide', 'really-simple-testimonials'); ?>
                                                <span class="mark"><?php esc_attr_e('Pro', 'really-simple-testimonials'); ?></span></label>
                                        </div>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose one option whether you want to show or hide the designation of testimonial giver.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>

                                <tr valign="top" id="desig_size_controller"
                                    style="<?php if ($rst_designation_show_hide == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_desig_fontsize_option"><?php esc_attr_e('Designation Font Size', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="number" name="rst_desig_fontsize_option"
                                               id="rst_desig_fontsize_option"
                                               min="10" max="45" class="timezone_string" required
                                               value="<?php if ($rst_desig_fontsize_option != '') {
                                                   echo esc_attr($rst_desig_fontsize_option);
                                               } else {
                                                   echo esc_attr('16');
                                               } ?>"> <br/>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose a font size for testimonial designation.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>


                                <!-- End Designation Font Size-->

                                <tr valign="top" id="desig_color_controller"
                                    style="<?php if ($rst_designation_show_hide == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_designation_color_option"><?php esc_attr_e('Designation Font Color', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_designation_color_option"
                                               name="rst_designation_color_option"
                                               value="<?php if ($rst_designation_color_option != '') {
                                                   echo esc_attr($rst_designation_color_option);
                                               } else {
                                                   echo esc_attr("#666666");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for testimonial givers designation.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>


                                <!-- End Designation Font Color -->

                                <tr id="desig_text_trans_controller" valign="top"
                                    style="<?php if ($rst_designation_show_hide == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_designation_case"><?php esc_attr_e('Designation Text Transform', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_designation_case" id="rst_designation_case"
                                                class="timezone_string">
                                            <option value="none" <?php if (isset ($rst_designation_case)) {
                                                selected($rst_designation_case, 'none');
                                            } ?>><?php esc_attr_e('Default', 'really-simple-testimonials') ?></option>
                                            <option value="capitalize" <?php if (isset ($rst_designation_case)) {
                                                selected($rst_designation_case, 'capitalize');
                                            } ?>><?php esc_attr_e('Capitalize', 'really-simple-testimonials') ?></option>
                                            <option value="lowercase" <?php if (isset ($rst_designation_case)) {
                                                selected($rst_designation_case, 'lowercase');
                                            } ?>><?php esc_attr_e('Lowercase', 'really-simple-testimonials') ?></option>
                                            <option value="uppercase" <?php if (isset ($rst_designation_case)) {
                                                selected($rst_designation_case, 'uppercase');
                                            } ?>><?php esc_attr_e('Uppercase', 'really-simple-testimonials') ?></option>
                                        </select><br>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Select Designation Text Transform', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>


                                <!-- End name text Transform -->

                                <tr valign="top" id="desig_text_style_controller"
                                    style="<?php if ($rst_designation_show_hide == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_designation_font_style"><?php esc_attr_e('Designation Text Style', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_designation_font_style" id="rst_designation_font_style"
                                                class="timezone_string">
                                            <option value="normal" <?php if (isset ($rst_designation_font_style)) {
                                                selected($rst_designation_font_style, 'normal');
                                            } ?>><?php esc_attr_e('Default', 'really-simple-testimonials') ?></option>
                                            <option value="italic" <?php if (isset ($rst_designation_font_style)) {
                                                selected($rst_designation_font_style, 'italic');
                                            } ?>><?php esc_attr_e('Italic', 'really-simple-testimonials') ?></option>
                                        </select><br>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Select Designation Text style', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr> <!-- End name text style -->


                                <!--=====================Designation Area End======================-->

                                <!--=====================Company Area Start======================-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php esc_attr_e('Company Settings Area', 'really-simple-testimonials') ?></label>
                                        <hr/>
                                    </th>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_company_show_hide"><?php esc_attr_e('Company URL Option', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="rst_company_show" name="rst_company_show_hide"
                                                   value="1" <?php if ($rst_company_show_hide == 1 || $rst_company_show_hide == '') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="rst_company_show"><?php esc_attr_e('Show', 'really-simple-testimonials'); ?></label>
                                            <input type="radio" id="rst_company_hide" name="rst_company_show_hide"
                                                   value="2" <?php if ($rst_company_show_hide == 2) {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="rst_company_hide"><?php esc_attr_e('Hide', 'really-simple-testimonials'); ?><span
                                                        class="mark"><?php esc_attr_e('Pro', 'really-simple-testimonials'); ?></span></label>
                                        </div>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose one option whether you want to show or hide the company name and URL of testimonial giver.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Company Profiles Show/Hide -->

                                <tr valign="top" id="url_controller" style="<?php if ($rst_company_show_hide == 2) {
                                    echo esc_attr("display:none;");
                                } ?>">
                                    <th scope="row">
                                        <label for="rst_company_url_color"><?php esc_attr_e('Company URL Color', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_company_url_color" name="rst_company_url_color"
                                               value="<?php if ($rst_company_url_color != '') {
                                                   echo esc_attr($rst_company_url_color);
                                               } else {
                                                   echo esc_attr("#666666");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for testimonial givers company name.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>
                                <!-- End Url  Color -->


                                <!--=====================Company Area Start======================-->


                                <!--=====================Content Area Start======================-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php esc_attr_e('Content Settings Area', 'really-simple-testimonials') ?></label>
                                        <hr/>
                                    </th>
                                </tr>


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_content_show_hide"><?php esc_attr_e('Content Option', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="rst_content_show" name="rst_content_show_hide"
                                                   value="1" <?php if ($rst_content_show_hide == 1 || $rst_content_show_hide == '') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="rst_content_show"><?php esc_attr_e('Show', 'really-simple-testimonials'); ?></label>
                                            <input type="radio" id="rst_content_hide" name="rst_content_show_hide"
                                                   value="2" <?php if ($rst_content_show_hide == 2) {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="rst_content_hide"><?php esc_attr_e('Hide', 'really-simple-testimonials'); ?>
                                                <span class="mark"><?php esc_attr_e('Pro', 'really-simple-testimonials'); ?></span></label>
                                        </div>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose one option whether you want to show or hide the designation of testimonial giver.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>


                                <tr valign="top" id="content_color_controller"
                                    style="<?php if ($rst_content_show_hide == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_content_color"><?php esc_attr_e('Content Font Color', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_content_color" name="rst_content_color"
                                               value="<?php if ($rst_content_color != '') {
                                                   echo esc_attr($rst_content_color);
                                               } else {
                                                   echo esc_attr("#000000");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for testimonial message.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Content Color -->

                                <tr valign="top" id="content_font_controller"
                                    style="<?php if ($rst_content_show_hide == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_content_fontsize_option"><?php esc_attr_e('Content Font Size', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="number" name="rst_content_fontsize_option"
                                               id="rst_content_fontsize_option" min="10" max="45"
                                               class="timezone_string"
                                               required value="<?php if ($rst_content_fontsize_option != '') {
                                            echo esc_attr($rst_content_fontsize_option);
                                        } else {
                                            echo esc_attr('16');
                                        } ?>"> <br/>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose a font size for testimonial message.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Content Font Size-->

                                <tr valign="top" id="content_bg_color_controller"
                                    style="<?php if ($rst_content_show_hide == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_content_bg_color"><?php esc_attr_e('Content Background Color', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_content_bg_color" name="rst_content_bg_color"
                                               value="<?php if ($rst_content_bg_color != '') {
                                                   echo esc_attr($rst_content_bg_color);
                                               } else {
                                                   echo esc_attr("transparent");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for content background.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>

                                <tr valign="top" id="content_padding_controller"
                                    style="<?php if ($rst_content_show_hide == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_content_padding"><?php esc_attr_e('Content Padding', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_content_padding" id="rst_content_padding"
                                                class="timezone_string">

                                            <option value="5" <?php if (isset ($rst_content_padding)) {
                                                selected($rst_content_padding, '5');
                                            } ?>><?php esc_attr_e('5px', 'really-simple-testimonials') ?></option>

                                            <option value="10" <?php if (isset ($rst_content_padding)) {
                                                selected($rst_content_padding, '10');
                                            } ?>><?php esc_attr_e('10px', 'really-simple-testimonials') ?></option>

                                            <option value="20" <?php if (isset ($rst_content_padding)) {
                                                selected($rst_content_padding, '20');
                                            } ?>><?php esc_attr_e('20px', 'really-simple-testimonials') ?></option>

                                        </select>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Select an option for content padding.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>
                                <!-- End Content Background Color -->

                                <tr valign="top" id="rst_content_border_radius_controller"
                                    style="<?php if ($rst_content_show_hide == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_content_border_radius"><?php esc_attr_e('Content Border Radius', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_content_border_radius" id="rst_content_border_radius"
                                                class="timezone_string">


                                            <option value="0%" <?php if (isset ($rst_content_border_radius)) {
                                                selected($rst_content_border_radius, '0%');
                                            } ?>><?php esc_attr_e('Default', 'really-simple-testimonials') ?></option>

                                            <option value="1%" <?php if (isset ($rst_content_border_radius)) {
                                                selected($rst_content_border_radius, '1%');
                                            } ?>><?php esc_attr_e('1%', 'really-simple-testimonials') ?></option>

                                            <option value="2%" <?php if (isset ($rst_content_border_radius)) {
                                                selected($rst_content_border_radius, '2%');
                                            } ?>><?php esc_attr_e('2%', 'really-simple-testimonials') ?></option>

                                            <option value="3%" <?php if (isset ($rst_content_border_radius)) {
                                                selected($rst_content_border_radius, '3%');
                                            } ?>><?php esc_attr_e('3%', 'really-simple-testimonials') ?></option>

                                        </select>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Select an option for border radius of the content.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>

                                <!--=====================Content Area End======================-->


                                <!--=====================Ratting Area Start======================-->


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php esc_attr_e('Rating Settings Area', 'really-simple-testimonials') ?></label>
                                        <hr/>
                                    </th>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_show_rating_option"><?php esc_attr_e('Rating Option', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="rst_show_rating_option"
                                                   name="rst_show_rating_option"
                                                   value="1" <?php if ($rst_show_rating_option == 1 || $rst_show_rating_option == '') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="rst_show_rating_option"><?php esc_attr_e('Show', 'really-simple-testimonials'); ?></label>
                                            <input type="radio" id="rst_hide_rating_option"
                                                   name="rst_show_rating_option"
                                                   value="2" <?php if ($rst_show_rating_option == 2) {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="rst_hide_rating_option"><?php esc_attr_e('Hide', 'really-simple-testimonials'); ?>
                                                <span class="mark"><?php esc_attr_e('Pro', 'really-simple-testimonials'); ?></span></label>
                                        </div>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose one option whether you want to show or hide the rating of testimonial giver.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Rating -->

                                <tr valign="top" id="rating_controller" style="<?php if ($rst_show_rating_option == 2) {
                                    echo esc_attr("display:none;");
                                } ?>">
                                    <th scope="row">
                                        <label for="rst_rating_color"><?php esc_attr_e('Rating Icon Color', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_rating_color" name="rst_rating_color"
                                               value="<?php if ($rst_rating_color != '') {
                                                   echo esc_attr($rst_rating_color);
                                               } else {
                                                   echo esc_attr("#ffa900");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for testimonial ratings.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Rating Color -->

                                <tr valign="top" id="rating_size_controller"
                                    style="<?php if ($rst_show_rating_option == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_rating_fontsize_option"><?php esc_attr_e('Rating Font Size', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="number" name="rst_rating_fontsize_option"
                                               id="rst_rating_fontsize_option" min="10" max="45" class="timezone_string"
                                               required value="<?php if ($rst_rating_fontsize_option != '') {
                                            echo esc_attr($rst_rating_fontsize_option);
                                        } else {
                                            echo esc_attr('16');
                                        } ?>"> <br/>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose a font size for testimonial ratings.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr><!-- End Content Font Size-->


                                <!--=====================Ratting Area End======================-->


                                <!--=====================Item Background Area Start======================-->


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_background"
                                               class="rst_area_info"><?php esc_attr_e('Item Background Settings Area', 'really-simple-testimonials') ?></label>
                                        <hr/>
                                    </th>
                                </tr>


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_show_item_bg_option"><?php esc_attr_e('Item Background', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="rst_show_item_bg_option"
                                                   name="rst_show_item_bg_option"
                                                   value="1" <?php if ($rst_show_item_bg_option == 1 || $rst_show_item_bg_option == '') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="rst_show_item_bg_option"><?php esc_attr_e('Show', 'really-simple-testimonials'); ?></label>
                                            <input type="radio" id="rst_hide_item_bg_option"
                                                   name="rst_show_item_bg_option"
                                                   value="2" <?php if ($rst_show_item_bg_option == 2) {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="rst_hide_item_bg_option"><?php esc_attr_e('Hide', 'really-simple-testimonials'); ?></label>
                                        </div>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose one option whether you want to show or hide background color for an item.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>


                                <tr valign="top" id="item_backg_color_controller"
                                    style="<?php if ($rst_show_item_bg_option == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_item_bg_color"><?php esc_attr_e('Background Color', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_item_bg_color" name="rst_item_bg_color"
                                               value="<?php if ($rst_item_bg_color != '') {
                                                   echo esc_attr($rst_item_bg_color);
                                               } else {
                                                   echo esc_attr("transparent");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for item background.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Item Background Color -->

                                <tr valign="top" id="item_padding_controller"
                                    style="<?php if ($rst_show_item_bg_option == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_item_padding"><?php esc_attr_e('Item Padding', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_item_padding" id="rst_item_padding"
                                                class="timezone_string">

                                            <option value="10" <?php if (isset ($rst_item_padding)) {
                                                selected($rst_item_padding, '10');
                                            } ?>><?php esc_attr_e('10px', 'really-simple-testimonials') ?></option>

                                            <option value="20" <?php if (isset ($rst_item_padding)) {
                                                selected($rst_item_padding, '20');
                                            } ?>><?php esc_attr_e('20px', 'really-simple-testimonials') ?></option>

                                            <option value="30" <?php if (isset ($rst_item_padding)) {
                                                selected($rst_item_padding, '30');
                                            } ?>><?php esc_attr_e('30px', 'really-simple-testimonials') ?></option>

                                        </select>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Select Padding for items.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Item Padding -->

                                <tr valign="top" id="rst_item_border_radius_controller"
                                    style="<?php if ($rst_show_item_bg_option == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_item_border_radius"><?php esc_attr_e('Item Border Radius', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="rst_item_border_radius" id="rst_item_border_radius"
                                                class="timezone_string">


                                            <option value="0%" <?php if (isset ($rst_item_border_radius)) {
                                                selected($rst_item_border_radius, '0%');
                                            } ?>><?php esc_attr_e('Default', 'really-simple-testimonials') ?></option>

                                            <option value="1%" <?php if (isset ($rst_item_border_radius)) {
                                                selected($rst_item_border_radius, '1%');
                                            } ?>><?php esc_attr_e('1%', 'really-simple-testimonials') ?></option>

                                            <option value="2%" <?php if (isset ($rst_item_border_radius)) {
                                                selected($rst_item_border_radius, '2%');
                                            } ?>><?php esc_attr_e('2%', 'really-simple-testimonials') ?></option>

                                            <option value="3%" <?php if (isset ($rst_item_border_radius)) {
                                                selected($rst_item_border_radius, '3%');
                                            } ?>><?php esc_attr_e('3%', 'really-simple-testimonials') ?></option>

                                        </select>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Select an option for border radius of the Item.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Item Border Radius-->


                                <tr valign="top" id="item_border_color_controller"
                                    style="<?php if ($rst_show_item_bg_option == 2) {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="rst_item_border_color"><?php esc_attr_e('Border Color', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="rst_item_border_color" name="rst_item_border_color"
                                               value="<?php if ($rst_item_border_color != '') {
                                                   echo esc_attr($rst_item_border_color);
                                               } else {
                                                   echo esc_attr("#E8E8E8");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for item border.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>

                                <!-- End Item Border Color -->
                            </table>
                        </div>
                    </div>
                </li>
                <!-- Tab 4 -->
                <li   class="box4 tab-box ">
                    <div class="wrap">
                        <div class="option-box">
                            <p class="option-title"><?php esc_attr_e('Slider Settings', 'really-simple-testimonials'); ?></p>
                            <table class="form-table">
                                <tr valign="top">
                                    <th scope="row">
                                        <label for="autoplay"><?php esc_attr_e('Autoplay', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="autoplay_true" name="autoplay"
                                                   value="true" <?php if ($autoplay == 'true' || $autoplay == '') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="autoplay_true"><?php esc_attr_e('Yes', 'really-simple-testimonials'); ?></label>
                                            <input type="radio" id="autoplay_false" name="autoplay"
                                                   value="false" <?php if ($autoplay == 'false') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="autoplay_false"><?php esc_attr_e('No', 'really-simple-testimonials'); ?></label>
                                        </div>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose an option whether you want the rst_slider autoplay or not.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr> <!-- End Autoplay -->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="autoplay_speed"><?php esc_attr_e('Slide Delay', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;" class="auto_play">

                                        <input type="range" step="100" min="100" max="5000"
                                               value="<?php if ($autoplay_speed != '') {
                                                   echo esc_attr($autoplay_speed);
                                               } else {
                                                   echo esc_attr('700');
                                               } ?>" class="slider" id="myRange"><br>
                                        <input size="5" type="text" name="autoplay_speed" id="autoplay_speed"
                                               maxlength="4"
                                               class="timezone_string" readonly
                                               value="<?php if ($autoplay_speed != '') {
                                                   echo esc_attr($autoplay_speed);
                                               } else {
                                                   echo esc_attr('700');
                                               } ?>">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Select a value for sliding speed.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr> <!-- End Slide Delay -->


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="item_no"><?php esc_attr_e('Items No', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <select name="item_no" id="item_no" class="timezone_string">
                                            <option value="3" <?php if (isset ($item_no)) {
                                                selected($item_no, '3');
                                            } ?>><?php esc_attr_e('3', 'really-simple-testimonials') ?></option>
                                            <option value="1" <?php if (isset ($item_no)) {
                                                selected($item_no, '1');
                                            } ?>><?php esc_attr_e('1', 'really-simple-testimonials') ?></option>
                                            <option value="2" <?php if (isset ($item_no)) {
                                                selected($item_no, '2');
                                            } ?>><?php esc_attr_e('2', 'really-simple-testimonials') ?></option>
                                            <option value="4" <?php if (isset ($item_no)) {
                                                selected($item_no, '4');
                                            } ?>><?php esc_attr_e('4', 'really-simple-testimonials') ?></option>
                                            <option value="5" <?php if (isset ($item_no)) {
                                                selected($item_no, '5');
                                            } ?>><?php esc_attr_e('5', 'really-simple-testimonials') ?></option>

                                        </select>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Select number of items you want to show.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr> <!-- End Items No -->


                                <!--DOTS AREA SETTINGS START-->

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php esc_attr_e('Dots Settings Area', 'really-simple-testimonials') ?></label>
                                        <hr/>
                                    </th>
                                </tr>


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="dots"><?php esc_attr_e('Dots', 'really-simple-testimonials'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="dots_true" name="dots"
                                                   value="true" <?php if ($rst_dots == 'true' || $rst_dots == '') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="dots_true"><?php esc_attr_e('Yes', 'really-simple-testimonials'); ?></label>
                                            <input type="radio" id="dots_false" name="dots"
                                                   value="false" <?php if ($rst_dots == 'false') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="dots_false"><?php esc_attr_e('No', 'really-simple-testimonials'); ?><span
                                                        class="mark"><?php esc_attr_e('Pro', 'really-simple-testimonials'); ?></span></label>
                                        </div>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose an option whether you want dots option or not.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>


                                <tr valign="top" id="dots_color_controller" style="<?php if ($rst_dots == 'false') {
                                    echo esc_attr("display:none;");
                                } ?>">
                                    <th scope="row">
                                        <label for="dots_text_color"><?php esc_attr_e('Inactive Dots Color', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="dots_text_color" size="5" type="text"
                                               name="dots_text_color"
                                               value="<?php if ($rst_dots_text_color != '') {
                                                   echo esc_attr($rst_dots_text_color);
                                               } else {
                                                   echo esc_attr("#f2bccc");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for Inactive Dots.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>
                                <!--End Dots Color-->


                                <tr valign="top" id="dots_bgcolor_controller" style="<?php if ($rst_dots == 'false') {
                                    echo esc_attr("display:none;");
                                } ?>">
                                    <th scope="row">
                                        <label for="dots_bg_color"><?php esc_attr_e('Active Dot Color', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input id="dots_bg_color" type="text" name="dots_bg_color"
                                               value="<?php if ($rst_dots_bg_color != '') {
                                                   echo esc_attr($rst_dots_bg_color);
                                               } else {
                                                   echo esc_attr("#e45a7e");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for Active dots.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>
                                <!--End Dots Background Color-->

                                <!--DOTS AREA SETTINGS END-->


                                <!--Navigation AREA SETTINGS START-->


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="rst_designation_designation"
                                               class="rst_area_info"><?php esc_attr_e('Navigation Settings Area', 'really-simple-testimonials') ?></label>
                                        <hr/>
                                    </th>
                                </tr>


                                <tr valign="top">
                                    <th scope="row">
                                        <label for="navigation"><?php esc_attr_e('Navigation', 'really-simple-testimonials'); ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <div class="switch-field">
                                            <input type="radio" id="navigation_true" name="navigation"
                                                   value="true" <?php if ($navigation == 'true' || $navigation == '') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="navigation_true"><?php esc_attr_e('Yes', 'really-simple-testimonials'); ?></label>
                                            <input type="radio" id="navigation_false" name="navigation"
                                                   value="false" <?php if ($navigation == 'false') {
                                                echo esc_attr('checked');
                                            } ?>/>
                                            <label for="navigation_false"><?php esc_attr_e('No', 'really-simple-testimonials'); ?><span
                                                        class="mark"><?php esc_attr_e('Pro', 'really-simple-testimonials'); ?></span></label>
                                        </div>
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Choose an option whether you want navigation option or not.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>
                                <!-- End Navigation -->


                                <tr valign="top" id="navi_color_controller" style="<?php if ($navigation == 'false') {
                                    echo esc_attr("display:none;");
                                } ?>">
                                    <th scope="row">
                                        <label for="nav_text_color"><?php esc_attr_e('Navigation Color', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input type="text" id="nav_text_color" size="5" type="text"
                                               name="nav_text_color"
                                               value="<?php if ($nav_text_color != '') {
                                                   echo esc_attr($nav_text_color);
                                               } else {
                                                   echo esc_attr("#E8E8E8");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for navigation tool.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>
                                <!-- End Navigation Color -->

                                <tr valign="top" id="navi_bgcolor_controller" style="<?php if ($navigation == 'false') {
                                    echo esc_attr("display:none;");
                                } ?>">
                                    <th scope="row">
                                        <label for="nav_bg_color"><?php esc_attr_e('Navigation Background', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input id="nav_bg_color" type="text" name="nav_bg_color"
                                               value="<?php if ($nav_bg_color != '') {
                                                   echo esc_attr($nav_bg_color);
                                               } else {
                                                   echo esc_attr("#f2bccc");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for background of navigation tool.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>
                                <!-- End Navigation Background Color -->


                                <tr valign="top" id="navi_bgcolor_hover_controller"
                                    style="<?php if ($navigation == 'false') {
                                        echo esc_attr("display:none;");
                                    } ?>">
                                    <th scope="row">
                                        <label for="nav_bg_color_hover"><?php esc_attr_e('Navigation Hover Background', 'really-simple-testimonials') ?></label>
                                    </th>
                                    <td style="vertical-align: middle;">
                                        <input id="nav_bg_color_hover" type="text" name="nav_bg_color_hover"
                                               value="<?php if ($nav_bg_color_hover != '') {
                                                   echo esc_attr($nav_bg_color_hover);
                                               } else {
                                                   echo esc_attr("#F43F5E");
                                               } ?>" class="timezone_string">
                                        <span class="really-simple-testimonials-manager_hint"><?php echo esc_attr__('Pick a color for background of navigation tool in hover.', 'really-simple-testimonials'); ?></span>
                                    </td>
                                </tr>
                                <!-- End Navigation Hover Background Color -->
                            </table>
                        </div>
                    </div>
                </li>

                <!-- Tab 6 -->
                <li class="box6 tab-box ">
                    <div class="wrap">
                        <div class="option-box">
                            <p class="option-title"><?php esc_attr_e('Support & Documentation', 'really-simple-testimonials'); ?></p>
                            <div class="testimoinal-pro-features">
                                <div class="help-support">
                                    <div class="support-items">
                                        <div class="support-title">
                                            <?php echo esc_attr__('Need Support', 'really-simple-testimonials'); ?>
                                        </div>
                                        <div class="support-details">
                                            <p><?php echo esc_attr__('If you need any helps, please don\'t hesitate to post it on WordPress.org Support Forum or Themeix Support Forum', 'really-simple-testimonials'); ?></p>
                                        </div>
                                        <div class="support-link">
                                            <a target="_blank"
                                               href="https://wordpress.org/support/plugin/"
                                               class="button-1"><?php echo esc_attr__('WordPress.org', 'really-simple-testimonials') ?></a>
                                            <a target="_blank" href="https://themeix.com"
                                               class="button-1"><?php echo esc_attr__('Themeix.com', 'really-simple-testimonials') ?></a>
                                        </div>
                                    </div>
                                    <div class="support-items">
                                        <div class="support-title">
                                            <?php echo esc_attr__('Happy User', 'really-simple-testimonials'); ?>
                                        </div>
                                        <div class="support-details">
                                            <p><?php echo esc_attr__('If you are happy with the Testimonial Plugin, say it on wordpress.org and give RST Testimonial a nice review!', 'really-simple-testimonials'); ?></p>
                                        </div>
                                        <div class="support-link">
                                            <a target="_blank"
                                               href="https://wordpress.org/support/plugin">
                                                <div class="reviewteam">
                                                    <span class="dashicons dashicons-star-filled"></span>
                                                    <span class="dashicons dashicons-star-filled"></span>
                                                    <span class="dashicons dashicons-star-filled"></span>
                                                    <span class="dashicons dashicons-star-filled"></span>
                                                    <span class="dashicons dashicons-star-filled"></span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function (jQuery) {
                jQuery('#rst_item_bg_color, #rst_rating_color, #rst_content_bg_color, #rst_content_color, #rst_company_url_color, #rst_designation_color_option, #rst_name_color_option, #rst_imgborder_color_option, #nav_text_color, #nav_bg_color, #nav_text_color_hover, #nav_bg_color_hover, #pagination_bg_color, #pagination_bg_color_active,  #rst_item_border_color, #dots_bg_color, #dots_text_color').wpColorPicker();
            });
        </script>


    <?php }   //
}

# Data save in custom metabox field
if(!function_exists('rst_testimonial_meta_box_save_func')) {
    function rst_testimonial_meta_box_save_func($post_id)
    {
        #check nonce
        if (!isset($_POST['rst_short_code_mt_box_nonce']) || !wp_verify_nonce(wp_unslash($_POST['rst_short_code_mt_box_nonce']), 'rst_short_code_mt_box_action')) {
            return;
        }


        # Doing autosave then return.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        #Checks for input and saves if needed
        if (isset($_POST['testimonial_cat_name'])) {
            update_post_meta($post_id, 'testimonial_cat_name', array_map('sanitize_text_field', wp_unslash($_POST['testimonial_cat_name'])));
        } else {
            delete_post_meta($post_id, 'testimonial_cat_name');
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_name_color_option'])) {
            update_post_meta($post_id, 'rst_name_color_option', sanitize_hex_color(wp_unslash($_POST['rst_name_color_option'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_designation_color_option'])) {
            update_post_meta($post_id, 'rst_designation_color_option', sanitize_hex_color(wp_unslash($_POST['rst_designation_color_option'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_testimonial_themes'])) {
            update_post_meta($post_id, 'rst_testimonial_themes', sanitize_text_field(wp_unslash($_POST['rst_testimonial_themes'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_testimonial_theme_style'])) {
            update_post_meta($post_id, 'rst_testimonial_theme_style', sanitize_text_field(wp_unslash($_POST['rst_testimonial_theme_style'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_testimonial_textalign'])) {
            update_post_meta($post_id, 'rst_testimonial_textalign', sanitize_text_field(wp_unslash($_POST['rst_testimonial_textalign'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_order_by_option'])) {
            update_post_meta($post_id, 'rst_order_by_option', sanitize_text_field(wp_unslash($_POST['rst_order_by_option'])));
        }
        #Checks for input and saves if needed
        if (isset($_POST['rst_image_sizes'])) {
            update_post_meta($post_id, 'rst_image_sizes', sanitize_text_field(wp_unslash($_POST['rst_image_sizes'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['dpstotoal_items'])) {
            update_post_meta($post_id, 'dpstotoal_items', sanitize_text_field(wp_unslash($_POST['dpstotoal_items'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_img_show_hide'])) {
            update_post_meta($post_id, 'rst_img_show_hide', sanitize_text_field(wp_unslash($_POST['rst_img_show_hide'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_img_border_radius'])) {
            update_post_meta($post_id, 'rst_img_border_radius', sanitize_text_field(wp_unslash($_POST['rst_img_border_radius'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_imgborder_width_option'])) {
            update_post_meta($post_id, 'rst_imgborder_width_option', sanitize_text_field(wp_unslash($_POST['rst_imgborder_width_option'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_imgborder_color_option'])) {
            update_post_meta($post_id, 'rst_imgborder_color_option', sanitize_hex_color(wp_unslash($_POST['rst_imgborder_color_option'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_designation_show_hide'])) {
            update_post_meta($post_id, 'rst_designation_show_hide', sanitize_text_field(wp_unslash($_POST['rst_designation_show_hide'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_company_show_hide'])) {
            update_post_meta($post_id, 'rst_company_show_hide', sanitize_text_field(wp_unslash($_POST['rst_company_show_hide'])));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_company_url_color'])) {
            update_post_meta($post_id, 'rst_company_url_color', sanitize_hex_color(wp_unslash($_POST['rst_company_url_color'])));
        }

        #Checks for input and saves
        if (isset($_POST['rst_name_fontsize_option'])) {
            update_post_meta($post_id, 'rst_name_fontsize_option', sanitize_text_field(wp_unslash($_POST['rst_name_fontsize_option'])));
        }

        #Checks for input and saves
        if (isset($_POST['rst_name_font_case'])) {
            update_post_meta($post_id, 'rst_name_font_case', sanitize_text_field(wp_unslash($_POST['rst_name_font_case'])));
        }

        #Checks for input and saves
        if (isset($_POST['rst_name_font_style'])) {
            update_post_meta($post_id, 'rst_name_font_style', sanitize_text_field(wp_unslash($_POST['rst_name_font_style'])));
        }

        #Checks for input and saves
        if (isset($_POST['rst_designation_case'])) {
            update_post_meta($post_id, 'rst_designation_case', sanitize_text_field(wp_unslash($_POST['rst_designation_case'])));
        }

        #Checks for input and saves
        if (isset($_POST['rst_designation_font_style'])) {
            update_post_meta($post_id, 'rst_designation_font_style', sanitize_text_field($_POST['rst_designation_font_style']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_desig_fontsize_option'])) {
            update_post_meta($post_id, 'rst_desig_fontsize_option', sanitize_text_field($_POST['rst_desig_fontsize_option']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_content_show_hide'])) {
            update_post_meta($post_id, 'rst_content_show_hide', sanitize_text_field($_POST['rst_content_show_hide']));
        }


        #Checks for input and saves
        if (isset($_POST['rst_content_fontsize_option'])) {
            update_post_meta($post_id, 'rst_content_fontsize_option', sanitize_text_field($_POST['rst_content_fontsize_option']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_content_bg_color'])) {
            update_post_meta($post_id, 'rst_content_bg_color', sanitize_hex_color(wp_unslash($_POST['rst_content_bg_color'])));
        }

        #Checks for input and saves
        if (isset($_POST['rst_content_padding'])) {
            update_post_meta($post_id, 'rst_content_padding', sanitize_text_field($_POST['rst_content_padding']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_rating_fontsize_option'])) {
            update_post_meta($post_id, 'rst_rating_fontsize_option', sanitize_text_field($_POST['rst_rating_fontsize_option']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_content_color'])) {
            update_post_meta($post_id, 'rst_content_color', sanitize_hex_color(wp_unslash($_POST['rst_content_color'])));
        }

        #Checks for input and saves
        if (isset($_POST['rst_content_border_radius'])) {
            update_post_meta($post_id, 'rst_content_border_radius', sanitize_text_field($_POST['rst_content_border_radius']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_show_rating_option'])) {
            update_post_meta($post_id, 'rst_show_rating_option', sanitize_text_field($_POST['rst_show_rating_option']));
        }

        #Checks for input and saves if needed
        if (isset($_POST['rst_show_item_bg_option'])) {
            update_post_meta($post_id, 'rst_show_item_bg_option', sanitize_text_field($_POST['rst_show_item_bg_option']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_rating_color'])) {
            update_post_meta($post_id, 'rst_rating_color', sanitize_hex_color(wp_unslash($_POST['rst_rating_color'])));
        }

        #Checks for input and saves
        if (isset($_POST['rst_item_bg_color'])) {
            update_post_meta($post_id, 'rst_item_bg_color', sanitize_hex_color(wp_unslash($_POST['rst_item_bg_color'])));
        }
        #Checks for input and saves
        if (isset($_POST['rst_item_padding'])) {
            update_post_meta($post_id, 'rst_item_padding', sanitize_text_field($_POST['rst_item_padding']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_item_border_radius'])) {
            update_post_meta($post_id, 'rst_item_border_radius', sanitize_text_field($_POST['rst_item_border_radius']));
        }

        #Checks for input and saves
        if (isset($_POST['rst_item_border_color'])) {
            update_post_meta($post_id, 'rst_item_border_color', sanitize_hex_color(wp_unslash($_POST['rst_item_border_color'])));
        }

        // Carousal Settings

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['item_no']) && ($_POST['item_no'] != '')) {
            update_post_meta($post_id, 'item_no', sanitize_text_field($_POST['item_no']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['loop']) && ($_POST['loop'] != '')) {
            update_post_meta($post_id, 'loop', sanitize_text_field($_POST['loop']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['margin'])) {
            //print_r($_POST['margin']);die();
            update_post_meta($post_id, 'margin', sanitize_text_field($_POST['margin']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['dots']) && ($_POST['dots'] != '')) {
            update_post_meta($post_id, 'dots', sanitize_text_field($_POST['dots']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['dots_text_color']) && ($_POST['dots_text_color'] != '')) {
            update_post_meta($post_id, 'dots_text_color', sanitize_hex_color(wp_unslash($_POST['dots_text_color'])));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['dots_bg_color']) && ($_POST['dots_bg_color'] != '')) {
            update_post_meta($post_id, 'dots_bg_color', sanitize_hex_color(wp_unslash($_POST['dots_bg_color'])));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['navigation']) && ($_POST['navigation'] != '')) {
            update_post_meta($post_id, 'navigation', sanitize_text_field($_POST['navigation']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['navigation_align']) && ($_POST['navigation_align'] != '')) {
            update_post_meta($post_id, 'navigation_align', sanitize_text_field($_POST['navigation_align']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['navigation_style']) && ($_POST['navigation_style'] != '')) {
            update_post_meta($post_id, 'navigation_style', sanitize_text_field($_POST['navigation_style']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['pagination']) && ($_POST['pagination'] != '')) {
            update_post_meta($post_id, 'pagination', sanitize_text_field($_POST['pagination']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['pagination_align']) && ($_POST['pagination_align'] != '')) {
            update_post_meta($post_id, 'pagination_align', sanitize_text_field($_POST['pagination_align']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['pagination_style']) && ($_POST['pagination_style'] != '')) {
            update_post_meta($post_id, 'pagination_style', sanitize_text_field($_POST['pagination_style']));
        }


        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['pagination_bg_color']) && ($_POST['pagination_bg_color'] != '')) {
            update_post_meta($post_id, 'pagination_bg_color', sanitize_hex_color(wp_unslash($_POST['pagination_bg_color'])));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['pagination_bg_color_active']) && ($_POST['pagination_bg_color_active'] != '')) {
            update_post_meta($post_id, 'pagination_bg_color_active', sanitize_hex_color(wp_unslash($_POST['pagination_bg_color_active'])));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['autoplay']) && ($_POST['autoplay'] != '')) {
            update_post_meta($post_id, 'autoplay', sanitize_text_field($_POST['autoplay']));
        }

        #Checks for input and sanitizes/saves if needed
        if (!empty($_POST['autoplay_speed'])) {
            if (strlen($_POST['autoplay_speed']) > 4) {

            } else {

                if ($_POST['autoplay_speed'] == '' || is_null($_POST['autoplay_speed'])) {

                    update_post_meta($post_id, 'autoplay_speed', 700);
                } else {
                    if (is_numeric($_POST['autoplay_speed']) && strlen($_POST['autoplay_speed']) <= 4) {

                        update_post_meta($post_id, 'autoplay_speed', sanitize_text_field($_POST['autoplay_speed']));

                    }
                }
            }
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['stop_hover']) && ($_POST['stop_hover'] != '')) {
            update_post_meta($post_id, 'stop_hover', sanitize_text_field($_POST['stop_hover']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['itemsdesktop']) && ($_POST['itemsdesktop'] != '')) {
            update_post_meta($post_id, 'itemsdesktop', sanitize_text_field($_POST['itemsdesktop']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['itemsdesktopsmall']) && ($_POST['itemsdesktopsmall'] != '')) {
            update_post_meta($post_id, 'itemsdesktopsmall', sanitize_text_field($_POST['itemsdesktopsmall']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['itemsmobile']) && ($_POST['itemsmobile'] != '')) {
            update_post_meta($post_id, 'itemsmobile', sanitize_text_field($_POST['itemsmobile']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['autoplaytimeout']) && ($_POST['autoplaytimeout'] != '')) {
            update_post_meta($post_id, 'autoplaytimeout', sanitize_text_field($_POST['autoplaytimeout']));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['nav_text_color']) && ($_POST['nav_text_color'] != '')) {
            update_post_meta($post_id, 'nav_text_color', sanitize_hex_color(wp_unslash($_POST['nav_text_color'])));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['nav_text_color_hover']) && ($_POST['nav_text_color_hover'] != '')) {
            update_post_meta($post_id, 'nav_text_color_hover', sanitize_hex_color(wp_unslash($_POST['nav_text_color_hover'])));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['nav_bg_color']) && ($_POST['nav_bg_color'] != '')) {
            update_post_meta($post_id, 'nav_bg_color', sanitize_hex_color(wp_unslash($_POST['nav_bg_color'])));
        }

        #Checks for input and sanitizes/saves if needed
        if (isset($_POST['nav_bg_color_hover']) && ($_POST['nav_bg_color_hover'] != '')) {
            update_post_meta($post_id, 'nav_bg_color_hover', sanitize_hex_color(wp_unslash($_POST['nav_bg_color_hover'])));
        }

        #Value check and saves if needed
        if (isset($_POST['nav_value'])) {
            update_post_meta($post_id, 'nav_value', sanitize_text_field($_POST['nav_value']));
        } else {
            update_post_meta($post_id, 'nav_value', 1);
        }
        
        #Save active tab
        if (isset($_POST['active_tab'])) {
            update_post_meta($post_id, 'active_tab', sanitize_text_field($_POST['active_tab']));
        }


    }
}
add_action('save_post', 'rst_testimonial_meta_box_save_func');

add_action('admin_head-post.php', 'rst_shortcode_preserve_tab');
add_action('admin_head-post-new.php', 'rst_shortcode_preserve_tab');

function rst_shortcode_preserve_tab() {
    global $post_type, $post;
    if ($post_type !== 'rst_shortcode') {
        return;
    }
    
    $saved_tab = get_post_meta($post->ID, 'active_tab', true);
    $url_tab = isset($_GET['active_tab']) ? sanitize_text_field($_GET['active_tab']) : ($saved_tab ? $saved_tab : '1');
    
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        var initialTab = '<?php echo esc_js($url_tab); ?>';
        var currentTab = initialTab;
        
        function switchToTab(tabNumber) {
            currentTab = tabNumber;
            $('.tab-nav li').removeClass('active');
            $('.nav' + tabNumber).addClass('active');
            $('.box li.tab-box').removeClass('d-block');
            $('.box' + tabNumber).addClass('d-block');
            $('#nav_value').val(tabNumber);
            $('#active_tab_field').val(tabNumber);
            localStorage.setItem('rst_shortcode_active_tab', tabNumber);
            
            // Update URL without reloading
            var url = new URL(window.location.href);
            url.searchParams.set('active_tab', tabNumber);
            window.history.replaceState({}, '', url);
        }
        
        // Add hidden field to track active tab
        if ($('#active_tab_field').length === 0) {
            $('#post').append('<input type="hidden" id="active_tab_field" name="active_tab" value="' + initialTab + '">');
        }
        
        switchToTab(initialTab);
        
        $(document).on('click', '.tab-nav li', function() {
            var tabNumber = $(this).attr('nav');
            switchToTab(tabNumber);
        });
        
        // Update form submission to include current tab
        $('#post').on('submit', function() {
            if ($('#active_tab_field').length === 0) {
                $(this).append('<input type="hidden" id="active_tab_field" name="active_tab" value="' + currentTab + '">');
            } else {
                $('#active_tab_field').val(currentTab);
            }
        });
        
        // Clear localStorage when leaving the page
        $(window).on('beforeunload', function() {
            localStorage.removeItem('rst_shortcode_active_tab');
        });
    });
    </script>
    <?php
}
# Custom metabox field end




