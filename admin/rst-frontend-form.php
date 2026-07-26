<?php

if (!defined('ABSPATH')) {
    exit;
}

wp_enqueue_style('rst_frontend_from_style', plugin_dir_url(__FILE__) . 'css/frontend-form.css', array(), time(), 'all');

$selected_fields = get_option('rst_user_fields', array());



$rst_user_title = get_option('rst_user_title', 'We love to hear from our customers');
$rst_user_name_label = get_option('rst_user_name', 'Name');
$rst_user_designation_label = get_option('rst_user_designation', 'Designation');
$rst_user_company_name_label = get_option('rst_user_company_name', 'Company Name');
$rst_user_company_url_label = get_option('rst_user_company_url', 'Company URL');
$rst_user_rating_label = get_option('rst_user_rating', 'Rating');
$rst_user_testi_text_label = get_option('rst_user_testi_text', 'Testimonial Message');
$rst_user_categories_label = get_option('rst_user_categories', 'Categories');
$rst_user_logo_img_label = get_option('rst_user_logo_img', "Image or Logo");
$rst_user_calculate_label = get_option('rst_user_calculate', 'Calculate');
$rst_user_submit_btn_text = get_option('rst_user_submit_btn_text', 'Submit Testimonial');
$rst_save_success_text = rst_user_retrive_messages('rst_save_success_text', __('Thank you for your valuable comments. Stay with us.', 'really-simple-testimonials'));
$rst_save_error_text = rst_user_retrive_messages('rst_save_error_text', __('Please fill-up all the info again.','really-simple-testimonials'));
$rst_file_mishmatch_text = rst_user_retrive_messages('rst_file_mishmatch_text', __('Only jpg, png and jpeg is accepted. Please try again.', 'really-simple-testimonials'));
$rst_calc_error_text = rst_user_retrive_messages('rst_calc_error_text', __('Calculation is incorrect. Please try again.', 'really-simple-testimonials'));

$show_captcha = in_array('Calculate', $selected_fields);
$show_logo = false;
foreach ($selected_fields as $field) {
    if (strpos($field, "Image/Logo") !== false || strpos($field, "Image") !== false) {
        $show_logo = true;
        break;
    }
}

$captcha_num1 = $show_captcha ? wp_rand(1, 10) : 0;
$captcha_num2 = $show_captcha ? wp_rand(1, 10) : 0;
?>

