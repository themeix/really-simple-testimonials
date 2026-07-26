<?php

// if direct access
if (!defined('ABSPATH')) {
    exit;
}

// AJAX handler for saving user form options
add_action('wp_ajax_rst_save_user_form_options', 'rst_ajax_save_user_form_options');

function rst_ajax_save_user_form_options() {
    check_ajax_referer('rst_user_form_action', 'rst_user_form_nonce');

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Permission denied'));
    }

    if (isset($_POST['rstoptions'])) {
        $rstoptions = wp_unslash($_POST['rstoptions']);
        $rstoptions = array_map('sanitize_text_field', $rstoptions);
        update_option('rst_user_fields', $rstoptions);
    }

    if (isset($_POST['rst_user_title'])) {
        update_option('rst_user_title', sanitize_text_field(wp_unslash($_POST['rst_user_title'])));
    }

    if (isset($_POST['rst_user_name'])) {
        update_option('rst_user_name', sanitize_text_field(wp_unslash($_POST['rst_user_name'])));
    }

    if (isset($_POST['rst_user_designation'])) {
        update_option('rst_user_designation', sanitize_text_field(wp_unslash($_POST['rst_user_designation'])));
    }

    if (isset($_POST['rst_user_company_name'])) {
        update_option('rst_user_company_name', sanitize_text_field(wp_unslash($_POST['rst_user_company_name'])));
    }

    if (isset($_POST['rst_user_company_url'])) {
        update_option('rst_user_company_url', sanitize_text_field(wp_unslash($_POST['rst_user_company_url'])));
    }

    if (isset($_POST['rst_user_rating'])) {
        update_option('rst_user_rating', sanitize_text_field(wp_unslash($_POST['rst_user_rating'])));
    }

    if (isset($_POST['rst_user_testi_text'])) {
        update_option('rst_user_testi_text', sanitize_text_field(wp_unslash($_POST['rst_user_testi_text'])));
    }

    if (isset($_POST['rst_user_categories'])) {
        update_option('rst_user_categories', sanitize_text_field(wp_unslash($_POST['rst_user_categories'])));
    }

    if (isset($_POST['rst_user_logo_img'])) {
        update_option('rst_user_logo_img', sanitize_text_field(wp_unslash($_POST['rst_user_logo_img'])));
    }

    if (isset($_POST['rst_user_calculate'])) {
        update_option('rst_user_calculate', sanitize_text_field(wp_unslash($_POST['rst_user_calculate'])));
    }

    if (isset($_POST['rst_post_status'])) {
        update_option('rst_post_status', sanitize_text_field(wp_unslash($_POST['rst_post_status'])));
    }

    if (isset($_POST['rst_user_submit_btn_text'])) {
        update_option('rst_user_submit_btn_text', sanitize_text_field(wp_unslash($_POST['rst_user_submit_btn_text'])));
    }

    if (isset($_POST['rst_save_success_text'])) {
        update_option('rst_save_success_text', sanitize_textarea_field(wp_unslash($_POST['rst_save_success_text'])));
    }

    if (isset($_POST['rst_save_error_text'])) {
        update_option('rst_save_error_text', sanitize_textarea_field(wp_unslash($_POST['rst_save_error_text'])));
    }

    if (isset($_POST['rst_file_mishmatch_text'])) {
        update_option('rst_file_mishmatch_text', sanitize_textarea_field(wp_unslash($_POST['rst_file_mishmatch_text'])));
    }

    if (isset($_POST['rst_calc_error_text'])) {
        update_option('rst_calc_error_text', sanitize_textarea_field(wp_unslash($_POST['rst_calc_error_text'])));
    }

    wp_send_json_success(array('message' => 'Settings saved successfully.'));
}




// Check whether a field is selected or not
function rst_isOptionChecked($value)
{
    $options = get_option('rst_user_fields');
    if (isset($options) && !empty($options) && is_array($options) && in_array($value, $options)) {
        echo esc_attr(" checked ");
    }
}

// Retrive custom fields name
function rst_user_fields_name($field, $default)
{
    $field_name = get_option($field);
    if (isset($field_name) && !empty($field_name)) {
        echo esc_attr($field_name);
    } else {
        echo esc_attr($default);
    }
}

