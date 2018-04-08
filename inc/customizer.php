<?php
/**
 * Manage WordPress customizer
 *
 * Author: DezoDev | @dezodev
 * URL: http://dezodev.tk/
 */


function dezo_customizer_settings( $wp_customize ) {
    $wp_customize->add_section( 'dezo_theme_options' , array(
        'title'      => __('Theme options', 'dez-starter'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting( 'dezo_post_meta_authors_display' , array(
        'default'     => true,
        'transport'   => 'refresh',
    ) );

    $wp_customize->add_control( 'dezo_post_meta_authors_display', array(
        'label' => 'Display authors in post meta options',
        'section' => 'dezo_theme_options',
        'settings' => 'dezo_post_meta_authors_display',
        'type' => 'radio',
        'choices' => array(
            'show' => 'Show authors',
            'hide' => 'Hide authors',
        ),
    ));
}
add_action('customize_register', 'dezo_customizer_settings');
