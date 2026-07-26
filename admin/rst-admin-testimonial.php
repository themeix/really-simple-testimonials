<?php


// if direct access
if (!defined('ABSPATH')) {
    exit;
}

//create custom post type

if (!function_exists('rst_testimonial_init')) {
    function rst_testimonial_init()
    {
        register_post_type('rst_testimonial', array(
            'labels' => array(
                'name' => esc_attr__('Testimonials', 'really-simple-testimonials'),
                'singular_name' => esc_attr__('Testimonial', 'really-simple-testimonials'),
                'add_new' => esc_attr__('Add New', 'really-simple-testimonials'),
                'add_new_item' => esc_attr__('Add New Testimonial', 'really-simple-testimonials'),
                'edit_item' => esc_attr__('Edit Testimonial', 'really-simple-testimonials'),
                'new_item' => esc_attr__('New Testimonial', 'really-simple-testimonials'),
                'view_item' => esc_attr__('View Testimonial', 'really-simple-testimonials'),
                'search_items' => esc_attr__('Search Testimonials', 'really-simple-testimonials'),
                'not_found' => esc_attr__('No Testimonials found', 'really-simple-testimonials'),
                'not_found_in_trash' => esc_attr__('No Testimonials found in Trash', 'really-simple-testimonials'),
                'parent_item_colon' => esc_attr__('Parent Testimonial:', 'really-simple-testimonials'),
                'menu_name' => esc_attr__('Testimonials', 'really-simple-testimonials'),
            ),
            'hierarchical' => false,
            'description' => esc_attr__('Testimonial', 'really-simple-testimonials'),
            'supports' => array('title', 'editor', 'thumbnail'),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-format-quote',
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post'
        ));
    }
}


add_action('init', 'rst_testimonial_init');


// create custom taxonomy

if (!function_exists('rst_create_testimonial_taxonomies')) {
    function rst_create_testimonial_taxonomies()
    {
        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => esc_attr_x('Testimonial Categories', 'taxonomy general name', 'really-simple-testimonials'),
            'singular_name' => esc_attr_x('Testimonial Category', 'taxonomy singular name', 'really-simple-testimonials'),
            'search_items' => esc_attr__('Search Testimonial Categories', 'really-simple-testimonials'),
            'all_items' => esc_attr__('All Testimonial Categories', 'really-simple-testimonials'),
            'parent_item' => esc_attr__('Parent Testimonial Category', 'really-simple-testimonials'),
            'parent_item_colon' => esc_attr__('Parent Testimonial Category:', 'really-simple-testimonials'),
            'edit_item' => esc_attr__('Edit Testimonial Category', 'really-simple-testimonials'),
            'update_item' => esc_attr__('Update Testimonial Category', 'really-simple-testimonials'),
            'add_new_item' => esc_attr__('Add New Testimonial Category', 'really-simple-testimonials'),
            'new_item_name' => esc_attr__('New Testimonial Category Name', 'really-simple-testimonials'),
            'menu_name' => esc_attr__('Categories', 'really-simple-testimonials'),
        );

        register_taxonomy('rst_testimonial_category', array('rst_testimonial'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'rst_testimonial-category'),
        ));

    }
}


add_action('init', 'rst_create_testimonial_taxonomies', 0);


/*----------------------------------------------------------------------
		Columns Declaration Function
	----------------------------------------------------------------------*/