// Retrive custom success and error messages
function rst_user_retrive_messages($field, $default)
{
    $field_name = get_option($field);
    if (isset($field_name) && !empty($field_name)) {
        return $field_name;
    } else {
        return $default;
    }
}


// Add Submenu Page Front end form options
function rst_register_testimonial_user_options()
{
    add_submenu_page('edit.php?post_type=rst_testimonial', esc_attr__('User Form', 'really-simple-testimonials'), sprintf('<span style="color:#ddd;">%s</span>', esc_attr__('Frontend Submission', 'really-simple-testimonials')), 'manage_options', 'rst-user-form-options', 'rst_testimonial_user_options_page_layouts');
}

add_action('admin_menu', 'rst_register_testimonial_user_options');

add_action('admin_enqueue_scripts', 'rst_enqueue_user_form_scripts');

function rst_enqueue_user_form_scripts($hook) {
    if ($hook !== 'rst_testimonial_page_rst-user-form-options') {
        return;
    }
    wp_enqueue_script('jquery');
    wp_localize_script('jquery', 'rst_admin_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('rst_user_form_action')
    ));
}

function rst_testimonial_user_options_page_layouts()
{
    $rst_post_status = get_option('rst_post_status');
    ?>
    <div class="wrap">
        <h1><?php esc_attr_e('Testimonial Submission Form :', 'really-simple-testimonials'); ?></h1>
        <p><?php esc_attr_e('From the list below select and give the name of the field you want to show as input fields to the front end
            users to submit testimonials.', 'really-simple-testimonials') ?></p>
        <p>
        <p><?php esc_attr_e('To display a form with fields selected here, just copy and paste this', 'really-simple-testimonials') ?> <input
                    onClick="this.select(); execCommand('copy');" type="text" name="" readonly
                    value="[rst_frontend_form]"> <?php esc_attr_e('shortcode in a page or post. User will then see a form in frontend to
            submit their testimonial in that page or post.', 'really-simple-testimonials') ?></p>
        </p>

        <h3 style="color:red;"><?php esc_attr_e('Available Only Premium Version:', 'really-simple-testimonials'); ?></h3>
        <div id="rst-form-notice" style="display:none;"></div>
        <form method="post" action="" id="rst-user-form">
            <?php wp_nonce_field('rst_user_form_action', 'rst_user_form_nonce'); ?>

            <table>
                <tr>
                    <td>
                        <input type="checkbox" id="rst_user_title" name="rstoptions[]"
                               value="Title" <?php rst_isOptionChecked('Title'); ?>>
                        <label for="rst_user_title"><?php esc_attr_e('Title', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_title"
                               value="<?php rst_user_fields_name('rst_user_title', 'We love to hear from our customers'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" id="rst_user_name" name="rstoptions[]"
                               value="Name" <?php rst_isOptionChecked('Name'); ?>>
                        <label for="rst_user_name"><?php esc_attr_e('Name', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_name"
                               value="<?php rst_user_fields_name('rst_user_name', 'Name'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_designation" type="checkbox" name="rstoptions[]"
                               value="Designation" <?php rst_isOptionChecked('Designation'); ?>>
                        <label for="rst_user_designation"><?php esc_attr_e('Designation', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_designation"
                               value="<?php rst_user_fields_name('rst_user_designation', 'Designation'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_company_name" type="checkbox" name="rstoptions[]"
                               value="Company Name" <?php rst_isOptionChecked('Company Name'); ?>>
                        <label for="rst_user_company_name"><?php esc_attr_e('Company Name', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_company_name"
                               value="<?php rst_user_fields_name('rst_user_company_name', 'Company Name'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_company_url" type="checkbox" name="rstoptions[]"
                               value="Company URL" <?php rst_isOptionChecked('Company URL'); ?>>
                        <label for="rst_user_company_url"><?php esc_attr_e('Company URL', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_company_url"
                               value="<?php rst_user_fields_name('rst_user_company_url', 'Company URL'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_rating" type="checkbox" name="rstoptions[]"
                               value="Rating" <?php rst_isOptionChecked('Rating'); ?>>
                        <label for="rst_user_rating"><?php esc_attr_e('Rating', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_rating"
                               value="<?php rst_user_fields_name('rst_user_rating', 'Rating'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_testi_text" type="checkbox" name="rstoptions[]"
                               value="Testimonial Message" <?php rst_isOptionChecked('Testimonial Message'); ?>>
                        <label for="rst_user_testi_text"><?php esc_attr_e('Testimonial Message', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_testi_text"
                               value="<?php rst_user_fields_name('rst_user_testi_text', 'Testimonial Message'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_categories" type="checkbox" name="rstoptions[]"
                               value="Categories" <?php rst_isOptionChecked('Categories'); ?>>
                        <label for="rst_user_categories"><?php esc_attr_e('Categories', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td><input type="text" name="rst_user_categories"
                               value="<?php rst_user_fields_name('rst_user_categories', 'Categories'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_logo_img" type="checkbox" name="rstoptions[]"
                               value="Image or Logo" <?php rst_isOptionChecked("Image or Logo"); ?>>
                        <label for="rst_user_logo_img"><?php esc_attr_e('Image or Logo', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_logo_img"
                               value="<?php rst_user_fields_name('rst_user_logo_img', "Image or Logo"); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_calculate" type="checkbox" name="rstoptions[]"
                               value="Calculate" <?php rst_isOptionChecked("Calculate"); ?>>
                        <label for="rst_user_calculate"><?php esc_attr_e('User\'s Captcha', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_calculate"
                               value="<?php rst_user_fields_name('rst_user_calculate', "Calculate"); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_post_status"><?php esc_attr_e('Select post status', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <select id="rst_post_status" name="rst_post_status">
                            <option value="draft" <?php if (isset($rst_post_status) && $rst_post_status == 'draft') echo esc_attr('selected');?>>
                                <?php esc_attr_e('Draft', 'really-simple-testimonials')  ?>
                            </option>
                            <option value="pending" <?php if (isset($rst_post_status) && $rst_post_status == 'pending') echo esc_attr('selected'); ?>>
                                <?php esc_attr_e('Pending', 'really-simple-testimonials')  ?>
                            </option>
                            <option value="publish" <?php if (isset($rst_post_status) && $rst_post_status == 'publish') echo esc_attr('selected'); ?>>
                                <?php esc_attr_e('Publish', 'really-simple-testimonials')  ?>
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_user_submit_btn_text"><?php esc_attr_e('Submit button text', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <input id="rst_user_submit_btn_text" type="text" name="rst_user_submit_btn_text"
                               value="<?php rst_user_fields_name('rst_user_submit_btn_text', "Submit Testimonial"); ?>">
                    </td>
                </tr>
            </table>
            <h3> <?php esc_attr_e('Testimonial Error and success messages for public users', 'really-simple-testimonials'); ?></h3>
            <table>
                <tr>
                    <td>
                        <label for="rst_save_success_text"><?php esc_attr_e('Data saved success message', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <textarea id="rst_save_success_text" rows="4" cols="50"
                                  name="rst_save_success_text"><?php echo esc_attr(rst_user_retrive_messages('rst_save_success_text', __('Thank you for your valuable comments. Stay with us.', 'really-simple-testimonials'))); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_save_error_text"><?php esc_attr_e('Data saved error message', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <textarea id="rst_save_error_text" rows="4" cols="50"
                                  name="rst_save_error_text"><?php echo esc_attr(rst_user_retrive_messages('rst_save_error_text', __('Please fill-up all the info again.','really-simple-testimonials'))); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_file_mishmatch_text"><?php esc_attr_e('File type mishmatch message', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <textarea id="rst_file_mishmatch_text" rows="4" cols="50"
                                  name="rst_file_mishmatch_text"><?php echo esc_attr(rst_user_retrive_messages('rst_file_mishmatch_text', __('Only jpg, png and jpeg is accepted. Please try again.', 'really-simple-testimonials'))); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_calc_error_text"><?php esc_attr_e('Calculation error message', 'really-simple-testimonials'); ?></label>
                    </td>
                    <td>
                        <textarea id="rst_calc_error_text" rows="4" cols="50"
                                  name="rst_calc_error_text"><?php echo esc_attr(rst_user_retrive_messages('rst_calc_error_text', __('Calculation is incorrect. Please try again.', 'really-simple-testimonials'))); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="button button-primary rst-admin-submit-btn" name="rst_save_btn" value="Save Changes">
                        <span class="rst-spinner rst-admin-spinner" style="display:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12a9 9 0 1 1-6.219-8.56"></path>
                            </svg>
                        </span>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <style>
    .rst-spinner {
        display: inline-flex;
        align-items: center;
        margin-left: 10px;
        vertical-align: middle;
    }

    .rst-spinner svg {
        animation: rst-spin 1s linear infinite;
    }

    @keyframes rst-spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    #rst-form-notice {
        margin: 20px 0;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        font-size: 15px;
        line-height: 1.5;
        max-width: 600px;
    }

    #rst-form-notice.success {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border-left: 5px solid #48bb78;
    }

    #rst-form-notice.error {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        color: #fff;
        border-left: 5px solid #f56565;
    }

    #rst-form-notice p {
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
    }

    .rst-animation-fade-in {
        animation: rst-fadeIn 0.5s ease-out;
    }

    @keyframes rst-fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
    
    <script type="text/javascript">
jQuery(document).ready(function($) {
    $('#rst-user-form').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var submitBtn = form.find('input[type="submit"]');
        var spinner = $('.rst-admin-spinner');
        var messageDiv = $('#rst-form-notice');
        var formData = new FormData(this);
        var originalBtnText = submitBtn.val();
        
        submitBtn.prop('disabled', true).val('Saving...').css('opacity', '0.7');
        spinner.fadeIn();
        messageDiv.hide().removeClass('rst-animation-fade-in');
        
        formData.append('action', 'rst_save_user_form_options');
        
        $.ajax({
            url: rst_admin_ajax.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                submitBtn.prop('disabled', false).val(originalBtnText).css('opacity', '1');
                spinner.fadeOut();
                
                if (response.success) {
                    messageDiv.removeClass('error notice-error').addClass('success rst-animation-fade-in').html('<p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;margin-right:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>' + response.data.message + '</p>').fadeIn(300);
                } else {
                    messageDiv.removeClass('success notice-success').addClass('error rst-animation-fade-in').html('<p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;margin-right:8px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>' + response.data.message + '</p>').fadeIn(300);
                }
                
                setTimeout(function() {
                    messageDiv.fadeOut(500);
                }, 3000);
            },
            error: function(xhr, status, error) {
                submitBtn.prop('disabled', false).val(originalBtnText).css('opacity', '1');
                spinner.fadeOut();
                
                messageDiv.removeClass('success notice-success').addClass('error rst-animation-fade-in').html('<p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;margin-right:8px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>Error saving settings: ' + error + '</p>').fadeIn(300);
                
                setTimeout(function() {
                    messageDiv.fadeOut(500);
                }, 3000);
            }
        });
    });
});
    </script>
<?php }


add_action('wp_enqueue_scripts', 'rst_enqueue_frontend_scripts');

function rst_enqueue_frontend_scripts() {
    global $post;
    
    if (!is_a($post, 'WP_Post')) {
        return;
    }
    
    if (has_shortcode($post->post_content, 'rst_frontend_form')) {
        wp_enqueue_script('jquery');
        wp_register_script('rst-frontend-form', false, array('jquery'), time(), true);
        wp_enqueue_script('rst-frontend-form');
        wp_localize_script('rst-frontend-form', 'rst_frontend_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'submit_text' => get_option('rst_user_submit_btn_text', 'Submit Testimonial'),
        ));
    }
}

function rst_frontend_form_callback()
{
    ob_start();
    include (__DIR__) . '/rst-frontend-form.php';
    return ob_get_clean();
}

add_shortcode('rst_frontend_form', 'rst_frontend_form_callback');

add_action('wp_ajax_rst_handle_frontend_submission', 'rst_handle_frontend_submission');
add_action('wp_ajax_nopriv_rst_handle_frontend_submission', 'rst_handle_frontend_submission');

function rst_handle_frontend_submission() {
    check_ajax_referer('rst_frontend_submit_action', 'rst_frontend_nonce');
    
    
    $post_status = get_option('rst_post_status', 'draft');
    $selected_fields = get_option('rst_user_fields', array());
    
    $post_title = isset($_POST['rst_name']) ? sanitize_text_field(wp_unslash($_POST['rst_name'])) : '';
    
    if (in_array('Title', $selected_fields) && isset($_POST['rst_title'])) {
        $post_title = sanitize_text_field(wp_unslash($_POST['rst_title']));
    }
    
    if (empty($post_title)) {
        $post_title = 'Untitled Testimonial';
    }
    
    $post_content = isset($_POST['rst_testimonial']) ? sanitize_textarea_field(wp_unslash($_POST['rst_testimonial'])) : '';
    
    $post_data = array(
        'post_title'    => $post_title,
        'post_content'  => $post_content,
        'post_status'   => $post_status,
        'post_type'     => 'rst_testimonial',
    );
    
    $post_id = wp_insert_post($post_data);
    
    if (is_wp_error($post_id)) {
        wp_send_json_error(array('message' => $post_id->get_error_message()));
    }
    
    
    if (!empty($_POST['rst_name'])) {
        update_post_meta($post_id, 'name', sanitize_text_field(wp_unslash($_POST['rst_name'])));
    }
    
    if (!empty($_POST['rst_designation'])) {
        update_post_meta($post_id, 'position', sanitize_text_field(wp_unslash($_POST['rst_designation'])));
        update_post_meta($post_id, 'rst_designation', sanitize_text_field(wp_unslash($_POST['rst_designation'])));
    }
    
    if (!empty($_POST['rst_company_name'])) {
        update_post_meta($post_id, 'company', sanitize_text_field(wp_unslash($_POST['rst_company_name'])));
        update_post_meta($post_id, 'rst_company_name', sanitize_text_field(wp_unslash($_POST['rst_company_name'])));
    }
    
    if (!empty($_POST['rst_company_url'])) {
        update_post_meta($post_id, 'company_website', esc_url_raw(wp_unslash($_POST['rst_company_url'])));
        update_post_meta($post_id, 'rst_company_url', esc_url_raw(wp_unslash($_POST['rst_company_url'])));
    }
    
    if (!empty($_POST['rst_rating'])) {
        update_post_meta($post_id, 'company_rating_target', sanitize_text_field(wp_unslash($_POST['rst_rating'])));
        update_post_meta($post_id, 'rst_rating', sanitize_text_field(wp_unslash($_POST['rst_rating'])));
    }
    
    if (!empty($post_content)) {
        update_post_meta($post_id, 'testimonial_text', $post_content);
    }
    
    if (!empty($_POST['rst_categories']) && is_array($_POST['rst_categories'])) {
        $category_ids = array_map('intval', $_POST['rst_categories']);
        $category_ids = array_filter($category_ids);
        if (!empty($category_ids)) {
            wp_set_object_terms($post_id, $category_ids, 'rst_testimonial_category');
        }
    }
    
    if (!empty($_FILES['rst_user_image'])) {
        $uploaded_file = $_FILES['rst_user_image'];
        
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        
        $uploaded_file['name'] = sanitize_file_name($uploaded_file['name']);
        $file_type = wp_check_filetype(basename($uploaded_file['name']));
        $allowed_types = array('jpg', 'jpeg', 'png');
        
        if (in_array($file_type['ext'], $allowed_types)) {
            
            $upload = wp_handle_upload($uploaded_file, array('test_form' => false));
            
            if (isset($upload['error'])) {
                wp_delete_post($post_id, true);
                wp_send_json_error(array('message' => $upload['error']));
            }
            
            $attachment = array(
                'post_mime_type' => $upload['type'],
                'post_title'     => basename($upload['file']),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );
            
            $attach_id = wp_insert_attachment($attachment, $upload['file'], $post_id);
            $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
            wp_update_attachment_metadata($attach_id, $attach_data);
            set_post_thumbnail($post_id, $attach_id);
        } else {
            wp_delete_post($post_id, true);
            $error_msg = rst_user_retrive_messages('rst_file_mishmatch_text', __('Only jpg, png and jpeg is accepted. Please try again.', 'really-simple-testimonials'));
            wp_send_json_error(array('message' => $error_msg));
        }
    }
    
    if (isset($_POST['rst_captcha_sum']) && isset($_POST['rst_captcha'])) {
        $expected = intval($_POST['rst_captcha_sum']);
        $provided = intval($_POST['rst_captcha']);
        
        if ($expected !== $provided) {
            wp_delete_post($post_id, true);
            $error_msg = rst_user_retrive_messages('rst_calc_error_text', __('Calculation is incorrect. Please try again.', 'really-simple-testimonials'));
            wp_send_json_error(array('message' => $error_msg));
        }
    }
    
    $success_msg = rst_user_retrive_messages('rst_save_success_text', __('Thank you for your valuable comments. Stay with us.', 'really-simple-testimonials'));
    wp_send_json_success(array('message' => $success_msg));
}