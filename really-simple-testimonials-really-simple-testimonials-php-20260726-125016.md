# Plugin Check Report

**Plugin:** Really Simple Testimonials
**Generated at:** 2026-07-26 12:50:16


## `admin/rst-admin-shortcode.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 265 | 215 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$checked'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 265 | 283 | ERROR | WordPress.WP.I18n.NonSingularStringLiteralText | The $text parameter must be a single text string literal. Found: $category->cat_name | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#basic-strings) |
| 327 | 104 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'plugin_dir_url'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 331 | 104 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'plugin_dir_url'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 335 | 104 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'plugin_dir_url'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 339 | 104 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'plugin_dir_url'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 343 | 104 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'plugin_dir_url'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 366 | 106 | ERROR | WordPress.WP.I18n.MissingArgDomain | Missing $domain parameter in function call to esc_attr__(). | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 1556 | 79 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_short_code_mt_box_nonce&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1556 | 79 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_POST[&#039;rst_short_code_mt_box_nonce&#039;] |  |
| 1568 | 97 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;testimonial_cat_name&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1575 | 84 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_name_color_option&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1580 | 91 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_designation_color_option&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1585 | 86 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_testimonial_themes&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1590 | 91 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_testimonial_theme_style&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1595 | 89 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_testimonial_textalign&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1600 | 83 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_order_by_option&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1604 | 79 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_image_sizes&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1609 | 79 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;dpstotoal_items&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1614 | 81 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_img_show_hide&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1619 | 85 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_img_border_radius&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1624 | 90 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_imgborder_width_option&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1629 | 89 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_imgborder_color_option&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1634 | 89 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_designation_show_hide&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1639 | 85 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_company_show_hide&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1644 | 84 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_company_url_color&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1649 | 88 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_name_fontsize_option&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1654 | 82 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_name_font_case&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1659 | 83 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_name_font_style&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1664 | 84 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_designation_case&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1669 | 90 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_designation_font_style&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1674 | 89 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_desig_fontsize_option&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1679 | 85 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_content_show_hide&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1685 | 91 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_content_fontsize_option&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1690 | 83 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_content_bg_color&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1695 | 83 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_content_padding&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1700 | 90 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_rating_fontsize_option&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1705 | 80 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_content_color&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1710 | 89 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_content_border_radius&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1715 | 86 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_show_rating_option&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1720 | 87 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_show_item_bg_option&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1725 | 79 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_rating_color&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1730 | 80 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_item_bg_color&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1734 | 80 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_item_padding&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1739 | 86 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_item_border_radius&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1744 | 84 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_item_border_color&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1751 | 71 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;item_no&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1756 | 68 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;loop&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1762 | 70 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;margin&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1767 | 68 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;dots&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1772 | 78 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;dots_text_color&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1777 | 76 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;dots_bg_color&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1782 | 74 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;navigation&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1787 | 80 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;navigation_align&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1792 | 80 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;navigation_style&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1797 | 74 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;pagination&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1802 | 80 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;pagination_align&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1807 | 80 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;pagination_style&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1813 | 82 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;pagination_bg_color&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1818 | 89 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;pagination_bg_color_active&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1823 | 72 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;autoplay&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1828 | 24 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;autoplay_speed&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1828 | 24 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_POST[&#039;autoplay_speed&#039;] |  |
| 1836 | 72 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;autoplay_speed&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1836 | 72 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_POST[&#039;autoplay_speed&#039;] |  |
| 1838 | 90 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;autoplay_speed&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1847 | 74 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;stop_hover&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1852 | 76 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;itemsdesktop&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1857 | 81 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;itemsdesktopsmall&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1862 | 75 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;itemsmobile&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1867 | 79 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;autoplaytimeout&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1872 | 77 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;nav_text_color&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1877 | 83 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;nav_text_color_hover&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1882 | 75 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;nav_bg_color&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1887 | 81 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;nav_bg_color_hover&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1892 | 73 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;nav_value&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1899 | 74 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;active_tab&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1917 | 22 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 1917 | 65 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 1917 | 65 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_GET[&#039;active_tab&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |

## `admin/rst-admin-testimonial.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 99 | 19 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 99 | 38 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 184 | 40 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'admin_url'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 376 | 90 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_testimonial_inner_custom_box_nonce&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 376 | 90 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_POST[&#039;rst_testimonial_inner_custom_box_nonce&#039;] |  |
| 381 | 45 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;post_title&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 386 | 49 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;position_input&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 391 | 48 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;company_input&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 396 | 48 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;company_website_input&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 401 | 60 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;company_link_target_list&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 406 | 62 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;company_rating_target_list&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 411 | 57 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;testimonial_text_input&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 514 | 85 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_testimonial_repeaterBox_nonce&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 514 | 85 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_POST[&#039;rst_testimonial_repeaterBox_nonce&#039;] |  |
| 533 | 56 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;title&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 538 | 56 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;tdesc&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 545 | 50 | ERROR | WordPress.WP.AlternativeFunctions.strip_tags_strip_tags | strip_tags() is discouraged. Use the more comprehensive wp_strip_all_tags() instead. |  |

## `admin/templates/theme_5_grid/theme_5.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 167 | 80 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$rst_rating_color'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |

## `admin/rst-frontend-form.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 12 | 5 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 12 | 57 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_print_r | print_r() found. Debug code should not normally be used in production. |  |
| 40 | 33 | ERROR | WordPress.WP.AlternativeFunctions.rand_rand | rand() is discouraged. Use the far less predictable wp_rand() instead. |  |
| 41 | 33 | ERROR | WordPress.WP.AlternativeFunctions.rand_rand | rand() is discouraged. Use the far less predictable wp_rand() instead. |  |

## `admin/rst-user-form-options.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 19 | 75 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rstoptions&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 23 | 61 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_user_title&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 27 | 60 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_user_name&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 31 | 67 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_user_designation&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 35 | 68 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_user_company_name&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 39 | 67 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_user_company_url&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 43 | 62 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_user_rating&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 47 | 66 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_user_testi_text&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 51 | 66 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_user_categories&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 55 | 64 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_user_logo_img&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 59 | 65 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_user_calculate&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 63 | 62 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_post_status&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 67 | 71 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_user_submit_btn_text&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 71 | 72 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_save_success_text&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 75 | 70 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_save_error_text&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 79 | 74 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_file_mishmatch_text&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 83 | 70 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_calc_error_text&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 508 | 5 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 508 | 40 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_print_r | print_r() found. Debug code should not normally be used in production. |  |
| 509 | 5 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 509 | 41 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_print_r | print_r() found. Debug code should not normally be used in production. |  |
| 514 | 67 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_name&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 517 | 43 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_title&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 524 | 80 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_testimonial&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 536 | 9 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 540 | 5 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 543 | 64 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_name&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 544 | 9 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 544 | 56 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_name&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 548 | 68 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_designation&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 549 | 75 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_designation&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 550 | 9 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 550 | 63 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_designation&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 554 | 67 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_company_name&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 555 | 76 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_company_name&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 556 | 9 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 556 | 64 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_company_name&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 560 | 67 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_company_url&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 561 | 67 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_company_url&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 562 | 9 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 562 | 55 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_company_url&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 566 | 81 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_rating&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 567 | 70 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_rating&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 568 | 9 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 568 | 58 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;rst_rating&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 573 | 9 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 581 | 13 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 586 | 26 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_FILES[&#039;rst_user_image&#039;] |  |
| 596 | 17 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 612 | 13 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 614 | 13 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 626 | 13 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 633 | 5 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |

## `really-simple-testimonials.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 24 | 5 | WARNING | PluginCheck.CodeAnalysis.DiscouragedFunctions.load_plugin_textdomainFound | load_plugin_textdomain() has been discouraged since WordPress version 4.6. When your plugin is hosted on WordPress.org, you no longer need to manually include this function call for translations under your plugin slug. WordPress will automatically load the translations for you as needed. | [Docs](https://make.wordpress.org/core/2016/07/06/i18n-improvements-in-4-6/) |