<div class="smart-wrap rst_frontend_form">
    <div class="smart-forms smart-container wrap-2">
        <div class="form-header header-primary"><h4><?php echo esc_html($rst_user_title); ?></h4></div>
        <form method="post" id="rst_frontend_submit_form" name="new_post" action="" class="wpcf7-form" enctype="multipart/form-data">
            <?php wp_nonce_field('rst_frontend_submit_action', 'rst_frontend_nonce'); ?>
            <div class="form-body">
                <?php if (in_array('Title', $selected_fields)): ?>
                <div class="frm-row">
                    <div class="section colm colm12">
                        <label class="field prepend-icon">
                            <span class="field-icon"><?php echo esc_html($rst_user_title); ?></span>
                            <input type="text" name="rst_title" id="rst_title" class="gui-input" placeholder="<?php echo esc_attr($rst_user_title); ?>">
                        </label>
                    </div>
                </div>
                <?php endif; ?>

                <div class="frm-row">
                    <?php if (in_array('Name', $selected_fields)): ?>
                    <div class="section colm colm6">
                        <label class="field prepend-icon">
                            <span class="field-icon"><?php echo esc_html($rst_user_name_label); ?></span>
                            <input type="text" name="rst_name" id="rst_name" class="gui-input" placeholder="<?php echo esc_attr($rst_user_name_label); ?>" required>
                        </label>
                    </div>
                    <?php endif; ?>

                    <?php if (in_array('Designation', $selected_fields)): ?>
                    <div class="section colm colm6">
                        <label class="field prepend-icon">
                            <span class="field-icon"><?php echo esc_html($rst_user_designation_label); ?></span>
                            <input type="text" name="rst_designation" id="rst_designation" class="gui-input" placeholder="<?php echo esc_attr($rst_user_designation_label); ?>">
                        </label>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if (in_array('Company Name', $selected_fields)): ?>
                <div class="section">
                    <label class="field prepend-icon">
                        <span class="field-icon"><?php echo esc_html($rst_user_company_name_label); ?></span>
                        <input type="text" name="rst_company_name" id="rst_company_name" class="gui-input" placeholder="<?php echo esc_attr($rst_user_company_name_label); ?>">
                    </label>
                </div>
                <?php endif; ?>

                <?php if (in_array('Company URL', $selected_fields)): ?>
                <div class="section">
                    <label class="field prepend-icon">
                        <span class="field-icon"><?php echo esc_html($rst_user_company_url_label); ?></span>
                        <input type="url" name="rst_company_url" id="rst_company_url" class="gui-input" placeholder="<?php echo esc_attr($rst_user_company_url_label); ?>">
                    </label>
                </div>
                <?php endif; ?>

                <?php if (in_array('Rating', $selected_fields)): ?>
                <div class="section">
                    <label class="field select">
                        <span class="field-icon"><?php echo esc_html($rst_user_rating_label); ?></span>
                        <select id="rst_rating" name="rst_rating" required>
                            <option value=""><?php echo esc_html($rst_user_rating_label); ?>...</option>
                            <option value="5">5</option>
                            <option value="4.5">4.5</option>
                            <option value="4">4</option>
                            <option value="3.5">3.5</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                        <i class="arrow double"></i>
                    </label>
                </div>
                <?php endif; ?>

                <?php if (in_array('Categories', $selected_fields)): ?>
                <div class="section">
                    <label class="field select">
                        <span class="field-icon"><?php echo esc_html($rst_user_categories_label); ?></span>
                        <?php
                        $categories = get_terms(array(
                            'taxonomy'   => 'rst_testimonial_category',
                            'hide_empty' => false,
                        ));
                        if (!empty($categories) && !is_wp_error($categories)):
                        ?>
                        <select id="rst_categories" name="rst_categories[]" multiple class="gui-input">
                            <?php foreach ($categories as $category): ?>
                            <option value="<?php echo esc_attr($category->term_id); ?>"><?php echo esc_html($category->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php else: ?>
                        <input type="text" name="rst_categories_none" class="gui-input" placeholder="<?php esc_attr_e('No categories found', 'really-simple-testimonials'); ?>" disabled>
                        <?php endif; ?>
                        <i class="arrow double"></i>
                    </label>
                </div>
                <?php endif; ?>

                <?php if (in_array('Testimonial Message', $selected_fields)): ?>
                <div class="section">
                    <label class="field prepend-icon">
                        <span class="field-icon"><?php echo esc_html($rst_user_testi_text_label); ?></span>
                        <textarea class="gui-textarea" rows="9" id="rst_testimonial" name="rst_testimonial" placeholder="<?php echo esc_attr($rst_user_testi_text_label); ?>" required></textarea>
                    </label>
                </div>
                <?php endif; ?>

                <?php if ($show_logo): ?>
                <div class="section">
                    <label class="field prepend-icon">
                        <span class="field-icon"><?php echo esc_html($rst_user_logo_img_label); ?></span>
                        <input type="file" name="rst_user_image" id="rst_user_image" class="gui-input" accept="image/jpeg,image/jpg,image/png">
                        <small class="help-text"><?php echo esc_html($rst_file_mishmatch_text); ?></small>
                    </label>
                </div>
                <?php else: ?>
                <?php if (defined('WP_DEBUG') && WP_DEBUG): ?>
                <div class="section" style="background:#ffffcc;padding:10px;margin:10px 0;">
                    <strong>Debug:</strong> Logo field not shown. Selected fields: <?php echo esc_html(implode(', ', $selected_fields)); ?>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <?php if ($show_captcha): ?>
                <div class="section">
                    <label class="field prepend-icon">
                        <span class="field-icon"><?php echo esc_html($rst_user_calculate_label); ?></span>
                        <div class="captcha-wrapper">
                            <span class="captcha-question"><?php echo esc_html($captcha_num1); ?> + <?php echo esc_html($captcha_num2); ?> = </span>
                            <input type="number" name="rst_captcha" id="rst_captcha" class="gui-input captcha-input" required>
                            <input type="hidden" name="rst_captcha_sum" id="rst_captcha_sum" value="<?php echo esc_attr($captcha_num1 + $captcha_num2); ?>">
                        </div>
                    </label>
                </div>
                <?php endif; ?>

                <div class="section">
                    <input type="submit" id="rst_submit_btn" class="button btn-primary" value="<?php echo esc_attr($rst_user_submit_btn_text); ?>">
                    <span class="rst-spinner" style="display:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12a9 9 0 1 1-6.219-8.56"></path>
                        </svg>
                    </span>
                </div>

                <div id="rst_form_message" style="display:none;"></div>
            </div>
        </form>
    </div>
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

#rst_form_message {
    margin-top: 20px;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    font-size: 15px;
    line-height: 1.5;
}