if (!function_exists('rst_testimonial_columns')) {

    function rst_testimonial_columns($columns)
    {

        $allowed_orders = array('asc', 'desc');
        $order = 'asc';

        if (isset($_GET['order']) && in_array($_GET['order'], $allowed_orders, true) && $_GET['order'] == 'asc') {
            $order = 'desc';
        }

        unset($columns['date']);

        return array_merge($columns,
            array(
                "title" => esc_attr__('Name', 'really-simple-testimonials'),
                "thumbnail" => esc_attr__('Image', 'really-simple-testimonials'),
                "description" => esc_attr__('Testimonial Description', 'really-simple-testimonials'),
                "clientratings" => esc_attr__('Rating', 'really-simple-testimonials'),
                "position" => esc_attr__('Position', 'really-simple-testimonials'),
                "rstcategories" => esc_attr__('Categories', 'really-simple-testimonials'),
                "date" => esc_attr__('Date', 'really-simple-testimonials'),
            )
        );
    }
}
/*----------------------------------------------------------------------
    testimonial Value Function
----------------------------------------------------------------------*/
if (!function_exists('rst_testimonial_columns_display')) {

    function rst_testimonial_columns_display($rst_columns, $post_id)
    {
        global $post;
        $width = (int)80;
        $height = (int)80;
        if ('thumbnail' == $rst_columns) {
            if (has_post_thumbnail($post_id)) {
                $thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
                $thumb = wp_get_attachment_image($thumbnail_id, array($width, $height), true);
                echo wp_kses_post($thumb);
            } else {
                echo esc_attr__('None', 'really-simple-testimonials');
            }
        }
        if ('position' == $rst_columns) {
            echo esc_attr(get_post_meta($post_id, 'position', true));
        }
        if ('description' == $rst_columns) {
            echo esc_attr(get_post_meta($post_id, 'testimonial_text', true));
        }
        if ('clientratings' == $rst_columns) {
            $rst_author_rating = esc_attr(get_post_meta($post_id, 'company_rating_target', true));
            if (!empty($rst_author_rating)) {

                $rst_ratting = plugin_dir_url(__FILE__) . 'templates/icons/rating.svg';
                $rst_ratting_blank = plugin_dir_url(__FILE__) . 'templates/icons/rating-0.svg';
                $rst_ratting_half = plugin_dir_url(__FILE__) . 'templates/icons/ratting-50.svg';

                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $rst_author_rating) {
                        ?>
                        <img style="height: 21px; width: 21px;" src="<?php echo esc_attr($rst_ratting); ?>"
                             alt="rating">
                        <?php

                    } else if ($i == $rst_author_rating + 0.5) {
                        ?>
                        <img style="height: 21px; width: 21px;" src="<?php echo esc_attr($rst_ratting_half); ?>"
                             alt="rating">
                        <?php
                    } else {
                        ?>
                        <img style="height: 21px; width: 21px;" src="<?php echo esc_attr($rst_ratting_blank); ?>"
                             alt="rating">
                        <?php
                    } ?>

                    <?php
                }
            }

        }
        if ('rstcategories' == $rst_columns) {
            $terms = get_the_terms($post_id, 'rst_testimonial_category');
            $count = count(array($terms));
            if ($terms) {
                $i = 0;
                foreach ($terms as $term) {
                    if ($i + 1 != $count) {
                        echo esc_attr(", ");
                    }
                    echo '<a href="' . esc_url(admin_url('edit.php?post_type=rst_shortcode&rst_testimonial_category=' . esc_attr($term->slug))) . '">' . esc_attr($term->name) . '</a>';
                    $i++;
                }
            }
        }
    }

}
/*----------------------------------------------------------------------
    Add manage_tmls_posts_columns Filter
----------------------------------------------------------------------*/
add_filter("manage_rst_testimonial_posts_columns", "rst_testimonial_columns");

/*----------------------------------------------------------------------
    Add manage_rst_testimonial_posts_custom_column Action
----------------------------------------------------------------------*/
add_action("manage_rst_testimonial_posts_custom_column", "rst_testimonial_columns_display", 10, 2);


//remove content editor from custom post type

if (!function_exists('rst_remove_editor_from_post_type')) {
    function rst_remove_editor_from_post_type()
    {
        remove_post_type_support('rst_testimonial', 'editor');
        remove_post_type_support('rst_testimonial', 'title');
    }
}

add_action('init', 'rst_remove_editor_from_post_type');


//remove row actions from custom post type
if (!function_exists('rst_remove_row_actions')) {
    function rst_remove_row_actions($actions)
    {
        if (get_post_type() === 'rst_testimonial') {
            unset($actions['view']);
        }
        return $actions;
    }
}


add_filter('post_row_actions', 'rst_remove_row_actions', 10, 1);


// create custom meta box
if (!function_exists('rst_testimonial_meta_box')) {
    function rst_testimonial_meta_box()
    {
        add_meta_box(
            'custom_meta_box', // $id
            esc_attr__('Testimonial Information ', 'really-simple-testimonials'), // $title
            'rst_testimonials_inner_custom_box', // $callback
            'rst_testimonial', // $page
            'normal', // $context
            'high'); // $priority
    }
}
add_action('add_meta_boxes', 'rst_testimonial_meta_box');

