<?php


// if direct access
if (!defined('ABSPATH')) {
    exit;
}

//create custom post type


function rst_testimonial_init()
{
    register_post_type('rst_testimonial', array(
        'labels' => array(
            'name' => __('Testimonials', 'rst-testimonial'),
            'singular_name' => __('Testimonial', 'rst-testimonial'),
            'add_new' => __('Add New', 'rst-testimonial'),
            'add_new_item' => __('Add New Testimonial', 'rst-testimonial'),
            'edit_item' => __('Edit Testimonial', 'rst-testimonial'),
            'new_item' => __('New Testimonial', 'rst-testimonial'),
            'view_item' => __('View Testimonial', 'rst-testimonial'),
            'search_items' => __('Search Testimonials', 'rst-testimonial'),
            'not_found' => __('No Testimonials found', 'rst-testimonial'),
            'not_found_in_trash' => __('No Testimonials found in Trash', 'rst-testimonial'),
            'parent_item_colon' => __('Parent Testimonial:', 'rst-testimonial'),
            'menu_name' => __('Testimonials', 'rst-testimonial'),
        ),
        'hierarchical' => false,
        'description' => 'Testimonial',
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

add_action('init', 'rst_testimonial_init');


// create custom taxonomy

function create_testimonial_taxonomies()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => _x('Testimonial Categories', 'taxonomy general name', 'rst-testimonial'),
        'singular_name' => _x('Testimonial Category', 'taxonomy singular name', 'rst-testimonial'),
        'search_items' => __('Search Testimonial Categories', 'rst-testimonial'),
        'all_items' => __('All Testimonial Categories', 'rst-testimonial'),
        'parent_item' => __('Parent Testimonial Category', 'rst-testimonial'),
        'parent_item_colon' => __('Parent Testimonial Category:', 'rst-testimonial'),
        'edit_item' => __('Edit Testimonial Category', 'rst-testimonial'),
        'update_item' => __('Update Testimonial Category', 'rst-testimonial'),
        'add_new_item' => __('Add New Testimonial Category', 'rst-testimonial'),
        'new_item_name' => __('New Testimonial Category Name', 'rst-testimonial'),
        'menu_name' => __('Categories', 'rst-testimonial'),
    );

    register_taxonomy('rst_testimonial_category', array('rst_testimonial'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'rst_testimonial-category'),
    ));

}

add_action('init', 'create_testimonial_taxonomies', 0);


/*----------------------------------------------------------------------
		Columns Declaration Function
	----------------------------------------------------------------------*/

function rst_testimonial_columns($columns)
{

    $order = 'asc';

    if (isset($_GET['order']) && $_GET['order'] == 'asc') {
        $order = 'desc';
    }

    unset($columns['date']);

    return array_merge($columns,
        array(
            "title" => __('Name', 'rst-testimonial'),
            "thumbnail" => __('Image', 'rst-testimonial'),
            "description" => __('Testimonial Description', 'rst-testimonial'),
            "clientratings" => __('Rating', 'rst-testimonial'),
            "position" => __('Position', 'rst-testimonial'),
            "rstcategories" => __('Categories', 'rst-testimonial'),
            "date" => __('Date', 'rst-testimonial'),
        )
    );
}