#rst_form_message.success {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-left: 5px solid #48bb78;
}

#rst_form_message.error {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
    color: #fff;
    border-left: 5px solid #f56565;
}

#rst_form_message p {
    margin: 0;
    padding: 0;
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
    $('#rst_frontend_submit_form').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var submitBtn = $('#rst_submit_btn');
        var spinner = $('.rst-spinner');
        var messageDiv = $('#rst_form_message');
        var formData = new FormData(this);
        var originalBtnText = submitBtn.val();
        
        submitBtn.prop('disabled', true).val('Submitting...').css('opacity', '0.7');
        spinner.fadeIn();
        messageDiv.hide().removeClass('rst-animation-fade-in');
        
        formData.append('action', 'rst_handle_frontend_submission');
        
        console.log('Form data being sent:');
        for (var pair of formData.entries()) {
            console.log(pair[0], pair[1]);
        }
        
        $.ajax({
            url: rst_frontend_ajax.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('Response:', response);
                
                submitBtn.prop('disabled', false).val(originalBtnText).css('opacity', '1');
                spinner.fadeOut();
                
                if (response.success) {
                    messageDiv.removeClass('error').addClass('success rst-animation-fade-in').html('<p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;margin-right:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>' + response.data.message + '</p>').fadeIn(300);
                    
                    form[0].reset();
                    if ($('#rst_captcha_sum').length) {
                        var num1 = Math.floor(Math.random() * 10) + 1;
                        var num2 = Math.floor(Math.random() * 10) + 1;
                        $('.captcha-question').text(num1 + ' + ' + num2 + ' = ');
                        $('#rst_captcha_sum').val(num1 + num2);
                    }
                    
                    $('html, body').animate({
                        scrollTop: messageDiv.offset().top - 50
                    }, 500);
                } else {
                    messageDiv.removeClass('success').addClass('error rst-animation-fade-in').html('<p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;margin-right:8px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>' + response.data.message + '</p>').fadeIn(300);
                }
                
                setTimeout(function() {
                    messageDiv.fadeOut(500);
                }, 5000);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', xhr, status, error);
                
                submitBtn.prop('disabled', false).val(originalBtnText).css('opacity', '1');
                spinner.fadeOut();
                
                messageDiv.removeClass('success').addClass('error rst-animation-fade-in').html('<p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;margin-right:8px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><?php echo esc_js($rst_save_error_text); ?></p>').fadeIn(300);
                
                setTimeout(function() {
                    messageDiv.fadeOut(500);
                }, 5000);
            }
        });
    });
});
</script>