if (!function_exists('rst_testimonials_inner_custom_box')) {
    function rst_testimonials_inner_custom_box($post)
    {

        // nonce field with action
        wp_nonce_field('rst_testimonial_inner_custom_box', 'rst_testimonial_inner_custom_box_nonce');
        
        $rst_name = get_post_meta($post->ID, 'rst_designation', true);
        $rst_position = get_post_meta($post->ID, 'rst_designation', true);
        $rst_company = get_post_meta($post->ID, 'rst_company_name', true);
        $rst_company_url = get_post_meta($post->ID, 'rst_company_url', true);
        $rst_rating = get_post_meta($post->ID, 'rst_rating', true);
        $rst_testimonial_text = get_post_meta($post->ID, 'rst_designation', true);
        
        $saved_name = get_post_meta($post->ID, 'name', true);
        $saved_position = get_post_meta($post->ID, 'position', true);
        $saved_company = get_post_meta($post->ID, 'company', true);
        $saved_company_url = get_post_meta($post->ID, 'company_website', true);
        $saved_rating = get_post_meta($post->ID, 'company_rating_target', true);
        $saved_testimonial_text = get_post_meta($post->ID, 'testimonial_text', true);

        ?>

        <!-- Name -->
        <p><label for="title"><strong><?php esc_attr_e('Name:', 'really-simple-testimonials'); ?></strong></label></p>

        <input type="text" name="post_title" id="title" class="regular-text code"
               value="<?php echo esc_attr($saved_name ? $saved_name : $post->post_title); ?>"/>

        <hr class="horizontalRuler"/>

        <!-- Position -->
        <p><label for="position_input"><strong><?php esc_attr_e('Position:', 'really-simple-testimonials'); ?></strong></label></p>

        <input type="text" name="position_input" id="position_input" class="regular-text code"
               value="<?php echo esc_attr($saved_position ? $saved_position : $rst_position); ?>"/>

        <hr class="horizontalRuler"/>

        <!-- Company Name -->
        <p><label for="company_input"><strong><?php esc_attr_e('Company Name:', 'really-simple-testimonials'); ?></strong></label></p>

        <input type="text" name="company_input" id="company_input" class="regular-text code"
               value="<?php echo esc_attr($saved_company ? $saved_company : $rst_company); ?>"/>

        <hr class="horizontalRuler"/>

        <!-- Company Website -->
        <p><label for="company_website_input"><strong><?php esc_attr_e('Company URL:', 'really-simple-testimonials'); ?></strong></label>
        </p>

        <input type="text" name="company_website_input" id="company_website_input" class="regular-text code"
               value="<?php echo esc_url($saved_company_url ? $saved_company_url : $rst_company_url); ?>"/>

        <p><span class="description"><?php esc_attr_e('Example: (www.example.com)', 'really-simple-testimonials'); ?></span></p>

        <hr class="horizontalRuler"/>

        <!-- Company Link Target -->
        <p>
            <label for="company_link_target_list"><strong><?php esc_attr_e('Link Target:', 'really-simple-testimonials'); ?></strong></label>
        </p>

        <select id="company_link_target_list" name="company_link_target_list">
            <option value="_blank" <?php if (get_post_meta($post->ID, 'company_link_target', true) == '_blank') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('blank', 'really-simple-testimonials'); ?></option>
            <option value="_self" <?php if (get_post_meta($post->ID, 'company_link_target', true) == '_self') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('self', 'really-simple-testimonials'); ?></option>
        </select>

        <hr class="horizontalRuler"/>
        <!-- Rating -->

        <p><label for="company_rating_target_list"><strong><?php esc_attr_e('Rating:', 'really-simple-testimonials'); ?></strong></label>
        </p>

        <select id="company_rating_target_list" name="company_rating_target_list">
            <option value="5" <?php if (($saved_rating ? $saved_rating : $rst_rating) == '5') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('5 Star', 'really-simple-testimonials'); ?></option>
            <option value="4.5" <?php if (($saved_rating ? $saved_rating : $rst_rating) == '4.5') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('4.5 Star', 'really-simple-testimonials'); ?></option>
            <option value="4" <?php if (($saved_rating ? $saved_rating : $rst_rating) == '4') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('4 Star', 'really-simple-testimonials'); ?></option>
            <option value="3.5" <?php if (($saved_rating ? $saved_rating : $rst_rating) == '3.5') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('3.5 Star', 'really-simple-testimonials'); ?></option>
            <option value="3" <?php if (($saved_rating ? $saved_rating : $rst_rating) == '3') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('3 Star', 'really-simple-testimonials'); ?></option>
            <option value="2" <?php if (($saved_rating ? $saved_rating : $rst_rating) == '2') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('2 Star', 'really-simple-testimonials'); ?></option>
            <option value="1" <?php if (($saved_rating ? $saved_rating : $rst_rating) == '1') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('1 Star', 'really-simple-testimonials'); ?></option>
        </select>

        <hr class="horizontalRuler"/>

        <!-- Testimonial Text -->

        <p>
            <label for="testimonial_text_input"><strong><?php esc_attr_e('Testimonial Text:', 'really-simple-testimonials'); ?></strong></label>
        </p>

        <textarea type="text" name="testimonial_text_input" id="testimonial_text_input" class="regular-text code"
                  rows="5"
                  cols="100"><?php echo esc_textarea($saved_testimonial_text ? $saved_testimonial_text : $post->post_content); ?></textarea>


        <?php
    }

}
/*===============================================
    Save testimonial Options Meta Box Function
 =================================================*/