/*----------------------------------------------------------------------
    testimonial Value Function
----------------------------------------------------------------------*/
function rst_testimonial_columns_display($rst_columns, $post_id)
{
    global $post;
    $width = (int)80;
    $height = (int)80;
    if ('thumbnail' == $rst_columns) {
        if (has_post_thumbnail($post_id)) {
            $thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
            $thumb = wp_get_attachment_image($thumbnail_id, array($width, $height), true);
            echo $thumb;
        } else {
            echo __('None', 'rst-testimonial');
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
                    <img style="height: 21px; width: 21px;" src="<?php echo $rst_ratting; ?>"
                         alt="rating">
                    <?php

                } else if ($i == $rst_author_rating + 0.5) {
                    ?>
                    <img style="height: 21px; width: 21px;" src="<?php echo $rst_ratting_half; ?>"
                         alt="rating">
                    <?php
                } else {
                    ?>
                    <img style="height: 21px; width: 21px;" src="<?php echo $rst_ratting_blank; ?>"
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
                    echo ", ";
                }
                echo '<a href="' . admin_url('edit.php?post_type=rst_shortcode&rst_testimonial_category=' . $term->slug) . '">' . $term->name . '</a>';
                $i++;
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

function rst_remove_editor_from_post_type()
{
    remove_post_type_support('rst_testimonial', 'editor');
    remove_post_type_support('rst_testimonial', 'title');
}

add_action('init', 'rst_remove_editor_from_post_type');


//remove row actions from custom post type

function remove_row_actions($actions)
{
    if (get_post_type() === 'rst_testimonial') {
        unset($actions['view']);
    }
    return $actions;
}

add_filter('post_row_actions', 'remove_row_actions', 10, 1);


// create custom meta box

function rst_testimonial_meta_box()
{
    add_meta_box(
        'custom_meta_box', // $id
        'Testimonial Information ', // $title
        'rst_testimonials_inner_custom_box', // $callback
        'rst_testimonial', // $page
        'normal', // $context
        'high'); // $priority
}

add_action('add_meta_boxes', 'rst_testimonial_meta_box');

function rst_testimonials_inner_custom_box($post)
{


      ?>

    <!-- Name -->
    <p><label for="title"><strong><?php _e('Name:', 'rst-testimonial'); ?></strong></label></p>

    <input type="text" name="post_title" id="title" class="regular-text code"
           value="<?php echo esc_attr(get_post_meta($post->ID, 'name', true)); ?>"/>

    <hr class="horizontalRuler"/>

    <!-- Position -->
    <p><label for="position_input"><strong><?php _e('Position:', 'rst-testimonial'); ?></strong></label></p>

    <input type="text" name="position_input" id="position_input" class="regular-text code"
           value="<?php echo esc_attr(get_post_meta($post->ID, 'position', true)); ?>"/>

    <hr class="horizontalRuler"/>

    <!-- Company Name -->
    <p><label for="company_input"><strong><?php _e('Company Name:', 'rst-testimonial'); ?></strong></label></p>

    <input type="text" name="company_input" id="company_input" class="regular-text code"
           value="<?php echo esc_attr(get_post_meta($post->ID, 'company', true)); ?>"/>

    <hr class="horizontalRuler"/>

    <!-- Company Website -->
    <p><label for="company_website_input"><strong><?php _e('Company URL:', 'rst-testimonial'); ?></strong></label></p>

    <input type="text" name="company_website_input" id="company_website_input" class="regular-text code"
           value="<?php echo esc_url(get_post_meta($post->ID, 'company_website', true)); ?>"/>

    <p><span class="description"><?php _e('Example: (www.example.com)', 'rst-testimonial'); ?></span></p>

    <hr class="horizontalRuler"/>

    <!-- Company Link Target -->
    <p><label for="company_link_target_list"><strong><?php _e('Link Target:', 'rst-testimonial'); ?></strong></label>
    </p>

    <select id="company_link_target_list" name="company_link_target_list">
        <option value="_blank" <?php if (get_post_meta($post->ID, 'company_link_target', true) == '_blank') {
            echo 'selected';
        } ?> ><?php _e('blank', 'rst-testimonial'); ?></option>
        <option value="_self" <?php if (get_post_meta($post->ID, 'company_link_target', true) == '_self') {
            echo 'selected';
        } ?> ><?php _e('self', 'rst-testimonial'); ?></option>
    </select>

    <hr class="horizontalRuler"/>
    <!-- Rating -->

    <p><label for="company_rating_target_list"><strong><?php _e('Rating:', 'rst-testimonial'); ?></strong></label></p>

    <select id="company_rating_target_list" name="company_rating_target_list">
        <option value="5" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '5') {
            echo 'selected';
        } ?> ><?php _e('5 Star', 'rst-testimonial'); ?></option>
        <option value="4.5" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '4.5') {
            echo 'selected';
        } ?> ><?php _e('4.5 Star', 'rst-testimonial'); ?></option>
        <option value="4" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '4') {
            echo 'selected';
        } ?> ><?php _e('4 Star', 'rst-testimonial'); ?></option>
        <option value="3.5" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '3.5') {
            echo 'selected';
        } ?> ><?php _e('3.5 Star', 'rst-testimonial'); ?></option>
        <option value="3" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '3') {
            echo 'selected';
        } ?> ><?php _e('3 Star', 'rst-testimonial'); ?></option>
        <option value="2" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '2') {
            echo 'selected';
        } ?> ><?php _e('2 Star', 'rst-testimonial'); ?></option>
        <option value="1" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '1') {
            echo 'selected';
        } ?> ><?php _e('1 Star', 'rst-testimonial'); ?></option>
    </select>

    <hr class="horizontalRuler"/>

    <!-- Testimonial Text -->

    <p><label for="testimonial_text_input"><strong><?php _e('Testimonial Text:', 'rst-testimonial'); ?></strong></label>
    </p>

    <textarea type="text" name="testimonial_text_input" id="testimonial_text_input" class="regular-text code" rows="5"
              cols="100"><?php echo esc_attr(get_post_meta($post->ID, 'testimonial_text', true)); ?></textarea>

    <?php
}


/*===============================================
    Save testimonial Options Meta Box Function
=================================================*/

