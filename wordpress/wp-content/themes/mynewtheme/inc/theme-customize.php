<?php
function mynewtheme_customizer($wp_customize)
{
    // =============== Footer Section ===============
    // Add Section
    $wp_customize->add_section(
        'mynewtheme_footer_section',
        array(
            'title' => __('Footer Text', 'Mynewtheme'),
            'priority' => 4,
        )
    );
    // Add Setting copyright
    $wp_customize->add_setting(
        'mynewtheme_footer_text',
        array(
            'default' => 'Copyright &copy; Mynewtheme. All rights reserved.',
            'section' => 'mynewtheme_footer_section',
        )
    );
    // Add Control copyright
    $wp_customize->add_control(
        'mynewtheme_footer_text',
        array(
            'label' => __('Coppyright', 'Mynewtheme'),
            'section' => 'mynewtheme_footer_section',
            'type' => 'text',
        )
    );
    // Add Setting additional info
    $wp_customize->add_setting(
        'mynewtheme_footer_info',
        array(
            'default' => 'Developed by Mynewtheme',
            'section' => 'mynewtheme_footer_section',
        )
    );
    // Add Control additional info
    $wp_customize->add_control(
        'mynewtheme_footer_info',
        array(
            'label' => __('Additional Info', 'Mynewtheme'),
            'section' => 'mynewtheme_footer_section',
            'type' => 'textarea',
        )
    );


    // Add Setting additional info
    $wp_customize->add_setting(
        'mynewtheme_footer_main_text',
        array(
            'default' => 'Developed by lorem',
            'section' => 'mynewtheme_footer_section',
        )
    );
    // Add Control additional info
    $wp_customize->add_control(
        'mynewtheme_footer_main_text',
        array(
            'label' => __('Footer Main Text', 'Mynewtheme'),
            'section' => 'mynewtheme_footer_section',
            'type' => 'textarea',
        )
    );

    // ========================= Logo =========================
    // Add Section
    $wp_customize->add_section(
        'mynewtheme_logo_section',
        array(
            'title'    => __('Logo', 'Mynewtheme'),
            'priority' => 30,
        )
    );
    // Add Setting
    $wp_customize->add_setting(
        'mynewtheme_logo',
        array(
            'sanitize_callback' => 'absint',
        )
    );
    // Add Control
    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'mynewtheme_logo',
            array(
                'label'     => __('Upload Logo', 'Mynewtheme'),
                'section'   => 'mynewtheme_logo_section',
                'mime_type' => 'image',
            )
        )
    );
}
add_action('customize_register', 'mynewtheme_customizer');
