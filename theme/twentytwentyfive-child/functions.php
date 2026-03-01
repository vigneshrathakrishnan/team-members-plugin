<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue Parent + Child Styles
 */
function ttf_child_enqueue_styles() {

    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_style(
        'child-team-member-style',
        get_stylesheet_directory_uri() . '/assets/css/team-member.css',
        ['parent-style'],
        '1.0'
    );

    wp_enqueue_script(
        'child-team-member-script',
        get_stylesheet_directory_uri() . '/assets/js/team-member.js',
        [],
        '1.0',
        true
    );
}

add_action('wp_enqueue_scripts', 'ttf_child_enqueue_styles');