function rst_testimonials_save_meta_box($post_id)
{
    /*----------------------------------------------------------------------
        Name
    ----------------------------------------------------------------------*/
    if (isset($_POST['post_title'])) {
        update_post_meta($post_id, 'name', $_POST['post_title']);
    }

    /*----------------------------------------------------------------------
        Position
    ----------------------------------------------------------------------*/
    if (isset($_POST['position_input'])) {
        update_post_meta($post_id, 'position', $_POST['position_input']);
    }

    /*----------------------------------------------------------------------
        Company
    ----------------------------------------------------------------------*/
    if (isset($_POST['company_input'])) {
        update_post_meta($post_id, 'company', $_POST['company_input']);
    }

    /*----------------------------------------------------------------------
        company website
    ----------------------------------------------------------------------*/
    if (isset($_POST['company_website_input'])) {
        update_post_meta($post_id, 'company_website', $_POST['company_website_input']);
    }

    /*----------------------------------------------------------------------
        company link target
    ----------------------------------------------------------------------*/
    if (isset($_POST['company_link_target_list'])) {
        update_post_meta($post_id, 'company_link_target', $_POST['company_link_target_list']);
    }

    /*----------------------------------------------------------------------
        Rating
    ----------------------------------------------------------------------*/
    if (isset($_POST['company_rating_target_list'])) {
        update_post_meta($post_id, 'company_rating_target', $_POST['company_rating_target_list']);
    }

    /*----------------------------------------------------------------------
        testimonial text
    ----------------------------------------------------------------------*/
    if (isset($_POST['testimonial_text_input'])) {
        update_post_meta($post_id, 'testimonial_text', $_POST['testimonial_text_input']);
    }
}

/*----------------------------------------------------------------------
    Save testimonial Options Meta Box Action
----------------------------------------------------------------------*/
add_action('save_post', 'rst_testimonials_save_meta_box');


//Add repeatrable fields to testimonial post type

add_action('admin_init', 'single_raepeater_meta_boxes');

function single_raepeater_meta_boxes()
{
    add_meta_box('single-repeter-data',
        'Social Links',
        'single_repeatable_meta_box_callback',
        'rst_testimonial',
        'normal',
        'high');
}

function single_repeatable_meta_box_callback($post)
{

    $single_repeter_group = get_post_meta($post->ID, 'single_repeter_group', true);
    wp_nonce_field('repeterBox', 'formType');
    ?>

    <table id="repeatable-fieldset-one" width="100%">
        <tbody>
        <?php
        if ($single_repeter_group) :
            foreach ($single_repeter_group as $field) {
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
                        <option value="">--Select--</option>
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="linkedin">Linkedin</option>
                        <option value="instagram">Instagram</option>
                    </select>
                </td>

                <td><input type="text" class="rst_repeat_field" name="tdesc[]" value="" placeholder="Link"/></td>
                <td><a class="button  cmb-remove-row-button button-disabled" href="javascript:void(0);">Remove</a></td>
            </tr>
        <?php endif; ?>
        <tr class="empty-row custom-repeter-text" style="display: none">
            <td>
                <select name="title[]" class="rst_repeat_field">
                    <option value="">--Select--</option>
                    <option value="facebook">Facebook</option>
                    <option value="twitter">Twitter</option>
                    <option value="linkedin">Linkedin</option>
                    <option value="instagram">Instagram</option>
                </select>
            </td>
            <td><input type="text" class="rst_repeat_field" name="tdesc[]" value="" placeholder="Link"/></td>
            <td><a class="button remove-row" href="javascript:void(0);">Remove</a></td>
        </tr>

        </tbody>
    </table>
    <p><a id="add-row" class="button" href="#">Add another</a></p>
    <?php
}

// Save Repeater field values.
add_action('save_post', 'single_repeatable_meta_box_save');

function single_repeatable_meta_box_save($post_id)
{

    if (!isset($_POST['formType']))
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'single_repeter_group', true);

    $new = array();
    $titles = $_POST['title'];
    $tdescs = $_POST['tdesc'];
    $count = count($titles);
    for ($i = 0; $i < $count; $i++) {
        if ($titles[$i] != '') {
            $new[$i]['title'] = stripslashes(strip_tags($titles[$i]));
            $new[$i]['tdesc'] = stripslashes($tdescs[$i]);
        }
    }

    if (!empty($new) && $new != $old) {
        update_post_meta($post_id, 'single_repeter_group', $new);
    } elseif (empty($new) && $old) {
        delete_post_meta($post_id, 'single_repeter_group', $old);
    }
    $repeter_status = $_REQUEST['repeter_status'];
    update_post_meta($post_id, 'repeter_status', $repeter_status);
}
