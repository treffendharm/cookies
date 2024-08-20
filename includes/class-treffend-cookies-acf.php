<?php

class Treffend_Cookies_ACF
{

    public static function init()
    {
        if (!class_exists('ACF')) {
            return;
        }

        // Add ACF-specific functionality here
        add_action('acf/include_fields', function () {
            if (! function_exists('acf_add_local_field_group')) {
                return;
            }

            acf_add_local_field_group(array(
                'key' => 'group_66bc9946034dc',
                'title' => 'Cookie options',
                'fields' => array(
                    array(
                        'key' => 'field_66bc9946a613c',
                        'label' => 'Code',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'left',
                        'endpoint' => 0,
                        'selected' => 0,
                    ),
                    array(
                        'key' => 'field_66bc9954a613d',
                        'label' => 'Inside head code',
                        'name' => 'treffend_cookie-code_head',
                        'aria-label' => '',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                        'delay' => 0,
                    ),
                    array(
                        'key' => 'field_66bc9967a613e',
                        'label' => 'Top body code',
                        'name' => 'treffend_cookie-code_top_body',
                        'aria-label' => '',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                        'delay' => 0,
                    ),
                    array(
                        'key' => 'field_66bc9974a613f',
                        'label' => 'Bottom body code',
                        'name' => 'treffend_cookie-code_bottom_body',
                        'aria-label' => '',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                        'delay' => 0,
                    ),
                    array(
                        'key' => 'field_66bc9985a6140',
                        'label' => 'Cookie banner',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'left',
                        'endpoint' => 0,
                        'selected' => 0,
                    ),
                    array(
                        'key' => 'field_66c3083bb0d9c',
                        'label' => 'Banner style',
                        'name' => 'treffend_cookie-banner_style',
                        'aria-label' => '',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'banner-right_bottom' => 'Bottom right',
                            'banner-left_bottom' => 'Bottom left',
                            'bar-bottom' => 'Bottom full width',
                        ),
                        'default_value' => 'banner-right_bottom',
                        'return_format' => 'value',
                        'multiple' => 0,
                        'allow_null' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                    array(
                        'key' => 'field_66bc9995a6141',
                        'label' => 'Banner title',
                        'name' => 'treffend_cookie-banner_title',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_66bc99b0a6142',
                        'label' => 'Text',
                        'name' => 'treffend_cookie-banner_text',
                        'aria-label' => '',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                        'delay' => 0,
                    ),
                    array(
                        'key' => 'field_66bc99c7a6143',
                        'label' => 'Accept button title',
                        'name' => 'treffend_cookie-button_accept',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_66bc99e7a6144',
                        'label' => 'Decline button title',
                        'name' => 'treffend_cookie-button_decline',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'cookie-options',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'seamless',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
                'show_in_rest' => 0,
            ));
        });

        add_action('acf/init', function () {
            acf_add_options_page(array(
                'page_title'  => 'Cookies',
                'menu_slug'   => 'cookie-options',
                'position'    => '',
                'parent_slug' => 'options-general.php', // This places the page under "Settings"
                'redirect'    => false,
                'description' => 'Change the cookie settings',
                'menu_icon'   => array(
                    'type'  => 'dashicons',
                    'value' => 'dashicons-info',
                ),
                'icon_url'    => 'dashicons-info',
            ));
        });
    }
}
