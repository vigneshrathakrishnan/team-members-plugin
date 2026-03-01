<?php
if (!defined('ABSPATH')) exit;

class TS_Team_Member_Post_Type {

    public function __construct() {
        add_action('init', [$this, 'register_post_type']);
    }

    public function register_post_type() {
        register_post_type('team_member', [
            'labels' => [
                'name' => 'Team Members',
                'singular_name' => 'Team Member'
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'team'],
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true
        ]);
    }
}