//check if the nonce is set and verify it with action

if (!function_exists('rst_testimonials_save_meta_box')) {

    function rst_testimonials_save_meta_box($post_id)
    {
        //check nonce field  and verify it
        if (!isset($_POST['rst_testimonial_inner_custom_box_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['rst_testimonial_inner_custom_box_nonce'])), 'rst_testimonial_inner_custom_box')) {
            return;
        } else {

            if (isset($_POST['post_title'])) {
                $name = sanitize_text_field(wp_unslash($_POST['post_title']));
                update_post_meta($post_id, 'name', $name);
            }

            if (isset($_POST['position_input'])) {
                $position = sanitize_text_field(wp_unslash($_POST['position_input']));
                update_post_meta($post_id, 'position', $position);
            }

            if (isset($_POST['company_input'])) {
                $company = sanitize_text_field(wp_unslash($_POST['company_input']));
                update_post_meta($post_id, 'company', $company);
            }

            if (isset($_POST['company_website_input'])) {
                $company_website = esc_url_raw(wp_unslash($_POST['company_website_input']));
                update_post_meta($post_id, 'company_website', $company_website);
            }

            if (isset($_POST['company_link_target_list'])) {
                $company_link_target = sanitize_text_field(wp_unslash($_POST['company_link_target_list']));
                update_post_meta($post_id, 'company_link_target', $company_link_target);
            }

            if (isset($_POST['company_rating_target_list'])) {
                $company_rating_target = sanitize_text_field(wp_unslash($_POST['company_rating_target_list']));
                update_post_meta($post_id, 'company_rating_target', $company_rating_target);
            }

            if (isset($_POST['testimonial_text_input'])) {
                $testimonial_text = sanitize_text_field(wp_unslash($_POST['testimonial_text_input']));
                update_post_meta($post_id, 'testimonial_text', $testimonial_text);
            }
        }

    }

}
/*----------------------------------------------------------------------
    Save testimonial Options Meta Box Action
----------------------------------------------------------------------*/
add_action('save_post', 'rst_testimonials_save_meta_box');


//Add repeatable fields to testimonial post type

add_action('admin_init', 'rst_single_repeater_meta_boxes');

if (!function_exists('rst_single_repeater_meta_boxes')) {
    function rst_single_repeater_meta_boxes()
    {
        add_meta_box('single-repeater-data',
            esc_attr__('Social Links' , 'really-simple-testimonials'),
            'rst_single_repeatable_meta_box_callback',
            'rst_testimonial',
            'normal',
            'low');
    }
}


if (!function_exists('rst_single_repeatable_meta_box_callback')) {
    function rst_single_repeatable_meta_box_callback($post)
    {

        $rst_single_repeater_group = get_post_meta($post->ID, 'single_repeater_group', true);
        wp_nonce_field('rst_testimonial_repeaterBox', 'rst_testimonial_repeaterBox_nonce');
        ?>

        <table id="repeatable-fieldset-one" width="100%">
            <tbody>
            <?php
            if ($rst_single_repeater_group) :
                foreach ($rst_single_repeater_group as $field) {
                    ?>
                    <tr>
                        <td>
                            <input type="text" class="rst_repeat_field" name="title[]"
                                   value="<?php if ($field['title'] != '') echo esc_attr($field['title']); ?>"
                                   placeholder="Heading" readonly/>
                        </td>
                        <td><input type="text" class="rst_repeat_field" name="tdesc[]"
                                   value="<?php if ($field['tdesc'] != '') echo esc_url($field['tdesc']); ?>"
                                   placeholder="Link"/></td>
                        <td><a class="button remove-row" href="javascript:void(0);">Remove</a></td>
                    </tr>
                    <?php
                }
            else :
                ?>
                <tr>
                    <td>
                        <select name="title[]" class="rst_repeat_field" id="title[]">
                            <option value=""><?php esc_attr_e('--Select--','really-simple-testimonials') ?></option>
                            <option value="facebook"><?php esc_attr_e('Facebook','really-simple-testimonials') ?></option>
                            <option value="twitter"><?php esc_attr_e('Twitter','really-simple-testimonials') ?></option>
                            <option value="linkedin"><?php esc_attr_e('Linkedin','really-simple-testimonials') ?></option>
                            <option value="instagram"><?php esc_attr_e('Instagram','really-simple-testimonials') ?></option>
                        </select>
                    </td>

                    <td><input type="text" class="rst_repeat_field" name="tdesc[]" value="" placeholder="Link"/></td>
                    <td><a class="button  cmb-remove-row-button button-disabled" href="javascript:void(0);">Remove</a>
                    </td>
                </tr>
            <?php endif; ?>
            <tr class="empty-row custom-repeater-text" style="display: none">
                <td>
                    <select name="title[]" class="rst_repeat_field">
                        <option value=""><?php esc_attr_e('--Select--','really-simple-testimonials') ?></option>
                        <option value="facebook"><?php esc_attr_e('Facebook','really-simple-testimonials') ?></option>
                        <option value="twitter"><?php esc_attr_e('Twitter','really-simple-testimonials') ?></option>
                        <option value="linkedin"><?php esc_attr_e('Linkedin','really-simple-testimonials') ?></option>
                        <option value="instagram"><?php esc_attr_e('Instagram','really-simple-testimonials') ?></option>
                    </select>
                </td>
                <td><input type="text" class="rst_repeat_field" name="tdesc[]" value="" placeholder="Link"/></td>
                <td><a class="button remove-row" href="javascript:void(0);"><?php esc_attr_e('Remove','really-simple-testimonials') ?></a></td>
            </tr>

            </tbody>
        </table>
        <p><a id="add-row" class="button" href="#"><?php esc_attr_e('Add another','really-simple-testimonials') ?></a></p>
        <?php
    }
}
// Save Repeater field values.
add_action('save_post', 'rst_single_repeatable_meta_box_save');


if (!function_exists('rst_single_repeatable_meta_box_save')) {
    function rst_single_repeatable_meta_box_save($post_id)
    {
        if (!isset($_POST['rst_testimonial_repeaterBox_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['rst_testimonial_repeaterBox_nonce'])), 'rst_testimonial_repeaterBox')) {
            return;
        }


        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $old = get_post_meta($post_id, 'single_repeater_group', true);

        $new = array();

        if (isset($_POST['title'])) {
            //sanitize a array
            $titles = array_map('sanitize_text_field', wp_unslash($_POST['title']));
        }

        if (isset($_POST['tdesc'])) {
            //sanitize a array
            $tdescs = array_map('sanitize_text_field', wp_unslash($_POST['tdesc']));
        }


        $count = count($titles);
        for ($i = 0; $i < $count; $i++) {
            if ($titles[$i] != '') {
                $new[$i]['title'] = stripslashes(wp_strip_all_tags($titles[$i]));
                $new[$i]['tdesc'] = stripslashes($tdescs[$i]);
            }
        }

        if (!empty($new) && $new != $old) {
            update_post_meta($post_id, 'single_repeater_group', $new);
        } elseif (empty($new) && $old) {
            delete_post_meta($post_id, 'single_repeater_group', $old);
        }

    }
}